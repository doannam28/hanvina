<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form;
use App\Models\Page;
use Encore\Admin\Layout\Content;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Utility;

class TourPageController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Trang tour';


    public function setting(): Content
    {
        $content = new Content();
        return $content
            ->title($this->title)
            ->body($this->form());
    }

    public function grid(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        return redirect('/admin/tour-page/4/edit');
    }

    /**
     * Make a form builder.
     *
     */
    protected function form(): Form
    {
        $page = Page::where('type', Page::TOUR_PAGE)->first();
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
           /* for($i=1; $i<6; $i++){
                $form->image('image'.$i, 'Ảnh slide'.$i)->help('<b style="color:red">(Nên up ảnh có độ phân giải 2880x1400)</b>');
                $form->text('title_image'.$i, 'Tiêu đề '.$i);
            }*/

            $form->text('title', 'Tiêu đề website')->attribute(['id' => 'content_page_title']);
            $form->text('description', 'Description')->attribute(['id' => 'content_page_content']);
        });

        $form->submitted(function ($form) use ($page){
            $content = $form->model()->content;
            $contentPage = request('content_page');
           /* for($i=1; $i<6; $i++){
                if (request()->hasFile('content_page.image'.$i)) {
//                    $contentPage['image'.$i] = Storage::disk('admin')->putFile('images', request()->file('content_page.image'.$i));
                    $contentPage['image'.$i] = \App\Files\Storage::putFile('admin', 'images', request()->file('content_page.image'.$i));
                }else{
                    $contentPage['image'.$i] = $content['image'.$i] ?? '';
                }
            }*/
            $form->ignore(['content_page']);
            $form->model()->content = $contentPage;
        });

        return $form->edit($page->id);
    }
}
