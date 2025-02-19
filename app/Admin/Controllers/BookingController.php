<?php

namespace App\Admin\Controllers;

use App\Models\Tour;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Booking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class BookingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Đặt tour';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Booking());
        // Sắp xếp mặc định theo ID giảm dần
        $grid->model()->orderBy('id', 'desc');
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', __('Tên khách hàng'));
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Tên khách hàng'));
        $grid->column('phone', __('Số điện thoại'));
        $grid->column('tour.name', __('Tour'));
        $grid->column('date', __('Ngày khởi hành'))->display(function ($created_at) {
            return date('d-m-Y', strtotime($created_at));
        });
        $grid->column('created_at',  __('Ngày đặt'))->display(function ($created_at) {
            return date('d-m-Y H:i:s', strtotime($created_at));
        });
        $grid->column('adult', __('Người lớn'));
        $grid->column('status', __('Trạng thái duyệt'))->switch();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     */
    protected function detail($id): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        return redirect('/admin/bookings/'.$id.'/edit');
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Booking());
        $form->tools(function ($tools) {
            $tools->disableView();
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        $form->text('name', __('Tên khách hàng'))->required();
        $form->text('phone', __('Số điện thoại'))->required();
        $form->date('date', __('Ngày đặt'))->required();
        $form->number('adult', __('Người lớn'))->required();
        $form->select('tour_id', __('Tour'))->options(function ($id) {
            return Tour::all()->pluck('name', 'id');
        })->required();
        $form->radio('status', __('Trạng thái duyệt'))->options([0 => 'Chưa duyệt', 1 => 'Đã duyệt'])->default(0);
        return $form;
    }
}
