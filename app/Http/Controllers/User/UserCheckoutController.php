<?php

namespace App\Http\Controllers\User;

use App\Customer;
use App\Http\Controllers\Controller;
use App\order_details;
use App\orders;
use App\paymetns;
use App\Shopping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class UserCheckoutController extends Controller
{
    //
    function checkoutLogin()
    {
        return view('user.cart.checkout_login');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|max:255|min:3',
                'password' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
            ],

            [
                'username' => 'Email',
                'password' => 'Mật khẩu',
            ],
        );

        $user = Customer::where([
            ['email', $request->input('username')],
            ['password', $request->input('password')],
        ])->first();

        if ($user) {
            session(['customer_id' => $user->customer_id]);
            return redirect(route('home'));
        } else {
            return redirect(route('cart.checkoutLogin'))->with('info', 'TK OR MK KO CHÍNH XÁC');
        }
    }

    function checkLogout(Request $request)
    {
        $request->session()->flush();
        return redirect(route('cart.checkoutLogin'));
    }

    function add_customer(Request $request)
    {
        $request->validate(
            [
                'customer_name' => 'required|max:255|min:3',
                'customer_email' => 'required|email',
                'customer_pass' => 'required',
                'comfirm_password' => 'required|same:customer_pass',
                'customer_phone' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
                'same' => 'mật khẩu không trùng khớp'
            ],

            [
                'customer_name' => 'Username',
                'customer_email' => 'Email',
                'customer_phone' => 'Phone',
                'customer_pass' => 'Password',
                'comfirm_password' => 'Password',
            ],
        );

        $customer_id = Customer::insertGetId(
            [
                'name' => $request->input('customer_name'),
                'password' => $request->input('customer_pass'),
                'email' => $request->input('customer_email'),
                'phone' => $request->input('customer_phone'),
            ]
        );
        session(['customer_id' => $customer_id]);
        session(['customer_name' => $request->input('customer_name')]);
        // return redirect(route('cart.checkoutLogin'))->with('status', 'Thêm bài viết thành công');
        return redirect(route('cart.checkout'));
    }

    function order_place(Request $request)
    {
        $request->validate(
            [
                'shopping_name' => 'required|max:255|min:3',
                'shopping_email' => 'required|email',
                'shopping_address' => 'required',
                'shopping_phone' => 'required|numeric',
                'payment-method' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',

            ],

            [
                'shopping_name' => 'Tên người dùng',
                'shopping_email' => 'Email',
                'shopping_address' => 'Địa chỉ',
                'shopping_phone' => 'Phone',
                'payment-method' => 'Phương thức thanh toán',
            ],
        );

        //payments
        $data = array();
        $data['payment_method'] = $request->input('payment-method');
        $data['payment_status'] = 0;
        $payment_id = paymetns::insertGetId($data);

        //shopping
        $shopping_data = array();
        $shopping_data['shipping_name'] = $request->input('shopping_name');
        $shopping_data['shipping_email'] = $request->input('shopping_email');
        $shopping_data['shipping_address'] = $request->input('shopping_address');
        $shopping_data['shipping_phone'] = $request->input('shopping_phone');
        $shopping_data['shipping_desc'] = $request->input('shopping_desc');
        $shopping_id = Shopping::insertGetId($shopping_data);

        //order
        $order_data = array();
        $order_code = "IS-" . Str::random(5);
        $customer_id = session('customer_id');
        $order_data['shipping_id'] = $shopping_id;
        $order_data['customer_id'] = $customer_id;
        $order_data['paymentid'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 0;
        $order_data['order_code'] = $order_code;
        $order_id = orders::insertGetId($order_data);

        //order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_price'] = $v_content->total;
            $order_d_data['product_qty'] = $v_content->qty;
            $order_d_id = order_details::insertGetId($order_d_data);
        }

        // return redirect(route('cart.checkout'));
        if ($data['payment_method'] == 1) {
            echo "thanh toan tai cua hang";
        } else {
            Cart::destroy();
            return view('user.cart.handcart');
        }
    }

}
