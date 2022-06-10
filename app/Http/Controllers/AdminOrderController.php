<?php

namespace App\Http\Controllers;

use App\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'order']);
            return $next($request);
        });
    }

    function show(Request $request)
    {

        $status = $request->input('status');
        $list_act = ['delete' => 'Đưa vào thùng rác'];
        if ($status == "trash") {
            $list_act = [
                'forceDelete' => 'Xóa vĩnh viễn',
                'restore' => 'Khôi phục',
            ];
            $all_order = orders::onlyTrashed()->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $all_order = DB::table('orders')
                ->join('shoppings', 'shoppings.shipping_id', '=', 'orders.shipping_id')
                ->select('orders.*', 'shoppings.shipping_name', 'shoppings.shipping_phone')
                ->orderBy('orders.order_id', 'desc')
                ->where('shipping_name', 'LIKE', "%{$keyword}%")
                ->orWhere('shipping_phone', 'LIKE', "%{$keyword}%")
                ->orWhere('order_code', 'LIKE', "%{$keyword}%")
                // ->get();
                ->paginate(5);
            // dd($all_order);
        }

        $count_admin_active = orders::count();
        $count_admin_trash = orders::onlyTrashed()->count();
        $count = [$count_admin_active, $count_admin_trash];

        return view('admins.order.show', compact('all_order', 'list_act', 'count'));
    }

    function delete($order_id)
    {
        orders::where('order_id', $order_id)->forceDelete();
        return back()->with('status', 'xóa thành công');
    }

    function detail($order_id)
    {
        $order_by_id = DB::table('orders')
            ->where('orders.order_id', $order_id)
            ->join('shoppings', 'shoppings.shipping_id', '=', 'orders.shipping_id')
            ->join('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->join('order_details', 'order_details.order_id', '=', 'orders.order_id')
            ->select('orders.*', 'customers.*', 'shoppings.*', 'order_details.*')
            ->first();

        $order_products = DB::table('order_details')
            ->where('order_details.order_id', $order_id)
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.order_id')
            ->select('order_details.*', 'products.*', 'orders.*')
            ->get();

        $total_qty = 0;
        foreach ($order_products as $v) {
            if ($v->order_id == $order_id) {
                $total_qty += $v->product_qty;
            }
        }
        // dd($total_qty);
        return view('admins.order.detail', compact('order_by_id', 'order_products', 'total_qty'));
    }

    function update_token(Request $request, $orderId)
    {
        $request->validate(
            [
                'status' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
            ],

            [
                'status' => 'Trang thái',
            ],
        );

        orders::where('order_id', $orderId)->update(
            [
                'order_status' => $request->input('status'),
            ]
        );

        return redirect(route('order.detail', $orderId))->with('status', 'Cập nhật trạng thái thành công');
    }
}
