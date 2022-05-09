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
                <h5 class="m-0 ">Danh sách bài viết</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Tất cả<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Thùng
                        rác<span class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="{{ route('post.action') }}" method="POST">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" name="act" id="act">
                            <option>Chọn</option>
                            @foreach ($list_act as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
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
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($posts->total() > 0)
                                @php
                                    $order = 0;
                                @endphp
                                @foreach ($posts as $item)
                                    @php
                                        $order += 1;
                                    @endphp
                                    <tr class="">
                                        <td>
                                            <input type="checkbox" name="checklist[]" value="{{ $item->id }}">
                                        </td>
                                        <td scope="row">{{ $order }}</td>
                                        <td><img width="100px" src="{{ asset($item->images) }}" alt=""></td>
                                        <td><a href="">{{ $item->name }}</a></td>
                                        <td>{{ $item->post_cat }}</td>
                                        <td>{{ $item->create_user }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ route('post.edit', $item->id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{ route('post.delete', $item->id) }}"
                                                onclick="return confirm('Bạn có chắc muốn xóa?')"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></a>
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
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
