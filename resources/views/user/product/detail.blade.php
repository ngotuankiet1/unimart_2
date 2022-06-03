@extends('layouts/customer')
@section('content')
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Điện thoại</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img style="border: none" width="350px" id="zoom" src="{{ asset($product->images) }}"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg" />
                            </a>
                            <div id="list-thumb">
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="public/images/img-pro-01.png" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ Illuminate\Support\Str::of($product->name)->words(10) }}</h3>
                            <div class="desc">
                                {!! $product->intro !!}
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status">{{ $product->warehouse }}</span>
                            </div>
                            <p class="price">{{ number_format($product->price, 0, 0, '.') }}Đ</p>
                            <form action="{{ route('cart.add', $product->id) }}">
                                @csrf
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num-order" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                    @if (session('info'))
                                        <div class="alert alert-danger">
                                            {{ session('info') }}
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <div class="product-detail detail-hide">
                            {!! $product->desc !!}
                        </div>
                    </div>
                    <div class="read-more">
                        <a href="#" class="show_hide" data-content="toggle-text">Đọc Thêm</a>
                    </div>
                </div>
                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($product_suggestion as $item)
                                @if ($product->id != $item->id)
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
                                            <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ
                                                hàng</a>
                                            <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua
                                                ngay</a>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @include('user.components.sidebar')
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('user/js/detail_products.js') }}"></script>
@endsection
