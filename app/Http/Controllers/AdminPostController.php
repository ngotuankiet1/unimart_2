<?php

namespace App\Http\Controllers;

use App\Post_cats;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'post']);
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
            $posts = Posts::onlyTrashed()->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $posts = Posts::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
            // dd($search_users);  //trả về các thông tin
        }

        $count_admin_active = Posts::count();
        $count_admin_trash = Posts::onlyTrashed()->count();
        $count = [$count_admin_active, $count_admin_trash];
        return view('admins.posts.list', compact('posts', 'count', 'list_act'));
    }

    function action(Request $request)
    {
        $checklist = $request->input('checklist');
        if ($checklist) {
            if (!empty($checklist)) {
                $act = $request->input("act");
                if ($act == "delete") {
                    Posts::destroy($checklist);
                    return redirect("admin/post/list")->with("action", "Đưa vào thùng rác thành công");
                }

                if ($act == "forceDelete") {
                    Posts::onlyTrashed()
                        ->whereIn('id', $checklist)
                        ->forceDelete();
                    return redirect("admin/post/list")->with("action", "Xóa vĩnh viễn thành công");
                }


                if ($act == "restore") {
                    Posts::onlyTrashed()
                        ->whereIn('id', $checklist)
                        ->restore();
                    return redirect("admin/post/list")->with("action", "Khôi phục thành công");
                }
            }
            return redirect("admin/post/list")->with("action", "Không được thực thi chính mình");
        } else {
            return redirect("admin/post/list")->with("action", "Vui lòng chọn");
        }
    }

    function delete($id)
    {
        Posts::find($id)->delete();
        return redirect("admin/post/list")->with("status", "Đưa vào thùng rác thành công");
    }

    function add()
    {
        $list_cat = $this->get_cat_post();
        return view('admins.posts.add', compact('list_cat'));
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255|min:3',
                'file' => 'required|image',
                'desc' => 'required',
                'parent_cat' => 'required',
                'status' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
                'image' => ':attribute bắt buộc phải là ảnh',
            ],

            [
                'name' => 'Tiêu đề bài viết',
                'file' => 'Ảnh bài viết',
                'desc' => 'Mô tả bài viết',
                'parent_cat' => 'Danh mục bài viết',
                'status' => 'Trang thái',
            ],
        );

        $input = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file;
            $path = $file->move('public/uploads/posts/', $file->getClientOriginalName());
            $thumnail = 'uploads/posts/' . $file->getClientOriginalName();
            $input['thumnail'] = $thumnail;
        }

        Posts::create(
            [
                'name' =>  $request->input('name'),
                'images' => $input['thumnail'],
                'desc' =>  $request->input('desc'),
                'post_cat' =>  $request->input('parent_cat'),
                'status' =>  $request->input('status'),
                'create_user' =>  Auth::user()->name,
            ]
        );
        return redirect('admin/post/add')->with('status', 'Thêm bài viết thành công');
    }

    function edit($id)
    {
        $list_cat = $this->get_cat_post();
        $post = Posts::find($id);
        return view('admins/posts/edit', compact('list_cat', 'post'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:255|min:3',
                'file' => 'required|image',
                'desc' => 'required',
                'parent_cat' => 'required',
                'status' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
                'image' => ':attribute bắt buộc phải là ảnh',
            ],

            [
                'name' => 'Tiêu đề bài viết',
                'file' => 'Ảnh bài viết',
                'desc' => 'Mô tả bài viết',
                'parent_cat' => 'Danh mục bài viết',
                'status' => 'Trang thái',
            ],
        );

        $input = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file;
            $path = $file->move('public/uploads/posts/', $file->getClientOriginalName());
            $thumnail = 'uploads/posts/' . $file->getClientOriginalName();
            $input['thumnail'] = $thumnail;
        }

        Posts::find($id)->update(
            [
                'name' =>  $request->input('name'),
                'images' => $input['thumnail'],
                'desc' =>  $request->input('desc'),
                'post_cat' =>  $request->input('parent_cat'),
                'status' =>  $request->input('status'),
                'create_user' =>  Auth::user()->name,
            ]
        );
        return redirect('admin/post/list')->with('status', 'Cập nhật bài viết thành công');
    }

    // ====================CAT POST=============================
    function get_cat_post()
    {
        $data = Post_cats::orderBy('id', 'DESC')->get();
        $result = [];
        Post_cats::data_tree($data, 0, 1, $result);
        return $result;
    }

    function show_cat()
    {
        $list_cat = $this->get_cat_post();
        return view('admins.posts.cat_list', compact('list_cat'));
    }

    function delete_cat($id)
    {
        Post_cats::where('id', $id,)->delete();
        return redirect('admin/post/cat/list')->with('status', 'Xóa danh mục thành công');
    }

    function edit_cat($id)
    {
        $list_cat = $this->get_cat_post();
        $cat = Post_cats::find($id);
        return view('admins/posts/cat_edit', compact('list_cat', 'cat'));
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

        Post_cats::find($id)->update(
            [
                'name' => $request->input('name'),
                'parent_cat' => $request->input('parent_cat'),
            ]
        );
        return redirect('admin/post/cat/list')->with('status', 'Cập nhật danh mục thành công');
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

        Post_cats::create(
            [
                'name' => $request->input('name'),
                'parent_cat' => $request->input('parent_cat'),
            ]
        );
        return redirect('admin/post/cat/list')->with('status', 'Đã thêm danh mục thành công');
    }
}
