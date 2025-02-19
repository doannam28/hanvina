<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class HomeController extends Controller
{
    public function index(Content $content): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        return redirect('/admin/home-page/1/edit');
    }
}
