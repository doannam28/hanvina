<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('status', Customer::STATUS_ACTIVE)
            ->orderBy('order')
            ->simplePaginate(6);
        $topCustomers = Customer::where('status', Customer::STATUS_ACTIVE)
            ->orderBy('order')
            ->limit(6)
            ->get();
        return view('frontend.customer',[
            'customers' => $customers,
            'topCustomers' => $topCustomers
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(): \Illuminate\Http\JsonResponse
    {
        $id = request('id');
        $customer = Customer::find($id);
        $html = view('frontend.customer_image', ['images' => collect($customer->images)->values()])->render();
        return response()->json([
            'html' => $html,
            'name' => $customer->name,
            'total' => count($customer->images),
            'avatar' => Storage::disk('admin')->url($customer->avatar)
        ]);
    }

    public function loadMore()
    {
        $page = request('page');
        $customers = Customer::where('status', Customer::STATUS_ACTIVE)
            ->orderBy('order')
            ->simplePaginate(6, ['*'], 'page', $page);
        return response()->json([
            'html' => view('frontend.customer_item', ['customers' => $customers])->render(),
            'hasNext' => $customers->hasMorePages()
        ]);

    }

}
