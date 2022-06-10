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
                <h5 class="m-0 ">Danh sách đơn hàng</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" name="keyword" placeholder="Tìm kiếm">
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
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="">
                        <option>Chọn</option>
                        @foreach ($list_act as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            {{-- <th scope="col">Số lượng</th> --}}
                            <th scope="col">Giá trị</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $order = 0;
                        @endphp
                        @foreach ($all_order as $item)
                            @php
                                $order++;
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $order }}</td>
                                <td>{{ $item->order_code }}</td>
                                <td>
                                    {{ $item->shipping_name }} <br>
                                    {{ $item->shipping_phone }} <br>
                                </td>
                                {{-- <td>{{ $item->product_qty }}</td> --}}
                                <td>{{ $item->order_total }}đ</td>
                                <td>
                                    <span
                                        class="badge badge-warning">{{ $item->order_status == 0 ? 'Đang xử lí' : '' }}</span>
                                    <span
                                        class="badge badge-primary">{{ $item->order_status == 1 ? 'Đang giao hàng' : '' }}</span>
                                    <span
                                        class="badge badge-success">{{ $item->order_status == 2 ? 'Hoàn thành' : '' }}</span>
                                    <span
                                        class="badge badge-danger">{{ $item->order_status == 3 ? 'Hủy đơn' : '' }}</span>
                                </td>
                                <td>26:06:2020 14:00</td>
                                <td>
                                    <a href="{{ route('order.detail', $item->order_id) }}"
                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{ route('order.delete', $item->order_id) }}"
                                        onclick="return confirm('Bạn có chắc muốn xóa?')"
                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $all_order->links() }}
            </div>

        </div>
    </div>
@endsection
