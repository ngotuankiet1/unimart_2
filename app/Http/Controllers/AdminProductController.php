<?php

namespace App\Http\Controllers;

use App\Product_cat;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    //
    function __construct()
    {
        $this -> middleware(function($request,$next){
            session(['module_active' => 'product']);
            return $next($request);
        });
    }

    // ====================CAT PRODUCT=============================

    function get_cat_product(){
        $data = Product_cat::orderBy('id','DESC')->get();
        $result = [];
        Product_cat::data_tree($data,0,1,$result);
        return $result;
    }

    function show_cat(){
        $list_cat = $this->get_cat_product();
        return view('admins.products.cat_list',compact('list_cat'));
    }

    function delete_cat($id){
        Product_cat::find($id)->delete();
        return redirect('admin/product/cat/list')->with('status', 'Xóa danh mục thành công');
    }

    function edit_cat($id){
        $list_cat = $this->get_cat_product();
        $cat = Product_cat::find($id);
        return view('admins/products/cat_edit',compact('list_cat','cat'));
    }

    function update_cat(Request $request,$id){
        $request -> validate(
            [
                'name' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
            ],

            [
                'name' => 'Tên danh mục',
            ],
        );

        Product_cat::find($id)->update(
            [
                'name' => $request->input('name'),
                'parent_cat' => $request->input('parent_cat'),
            ]
        );
        return redirect('admin/product/cat/list')->with('status', 'Cập nhật danh mục thành công');
    }

    function store_cat(Request $request){
        $request -> validate(
            [
                'name' => 'required',
                'parent_cat' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
            ],

            [
                'name' => 'Tên danh mục',
                'parent_cat' => 'Danh mục cha',
            ],
        );

        Product_cat::create(
            [
                'name' => $request->input('name'),
                'parent_cat' => $request->input('parent_cat'),
            ]
        );
        return redirect('admin/product/cat/list')->with('status', 'Đã thêm danh mục thành công');
    }
}
