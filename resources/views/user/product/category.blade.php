@extends('layouts/customer');
@section('content')
    <div id="main-content-wp" class="clearfix category-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">{{$cat_name}}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">{{$cat_name}}</h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Hiển thị {{$count[0]}} trên {{$count[1]}} sản phẩm</p>
                            <div class="form-filter">
                                <form method="POST" action="">
                                    <select name="select">
                                        <option value="0">Sắp xếp</option>
                                        <option value="1">Từ A-Z</option>
                                        <option value="2">Từ Z-A</option>
                                        <option value="3">Giá cao xuống thấp</option>
                                        <option value="3">Giá thấp lên cao</option>
                                    </select>
                                    <button type="submit">Lọc</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="section-detail">
                        @if ($products->count() > 0)
                            <ul class="list-item clearfix">
                                @foreach ($products as $item)
                                    <li>
                                        <a href="{{route('user.detail.product',$item->id)}}" title="" class="thumb">
                                            <img src="{{ asset($item->images) }}">
                                        </a>
                                        <a href="{{route('user.detail.product',$item->id)}}" title=""
                                            class="product-name">{{ $item->name }}</a>
                                        <div class="price">
                                            <span
                                                class="new">{{ number_format($item->price, 0, 0, '.') }}đ</span>
                                            <span class="old">20.900.000đ</span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ
                                                hàng</a>
                                            <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>không tìm thấy bất kì sản phẩm nào</p>
                        @endif
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            @include('user.product.componmentSidebar')
        </div>
    </div>
@endsection
