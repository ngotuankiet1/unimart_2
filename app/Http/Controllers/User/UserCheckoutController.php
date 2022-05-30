<?php

namespace App\Http\Controllers\User;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class UserCheckoutController extends Controller
{
    //
    function checkoutLogin()
    {
        return view('user.cart.checkout_login');
    }

    function checkLogout(){
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
                'phone' => $request->input('customer_name'),
            ]
        );
        session(['customer_id' => $customer_id]);
        session(['customer_name' => $request->input('customer_name')]);
        // return redirect(route('cart.checkoutLogin'))->with('status', 'Thêm bài viết thành công');
        return redirect(route('cart.checkout'));
    }
}
