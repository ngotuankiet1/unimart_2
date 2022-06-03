@extends('layouts/customer')
@section('content')
    <div class="main-content fl-right">
        <div class="section" id="list-product-wp">
            <div class="section-head">
                <h3 class="section-title">Kết quả tìm kiếm</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @if ($products->total() > 0)
                        @foreach ($products as $item)
                            <li>
                                <a href="{{ route('user.detail.product', $item->id) }}" title="" class="thumb">
                                    <img src="{{ asset($item->images) }}">
                                </a>
                                <a href="{{ route('user.detail.product', $item->id) }}" title=""
                                    class="product-name">{{ $item->name }}</a>
                                <div class="price">
                                    <span class="new">{{ number_format($item->price, 0, 0, '.') }}đ</span>
                                    <span class="old">20.900.000đ</span>
                                </div>
                                <div class="action clearfix">
                                    <form action="{{ route('cart.add', $item->id) }}">
                                        @csrf
                                        <input type="hidden" name="num-order" value="1" id="num-order">
                                        <button type="submit" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ
                                            hàng</button>
                                    </form>
                                    <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <tr>
                            <p class="bg-white">không có dữ liệu</p>
                        </tr>
                    @endif
                </ul>
                    {{ $products->links() }}
            </div>
        </div>
    </div>
    @include('user.components.sidebar')
@endsection
