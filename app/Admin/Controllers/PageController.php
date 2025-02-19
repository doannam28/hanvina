<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form;
use \App\Models\Page;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Collapse;

class PageController extends BaseAdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Page';


    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail(mixed $id): Show
    {
        $show = new Show(Page::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }


    /**
     * Make a form builder.
     *
     */
    protected function form(): \Encore\Admin\Widgets\Tab
    {
        $form = new Form(new Page());

        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));

        $form->editing(function ($form) {
            $model = $form->model();
            $model->content1 = $content['content1'] ?? [];
            $model->content2 = $content['content2'] ?? [];
        });
        $box = new Box('Box Title', 'Box content');

        $box->removable();

        $box->collapsable();
        //add form fields to the box


        $box->style('info');
        $box->solid();

        $collapse = new Collapse();
        $collapse->add('Title 1', $box);

        $form->table('content122', 'Nội dung', function ($table) {
            $table->text('key1')->rules('required');
        });

        $form->embeds('content1', "Nội dung", function ($form) {
            $form->text('key1')->rules('required');
        });


        $form->ckeditor('content11', 'Nội dung');

        $form->embeds('content2', "Nội dung", function ($form) {
            $form->text('key1')->rules('required');
        });
        $form->submitted(function ($form) {
            $form->ignore(['content1', 'content2']);
            $form->model()->content = [
                'content1' => request('content1'),
                'content2' => request('content2'),
            ];
        });
        $tab = new \Encore\Admin\Widgets\Tab();
        $tab->add('Tab 1', $form);
        $tab->add('Tab 2222', $collapse);
        for($i=2; $i<7; $i++) {
            $setting = new \App\Admin\Forms\Setting();
            $tab->add('Tab '.$i, $setting);
        }
        return $tab;
    }
}
