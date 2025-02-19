<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form;
use App\Admin\Selectable\Customers;
use App\Admin\Selectable\Posts;
use App\Admin\Selectable\Tours;
use App\Models\Page;
use Encore\Admin\Layout\Content;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class HomePageController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Trang chủ';


    public function updatePosition($id)
    {
        $home = Page::where('type', Page::HOME_PAGE)->first();
        $value = request('value');
        //update order pivot value
        $home->tours()->updateExistingPivot($id, ['order' => $value]);

        return response()->json(['status' => true]);
    }
    public function setting(): Content
    {
        $content = new Content();
        return $content
            ->title($this->title)
            ->body($this->form());
    }

    /**
     * @return \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
     */
    public function grid(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        return redirect('/admin/home-page/1/edit');
    }

    /**
     * Make a form builder.
     *
     */
    protected function form(): Form
    {
        $page = Page::where('type', Page::HOME_PAGE)->first();
        $form = new Form(new Page());
        $form->setTitle($this->title);
        $form->tools(function ($tools) {
            $tools->disableList();
            $tools->disableView();
            $tools->disableDelete();
        });
        //hide footer
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        $form->text('title', __('Tiêu đề'))->placeholder('Tiêu đề trang chủ')->readonly();
        $form->editing(function ($form) {
            $model = $form->model();
            $content = $model->content;
            $model->banner = $content['banner'] ?? [];
            $model->map = $content['map'] ?? [];
            $model->counter = $content['counter'] ?? [];
            $model->social_links = $content['social_links'] ?? [];
            $model->social_links = $this->convertKey($model->social_links);
            $model->counter_icons = $content['counter_icons'] ?? [];
            $model->counter_icons = $this->convertKey($model->counter_icons);
        });

        //wrap banner and map in a collapse
        $form->embeds('banner', "Banner", function ($form) {
            $form->text('title', 'Tiêu đề')->attribute(['id' => 'banner_title']);
            $form->file('video', 'Video')->help('<b style="color:red">(Yêu cầu video mp4 có độ phân giải 1920x1080)</b>');
            $form->file('video_mobile', 'Video Mobile')->help('<b style="color:red">(Yêu cầu video mp4 có độ phân giải 1080x1728)</b>');
        });


        $form->embeds('map', "Bản đồ", function ($form) {
            $form->image('image', 'Hình ảnh');
            $form->text('title', 'Tiêu đề')->attribute(['id' => 'map_title']);
            $form->textarea('content', 'Nội dung');
            $form->text('link');
        });

        $form->embeds('counter', "Số đếm", function ($form) {
            $form->text('title', 'Tiêu đề')->attribute(['counter' => 'banner_title']);
            //$form->image('image', 'Hình ảnh')->uniqueName();
        });
        $form->table('counter_icons', 'Icons', function ($table) {
            $table->image('icon')->uniqueName();
            $table->text('number', 'Số luợng');
            $table->text('title', 'Tiêu đề');
        });

        $form->belongsToMany('tours', Tours::class, 'Tour');
        $form->belongsToMany('posts', Posts::class, 'Tin tức');
        $form->belongsToMany('customers', Customers::class, 'Khách hàng nói về chúng tôi');


        $form->table('social_links', 'Mạng xã hội', function ($table) {
            $table->select('type', 'Mạng xã hội')->options([
                'facebook' => 'Facebook',
                'youtube' => 'Youtube',
                'tiktok' => 'Tiktok',
            ]);
            $table->text('title', 'Tiêu đề');
            $table->text('link', 'Link');
        });

        $form->submitted(function ($form) use ($page){
            $map = request('map');
            //store map image
            $content = $form->model()->content;
            if (request()->hasFile('map.image')) {
                $map['image'] = \App\Files\Storage::putFile('admin', 'images', request()->file('map.image'));
            }else{
                $map['image'] = $content['map']['image'] ?? '';
            }

            $banner = request('banner');
            if (request()->hasFile('banner.video')) {
                $banner['video'] = \App\Files\Storage::putFile('admin', 'images', request()->file('banner.video'));
            }else{
                $banner['video'] = $content['banner']['video'] ?? '';
            }
            if (request()->hasFile('banner.video_mobile')) {
                $banner['video_mobile'] = \App\Files\Storage::putFile('admin', 'images', request()->file('banner.video_mobile'));
            }else{
                $banner['video_mobile'] = $content['banner']['video_mobile'] ?? '';
            }
            //store counter image
            $counter = request('counter');
          /*  if (request()->hasFile('counter.image')) {
                $counter['image'] = Storage::disk('admin')->putFile('images', request()->file('counter.image'));
            }else{
                $counter['image'] = $content['counter']['image'] ?? '';
            }*/

            $counterIcons = request('counter_icons', []);
            $content['counter_icons'] = $this->convertKey($content['counter_icons'] ?? []);
            foreach ($counterIcons as $key => $icon) {
                if ($icon['_remove_'] == 1) {
                    unset($counterIcons[$key]);
                    continue;
                }
                if (request()->hasFile("counter_icons.$key.icon")) {
                    $counterIcons[$key]['icon'] = \App\Files\Storage::putFile('admin', 'images', request()->file("counter_icons.$key.icon"));
                }else{
                    $counterIcons[$key]['icon'] = $content['counter_icons'][$key]['icon'] ?? '';
                }
            }
            $socialLinks = request('social_links', []);
            foreach ($socialLinks as $key => $link) {
                if ($link['_remove_'] == 1) {
                    unset($socialLinks[$key]);
                }
            }

            $form->ignore(['banner', 'map', 'counter', 'social_links', 'counter_icons']);
            $form->model()->content = [
                'banner' => $banner,
                'map' => $map,
                'counter' => $counter,
                'social_links' => $socialLinks,
                'counter_icons' => $counterIcons,
            ];
        });

        return $form->edit($page->id);
    }
}
