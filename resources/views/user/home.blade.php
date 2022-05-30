@extends('layouts/customer')
@section('content')
    <div class="main-content fl-right">
        <div class="section" id="slider-wp">
            <div class="section-detail">
                <div class="item">
                    <img src="public//user/images/slider-01.png" alt="">
                </div>
                <div class="item">
                    <img src="public//user/images/slider-02.png" alt="">
                </div>
                <div class="item">
                    <img src="public//user/images/slider-03.png" alt="">
                </div>
            </div>
        </div>
        <div class="section" id="support-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <div class="thumb">
                            <img src="public//user/images/icon-1.png">
                        </div>
                        <h3 class="title">Miễn phí vận chuyển</h3>
                        <p class="desc">Tới tận tay khách hàng</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="public//user/images/icon-2.png">
                        </div>
                        <h3 class="title">Tư vấn 24/7</h3>
                        <p class="desc">1900.9999</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="public//user/images/icon-3.png">
                        </div>
                        <h3 class="title">Tiết kiệm hơn</h3>
                        <p class="desc">Với nhiều ưu đãi cực lớn</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="public//user/images/icon-4.png">
                        </div>
                        <h3 class="title">Thanh toán nhanh</h3>
                        <p class="desc">Hỗ trợ nhiều hình thức</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="public//user/images/icon-5.png">
                        </div>
                        <h3 class="title">Đặt hàng online</h3>
                        <p class="desc">Thao tác đơn giản</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="section" id="feature-product-wp">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm nổi bật</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item">
                    @foreach ($list_product_outstanding as $item)
                        <li>
                            <a href="{{route('user.detail.product',$item->id)}}" title="" class="thumb">
                                <img src="{{ asset($item->images) }}">
                            </a>
                            <a href="{{route('user.detail.product',$item->id)}}" title="" class="product-name">{{ $item->name }}</a>
                            <div class="price">
                                <span class="new">{{ number_format($item->price,0,0,'.') }}đ</span>
                                <span class="old">20.900.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route("cart.add",$item->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="section" id="list-product-wp">
            <div class="section-head">
                <h3 class="section-title">Điện thoại</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @foreach ($list_product_phone as $item)
                        <li>
                            <a href="{{route('user.detail.product',$item->id)}}" title="" class="thumb">
                                <img src="{{ asset($item->images) }}">
                            </a>
                            <a href="{{route('user.detail.product',$item->id)}}" title="" class="product-name">{{ $item->name }}</a>
                            <div class="price">
                                <span class="new">{{ number_format($item->price,0,0,'.') }}đ</span>
                                <span class="old">20.900.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route("cart.add",$item->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="section" id="list-product-wp">
            <div class="section-head">
                <h3 class="section-title">Laptop</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @foreach ($list_product_laptop as $item)
                        <li>
                            <a href="{{route('user.detail.product',$item->id)}}" title="" class="thumb">
                                <img src="{{ asset($item->images) }}">
                            </a>
                            <a href="{{route('user.detail.product',$item->id)}}" title="" class="product-name">{{ $item->name }}</a>
                            <div class="price">
                                <span class="new">{{ number_format($item->price,0,0,'.') }}đ</span>
                                <span class="old">20.900.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route("cart.add",$item->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @include('user.components.sidebar')
@endsection
