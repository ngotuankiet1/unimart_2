<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'page']);
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
            $pages = Page::onlyTrashed()->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $pages = Page::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
            // dd($search_users);  //trả về các thông tin
        }

        $count_admin_active = Page::count();
        $count_admin_trash = Page::onlyTrashed()->count();
        $count = [$count_admin_active, $count_admin_trash];
        return view('admins/pages/list', compact('pages', 'count', 'list_act'));
    }

    function add()
    {
        return view('admins/pages/add');
    }

    function action(Request $request)
    {
        $checklist = $request->input('checklist');
        if ($checklist) {
            if (!empty($checklist)) {
                $act = $request->input("act");
                if ($act == "delete") {
                    Page::destroy($checklist);
                    return redirect("admin/page/list")->with("action", "Đưa vào thùng rác thành công");
                }

                if ($act == "forceDelete") {
                    Page::onlyTrashed()
                        ->whereIn('id', $checklist)
                        ->forceDelete();
                    return redirect("admin/page/list")->with("action", "Xóa vĩnh viễn thành công");
                }


                if ($act == "restore") {
                    Page::onlyTrashed()
                        ->whereIn('id', $checklist)
                        ->restore();
                    return redirect("admin/page/list")->with("action", "Khôi phục thành công");
                }
            }
            return redirect("admin/page/list")->with("action", "Không được thực thi chính mình");
        } else {
            return redirect("admin/page/list")->with("action", "Vui lòng chọn");
        }
    }

    function delete($id)
    {
        Page::find($id)->delete();
        return redirect("admin/page/list")->with("action", "Đưa vào thùng rác thành công");
    }

    function edit($id){
        $page = Page::find($id);
        return view('admins/pages/edit',compact('page'));
    }

    function update(Request $request,$id){
        $request->validate(
            [
                'name' => 'required|max:255|min:3',
                'desc' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
            ],

            [
                'name' => 'Tiêu đề trang',
                'desc' => 'Mô tả bài viết',
            ],
        );

        Page::find($id)->update(
            [
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'create_user' =>  Auth::user()->name,
            ]
        );

        return redirect('admin/page/list')->with('status', 'Cập nhật thành công');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255|min:3',
                'desc' => 'required',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
            ],

            [
                'name' => 'Tiêu đề trang',
                'desc' => 'Mô tả bài viết',
            ],
        );

        Page::create(
            [
                'name' => $request->input('name'),
                'desc' => $request->input('desc'),
                'create_user' =>  Auth::user()->name,
            ]
        );

        return redirect('admin/page/add')->with('status', 'Thêm thành công');
    }
}
