<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form;
use App\Models\Page;
use Encore\Admin\Layout\Content;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class NewsPageController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Trang tin tức';


    public function setting(): Content
    {
        $content = new Content();
        return $content
            ->title($this->title)
            ->body($this->form());
    }

    public function grid(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        return redirect('/admin/news-page/5/edit');
    }

    /**
     * Make a form builder.
     *
     */
    protected function form(): Form
    {
        $page = Page::where('type', Page::NEWS_PAGE)->first();
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
            $model->content_page = $content ?? [];
        });

        $form->embeds('content_page', "Nội dung", function ($form) {
            $form->image('image', 'Ảnh banner')->attribute(['id' => 'content_page_image'])->help('<b style="color:red">(Nên upload ảnh có độ phân giải 1440x960)</b>');
            $form->text('title', 'Tiêu đề')->attribute(['id' => 'content_page_title']);
            $form->textarea('content', 'Nội dung')->attribute(['id' => 'content_page_content']);
            $form->text('link', 'Links')->attribute(['id' => 'link_page_content']);
        });

        $form->submitted(function ($form) use ($page){
            $content = $form->model()->content;
            $contentPage = request('content_page');
            if (request()->hasFile('content_page.image')) {
//                $contentPage['image'] = Storage::disk('admin')->putFile('images', request()->file('content_page.image'));
                $contentPage['image'] = \App\Files\Storage::putFile('admin', 'images', request()->file('content_page.image'));
            }else{
                $contentPage['image'] = $content['image'] ?? '';
            }
            $form->ignore(['content_page']);
            $form->model()->content = $contentPage;
        });
        return $form->edit($page->id);
    }
}
