<?php

namespace App\Admin\Selectable;

use App\Models\Post;
use Encore\Admin\Grid\Selectable;
use Illuminate\Support\Facades\Storage;

class Posts extends Selectable
{

    public $model = Post::class;
    public function make(): void
    {
        $this->column('id', __('ID'));
        $this->column('title', __('Tiêu đề'));
        $this->column('thumbnail', __('Hình ảnh'))->display(function ($thumbnail) {
            return "<img src='" . Storage::disk('admin')->url($thumbnail) . "' style='width: 50px; height: 50px;'/>";
        });
    }
}
