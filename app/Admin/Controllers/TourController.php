<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form;
use App\Models\TaxonomyItem;
use App\Models\TourDetail;
use Encore\Admin\Grid;
use App\Models\Tour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Utility;

class TourController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tour';

    /**
     * @param string $keyRelationship
     * @param Form $form
     * @param $type
     * @return void
     */
    function saveImages(string $keyRelationship, Form $form, $type): void
    {
        $requestDetailList = request($keyRelationship, []);
        foreach ($requestDetailList as $key => $requestDetail) {
            if ($requestDetail['_remove_'] == 1) {
                $form->model()->detailFeature()->where('id', $key)->delete();
                continue;
            }
            $detailFeature = $form->model()->$keyRelationship->where('id', $key)->first();
            $images = $this->convertKey($detailFeature['images'] ?? []);
            $requestImages = $requestDetail['images'] ?? [];
            $imageList = [];
            foreach ($requestImages as $key2 => $requestImage) {
                if ($key2 == '__key_images__') {
                    continue;
                }
                if ($requestImage['_remove_'] == 1) {
                    continue;
                }
                if (request()->hasFile("$keyRelationship.$key.images.$key2.url")) {
//                    $imageList[$key2]['url'] = Storage::disk('admin')->putFile(
//                        'images',
//                        request()->file("$keyRelationship.$key.images.$key2.url")
//                    );
                    $imageList[$key2]['url'] = \App\Files\Storage::putFile('admin', 'images', request()->file("$keyRelationship.$key.images.$key2.url"));
                } else {
                    $imageList[$key2]['url'] = $images[$key2]['url'] ?? '';
                }
            }
            $requestDetail['images'] = $imageList;
            $requestDetail['type'] = $type;
            $form->model()->$keyRelationship()->updateOrCreate(['id' => $key], $requestDetail);
        }
        $form->ignore($keyRelationship);
    }

    /**
     * @param Form $form
     * @return void
     */
    function tourImages(Form $form): void
    {
        $tourImages = $this->convertKey($form->model()->images);
        $requestImages = request('tour_images', []);
        $images = [];
        foreach ($requestImages as $key => $requestImage) {
            if ($requestImage['_remove_'] == 1) {
                continue;
            }
            if (request()->hasFile("tour_images.$key.image")) {
//                $images[$key]['image'] = Storage::disk('admin')->putFile(
//                    'images',
//                    request()->file("tour_images.$key.image")
//                );

                $images[$key]['image'] = \App\Files\Storage::putFile('admin', 'images', request()->file("tour_images.$key.image"));
            } else {
                $images[$key]['image'] = $tourImages[$key]['image'] ?? '';
            }
        }
        $form->ignore('tour_images');
        $form->model()->images = $images;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tour());
        $grid->model()->orderBy('created_at', 'desc');
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', __('Tên tour'));
        });
        $grid->column('id', __('Id'));
        $grid->column('image', __('Hình ảnh'))->display(function ($thumbnail) {
            if (!$thumbnail) return '';
            return "<img src='".Storage::disk('admin')->url($thumbnail)."' style='width: 100px; height: 100px;'>";
        });
        $grid->column('name', __('Tên tour'));
        $grid->column('status', __('Trạng thái'))->switch();
        $grid->column('hot', __('Tour nổi bật'))->switch();
        $grid->column('slide', __('Tour slide'))->switch();
        $grid->column('created_at',  __('Ngày tạo'))->display(function ($created_at) {
            return date('d-m-Y H:i:s', strtotime($created_at));
        });
        $grid->column('updated_at', __('Ngày cập nhật'))->display(function ($updated_at) {
            return date('d-m-Y H:i:s', strtotime($updated_at));
        });
        $grid->actions(function ($actions) {
            $actions->disableView();
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param  $id
     * @return \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
     */
    protected function detail($id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        return redirect('/admin/tours/' . $id . '/edit');
    }

    /**
     * Make a form builder.
     *
     */
    protected function form()
    {
        $form = new Form(new Tour());
        $form->tools(function ($tools) {
            $tools->disableView();
        });
        $form->setTitle('Tạo mới tour');
        //hide footer
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $form->editing(function (Form $form) {
            $form->model()->tour_images = $this->convertKey($form->model()->images);
        });

        $form->tab('Cơ bản', function ($form) {
            $cats = Taxonomyitem::where('taxonomy_id',config('admin.category_location_id'))->orderBy('order','ASC')->get();
            $listdatas = array();
            foreach($cats as $k => $v){
                $tmp['id'] = $v['id'];
                $tmp['name'] = $v['name'];
                $tmp['parent'] = $v['parent_id'];
                $listdatas[$k] = $tmp;
            }
            $tree =array();
            $listdatas1  = $listdatas;
            $listree = \Utility::listtree($listdatas1,0,$tree);
            $options= [];
            foreach ($listree as $row) {
                $options[$row['id']] = $row['name'];
            }
            $optionsLoactionStart = [];
            $locationStarts = TaxonomyItem::where('taxonomy_id',config('admin.start_location'))->orderBy('order','ASC')->get();
            foreach ($locationStarts as $row){
                $optionsLoactionStart[$row['name']] = $row['name'];
            }
            $cats = Taxonomyitem::where('taxonomy_id',config('admin.category_way_tour'))->orderBy('order','ASC')->get();
            $listdatas = array();
            foreach($cats as $k => $v){
                $tmp['id'] = $v['id'];
                $tmp['name'] = $v['name'];
                $tmp['parent'] = $v['parent_id'];
                $listdatas[$k] = $tmp;
            }
            $tree =array();
            $listdatas1  = $listdatas;
            $listree = \Utility::listtree($listdatas1,0,$tree);
            $optionWays= [];
            foreach ($listree as $row) {
                $optionWays[$row['id']] = $row['name'];
            }
            $form->text('name', __('Tên'))->required()->rules('required');
            $form->text('slug',__('Link'));
            $form->currency('price', 'Giá')->symbol('VND');
            $form->currency('price_old', 'Giá cũ')->symbol('VND');
            $form->currency('price_discount', 'Giá ưu đãi')->symbol('VND');
            $form->select('location_id', __('Filter địa điểm'))->options($options);
            $form->select('way_id', __('Filter tour đường bộ'))->options($optionWays);
            //$form->text('experience_title', __('Tiêu đề trải nghiệm'));
            $form->text('experience_video', __('Video trải nghiệm'));
            //$form->text('location_start', __('Xuất phát'));
            $form->select('location_start', __('Xuất phát'))->options($optionsLoactionStart);
            $form->tinyEditor('info', __('Thông tin tour(Nhập dưới dạng bảng)'));
            $form->tinyEditor('note', __('Ghi chú (Nhập dưới dạng bảng)'));
            $form->number('days', __('Số ngày'));
            $form->number('nights', __('Số đêm'));
            $form->image('image', __('Ảnh đại diện'))->help('<b style="color:red">(Nên up ảnh có độ phân giải 1000x900)</b>')
                ->name(function ($file) {
                    return \App\Files\Storage::getFileName($file);
                });
                //kip original name
            $form->table('tour_images', 'Hình ảnh slide', function ($table) {
                $table->image('image', 'Hình ảnh')->help('<b style="color:red">(Nên up ảnh có độ phân giải 1920x960)</b>');
            });
            $form->switch('status', __('Trạng thái'))->default(1);
            $form->switch('hot', __('Tour nổi bật'))->default(0);
            $form->switch('slide', __('Tour slide'))->default(0);
        });
        $form->tab('Lộ trình', function ($form) {
            $form->hasMany('routes', '', function ($form1) {
                $form1->select('day', 'Ngày')->options(function () {
                    $days = [];
                    for ($i = 1; $i <= config('admin.max_day_of_tour'); $i++) {
                        $days[$i] = 'Ngày ' . $i;
                    }
                    return $days;
                });
                $form1->number('order', 'Thứ tự');
                $form1->text('name', 'Địa điểm');
            })->required();
        });
        $form->tab('Hình ảnh nổi bật', function ($form) {
            $form->hasMany('detailFeature', '', function ($form1) {
                $form1->select('day', 'Ngày')->options(function () {
                    $days = [];
                    for ($i = 1; $i <= config('admin.max_day_of_tour'); $i++) {
                        $days[$i] = 'Ngày ' . $i;
                    }
                    return $days;
                })->required();
                $form1->tinyEditor('description', 'Mô tả');
                $form1->tinyEditor('note', 'Ghi chú');
                $form1->images('images', 'Danh sách hình ảnh');
            });
        });

        $form->tab('Hình ảnh phương tiện', function ($form) {
            $form->hasMany('detailVehicle', '', function ($form1) {
                $form1->select('day', 'Ngày')->options(function () {
                    $days = [];
                    for ($i = 1; $i <= config('admin.max_day_of_tour'); $i++) {
                        $days[$i] = 'Ngày ' . $i;
                    }
                    return $days;
                })->required();
                //$form1->textarea('description', 'Mô tả');
                $form1->tinyEditor('note', 'Ghi chú');
                $form1->images('images', 'Danh sách hình ảnh');
            });
        });

        $form->tab('Hình ảnh ẩm thực', function ($form) {
            $form->hasMany('detailFood', '', function ($form1) {
                $form1->select('day', 'Ngày')->options(function () {
                    $days = [];
                    for ($i = 1; $i <= config('admin.max_day_of_tour'); $i++) {
                        $days[$i] = 'Ngày ' . $i;
                    }
                    return $days;
                })->required();
                //$form1->textarea('description', 'Mô tả');
                $form1->tinyEditor('note', 'Ghi chú');
                $form1->images('images', 'Danh sách hình ảnh');
            });
        });


        $form->tab('Hình ảnh lưu trú', function ($form) {
            $form->hasMany('detailHotel', '', function ($form1) {
                $form1->select('day', 'Ngày')->options(function () {
                    $days = [];
                    for ($i = 1; $i <= config('admin.max_day_of_tour'); $i++) {
                        $days[$i] = 'Ngày ' . $i;
                    }
                    return $days;
                })->required();
                //$form1->textarea('description', 'Mô tả');
                $form1->tinyEditor('note', 'Ghi chú');
                $form1->images('images', 'Danh sách hình ảnh');
            });
        });

        $form->tab('Giá tour', function ($form) {
            $form->hasMany('tourPrices', '', function ($form1) {
                $form1->currency('price', 'Giá')->symbol('VND');
                $form1->tags('days', 'Các ngày(vd: 18/06/2024)');
                /*$form1->multipleSelect('days', 'Các ngày')->options(function () {
                    $days = [];
                    for ($i = 1; $i <= config('admin.max_day_of_tour'); $i++) {
                        $days[$i] = 'Ngày ' . $i;
                    }
                    return $days;
                });*/
                //$form1->textarea('description', 'Mô tả');
            });
        });

        /*$form->tab('Ghi chú', function ($form) {
            $form->hasMany('tourNotes', '', function ($form1) {
                $form1->select('type', 'Bao gồm/Không bao gồm')->options([1 => 'Bao gồm', 2 => 'Không bao gồm']);
                $form1->ckeditor('note', 'Nội dung');
            });
        });*/
        $form->saving(function (\Encore\Admin\Form $form) {
            $request = Request::all();
            if(!isset($request["_edit_inline"]) && !empty($form->name)) {
                if (empty(trim(strip_tags($form->slug)))) {
                    $form->slug = Utility::slug(trim(strip_tags($form->name)), "tours", $form->model()->id);
                } else {
                    $count = Tour::where('slug', $form->slug)->where('id', '<>', $form->model()->id)->count();
                    if ($count) {
                        $form->slug = Utility::slug(trim(strip_tags($form->name)), "tours");
                    }
                }
            }
        });
        $form->submitted(function (Form $form) {
            $form->model()->save();
            $request = Request::all();
            if(!isset($request["_edit_inline"])) {
                $this->tourImages($form);
                $this->saveImages('detailFeature', $form, TourDetail::FEATURE);
                $this->saveImages('detailVehicle', $form, TourDetail::VEHICLE);
                $this->saveImages('detailFood', $form, TourDetail::FOOD);
                $this->saveImages('detailHotel', $form, TourDetail::HOTEL);
            }
        });



        return $form;
    }


}
