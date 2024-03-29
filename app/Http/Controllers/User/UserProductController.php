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

            if (!empty($request->input('sort'))) {
                $sort = $request->input('sort');
                if ($sort == 'a-z') {
                    $products = Products::whereIn('parent_id', $productId)->orderBy('name')->paginate(8);
                } else if ($sort == 'z-a') {
                    $products = Products::whereIn('parent_id', $productId)->orderBy('name', 'DESC')->paginate(8);
                } else if ($sort == 'high-to-low') {
                    $products = Products::whereIn('parent_id', $productId)->orderBy('price', 'DESC')->paginate(8);
                } else {
                    $products = Products::whereIn('parent_id', $productId)->orderBy('price')->paginate(8);
                }
            }
        } else {
            $products = Products::where('parent_id', $id)->paginate(8);
            // $products = DB::table('products')
            //     ->join('product_cats', 'products.parent_id', '=', 'product_cats.id')
            //     ->where('products.parent_id', $id)
            //     ->paginate(8);

            if (!empty($request->input('sort'))) {
                $sort = $request->input('sort');
                if ($sort == 'a-z') {
                    $products = Products::where('parent_id', $id)->orderBy('name')->paginate(8);
                } else if ($sort == 'z-a') {
                    $products = Products::where('parent_id', $id)->orderBy('name', 'DESC')->paginate(8);
                } else if ($sort == 'high-to-low') {
                    $products = Products::where('parent_id', $id)->orderBy('price', 'DESC')->paginate(8);
                } else {
                    $products = Products::where('parent_id', $id)->orderBy('price')->paginate(8);
                }
            }
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

    function search(Request $request)
    {
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $products = Products::where('name', 'LIKE', "%{$keyword}%")->paginate(3);
        $list_product =  Products::orderBy('id', 'DESC')->offset(0)->limit(10)->get();
        $list_cat_product = $this->get_cat_product();
        return view('user.product.search', compact('list_cat_product', 'list_product', 'products'));
    }
}
