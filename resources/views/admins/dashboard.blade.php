@extends('layouts/admins')
@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[0]}}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[1]}}</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[2]}}</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[3]}}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                    <div class="card-header">Đang giao hàng</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count[4]}}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
        <div class="card">
            <div class="card-header font-weight-bold">
                ĐƠN HÀNG MỚI
            </div>
            <div class="card-body">
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
