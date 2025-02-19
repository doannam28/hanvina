<?php

namespace App\Admin\Selectable;

use App\Models\Page;
use App\Models\Tour;
use Encore\Admin\Grid\Selectable;
use Illuminate\Support\Facades\Storage;

class Tours extends Selectable
{

    public $model = Tour::class;
    public function make(): void
    {
        $home = Page::where('type', Page::HOME_PAGE)->first();
        $tours = $home->tours()->withPivot('order')->get();
        $tours = $tours->mapWithKeys(function ($tour) {
            return [$tour['id'] => $tour['pivot']['order']];
        })->toArray();


        $this->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', __('Tên tour'));
        });
        $this->column('id', __('ID'));
        $this->column('name', __('Tên tour'));
        $this->column('order', __('Vị trí'))->display(function ($order) use ($tours) {
            return $tours[$this->id] ?? 0;
        })->editable();
        $this->column('images', __('Hình ảnh'))->display(function ($images) {
            $html = '';
            foreach ($images as $image) {
                $html .= "<img src='" . Storage::disk('admin')->url($image['image']) . "' style='width: 50px; height: 50px;'/>";
                break;
            }
            return $html;
        });
    }
}
