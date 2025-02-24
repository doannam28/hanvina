<?php

namespace App\Admin\Controllers;

use App\Models\Settings;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Request;

class SettingsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Settings';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Settings());
        $grid->disableCreation();
        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('phone', __('Hotline'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableView();
        });
        return $grid;
    }
    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail()
    {
        $show = new Show(Settings::findOrFail(1));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('phone', __('Hotline'));
        $show->field('phone_display', __('Hiển thị hotline'));
        $show->field('phone2', __('Hotline2'));
        $show->field('phone2_display', __('Hiển thị hotline2'));
        $show->field('address', __('Địa chỉ'));
        $show->field('address2', __('Địa chỉ 2'));
        $show->field('facebook', __('Facebook'));
        $show->field('youtube', __('Link youtube'));
        $show->field('tiktok', __('Link tiktok'));
        $show->field('email_receive', __('Email nhận liên hệ'));
        $show->field('site_title', __('Title website'));
        $show->field('meta_description', __('Meta description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Settings());
        $setting = Settings::first();
        $content = isset($setting->content) ? json_decode($setting->content): '';
        $form->text('name','Tên website');
        $form->text('address', __('Địa chỉ'));
        $form->text('address2', __('Địa chỉ 2'));
        $form->text('phone', __('Hotline'));
        $form->text('phone_display', __('Hiển thị hotline'));
        $form->text('phone2', __('Hotline2'));
        $form->text('phone2_display', __('Hiển thị hotline2'));
        $form->text('email', __('Email'));
        $form->text('facebook', __('Link fanpage'));
        $form->text('youtube', __('Link youtube'));
        $form->text('tiktok', __('Link tiktok'));
        $form->text('link_chat', __('Link chat'));
        $form->text('link_chat_mobile', __('Link chat mobile'));
        $form->text('email_receive', __('Email nhận liên hệ'));
        $form->image('logo', __('Logo'));
        $form->image('logo_footer', __('Logo footer'));
        $form->image('favicon', __('Favicon'));
        $form->image('image_og', __('Ảnh show trên social'));
        $form->switch('is_show_popup', __('Có show popup'));
        $form->image('image_popup', __('Ảnh popup'))->help('<b style="color:red">(Nên up ảnh vuông tỉ lệ 1:1)</b>');
        $form->text('site_title', __('Tiêu đề website'));
        $form->text('meta_description', __('Meta description'));
        $form->hidden('content', __('Content'));
        $form->number('day_max', __('Số ngày tối đa'))->default($content->day_max ?? "");
        $form->currency('price_max', 'Giá tiền tối đa')->symbol('VND')->default($content->price_max ?? "");
        $form->submitted(function (Form $form) {
            $content = [];
            $content['day_max'] = Request::input('day_max');
            $content['price_max'] = Request::input('price_max');
            $form->content = json_encode($content);
            $form->ignore('day_max');
            $form->ignore('price_max');
        });
        return $form;
    }
}
