<?php

namespace App\Http\Controllers;

use App\Product_cat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list_cat_product = $this->get_cat_product();
        // print_r($list_cat_product);
        return view('users/home',compact('list_cat_product'));
    }

    function get_cat_product()
    {
        $data = Product_cat::get();
        $result = [];
        Product_cat::data_tree($data, 0, 1, $result);
        return $result;
    }
}
