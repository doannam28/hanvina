<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customer());
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', __('Tên khách hàng'));
        });

        $grid->column('id', __('Id'));
        $grid->column('avatar', __('Avatar'))->display(function ($thumbnail) {
            if (!$thumbnail) return '';
            return "<img src='".Storage::disk('admin')->url($thumbnail)."' style='max-width: 50px; height: 50px;'>";
        });
        $grid->column('images', __('Hình ảnh'))->display(function ($images) {
            $html = '';
            foreach ($images as $image) {
                $html .= "<img src='" . Storage::disk('admin')->url($image['image']) . "' style='width: 50px; height: 50px;'/>";
                break;
            }
            return $html;
        });
        $grid->column('name', __('Tên khách hàng'));
        $grid->column('content', __('Nội dung'));
        $grid->column('status', __('Trạng thái'))->switch();
        $grid->column('order', __('Thứ tự'))->editable();
        $grid->column('created_at', __('Ngày tạo'))->display(function ($created_at) {
            return date('d/m/Y H:i', strtotime($created_at));
        });
        $grid->column('updated_at', __('Ngày cập nhật'))->display(function ($updated_at) {
            return date('d/m/Y H:i', strtotime($updated_at));
        });
        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    protected function detail($id): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return redirect('/admin/customers/'.$id.'/edit');
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Customer());

        $form->tools(function ($tools) {
            $tools->disableView();
        });
        //hide footer
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $form->text('name', __('Tên khách hàng'))->required();
        $form->editing(function ($form) {
            $model = $form->model();
            $model->customer_images = $this->convertKey($model->images);
        });
        $form->image('avatar', __('Avatar'))->help('<b style="color:red">(Nên upload ảnh có độ phân giải 1000x1000)</b>')
            ->name(function ($file) {
                return \App\Files\Storage::getFileName($file);
            });
        $form->table('customer_images', 'Hình ảnh', function ($table) {
            $table->image('image')->uniqueName()->help('<b style="color:red">(Nên upload ảnh có độ phân giải 1440x1024)</b>');
            $table->number('order', 'Thứ tự')->default(1);
        });

        $form->textarea('content', __('Nội dung'));
        $form->switch('status', __('Trạng thái'));
        $form->number('order', __('Thứ tự'))->default(0);
        $form->submitted(function ($form){
            $request = Request::all();
            if(!isset($request["_editable"]) && !isset($request["_edit_inline"])) {
                $imageRequests = request('customer_images', []);
                $imageList = $this->convertKey($form->model()->images);
                $images = [];
                foreach ($imageRequests as $key => $imageRequest) {
                    if ($imageRequest['_remove_'] == 1) {
                        continue;
                    }
                    if (request()->hasFile("customer_images.$key.image")) {
//                        $images[$key]['image'] = Storage::disk('admin')->putFile('images', request()->file("customer_images.$key.image"));
                        $images[$key]['image'] = \App\Files\Storage::putFile('admin', 'images', request()->file("customer_images.$key.image"));
                    } else {
                        $images[$key]['image'] = $imageList[$key]['image'] ?? '';
                    }
                    $images[$key]['order'] = $imageRequest['order'] ?? 1;
                }
                $form->ignore('customer_images');
                $form->model()->images = [];
                if ($images) {
                    $form->model()->images = $images;
                }
            }
        });
        return $form;
    }
}
