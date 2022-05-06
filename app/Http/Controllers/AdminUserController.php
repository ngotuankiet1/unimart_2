<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //

    function __construct()
    {
        $this -> middleware(function($request,$next){
            session(['module_active' => 'user']);
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
            $users = User::onlyTrashed()->paginate(10);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $users = User::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
            // dd($search_users);  //trả về các thông tin
        }

        $count_admin_active = User::count();
        $count_admin_trash = User::onlyTrashed()->count();
        $count = [$count_admin_active, $count_admin_trash];
        return view('admins.users.list', compact('users', 'count', 'list_act'));
    }

    function search(Request $request)
    {
        // echo "ok";
        $output = '';
        $data = User::where('name', 'LIKE', '%' . $request->key . '%')->get();
        foreach ($data as $dt) {
            $output .= '<ul type="none">
        <li>' . $dt->name . '</li>
        </ul>';
        }
        return response()->json($output);
    }

    function action(Request $request)
    {
        $checklist = $request->input('listcheck');
        if ($checklist) {
            foreach ($checklist as $k => $id) {
                if (Auth::id() == $id) {
                    unset($checklist[$k]);
                }
            }

            if (!empty($checklist)) {
                $act = $request->input("act");
                if ($act == "delete") {
                    User::destroy($checklist);
                    return redirect("admin/user/list")->with("action", "Đưa vào thùng rác thành công");
                }

                if ($act == "forceDelete") {
                    User::onlyTrashed()
                        ->whereIn('id', $checklist)
                        ->forceDelete();
                    return redirect("admin/user/list")->with("action", "Xóa vĩnh viễn thành công");
                }


                if ($act == "restore") {
                    User::onlyTrashed()
                        ->whereIn('id', $checklist)
                        ->restore();
                    return redirect("admin/user/list")->with("action", "Khôi phục thành công");
                }
            }
            return redirect("admin/user/list")->with("action", "Không được thực thi chính mình");
        } else {
            return redirect("admin/user/list")->with("action", "Vui lòng chọn");
        }
    }

    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();

            return redirect("admin/user/list")->with("status", "Đưa vào thùng rác thành công");
        } else {
            return redirect("admin/user/list")->with("status", "Đưa vào thùng rác không thành công");
        }
    }


    function add()
    {
        return view('admins.users.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'password_confirm' => 'same:password',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
                'same' => 'Xác nhận mật khẩu không thành công',
            ],

            [
                'name' => 'Tên người dùng',
                'email' => 'Email',
                'password' => 'Mật khẩu',
            ],

        );

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),  #(Hash::make(password): Hàm mã hóa)
        ]);

        return redirect('admin/user/list')->with('status', 'Đã thêm thành viên thành công');
    }


    function edit($id)
    {
        $user = User::find($id);
        return view('admins.users.edit', compact('user'));
    }

    function update(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8',
                'password_confirm' => 'same:password',
            ],

            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối ta mã ký tự',
                'same' => 'Xác nhận mật khẩu không thành công',
            ],

            [
                'name' => 'Tên người dùng',
                'password' => 'Mật khẩu',
            ],
        );

        User::find($id)->update(
            [
                'name' => $request->input('name'),
                'password' => Hash::make($request->input('password')),
            ]
        );
        return redirect('admin/user/list')->with('status', 'Cập nhật thành công');
    }
}
