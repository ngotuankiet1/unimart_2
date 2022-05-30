<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Product_cat;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProductController extends Controller
{
    //
    function show()
    {
    }

    function categoty(Request $request, $id)
    {

        $list_cat_product = $this->get_cat_product();
        $cat_product = Product_cat::where('id', $id)->first();
        $cat_name = $cat_product->name;

        if ($cat_product->parent_cat == 0) {
            $cat_product = Product_cat::where('parent_cat', $id)->get();
            foreach ($cat_product as $item) {
                $productId[] = $item->id;
            }
            $products = Products::whereIn('parent_id', $productId)->latest()->paginate(8);
        } else {
            $products = Products::where('parent_id', $id)->paginate(8);
            // $products = DB::table('products')
            //     ->join('product_cats', 'products.parent_id', '=', 'product_cats.id')
            //     ->where('products.parent_id', $id)
            //     ->paginate(8);
        }

        // foreach ($products as $item) {
        //     $productId[] = $item->id;
        // }

        $count_product = $products->count();
        $count_total = Products::count();
        $count = [$count_product, $count_total];

        return view('user.product.category', compact('products', 'cat_name', 'count', 'list_cat_product'));
    }

    function get_cat_product()
    {
        $data = product_cat::get();
        $result = [];
        Product_cat::data_tree($data, 0, 1, $result);
        return $result;
    }

    function product_detail($id)
    {
        #Danh mục sản phẩm
        $list_cat_product = $this->get_cat_product();
        #Sản phẩm bán chạy
        $list_product =  Products::orderBy('id', 'DESC')->offset(0)->limit(10)->get();

        $product = Products::find($id);
        $product_suggestion = Products::where('parent_id', $product->parent_id)->get();
        return view('user.product.detail', compact('list_cat_product', 'product', 'list_product', 'product_suggestion'));
    }
}
