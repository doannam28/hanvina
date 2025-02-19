<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Page;
use App\Models\Settings;
use App\Models\TaxonomyItem;
use App\Models\Tour;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class ToursController extends Controller
{
    public function tours()
    {
        $objPost = new Tour();
        $objPost = $objPost->where('status', 1);
        $limit = 9;
        $request = Request::all();
        if (isset($request['locations']) && $request['locations'] != "") {
            $objPost = $objPost->whereIn('location_id', $request['locations']);
        }
        if (isset($request['key']) && $request['key'] != "") {
            $objPost = $objPost->where('name', 'like', $request['key']);
        }
        if (isset($request['ways']) && $request['ways'] != "") {
            $objPost = $objPost->whereIn('way_id', $request['ways']);
        }
        if (isset($request['location_start']) && $request['location_start'] != "") {
            $objPost = $objPost->whereIn('location_start', $request['location_start']);
        }
        if (isset($request['day']) && $request['day'] != "0") {
            $objPost = $objPost->where('days', '<=', intval($request['day']));
        }
        if (isset($request['price']) && $request['price'] != "0") {
            $objPost = $objPost->where('price', '<=', intval($request['price']));
        }
        $objPost = $objPost->orderBy('created_at', 'DESC');
        $list = $objPost->paginate($limit)->setPath(url('/filter-tour'));
        $localtions = TaxonomyItem::where('status', 1)->where('taxonomy_id',
            config('admin.category_location_id'))->orderBy('order', 'ASC')->get();
        $ways = TaxonomyItem::where('status', 1)->where('taxonomy_id',
            config('admin.category_way_tour'))->orderBy('order', 'ASC')->get();
        $locationStarts = TaxonomyItem::where('taxonomy_id',config('admin.start_location'))->orderBy('order','ASC')->get();
        $page = Page::where('id', config('admin.page_tour_id'))->first();
        $hotTours = Tour::where('hot', 1)->where('status', 1)->limit(12)->orderBy('id', 'DESC')->get();
        $slideTours = Tour::where('slide', 1)->where('status', 1)->limit(30)->orderBy('id', 'DESC')->get();
        return view('homes.tours',
            array(
                'localtions' => $localtions,
                'locationStarts' => $locationStarts,
                'ways' => $ways,
                'hotTours' => $hotTours,
                'slideTours' => $slideTours,
                'page' => $page,
                'tours' => $list,
                'request' => $request,
                'site_title' => 'Danh sách tour'
            )
        );
    }

    /**
     * @return array
     */
    public function filterTours(): array
    {
        $objPost = new Tour();
        $objPost = $objPost->where('status', 1);
        $request = Request::all();
        $limit = (isset($request['limit']) && $request['limit'] != "") ? intval($request['limit']): 9;
        if (isset($request['locations']) && $request['locations'] != "") {
            $objPost = $objPost->whereIn('location_id', $request['locations']);
        }
        if (isset($request['key']) && $request['key'] != "") {
            $objPost = $objPost->where('name', 'like', '%'.$request['key'].'%');
        }
        if (isset($request['ways']) && $request['ways'] != "") {
            $objPost = $objPost->whereIn('way_id', $request['ways']);
        }
        if (isset($request['location_start']) && $request['location_start'] != "") {
            $objPost = $objPost->whereIn('location_start', $request['location_start']);
        }
        if (isset($request['day']) && $request['day'] != "0") {
            $objPost = $objPost->where('days', '<=', intval($request['day']));
        }
        if (isset($request['price']) && $request['price'] != "0") {
            $objPost = $objPost->where('price', '<=', intval($request['price']));
        }
        $page = isset($input['page']) ? intval($input['page']) + 1 : 1;
        $objPost = $objPost->orderBy('created_at', 'DESC');
        $list = $objPost->paginate($limit)
            ->appends(Request::except(['page', '_token']));
        $rows = view('homes.ajax_view_tours', array('tours' => $list))->render();
        $paging = $list->links('frontend.pagination')->render();

        return [
            'paging' => $paging,
            'rows' => $rows,
            'page' => $page,
            'count' => count($list),
        ];
    }

    public function tour_detail($slug = null)
    {
        $tour = Tour::where('slug', $slug)->first();
        if (empty($tour)) {
            return abort(404);
        }
        $hotTours = Tour::where('hot', 1)->where('status', 1)->limit(12)->orderBy('id', 'DESC')->get();
        $routes = $tour->routes()->orderBy('day')->orderBy('order')->get()->groupBy('day');
        $detailFeatures = $tour->detailFeature()->orderBy('day')->get()->groupBy('day');
        $detailVehicles = $tour->detailVehicle()->orderBy('day')->get()->groupBy('day');
        $detailHotels = $tour->detailHotel()->orderBy('day')->get()->groupBy('day');
        $detailFoods = $tour->detailFood()->orderBy('day')->get()->groupBy('day');
        $tourPrices = $tour->tourPrices()->get();
        return view('homes.tour_detail',
            array(
                'hotTours' => $hotTours,
                'tour' => $tour,
                'routes' => $routes,
                'detailVehicles' => $detailVehicles,
                'detailFeatures' => $detailFeatures,
                'detailHotels' => $detailHotels,
                'detailFoods' => $detailFoods,
                'tourPrices' => $tourPrices,
            )
        );
    }

    public function booking()
    {
        $input = Request::all();
        foreach ($input as $k => $row) {
            $input[$k] = trim(strip_tags($row));
        }
        if (empty($input['name']) || !isset($input['tour_id']) || !isset($input['phone']) || empty($input['adult']) || empty($input['date'])) {
            return Response::json(['status' => 'error', 'msg' => 'Xin vui lòng điền đẩy đủ thông tin!'], 201);
        }
        $tour = Tour::where('id', $input['tour_id'])->first();
        if (empty($tour)) {
            return Response::json(['status' => 'error', 'msg' => 'Không tìm thấy tour cần đặt'], 201);
        }
        $tourPrices = $tour->tourPrices()->get();
        $price_discount = $tour->price_discount;
        $price = 0;
        foreach ($tourPrices as $row) {
            $days = explode(',', $row->days);
            foreach ($days as $row1) {
                if ($row1 == $input['date']) {
                    $price = $row->price;
                    break;
                }
            }
            if ($price > 0) {
                break;
            }
        }
        $date = date('Y-m-d', strtotime(str_replace('/', "-", $input['date'])));
        $booking = new Booking();
        $booking->name = $input['name'];
        $booking->phone = $input['phone'];
        $booking->tour_id = $input['tour_id'];
        $booking->date = $date;
        $booking->adult = $input['adult'];
        $booking->price_discount = $price_discount;
        $booking->price = $price;
        $booking->save();
        $setting = Settings::first();
        Mail::send('emails.booking', ['input' => $input, 'tourName' => $tour->name], function ($m) use ($setting) {
            $m->to($setting->email_receive)->subject("Có khách đặt tour");
        });
        return Response::json([
            'status' => 'success',
            'msg' => 'Đặt tour thành công. Chúng tôi sẽ liên hệ lại trong thời gian sớm nhất. Trân trọng!'
        ], 200);
    }

}
