<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class AboutController extends Controller
{
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $page = Page::where('type', Page::ABOUT_PAGE)->first();
        $tips = $page->posts()->where('status', 1)->limit(6)->get();
        $customers = Customer::where('status', 1)->limit(4)->get();
        return view('frontend.about', [
            'tips' => $tips,
            'data' => $page?->content,
            'customers' => $customers,
        ]);
    }

}
