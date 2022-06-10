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
                            <a href="" title="">{{ $cat_name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">{{ $cat_name }}</h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Hiển thị {{ $count[0] }} trên {{ $count[1] }} sản phẩm</p>
                            <div class="form-filter">
                                <form>
                                    <select name="sort">
                                        <option value="0">Sắp xếp</option>
                                        <option {{ request()->sort == 'a-z' ? 'selected' : '' }} value="a-z">Từ A-Z</option>
                                        <option {{ request()->sort == 'z-a' ? 'selected' : '' }} value="z-a">Từ Z-A</option>
                                        <option {{ request()->sort == 'high-to-low' ? 'selected' : '' }} value="high-to-low">Giá cao
                                            xuống thấp</option>
                                        <option {{ request()->sort == 'low-to-high' ? 'selected' : '' }} value="low-to-high">Giá
                                            thấp lên cao</option>
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
                                        <a href="{{ route('user.detail.product', $item->id) }}" title=""
                                            class="thumb">
                                            <img src="{{ asset($item->images) }}">
                                        </a>
                                        <a href="{{ route('user.detail.product', $item->id) }}" title=""
                                            class="product-name">{{ $item->name }}</a>
                                        <div class="price">
                                            <span
                                                class="new">{{ number_format($item->price, 0, 0, '.') }}đ</span>
                                            <span class="old">20.900.000đ</span>
                                        </div>
                                        <div class="action clearfix">
                                            <form action="{{ route('cart.add', $item->id) }}">
                                                @csrf
                                                <input type="hidden" name="num-order" value="1" id="num-order">
                                                <button type="submit" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm
                                                    giỏ
                                                    hàng</button>
                                            </form>
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
