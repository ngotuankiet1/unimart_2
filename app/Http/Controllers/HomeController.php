<?php

namespace App\Http\Controllers;

use App\Product_cat;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $list_product =  Products::orderBy('id', 'DESC')->offset(0)->limit(10)->get();
        $list_product_outstanding =  Products::orderBy('id', 'DESC')->where('outstanding', 1)->get();

        //Điện thoại
        $catPhone =  Product_cat::orderBy('id', 'DESC')->where('parent_cat',1)->get();
        foreach($catPhone as $item){
            $catPhoneId[] = $item->id;
        }
        $list_product_phone = Products::whereIn('parent_id',$catPhoneId)->latest()->take(8)->get();

        //Laptop
        $catLaptop =  Product_cat::orderBy('id', 'DESC')->where('parent_cat',2)->get();
        foreach($catLaptop as $item){
            $catLapId[] = $item->id;
        }
        $list_product_laptop = Products::whereIn('parent_id',$catLapId)->latest()->take(8)->get();

        $list_cat_product = $this->get_cat_product();
        $slug = Str::slug(Products::pluck('name'), '-');


        return view('user/home', compact(
            'list_cat_product',
            'list_product',
            'list_product_outstanding',
            'list_product_phone',
            'list_product_laptop'
        ));
    }

    function get_cat_product()
    {
        $data = Product_cat::get();
        $result = [];
        Product_cat::data_tree($data, 0, 1, $result);
        return $result;
    }

    function BrandProduct()
    {
    }
}
