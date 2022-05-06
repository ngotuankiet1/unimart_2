@extends('layouts/admins')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" class="form-control form-search search_ajax" name="keyword"
                        placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
            <div class="suggestsearch">
                <ul type="none">
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Tất cả<span
                        class="text-muted">({{ $count[0] }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Thùng
                    rác<span class="text-muted">({{ $count[1] }})</span></a>
            </div>
            <form action="{{ url('admin/user/action') }}" method="">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="act">
                        <option>Chọn</option>
                        @foreach ($list_act as $k => $v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                @if (session('action'))
                    <div class="alert alert-success">
                        {{ session('action') }}
                    </div>
                @endif
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->total() > 0)
                            @php
                                $order = 0;
                            @endphp
                            @foreach ($users as $user)
                                @php
                                    $order++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="listcheck[]" value="{{ $user->id }}">
                                    </td>
                                    <th scope="row">{{ $order }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{url('admin/user/edit',$user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fa fa-edit"></i></a>
                                        @if ($user->id != Auth::id())
                                            <a href="{{ route('admin-delete', $user->id) }}"
                                                onclick="return confirm('Bạn có chắc muốn xóa?')"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="bg-white">không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
