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
                            <a href="{{ route('user.catrgory', $cat->id) }}"
                                title="">{{ $cat->name }}</a>
                            <ul class="sub-menu">
                                @foreach ($list_cat_product as $cat_sub)
                                    @if ($cat_sub->lever == 2 && $cat_sub->parent_cat == $cat->id)
                                        <li>
                                            <a href="{{ route('user.catrgory', $cat_sub->id) }}"
                                                title="">{{ $cat_sub->name }}</a>
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
