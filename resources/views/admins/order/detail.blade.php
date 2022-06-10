@extends('layouts/admins')
@section('content')
    <style>
        .detail-order ul li {
            list-style-type: none;
            margin-bottom: 10px;
        }

        .detail-order ul {
            margin: 0px;
            padding: 0px;
        }

        .detail-order .info-order select {
            border: 1px solid #ccc;
            padding: 7px 20px;
            font-size: 13px;
            border-radius: 3px;
            margin-right: 15px;
        }

    </style>
    <div id="content" class="container-fluid detail-order">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card info-order">
            <div class="card-header font-weight-bold">
                Thông tin đơn hàng
            </div>
            <div class="card-body">
                <ul class="list-item">
                    <li>
                        <h5 class="title">
                            <i class="fas fa-info-circle"></i>
                            Thông tin khách hàng
                        </h5>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Họ và tên</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Thời gian đặt hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order_by_id->shipping_name }}</td>
                                    <td>{{ $order_by_id->order_code }}</td>
                                    <td>{{ $order_by_id->shipping_phone }}</td>
                                    <td>{{ $order_by_id->shipping_address }}</td>
                                    <td>{{ $order_by_id->shipping_email }}</td>
                                    <td>04/06/2022</td>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                    <form action="{{ route('order.update.token', $order_by_id->order_id) }}" method="POST">
                        @csrf
                        <li>
                            <h5 class="title">
                                <i class="fas fa-tasks"></i>
                                Tình trạng đơn hàng
                            </h5>
                            <select name="status" id="">
                                <option {{ $order_by_id->order_status == 0 ? 'selected' : ' ' }} value="0">
                                    Đang xử lý
                                </option>
                                <option {{ $order_by_id->order_status == 1 ? 'selected' : ' ' }} value="1">
                                    Đang giao hàng
                                </option>
                                <option {{ $order_by_id->order_status == 2 ? 'selected' : ' ' }} value="2">
                                    Hoàn thành
                                </option>
                                <option {{ $order_by_id->order_status == 3 ? 'selected' : ' ' }} value="3">
                                    Hủy đơn
                                </option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="submit" class="btn btn-primary" value="Cập nhật đơn hàng" name="btn-updateOrder">
                        </li>
                    </form>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header font-weight-bold">
                Chi tiết đơn hàng
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $order = 1;
                        @endphp
                        @foreach ($order_products as $item)
                            <tr>
                                <td scope="row">{{ $order++ }}</td>
                                <td><img width="120px" src="{{ asset($item->images) }}" alt="">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                <td>{{ $item->product_qty }}</td>
                                <td>{{ number_format($item->product_price, 0, ',', '.') }}đ</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header font-weight-bold">
                Giá trị đơn hàng
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="title-num">Tổng số lượng sản phẩm</td>
                            <td class="detail-num">{{ $total_qty }} sản phẩm</td>
                        </tr>
                        <tr class="total-order">
                            <td class="text-success">Tổng giá trị đơn hàng</td>
                            <td class="text-success">{{ $order_by_id->order_total }}đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
