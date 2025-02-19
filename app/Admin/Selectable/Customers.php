<?php

namespace App\Admin\Selectable;

use App\Models\Customer;
use Encore\Admin\Grid\Selectable;
use Illuminate\Support\Facades\Storage;

class Customers extends Selectable
{

    public $model = Customer::class;

    public function make(): void
    {
        $this->column('id', __('ID'));
        $this->column('name', __('Tên khách hàng'));
        $this->column('avatar', __('Avatar'))->display(function ($images) {
            return "<img src='" . Storage::disk('admin')->url($images) . "' style='width: 50px; height: 50px;'/>";
        });
    }
}
