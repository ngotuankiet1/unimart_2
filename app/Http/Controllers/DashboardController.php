<?php

namespace App\Http\Controllers;

use App\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'dashboard']);
            return $next($request);
        });
    }

    function show()
    {
        $all_order = DB::table('orders')
            ->join('shoppings', 'shoppings.shipping_id', '=', 'orders.shipping_id')
            ->select('orders.*', 'shoppings.shipping_name', 'shoppings.shipping_phone')
            ->orderBy('orders.order_id', 'desc')
            // ->get();
            ->paginate(5);

        $count_order_success = orders::where('order_status', 2)->count();
        $count_order_processing = orders::where('order_status', 0)->count();
        $total_sales = orders::sum('order_total');
        $count_order_cancle = orders::where('order_status', 3)->count();
        $count_order_delivering = orders::where('order_status', 1)->count();
        $count=[$count_order_success,$count_order_processing,$total_sales,$count_order_cancle,$count_order_delivering];
        // dd($count);
        return view('admins/dashboard', compact('all_order','count'));
    }
}
