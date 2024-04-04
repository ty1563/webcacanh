@extends('Client.share.master')
@section('noi_dung')
    <!-- HEADING-BANNER START -->
    <div class="heading-banner-area overlay-bg"
        style="background:rgba(0,0,0,0) url('{{ $data[0]->hinh_anh[0] }}') no-repeat scroll center center/cover">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-banner">
                        <div class="heading-banner-title">
                            <h2>Thế Giới Thủy Sinh</h2>
                        </div>
                        <div class="breadcumbs pb-15">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Product</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HEADING-BANNER END -->
    <!-- PRODUCT-AREA START -->
    <div class="product-area pt-80 pb-80 product-style-2" id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2">
                    <!-- Widget-Search start -->
                    <aside class="widget widget-search mb-30">
                        <form action="#">
                            <input type="text" placeholder="Search here..." />
                            <button type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </aside>
                    <!-- Widget-search end -->
                    <!-- Widget-Categories start -->
                    <aside class="widget widget-categories  mb-30">
                        <div class="widget-title">
                            <h4>Danh Mục</h4>
                        </div>
                        <div id="cat-treeview" class="widget-info product-cat boxscrol2">
                            <ul>
                                @foreach ($category as $key => $value)
                                    @if ($key == 0)
                                        <li class="open"><span>{{ $value->ten_chuyen_muc }}</span>
                                        @else
                                        <li><span>{{ $value->ten_chuyen_muc }}</span>
                                    @endif
                                    <ul>
                                        @if ($value->danhMucs)
                                            @foreach ($value->danhMucs as $value1)
                                                <li><a href="#">{{ $value1->ten_danh_muc }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                    <!-- Shop-Filter start -->
                    <aside class="widget shop-filter mb-30">
                        <div class="widget-title">
                            <h4>Lọc Theo Giá</h4>
                        </div>
                        <div class="widget-info">
                            <div class="price_filter">
                                <div class="price_slider_amount">
                                    <input type="submit" value="You range :" />
                                    <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                </div>
                                <div id="slider-range"></div>
                            </div>
                        </div>
                    </aside>
                    <!-- Shop-Filter end -->
                    <!-- Widget-banner start -->
                    <aside class="widget widget-banner">
                        <div class="widget-info widget-banner-img">
                            <a href="#"><img src="img/banner/5.jpg" alt="" /></a>
                        </div>
                    </aside>
                    <!-- Widget-banner end -->
                </div>
                <div class="col-lg-9 order-1">
                    <!-- Shop-Content End -->
                    <div class="shop-content mt-tab-30 mb-30 mb-lg-0">
                        <div class="product-option mb-30 clearfix">
                            <!-- Nav tabs -->
                            <ul class="nav d-block shop-tab">
                                <li><a href="#grid-view" data-bs-toggle="tab"><i class="zmdi zmdi-view-module"></i></a></li>
                                <li><a class="active" href="#list-view" data-bs-toggle="tab"><i
                                            class="zmdi zmdi-view-list"></i></a></li>
                            </ul>
                            <div class="showing text-end d-none d-md-block">
                                <p class="mb-0">Showing 01-{{count($data)}} of {{count($data)}} Results</p>
                            </div>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane" id="grid-view">
                                <div class="row">
                                    <template v-for="(v,k) in listSanPham">
                                        <!-- Single-product start -->
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <span class="pro-label new-label">new</span>
                                                    <template>
                                                        <span class="pro-price-2"
                                                            v-if="v.size_active==0">@{{ formatVnd(v.gia_ban) }}</span>
                                                        <span class="pro-price-2" v-else>@{{ formatVnd(v.min_gia_ban) }} -
                                                            @{{ formatVnd(v.max_gia_ban) }}</span>
                                                    </template>
                                                    <a :href="'/product/view/'+v.slug_san_pham"><img :src="v.hinh_anh[0]"
                                                            alt="" /></a>
                                                </div>
                                                <div class="product-info clearfix text-center">
                                                    <div class="fix">
                                                        <h4 class="post-title"><a :href="'/product/view/'+v.slug_san_pham">@{{v.ten_san_pham}}</a></h4>
                                                    </div>
                                                    <div class="fix">
                                                        <span class="pro-rating">
                                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                            <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                                            <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                                        </span>
                                                    </div>
                                                    <div class="product-action clearfix">
                                                        <a href="wishlist.html" data-bs-toggle="tooltip"
                                                            data-placement="top" title="Wishlist"><i
                                                                class="zmdi zmdi-favorite-outline"></i></a>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#productModal" title="Quick View"><i
                                                                class="zmdi zmdi-zoom-in"></i></a>
                                                        <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                            title="Compare"><i class="zmdi zmdi-refresh"></i></a>
                                                        <a href="cart.html" data-bs-toggle="tooltip" data-placement="top"
                                                            title="Add To Cart"><i
                                                                class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single-product end -->
                                    </template>
                                </div>
                            </div>
                            <div class="tab-pane active" id="list-view">
                                <div class="row shop-list">
                                   <template v-for="(v,k) in listSanPham">
                                    <div class="col-lg-12">
                                        <div class="single-product clearfix">
                                            <div class="product-img">
                                                <span class="pro-label new-label">new</span>
                                                <template>
                                                    <span class="pro-price-2"
                                                        v-if="v.size_active==0">@{{ formatVnd(v.gia_ban) }}</span>
                                                    <span class="pro-price-2" v-else>@{{ formatVnd(v.min_gia_ban) }} -
                                                        @{{ formatVnd(v.max_gia_ban) }}</span>
                                                </template>
                                                <a :href="'/product/view/'+v.slug_san_pham"><img :src="v.hinh_anh[0]"
                                                        alt="" /></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="fix">
                                                    <h4 class="post-title floatleft"><a :href="'/product/view/'+v.slug_san_pham">@{{v.ten_san_pham}}</a></h4>
                                                    <span class="pro-rating floatright">
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                                        {{-- <span>( {{rand(1,5)}} Rating )</span> --}}
                                                    </span>
                                                </div>
                                                <div class="fix mb-20">
                                                    <span class="pro-price" v-if="v.size_active==0">@{{formatVnd(v.gia_ban)}}</span>
                                                    <span class="pro-price" v-else>@{{formatVnd(v.min_gia_ban)}} - @{{formatVnd(v.max_gia_ban)}}</span>
                                                </div>
                                                <div class="product-description">
                                                    <p>@{{v.gioi_thieu}}</p>
                                                </div>
                                                <div class="clearfix">
                                                    <div class="cart-plus-minus">
                                                        <input type="text" value="02" name="qtybutton"
                                                            class="cart-plus-minus-box">
                                                    </div>
                                                    <div class="product-action clearfix">
                                                        <a href="wishlist.html" data-bs-toggle="tooltip"
                                                            data-placement="top" title="Wishlist"><i
                                                                class="zmdi zmdi-favorite-outline"></i></a>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#productModal" title="Quick View"><i
                                                                class="zmdi zmdi-zoom-in"></i></a>
                                                        <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                            title="Compare"><i class="zmdi zmdi-refresh"></i></a>
                                                        <a href="cart.html" data-bs-toggle="tooltip" data-placement="top"
                                                            title="Add To Cart"><i
                                                                class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   </template>
                                </div>
                            </div>
                        </div>
                        <!-- Pagination start -->
                        <div class="shop-pagination  text-center">
                            <div class="pagination">
                                <ul>
                                    <li><a href="#"><i class="zmdi zmdi-long-arrow-left"></i></a></li>
                                    <li><a href="#">01</a></li>
                                    <li><a class="active" href="#">02</a></li>
                                    <li><a href="#">03</a></li>
                                    <li><a href="#">04</a></li>
                                    <li><a href="#">05</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-long-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Pagination end -->
                    </div>
                    <!-- Shop-Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT-AREA END -->
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                listSanPham: @json($data),
            },
            created() {

            },
            methods: {
                formatVnd(number) {
                    var trieu = Math.floor(number / 1000000);
                    var ngan = Math.floor((number % 1000000) / 1000);
                    var result = '';
                    if (trieu > 0) {
                        result += trieu + ' Triệu ';
                    }
                    if (ngan > 0) {
                        result += ngan + 'k';
                    }

                    return result ? result : '0';
                },
            },
        });
    </script>
@endsection
