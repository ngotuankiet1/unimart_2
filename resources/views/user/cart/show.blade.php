@extends('layouts/customer');
@section('content')
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Giỏ hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            @if (Cart::count() > 0)
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Mã sản phẩm</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Giá sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td colspan="2">Thành tiền</td>
                                        <td>Tác vụ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $order = 0;
                                    @endphp
                                    @foreach (Cart::content() as $item)
                                        @php
                                            $order++;
                                        @endphp
                                        <tr>
                                            <td>{{ $order }}</td>
                                            <td>
                                                <a href="" title="" class="thumb">
                                                    <img src="{{ asset($item->options->images) }}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.detail.product', $item->id) }}" title=""
                                                    class="name-product">{{ $item->name }}</a>
                                            </td>
                                            <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                            <td>
                                                <input type="number" min="1" max="10" name="qty" value="{{ $item->qty }}"
                                                    class="num-order">
                                                <input type="hidden" value="{{ $item->rowId }}" name="rowId_cart"
                                                    class="form_control">
                                            </td>
                                            <td>{{ number_format($item->total, 0, ',', '.') }}đ</td>
                                            <td colspan="3">
                                                <a onclick="return confirm('Bạn có chắc muốn xóa?')"
                                                    href="{{ route('cart.delete', $item->rowId) }}" title="Delete"
                                                    class="del-product"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <p id="total-price" class="fl-right">Tổng giá:
                                                    <span>{{ Cart::total() }}đ</span>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <div class="fl-right">
                                                    <input type="submit" id="update-cart" value="Cập nhật giỏ hàng">
                                                    @php
                                                        $customer_id = Session::get('customer_id');
                                                    @endphp
                                                    @if ($customer_id != null)
                                                        <a href="{{ route('cart.checkout') }}" title=""
                                                            id="checkout-cart">Thanh toán</a>
                                                    @else
                                                        <a href="{{ route('cart.checkoutLogin') }}" title=""
                                                            id="checkout-cart">Thanh toán</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào
                            số
                            lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.
                        </p>
                        <a href="{{ url('/') }}" title="" id="buy-more">Mua tiếp</a><br />
                        <a href="{{ route('cart.delete', ['rowId' => 'all']) }}" title="" id="delete-cart">Xóa giỏ
                            hàng</a>
                    </div>
                </div>
            @else
                <p style="color: red">không có sản phẩm</p>
                <a href="{{ url('/') }}">Trở về trang chủ</a>
            @endif

        </div>
    </div>
@endsection
