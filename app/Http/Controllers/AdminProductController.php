<?php

namespace App\Http\Controllers;

use App\Product_cat;
use App\Products;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'product']);
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
            $products = Products::onlyTrashed()->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $products = Products::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
            // dd($search_users);  //trả về các thông tin
        }

        $count_admin_active = Products::count();
        $count_admin_trash = Products::onlyTrashed()->count();
        $count = [$count_admin_active, $count_admin_trash];
        $product_cat = Product_cat::get();
        return view('admins.products.list', compact('products', 'count', 'list_act','product_cat'));
    }

    function add()
    {
        $list_cat = $this->get_cat_product();
        return view('admins.products.add', compact('list_cat'));
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255|min:3',
                'price' => 'required|integer',
                'file' => 'required|image',
                'desc' => 'required',
                'intro' => 'required',
                'parent_cat' => 'required',
                'status' => 'required',
                'outstanding' => 'required',
                'warehouse' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
                'image' => ':attribute bắt buộc phải là ảnh',
            ],

            [
                'name' => 'Tên danh mục',
                'price' => 'Giá sản phẩm',
                'file' => 'Ảnh sản phẩm',
                'desc' => 'Mô tả sản phẩm',
                'intro' => 'Chi tiết sản phẩm',
                'parent_cat' => 'Danh mục sản phẩm',
                'status' => 'Trang thái',
                'outstanding' => 'Nổi bật',
                'warehouse' => 'Kho hàng',
            ],
        );

        $input = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file;
            $path = $file->move('public/uploads/', $file->getClientOriginalName());
            $thumnail = 'uploads/' . $file->getClientOriginalName();
            $input['thumnail'] = $thumnail;
        }

        Products::create(
            [
                'name' =>  $request->input('name'),
                'price' =>  $request->input('price'),
                'images' => $input['thumnail'],
                'desc' =>  $request->input('desc'),
                'intro' =>  $request->input('intro'),
                'parent_id' =>  $request->input('parent_cat'),
                'status' =>  $request->input('status'),
                'outstanding' =>  $request->input('outstanding'),
                'warehouse' =>  $request->input('warehouse'),
            ]
        );

        return redirect('admin/product/add')->with('status', 'Thêm sản phẩm thành công');
    }

    function delete($id)
    {
        Products::find($id)->delete();
        return redirect('admin/product/list')->with('status', 'Đã đưa vào thùng rác');
    }

    function action(Request $request)
    {
        $checklist = $request->input('checklist');
        if ($checklist) {
            if (!empty($checklist)) {
                $act = $request->input("act");
                if ($act == "delete") {
                    Products::destroy($checklist);
                    return redirect("admin/product/list")->with("action", "Đưa vào thùng rác thành công");
                }

                if ($act == "forceDelete") {
                    Products::onlyTrashed()
                        ->whereIn('id', $checklist)
                        ->forceDelete();
                    return redirect("admin/product/list")->with("action", "Xóa vĩnh viễn thành công");
                }


                if ($act == "restore") {
                    Products::onlyTrashed()
                        ->whereIn('id', $checklist)
                        ->restore();
                    return redirect("admin/product/list")->with("action", "Khôi phục thành công");
                }
            }
            return redirect("admin/product/list")->with("action", "Không được thực thi chính mình");
        } else {
            return redirect("admin/product/list")->with("action", "Vui lòng chọn");
        }
    }

    function edit($id)
    {
        $product = Products::find($id);
        $list_cat = $this->get_cat_product();
        return view('admins/products/edit', compact('product', 'list_cat'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:255|min:3',
                'price' => 'required|integer',
                // 'file' => 'required|image',
                'desc' => 'required',
                'intro' => 'required',
                'parent_cat' => 'required',
                'status' => 'required',
                'outstanding' => 'required',
                'warehouse' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
                'image' => ':attribute bắt buộc phải là ảnh',
            ],

            [
                'name' => 'Tên danh mục',
                'price' => 'Giá sản phẩm',
                'file' => 'Ảnh sản phẩm',
                'desc' => 'Mô tả sản phẩm',
                'intro' => 'Chi tiết sản phẩm',
                'parent_cat' => 'Danh mục sản phẩm',
                'status' => 'Trang thái',
                'outstanding' => 'Nổi bật',
                'warehouse' => 'Kho hàng',
            ],
        );

        $input = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file;
            $path = $file->move('public/uploads/', $file->getClientOriginalName());
            $thumnail = 'uploads/' . $file->getClientOriginalName();
            $input['thumnail'] = $thumnail;
        }else{
            $path_images = Products::where('id',$id)->pluck('images');
            $input['thumnail'] = $path_images[0];
        }

        Products::find($id)->update(
            [
                'name' =>  $request->input('name'),
                'price' =>  $request->input('price'),
                'images' => $input['thumnail'],
                'desc' =>  $request->input('desc'),
                'intro' =>  $request->input('intro'),
                'parent_id' =>  $request->input('parent_cat'),
                'status' =>  $request->input('status'),
                'outstanding' =>  $request->input('outstanding'),
                'warehouse' =>  $request->input('warehouse'),
            ]
        );

        return redirect('admin/product/list')->with('status', 'Cập nhật sản phẩm thành công');
    }

    // ====================CAT PRODUCT=============================

    function get_cat_product()
    {
        $data = Product_cat::orderBy('id', 'DESC')->get();
        $result = [];
        Product_cat::data_tree($data, 0, 1, $result);
        return $result;
    }

    function show_cat()
    {
        $list_cat = $this->get_cat_product();
        return view('admins.products.cat_list', compact('list_cat'));
    }

    function delete_cat($id)
    {
        Product_cat::find($id)->delete();
        return redirect('admin/product/cat/list')->with('status', 'Xóa danh mục thành công');
    }

    function edit_cat($id)
    {
        $list_cat = $this->get_cat_product();
        $cat = Product_cat::find($id);
        return view('admins/products/cat_edit', compact('list_cat', 'cat'));
    }

    function update_cat(Request $request, $id)
    {
        $request->validate(
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

    function store_cat(Request $request)
    {
        $request->validate(
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
