<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form;
use App\Admin\Selectable\Posts;
use \App\Models\Page;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Giới thiệu';


    public function setting(): Content
    {
        $content = new Content();
        return $content
            ->title($this->title)
            ->body($this->form());
    }

    public function grid()
    {
        return redirect('/admin/about-page/2/edit');
    }

    /**
     * Make a form builder.
     *
     */
    protected function form(): Form
    {
        $page = Page::where('type', Page::ABOUT_PAGE)->first();
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
        $form->editing(function ($form) {
            $model = $form->model();
            $content = $model->content;
            $model->header = $content['header'] ?? [];
            $model->about_us = $content['about_us'] ?? [];
            $model->vision = $content['vision'] ?? [];
            $model->mission = $content['mission'] ?? [];
            $model->values = $content['values'] ?? [];
        });

        $form->embeds('header', "Header", function ($form) {
            $form->text('title', __('Tiêu đề'))->placeholder('Tiêu đề');
            $form->text('sub_title', __('Tiêu đề 2'))->placeholder('Tiêu đề 2');
            $form->textarea('description', __('Nội dung ngắn'))->placeholder('Nội dung ngắn');
            $form->image('image_1', __('Hình ảnh 1'))->placeholder('Hình ảnh 1');
            $form->image('image_2', __('Hình ảnh 2'))->placeholder('Hình ảnh 2');
        });

        $form->embeds('about_us', "Về chúng tôi", function ($form) {
            $form->text('title', __('Tiêu đề'))->placeholder('Tiêu đề');
            $form->textarea('description', __('Nội dung'))->placeholder('Nội dung');
            $form->image('image', __('Hình ảnh'))->placeholder('Hình ảnh');
        });

        $form->embeds('vision', "Tầm nhìn", function ($form) {
            $form->text('title', __('Tiêu đề'))->placeholder('Tiêu đề');
            $form->textarea('description', __('Nội dung'))->placeholder('Nội dung');
            $form->image('image', __('Hình ảnh desktop'))->placeholder('Hình ảnh');
            $form->image('image_mobile_1', __('Hình ảnh mobile 1'))->placeholder('Hình ảnh');
            $form->image('image_mobile_2', __('Hình ảnh mobile 2'))->placeholder('Hình ảnh');
            $form->image('image_mobile_3', __('Hình ảnh mobile 3'))->placeholder('Hình ảnh');
        });
        $form->embeds('mission', "Sứ mệnh", function ($form) {
            $form->text('title', __('Tiêu đề'))->placeholder('Tiêu đề');
            $form->textarea('description', __('Nội dung'))->placeholder('Nội dung');
            $form->image('image', __('Hình ảnh'))->placeholder('Hình ảnh');
        });
        $form->table('values', 'Giá trị cốt lõi', function ($table) {
            $table->text('title', 'Tiêu đề');
            $table->textarea('content', 'Nội dung');
        });

        $form->belongsToMany('posts', Posts::class, 'Tin tức');

        $form->submitted(function ($form) use ($page){
            $header = request('header');
            //store map image
            $content = $form->model()->content;
            if (request()->hasFile('header.image_1')) {
                $header['image_1'] = \App\Files\Storage::putFile('admin', 'images', request()->file('header.image_1'));
            }else{
                $header['image_1'] = $content['header']['image_1'] ?? '';
            }

            if (request()->hasFile('header.image_2')) {
                $header['image_2'] = \App\Files\Storage::putFile('admin', 'images', request()->file('header.image_2'));
            }else{
                $header['image_2'] = $content['header']['image_2'] ?? '';
            }

            $aboutUs = request('about_us');
            if (request()->hasFile('about_us.image')) {
//                $aboutUs['image'] = Storage::disk('admin')->putFile('images', request()->file('about_us.image'));
                $aboutUs['image'] = \App\Files\Storage::putFile('admin', 'images', request()->file('about_us.image'));
            }else{
                $aboutUs['image'] = $content['about_us']['image'] ?? '';
            }

            $vision = request('vision');
            if (request()->hasFile('vision.image')) {
//                $vision['image'] = Storage::disk('admin')->putFile('images', request()->file('vision.image'));
                $vision['image'] = \App\Files\Storage::putFile('admin', 'images', request()->file('vision.image'));
            }else{
                $vision['image'] = $content['vision']['image'] ?? '';
            }

            if (request()->hasFile('vision.image_mobile_1')) {
//                $vision['image_mobile_1'] = Storage::disk('admin')->putFile('images', request()->file('vision.image_mobile_1'));
                $vision['image_mobile_1'] = \App\Files\Storage::putFile('admin', 'images', request()->file('vision.image_mobile_1'));
            }else{
                $vision['image_mobile_1'] = $content['vision']['image_mobile_1'] ?? '';
            }

            if (request()->hasFile('vision.image_mobile_2')) {
//                $vision['image_mobile_2'] = Storage::disk('admin')->putFile('images', request()->file('vision.image_mobile_2'));
                $vision['image_mobile_2'] = \App\Files\Storage::putFile('admin', 'images', request()->file('vision.image_mobile_2'));
            }else{
                $vision['image_mobile_2'] = $content['vision']['image_mobile_2'] ?? '';
            }

            if (request()->hasFile('vision.image_mobile_3')) {
//                $vision['image_mobile_3'] = Storage::disk('admin')->putFile('images', request()->file('vision.image_mobile_3'));
                $vision['image_mobile_3'] = \App\Files\Storage::putFile('admin', 'images', request()->file('vision.image_mobile_3'));
            }else{
                $vision['image_mobile_3'] = $content['vision']['image_mobile_3'] ?? '';
            }

            $mission = request('mission');
            if (request()->hasFile('mission.image')) {
//                $mission['image'] = Storage::disk('admin')->putFile('images', request()->file('mission.image'));
                $mission['image'] = \App\Files\Storage::putFile('admin', 'images', request()->file('mission.image'));
            }else{
                $mission['image'] = $content['about_us']['image'] ?? '';
            }

            $form->ignore(['about_us','header', 'vision', 'values', 'mission']);
            $form->model()->content = [
                'header' => $header,
                'values' => request('values'),
                'about_us' => $aboutUs,
                'vision' => $vision,
                'mission' => $mission,
            ];
        });

        return $form->edit($page->id);
    }
}
