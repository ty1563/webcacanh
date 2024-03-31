@extends('Client.share.master')
@section('noi_dung')
    <!-- SLIDER-BANNER-AREA START -->
    <section class="slider-banner-area clearfix" id="app">
        <!-- Sidebar-social-media start -->
        @php
            $slide = \App\Models\SanPham::with('sizeCustoms')->orderBy('xep_hang', 'asc')->take(3)->get();
        @endphp
        <div class="sidebar-social d-none d-md-block">
            <div class="table">
                <div class="table-cell">
                    <ul>
                        <li><a href="#" target="_blank" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>
                        <li><a href="#" target="_blank" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                        <li><a href="#" target="_blank" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                        <li><a href="#" target="_blank" title="Linkedin"><i class="zmdi zmdi-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar-social-media start -->
        <div class="banner-left floatleft">
            <!-- Slider-banner start -->
            <div class="slider-banner">
                <div class="single-banner banner-1">
                    <a class="banner-thumb" href="#"><img
                            src="{{ $slide[0] ? explode(',', $slide[0]->hinh_anh)[0] : '/Client_assets/img/banner/2.jpg' }}"
                            alt="" /></a>
                    <span class="pro-label new-label">Mới</span>
                    <span class="price" style="font-weight: bold;color: #c8a165 ;">
                        @if ($slide[0]->size_active)
                            {{ \App\Helpers\Helper::formatVnd($slide[0]->sizeCustoms->min('gia_ban'), 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($slide[0]->sizeCustoms->max('gia_ban'), 0, ',', '.') }}
                        @else
                            {{ \App\Helpers\Helper::formatVnd($slide[0]->gia_ban, 0, ',', '.') }}
                        @endif
                    </span>
                    <div class="banner-brief mb-1">
                        <h2 class="banner-title">
                            <a href="#" style="font-weight: bold;">
                                @php
                                    $tenSanPham = $slide[0]->ten_san_pham;
                                    $firstPart = $tenSanPham;
                                    $secondPart = '';

                                    if (mb_strlen($tenSanPham) > 15) {
                                        $breakPoint = mb_strpos($tenSanPham, ' ', 15);
                                        if ($breakPoint !== false) {
                                            $firstPart = mb_substr($tenSanPham, 0, $breakPoint);
                                            $secondPart = mb_substr($tenSanPham, $breakPoint + 1);
                                        }
                                    }
                                @endphp
                                {!! $firstPart . ($secondPart ? '<br>' . $secondPart : '') !!}
                            </a>
                        </h2>
                    </div>
                    <a href="#" class="button-one font-16px" data-text="Xem Ngay">Xem Ngay</a>
                </div>

                <div class="single-banner banner-2">
                    <span class="pro-label new-label">Mới</span>
                    <span class="price" style="font-weight: bold;color: #c8a165 ;">
                        @if ($slide[1]->size_active)
                            {{ \App\Helpers\Helper::formatVnd($slide[1]->sizeCustoms->min('gia_ban'), 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($slide[1]->sizeCustoms->max('gia_ban'), 0, ',', '.') }}
                        @else
                            {{ \App\Helpers\Helper::formatVnd($slide[1]->gia_ban, 0, ',', '.') }}
                        @endif
                    </span>
                    <a class="banner-thumb" href="#"><img
                            src="{{ $slide[1] ? explode(',', $slide[1]->hinh_anh)[0] : '/Client_assets/img/banner/2.jpg' }}"
                            alt="" /></a>
                    <div class="banner-brief">
                        <h2 class="banner-title">
                            <a href="#" style="font-weight:">
                                {!! $slide[1]->ten_san_pham !!}
                            </a>
                        </h2>
                        <a href="#" class="button-one font-16px" data-text="Xem Ngay">Xem Ngay</a>
                    </div>
                </div>
            </div>
            <!-- Slider-banner end -->
        </div>
        <div class="slider-right floatleft">
            <!-- Slider-area start -->
            <div class="slider-area">
                <div class="bend niceties preview-2">
                    <img class="nivo-main-image"
                        src="{{ $slide[2] ? explode(',', $slide[2]->hinh_anh)[0] : '/Client_assets/img/banner/2.jpg' }}"
                        style="width: 614.4px; height: 696.875px;">
                    <div class="nivo-caption" style="display: block;">
                        <div class="slider-progress"></div>
                        <div class="slider-content t-lfl s-tb slider-1">
                            <div class="title-container s-tb-c title-compress">
                                <div class="layer-1">

                                    <div class="wow fadeInUpBig  animated" data-wow-duration="1.5s" data-wow-delay="0.5s"
                                        style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.5s; animation-name: fadeInUpBig;">
                                        <h2 class="slider-title1 text-uppercase" style="font-weight: bold;color: #000000 ;">
                                            {{ mb_strlen($slide[2]->ten_san_pham) > 40 ? mb_substr($slide[2]->ten_san_pham, 0, 40) . '...' : $slide[2]->ten_san_pham }}
                                        </h2>
                                    </div>
                                    <div class="wow fadeInUpBig  animated" data-wow-duration="2s" data-wow-delay="0.5s"
                                        style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeInUpBig;">
                                        <p class="slider-pro-brief" style="font-weight: bold;color: #000000;">
                                            {!! mb_strlen($slide[2]->gioi_thieu) > 150 ? mb_substr($slide[2]->gioi_thieu, 0, 150) . '...' : $slide[2]->gioi_thieu !!}
                                        </p>
                                    </div>
                                    <div class="wow fadeInUpBig  animated" data-wow-duration="2.5s" data-wow-delay="0.5s"
                                        style="visibility: visible; animation-duration: 2.5s; animation-delay: 0.5s; animation-name: fadeInUpBig;">
                                        <a href="#" class="button-one style-2 text-uppercase mt-20"
                                            data-text="Xem Ngay">Xem Ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Slider-area end -->
        </div>
        <!-- Sidebar-social-media start -->
        <div class="sidebar-account d-none d-md-block">
            <div class="table">
                <div class="table-cell">
                    <ul>
                        <li><a class="search-open" href="#" title="Search"><i class="zmdi zmdi-search"></i></a>
                        </li>
                        <li><a href="#" title="Login"><i class="zmdi zmdi-lock"></i></a>
                            <div class="customer-login text-left">
                                <form action="#">
                                    <h4 class="title-1 title-border text-uppercase mb-30">Registered customers</h4>
                                    <p class="text-gray">If you have an account with us, Please login!</p>
                                    <input type="text" name="email" placeholder="Email here..." />
                                    <input type="password" placeholder="Password" />
                                    <p><a class="text-gray" href="#">Forget your password?</a></p>
                                    <button class="button-one submit-button mt-15" data-text="login"
                                        type="submit">login</button>
                                </form>
                            </div>
                        </li>
                        <li><a href="my-account.html" title="My-Account"><i class="zmdi zmdi-account"></i></a></li>
                        <li><a href="wishlist.html" title="Wishlist"><i class="zmdi zmdi-favorite"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Sidebar-social-media start -->
    </section>
    <!-- End Slider-section -->
    <!-- sidebar-search Start -->
    <div class="sidebar-search animated slideOutUp">
        <div class="table">
            <div class="table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 p-0">
                            <div class="search-form-wrap">
                                <button class="close-search"><i class="zmdi zmdi-close"></i></button>
                                <form action="#">
                                    <input type="text" placeholder="Search here..." />
                                    <button class="search-button" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar-search End -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="#" src="/Client_assets/img/product/quickview-photo.jpg" />
                                </div>
                            </div><!-- .product-images -->

                            <div class="product-info">
                                <h1>Aenean eu tristique</h1>
                                <div class="price-box-3">
                                    <hr />
                                    <div class="s-price-box">
                                        <span class="new-price">$160.00</span>
                                        <span class="old-price">$190.00</span>
                                    </div>
                                    <hr />
                                </div>
                                <a href="shop.html" class="see-all">See all features</a>
                                <div class="quick-add-to-cart">
                                    <form method="post" class="cart">
                                        <div class="numbers-row">
                                            <input type="number" id="french-hens" value="3" min="1">
                                        </div>
                                        <button class="single_add_to_cart_button" type="submit">Add to cart</button>
                                    </form>
                                </div>
                                <div class="quick-desc">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est
                                    tristique auctor. Donec non est at libero.
                                </div>
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="Google +" href="#"
                                                    class="gplus social-icon"><i class="zmdi zmdi-google-plus"></i></a>
                                            </li>
                                            <li><a target="_blank" title="Twitter" href="#"
                                                    class="twitter social-icon"><i class="zmdi zmdi-twitter"></i></a>
                                            </li>
                                            <li><a target="_blank" title="Facebook" href="#"
                                                    class="facebook social-icon"><i class="zmdi zmdi-facebook"></i></a>
                                            </li>
                                            <li><a target="_blank" title="LinkedIn" href="#"
                                                    class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .product-info -->
                        </div><!-- .modal-product -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>
    <!-- END QUICKVIEW PRODUCT -->
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                slide: @json($slide),
            },
            created() {},
            methods: {

            },
        });
    </script>
@endsection
