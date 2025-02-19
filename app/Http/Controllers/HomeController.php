<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Email;
use App\Models\Page;
use App\Models\Settings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use PHPUnit\Framework\Exception;

class HomeController extends Controller
{

    const SOCIAL_ICONS = [
        'facebook' => '/assets/images/icon-fb.png',
        'tiktok' => '/assets/images/icon-tiktok.png',
        'youtube' => '/assets/images/icon-yt.png',
    ];



    /**
     * @return Factory|View|Application
     */
    public function index()
    {
        $home = Page::where('type', Page::HOME_PAGE)->first();

        $icons = $home->content['counter_icons'] ?? [];
        //reset key
        $icons = array_values($icons);
        $tours  = $home->tours()->withPivot('order')->get();
        //sort by order
        $tours = $tours->sortBy(function ($tour) {
            return $tour->pivot->order;
        });
       /* $tours = $tours->map(function ($tour) {
            $images = $tour->images;
            $tour->image = collect($images)->first();
            return $tour;
        });*/

        $customers = $home->customers->map(function ($customer) {
            $images = $customer->images;
            $customer->image = collect($images)->first();
            return $customer;
        });

        $posts = $home->posts;
        return view('homes.index', [
            'content' => $home->content,
            'icons' => $icons,
            'tours' => $tours,
            'customers' => $customers,
            'posts' => $posts,
            'social_icons' => self::SOCIAL_ICONS,
        ]);
    }
    public function register_phone()
    {
        $input = Request::all();
        if(empty(strip_tags($input['phone']))){
            return Response::json(['status' => 'error', 'msg' => "Xin vui lòng kiểm tra lại thông tin"], 201);
        }
        $check = Email::where('phone',strip_tags($input['phone']))->first();
        if(!empty($check->id)) {
            return Response::json(['status' => 'error', 'msg' => "Số điện thoại này đã đăng ký rồi!"], 201);
        }
        $email = new Email();
        $email->phone = strip_tags($input['phone']);
        $email->save();
        return Response::json(['status' => 'success', 'msg' => "Đăng ký thành công"], 200);
    }
}
