@extends('layouts/customer')
@section('content')
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
        <div class="section" id="list-product-wp">
            <div class="section-head clearfix">
                @foreach ($brand_name as $k => $name)
                    <h3 class="section-title fl-left">
                        {{$name -> name}}
                    </h3>
                @endforeach
                <div class="filter-wp fl-right">
                    <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
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
                <ul class="list-item clearfix">
                    @foreach ($brand_by_id as $item)
                        <li>
                            <a href="?page=detail_product" title="" class="thumb">
                                <img src="{{ asset($item->images) }}">
                            </a>
                            <a href="?page=detail_product" title="" class="product-name">{{ $item->name }}</a>
                            <div class="price">
                                <span class="new">{{ $item->price }}đ</span>
                                <span class="old">20.900.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="section" id="paging-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">1</a>
                    </li>
                    <li>
                        <a href="" title="">2</a>
                    </li>
                    <li>
                        <a href="" title="">3</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('sidebar')
    <div class="sidebar fl-left">
        <div class="section" id="category-product-wp">
            <div class="section-head">
                <h3 class="section-title">Danh mục sản phẩm</h3>
            </div>
            <div class="secion-detail">
                <ul class="list-item">
                    @foreach ($list_cat_product as $cat)
                        @php
                            $slug = $cat;
                        @endphp
                        @if ($cat->lever == 1)
                            <li>
                                <a href="{{ URL::to($cat->id . '-' . $cat->name . '.html') }}"
                                    title="">{{ $cat->name }}</a>
                                <ul class="sub-menu">
                                    @foreach ($list_cat_product as $cat_sub)
                                        @if ($cat_sub->lever == 2 && $cat_sub->parent_cat == $cat->id)
                                            <li>
                                                <a href="{{ URL::to($cat->id . '-' . $cat->name . '.html') }}"
                                                    title="">{{ $cat_sub->name }}</a>
                                                <ul class="sub-menu">
                                                    @foreach ($list_cat_product as $cat_sub_3)
                                                        @if ($cat_sub_3->lever == 3 && $cat_sub_3->parent_cat == $cat_sub->id)
                                                            <li>
                                                                <a href="" title="">{{ $cat_sub_3->name }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="section" id="filter-product-wp">
            <div class="section-head">
                <h3 class="section-title">Bộ lọc</h3>
            </div>
            <div class="section-detail">
                <form method="POST" action="">
                    <table>
                        <thead>
                            <tr>
                                <td colspan="2">Giá</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="radio" name="r-price"></td>
                                <td>Dưới 500.000đ</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-price"></td>
                                <td>500.000đ - 1.000.000đ</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-price"></td>
                                <td>1.000.000đ - 5.000.000đ</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-price"></td>
                                <td>5.000.000đ - 10.000.000đ</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-price"></td>
                                <td>Trên 10.000.000đ</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <td colspan="2">Hãng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="radio" name="r-brand"></td>
                                <td>Acer</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-brand"></td>
                                <td>Apple</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-brand"></td>
                                <td>Hp</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-brand"></td>
                                <td>Lenovo</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-brand"></td>
                                <td>Samsung</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-brand"></td>
                                <td>Toshiba</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <td colspan="2">Loại</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="radio" name="r-price"></td>
                                <td>Điện thoại</td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="r-price"></td>
                                <td>Laptop</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="section" id="banner-wp">
            <div class="section-detail">
                <a href="?page=detail_product" title="" class="thumb">
                    <img src="public/images/banner.png" alt="">
                </a>
            </div>
        </div>
    </div>
@endsection
