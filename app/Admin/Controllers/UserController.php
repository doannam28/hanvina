<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Setting;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;

class UserController extends Controller
{
    public function setting(Content $content): Content
    {
        return $content
            ->title('Website setting')
            ->body(new Setting());
    }
}
