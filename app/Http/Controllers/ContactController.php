<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use App\Models\Page;
use App\Models\Settings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $data = Page::where('type', Page::CONTACT_PAGE)->first();
        return view('frontend.contact', [
            'data' => $data->content
        ]);
    }

    public function sendMail(ContactRequest $request): \Illuminate\Http\RedirectResponse
    {
        $setting = Settings::first();
        Mail::to($setting->email_receive)->send(new Contact($request->validated()));
        return redirect()->back()->with('success', 'Gửi liên hệ thành công');
    }

}
