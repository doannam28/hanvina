<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class TinyEditor extends Field
{
    public static $js = [
        '/packages/tinymce/tinymce.min.js',
        '/packages/setting.js'
    ];


    protected $view = 'admin.ckeditor';

    public function render(): Factory|string|View
    {
        $this->script = <<<EOT
            initEditor()
         EOT;

        return parent::render();
    }
}
