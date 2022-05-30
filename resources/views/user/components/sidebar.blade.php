<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                @foreach ($list_cat_product as $cat)
                @php
                    $slug = $cat
                @endphp
                    @if ($cat->lever == 1)
                        <li>
                            <a href="{{route('user.catrgory',$cat->id)}}" title="">{{ $cat->name }}</a>
                            <ul class="sub-menu">
                                @foreach ($list_cat_product as $cat_sub)
                                    @if ($cat_sub->lever == 2 && $cat_sub->parent_cat == $cat->id)
                                        <li>
                                            <a href="{{route('user.catrgory',$cat_sub->id)}}" title="">{{ $cat_sub->name }}</a>
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
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                @foreach ($list_product as $item)
                    <li class="clearfix">
                        <a href="{{route('user.detail.product',$item->id)}}" title="" class="thumb fl-left">
                            <img src="{{ asset($item->images) }}" alt="">
                        </a>
                        <div class="info fl-right">
                            <a href="{{route('user.detail.product',$item->id)}}" title="" class="product-name">{{ $item->name }}</a>
                            <div class="price">
                                <span class="new">{{ number_format($item->price,0,0,'.') }}đ</span>
                                <span class="old">7.190.000đ</span>
                            </div>
                            <a href="" title="" class="buy-now">Mua ngay</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public//user/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>
