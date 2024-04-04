<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('Client.share.css')
</head>

<body>
    <div class="loader-fullscreen-wrapper">
        <div class="loader-fullscreen">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
    </div>
    <div class="wrapper" id="app">
        @include('Client.share.mobile-header')
        @include('Client.share.mobile-menu')
        <!-- HEADER-AREA START -->
        <header id="sticky-menu" class="header">
            <div class="header-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 offset-md-4 col-7">
                            <div class="logo text-md-center">
                                <a href="/"><img height="48" width="48" src="/logo.svg"
                                        alt="" /></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-5">
                            <div class="mini-cart text-end">
                                <ul>
                                    <li>
                                        <a class="cart-icon" href="#">
                                            <i class="zmdi zmdi-shopping-cart"></i>
                                            <span>@{{ listCart.length }}</span>
                                        </a>
                                        <div class="mini-cart-brief text-left">
                                            <div class="cart-items">
                                                <p class="mb-0">You have <span>@{{ listCart.length }} items</span> in
                                                    your shopping bag
                                                </p>
                                            </div>
                                            <div class="all-cart-product clearfix">
                                                <template v-for="(v,k) in listCart">
                                                    <div class="single-cart clearfix">
                                                        <div class="cart-photo">
                                                            <a href="#"><img height="90" width="90"
                                                                    :src="v.hinh_anh[0]" alt="" /></a>
                                                        </div>
                                                        <div class="cart-info">
                                                            <h5><a href="#">@{{ formatString(v.ten_san_pham, 25) }}</a></h5>
                                                            <p class="mb-0">Giá : @{{ formatVND(v.gia_ban) }}</p>
                                                            <p class="mb-0">SL : @{{ v.so_luong }} </p>
                                                            <p class="mb-0">Loại : @{{ v.size }} </p>
                                                            <span class="cart-delete"><a
                                                                    @click.prevent="removeFromCart(v.id)"
                                                                    href="#"><i
                                                                        class="zmdi zmdi-close"></i></a></span>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="cart-totals">
                                                <h5 class="mb-0">Tổng Tiền : <span>@{{ formatVND(tongTien) }}</span></h5>
                                            </div>
                                            <div class="cart-bottom  clearfix">
                                                <a href="cart.html" class="button-one floatleft text-uppercase"
                                                    data-text="View cart">View cart</a>
                                                <a href="/checkout" class="button-one floatright text-uppercase"
                                                    data-text="Check out">Check out</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MAIN-MENU START -->
            <div class="menu-toggle hamburger hamburger--emphatic d-none d-md-block">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
            <div class="main-menu  d-none d-md-block">
                <nav>
                    <ul>
                        <li><a href="/"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z">
                                    </path>
                                </svg>
                                Trang Chủ</a>
                            <div class="sub-menu menu-scroll">
                                <ul>
                                    <li class="menu-title">Trang Chủ</li>
                                    <li><a href="/">Về Trang Chủ</a></li>
                                    <li><a href="/info">Thông Tin</a></li>
                                    <li><a href="/oder">Đơn Hàng Đã Mua</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
                                    </path>
                                </svg>
                                Danh Mục</a>
                            <div class="sub-menu menu-scroll">
                                <ul>
                                    <li class="menu-title">Danh Sách Danh Mục</li>
                                    @if (count($danhMuc) > 0)
                                        @foreach ($danhMuc as $value)
                                            <li><a href="blog.html">{{ $value->ten_danh_muc }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </li>

                        <li><a href="blog.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="M19 2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.806 5 19s.55-.988 1.012-1H21V4c0-1.103-.897-2-2-2zm0 14H5V5c0-.806.55-.988 1-1h13v12z">
                                    </path>
                                </svg>
                                Kiến Thức</a></li>
                        <li><a href="about.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="M20 3H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 16H5V5h14v14z">
                                    </path>
                                    <path d="M11 7h2v2h-2zm0 4h2v6h-2z"></path>
                                </svg>
                                Thông Tin</a></li>
                        <li><a href="contact.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="M21 2H6a2 2 0 0 0-2 2v3H2v2h2v2H2v2h2v2H2v2h2v3a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-8 2.999c1.648 0 3 1.351 3 3A3.012 3.012 0 0 1 13 11c-1.647 0-3-1.353-3-3.001 0-1.649 1.353-3 3-3zM19 18H7v-.75c0-2.219 2.705-4.5 6-4.5s6 2.281 6 4.5V18z">
                                    </path>
                                </svg>
                                Liên Hệ</a></li>
                        @if (Auth::guard('khach')->check())
                            <li><a href="/logout"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24"
                                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                        <path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path>
                                        <path
                                            d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z">
                                        </path>
                                    </svg>
                                    Đăng Xuất</a></li>
                        @else
                            <li><a href="/login"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24"
                                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                        <path d="m13 16 5-4-5-4v3H4v2h9z"></path>
                                        <path
                                            d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z">
                                        </path>
                                    </svg>
                                    Đăng Nhập</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <!-- MAIN-MENU END -->
        </header>
        <!-- HEADER-AREA END -->

        <section class="slider-banner-area clearfix">
            <!-- Sidebar-social-media start -->
            <div class="sidebar-social d-none d-md-block">
                <div class="table">
                    <div class="table-cell">
                        <ul>
                            <li><a href="#" target="_blank" title="Google Plus"><i
                                        class="zmdi zmdi-google-plus"></i></a>
                            </li>
                            <li><a href="#" target="_blank" title="Twitter"><i
                                        class="zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#" target="_blank" title="Facebook"><i
                                        class="zmdi zmdi-facebook"></i></a>
                            </li>
                            <li><a href="#" target="_blank" title="Linkedin"><i
                                        class="zmdi zmdi-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar-social-media start -->
            <div class="banner-left floatleft">
                <!-- Slider-banner start -->
                <div class="slider-banner">
                    <div class="single-banner banner-1">
                        <a class="banner-thumb" href="/product/view/{{ $slide[0]->slug_san_pham }}"><img
                                height="375" width="450"
                                src="{{ $slide[0] ? explode(',', $slide[0]->hinh_anh)[0] : '/Client_assets/img/banner/2.jpg' }}"
                                alt="" /></a>
                        <span class="pro-label new-label">Mới</span>
                        <span class="price"
                            style="font-weight: bold;color: #c8a165 ; text-shadow: 1px 1px 1px rgb(0, 0, 0);">
                            @if ($slide[0]->size_active)
                                {{ \App\Helpers\Helper::formatVnd($slide[0]->sizeCustoms->min('gia_ban'), 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($slide[0]->sizeCustoms->max('gia_ban'), 0, ',', '.') }}
                            @else
                                {{ \App\Helpers\Helper::formatVnd($slide[0]->gia_ban, 0, ',', '.') }}
                            @endif
                        </span>
                        <div class="banner-brief mb-1">
                            <h2 class="banner-title">
                                <a href="/product/view/{{ $slide[0]->slug_san_pham }}"
                                    style="font-weight: bold;color:#000000; text-shadow: 1px 1px 1px #c8a165;">
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
                        <a href="/product/view/{{ $slide[0]->slug_san_pham }}" class="button-one font-16px"
                            data-text="Xem Ngay">Xem Ngay</a>
                    </div>

                    <div class="single-banner banner-2">
                        <span class="pro-label new-label">Mới</span>
                        <span class="price"
                            style="font-weight: bold;color:#c8a165; text-shadow: 1px 1px 1px #000000;">
                            @if ($slide[1]->size_active)
                                {{ \App\Helpers\Helper::formatVnd($slide[1]->sizeCustoms->min('gia_ban'), 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($slide[1]->sizeCustoms->max('gia_ban'), 0, ',', '.') }}
                            @else
                                {{ \App\Helpers\Helper::formatVnd($slide[1]->gia_ban, 0, ',', '.') }}
                            @endif
                        </span>
                        <a class="banner-thumb" href="/product/view/{{ $slide[1]->slug_san_pham }}"><img
                                height="375" width="450"
                                src="{{ $slide[1] ? explode(',', $slide[1]->hinh_anh)[0] : '/Client_assets/img/banner/2.jpg' }}"
                                alt="" /></a>
                        <div class="banner-brief">
                            <h2 class="banner-title">
                                <a href="/product/view/{{ $slide[1]->slug_san_pham }}"
                                    style="font-weight: bold;color:#000000; text-shadow: 1px 1px 1px #c8a165;">
                                    {{ $slide[1]->ten_san_pham }}
                                </a>
                            </h2>
                            <a href="/product/view/{{ $slide[1]->slug_san_pham }}" class="button-one font-16px"
                                data-text="Xem Ngay">Xem Ngay</a>
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

                                        <div class="wow fadeInUpBig  animated" data-wow-duration="1.1s"
                                            data-wow-delay="0.5s"
                                            style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeInUpBig;">
                                            <h2 class="slider-title1 text-uppercase"
                                                style="font-weight: bold;color:#000000; text-shadow: 1px 2px 1px #ff9900;">
                                                {{ mb_strlen($slide[2]->ten_san_pham) > 40 ? mb_substr($slide[2]->ten_san_pham, 0, 40) . '...' : $slide[2]->ten_san_pham }}
                                            </h2>
                                        </div>
                                        <div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s"
                                            style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeInUpBig;">
                                            <h6 class="slider-pro-brief"
                                                style="color:#ffffff; text-shadow: 1px 1px 1px #000000;">
                                                {{ $slide[2]->gioi_thieu }}</h6>
                                        </div>
                                        <div class="wow fadeInUpBig animated" data-wow-duration="2s"
                                            data-wow-delay="0.5s"
                                            style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeInUpBig;">
                                            <span class="slider-title2 text-uppercase"
                                                style="font-weight: bold;color:#ff0000; text-shadow: 1px 2px 1px #000000;">
                                                Chỉ Từ @if ($slide[1]->size_active)
                                                    {{ \App\Helpers\Helper::formatVnd($slide[2]->sizeCustoms->min('gia_ban'), 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($slide[2]->sizeCustoms->max('gia_ban'), 0, ',', '.') }}
                                                @else
                                                    {{ \App\Helpers\Helper::formatVnd($slide[2]->gia_ban, 0, ',', '.') }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="wow fadeInUpBig  animated" data-wow-duration="2.5s"
                                            data-wow-delay="0.5s"
                                            style="visibility: visible; animation-duration: 2.5s; animation-delay: 0.5s; animation-name: fadeInUpBig;">
                                            <a href="/product/view/{{ $slide[2]->slug_san_pham }}"
                                                class="button-one style-2 text-uppercase mt-20"
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

            <!-- Sidebar-social-media start -->
            <div class="sidebar-account d-none d-md-block">
                <div class="table">
                    <div class="table-cell">
                        <ul>
                            <li><a class="search-open" href="#" title="Search"><i
                                        class="zmdi zmdi-search"></i></a>
                            </li>
                            <li v-show="id_user == -1"><a href="#" title="Login"><i
                                        class="zmdi zmdi-lock"></i></a>
                                <div class="customer-login text-left">
                                    <form v-on:submit.prevent="login()" id="formdata">
                                        <h4 class="title-1 title-border text-uppercase mb-30">Đăng Nhập
                                        </h4>
                                        {{-- <p class="text-gray">If you have an account with us, Please login!</p> --}}
                                        <input type="text" name="username"
                                            placeholder="Email or username here..." />
                                        <input type="password" name="password" placeholder="Password" />
                                        <p><a class="text-gray" href="/recover">Forget your password?</a></p>
                                        <button class="button-one submit-button mt-15" data-text="login"
                                            type="submit">login</button>
                                    </form>
                                </div>
                            </li>
                            <li><a href="my-account.html" title="My-Account"><i class="zmdi zmdi-account"></i></a>
                            </li>
                            <li><a href="/wishlist" title="Wishlist"><i class="zmdi zmdi-favorite"></i></a></li>
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

        <!-- PRODUCT-AREA START -->
        <div class="product-area pt-80 pb-35">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title-border">Sản Phẩm Bán Chạy</h2>
                        </div>
                        <div class="product-slider style-1 arrow-left-right">
                            @foreach ($listSp as $value)
                                <!-- Single-product start -->
                                <div class="single-product" style="height: 450px">
                                    <div class="product-img">
                                        <span class="pro-label new-label">HOT</span>
                                        <a href="/product/view/{{ $value->slug_san_pham }}"><img height="270"
                                                width="270" src="{{ $value->hinh_anh[0] }}" alt="" /></a>
                                        <div class="product-action clearfix">
                                            <a href="#" v-on:click.prevent="addWishList({{ $value }})"
                                                data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i
                                                    class="zmdi zmdi-favorite-outline"></i></a>
                                            <a href="#" v-on:click.prevent="view({{ $value }})"
                                                title="Quick View"><i class="zmdi zmdi-zoom-in"></i></a>
                                            <a href="#" data-bs-toggle="tooltip" data-placement="top"
                                                title="Compare"><i class="zmdi zmdi-refresh"></i></a>
                                            <a href="#" v-on:click.prevent="addToCart2({{ $value }})"
                                                data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i
                                                    class="zmdi zmdi-shopping-cart-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-info clearfix">
                                        <div class="fix">
                                            <h4 class="post-title floatleft"><a
                                                    href="/product/view/{{ $value->slug_san_pham }}">{{ $value->ten_san_pham }}</a>
                                            </h4>
                                            <p class="floatright hidden-sm d-none d-md-block">Sản Phẩm Bán Chạy</p>
                                        </div>
                                        <div class="fix">
                                            <span class="pro-price floatleft">
                                                @if ($value->size_active)
                                                    {{ \App\Helpers\Helper::formatVnd($value->sizeCustoms->min('gia_ban'), 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($value->sizeCustoms->max('gia_ban'), 0, ',', '.') }}
                                                @else
                                                    {{ \App\Helpers\Helper::formatVnd($value->gia_ban, 0, ',', '.') }}
                                                @endif
                                            </span>
                                            <span class="pro-rating floatright">
                                                <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                                <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single-product end -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCT-AREA END -->

        <!-- PURCHASE-ONLINE-AREA START -->
        <div class="purchase-online-area pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title-border">Danh Mục Sản phẩm</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        @php
                            $isActiveSet = false;
                        @endphp
                        <ul class="tab-menu nav clearfix">
                            @foreach ($danhMuc as $key => $value)
                                @if ($value->sanPhams && count($value->sanPhams) > 0)
                                    @if (!$isActiveSet)
                                        <li><a class="active" href="#danhMuc{{ $value->id }}"
                                                data-bs-toggle="tab">{{ $value->ten_danh_muc }}</a></li>
                                        @php
                                            $isActiveSet = true;
                                        @endphp
                                    @else
                                        <li><a href="#danhMuc{{ $value->id }}"
                                                data-bs-toggle="tab">{{ $value->ten_danh_muc }}</a></li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-12">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach ($danhMuc as $key1 => $value1)
                                @if ($value1->sanPhams && count($value1->sanPhams) > 0)
                                    @if ($key1 === 0)
                                        <div class="active tab-pane" id="danhMuc{{ $value1->id }}">
                                            <div class="row">
                                                @foreach ($value1->sanPhams as $key2 => $value2)
                                                    <div class="single-product col-xl-3 col-lg-4 col-md-6">
                                                        <div class="product-img">
                                                            <a href="/product/view/{{ $value2->slug_san_pham }}"><img
                                                                    src="{{ $value2->hinh_anh[0] }}"
                                                                    alt="" /></a>
                                                            <div class="product-action clearfix">
                                                                <a href="#"
                                                                    v-on:click.prevent="addWishList({{ $value2 }})"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    title="Wishlist"><i
                                                                        class="zmdi zmdi-favorite-outline"></i></a>
                                                                <a href="#" title="Quick View"
                                                                    v-on:click.prevent="view({{ $value2 }})"><i
                                                                        class="zmdi zmdi-zoom-in"></i></a>
                                                                <a href="#" data-bs-toggle="tooltip"
                                                                    data-placement="top" title="Compare"><i
                                                                        class="zmdi zmdi-refresh"></i></a>
                                                                <a href="#"
                                                                    v-on:click.prevent="addToCart2({{ $value2 }})"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    title="Add To Cart"><i
                                                                        class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-info clearfix">
                                                            <div class="fix">
                                                                <h4 class="post-title floatleft"><a
                                                                        href="/product/view/{{ $value->slug_san_pham }}">{{ $value2->ten_san_pham }}</a>
                                                                </h4>
                                                                <p class="floatright hidden-sm">
                                                                    {{ $value1->ten_danh_muc }}
                                                                </p>
                                                            </div>
                                                            <div class="fix">
                                                                <span class="pro-price floatleft">
                                                                    @if ($value2->size_active)
                                                                        {{ \App\Helpers\Helper::formatVnd($value2->sizeCustoms->min('gia_ban'), 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($value2->sizeCustoms->max('gia_ban'), 0, ',', '.') }}
                                                                    @else
                                                                        {{ \App\Helpers\Helper::formatVnd($value2->gia_ban, 0, ',', '.') }}
                                                                    @endif
                                                                </span>
                                                                <span class="pro-rating floatright">
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star"></i></a>
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star"></i></a>
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star"></i></a>
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star-half"></i></a>
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star-half"></i></a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="tab-pane" id="danhMuc{{ $value1->id }}">
                                            <div class="row">
                                                @foreach ($value1->sanPhams as $key2 => $value2)
                                                    <div class="single-product col-xl-3 col-lg-4 col-md-6">
                                                        <div class="product-img">
                                                            <a href="/product/view/{{ $value2->slug_san_pham }}"><img
                                                                    src="{{ $value2->hinh_anh[0] }}"
                                                                    alt="" /></a>
                                                            <div class="product-action clearfix">
                                                                <a href="#"
                                                                    v-on:click.prevent="addWishList({{ $value2 }})"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    title="Wishlist"><i
                                                                        class="zmdi zmdi-favorite-outline"></i></a>
                                                                <a href="#"
                                                                    v-on:click.prevent="view({{ $value2 }})"
                                                                    title="Quick View"><i
                                                                        class="zmdi zmdi-zoom-in"></i></a>
                                                                <a href="#" data-bs-toggle="tooltip"
                                                                    data-placement="top" title="Compare"><i
                                                                        class="zmdi zmdi-refresh"></i></a>
                                                                <a href="#"
                                                                    v-on:click.prevent="addToCart2({{ $value2 }})"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    title="Add To Cart"><i
                                                                        class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-info clearfix">
                                                            <div class="fix">
                                                                <h4 class="post-title floatleft"><a
                                                                        href="/product/view/{{ $value2->slug_san_pham }}">{{ $value2->ten_san_pham }}</a>
                                                                </h4>
                                                                <p class="floatright hidden-sm">
                                                                    {{ $value1->ten_danh_muc }}
                                                                </p>
                                                            </div>
                                                            <div class="fix">
                                                                <span class="pro-price floatleft">
                                                                    @if ($value1->size_active)
                                                                        {{ \App\Helpers\Helper::formatVnd($value1->sizeCustoms->min('gia_ban'), 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($value1->sizeCustoms->max('gia_ban'), 0, ',', '.') }}
                                                                    @else
                                                                        {{ \App\Helpers\Helper::formatVnd($value2->gia_ban, 0, ',', '.') }}
                                                                    @endif
                                                                </span>
                                                                <span class="pro-rating floatright">
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star"></i></a>
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star"></i></a>
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star"></i></a>
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star-half"></i></a>
                                                                    <a href="#"><i
                                                                            class="zmdi zmdi-star-half"></i></a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PURCHASE-ONLINE-AREA END -->

        <!-- BLGO-AREA START -->
        <div class="blog-area pt-55">
            <div class="container">
                <!-- Section-title start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title-border">Bài Viết Mới</h2>
                        </div>
                    </div>
                </div>
                <!-- Section-title end -->
                <div class="row">
                    @foreach ($kienThuc as $value)
                        <!-- Single-blog start -->
                        <div class="col-lg-6">
                            <div class="single-blog mt-30">
                                <div class="row">
                                    <div class="col-xl-6 col-md-7">
                                        <div class="blog-info">
                                            <div class="post-meta fix">
                                                <div class="post-date floatleft"><span
                                                        class="text-dark-red">{{ \Carbon\Carbon::parse($value->date)->format('j') }}</span>
                                                </div>
                                                <div class="post-year floatleft">
                                                    <p class="text-uppercase text-dark-red mb-0">
                                                        {{ $value->date }}</p>
                                                    <h4 class="post-title"><a
                                                            href="/blog-kien-thuc/view/{{ $value->slug }}"
                                                            tabindex="0">{{ $value->title }}</a></h4>
                                                </div>
                                            </div>
                                            <div class="like-share fix">
                                                <a href="#"><i
                                                        class="zmdi zmdi-favorite"></i><span>{{ rand(25, 98) }}
                                                        Like</span></a>
                                                <a href="#"><i
                                                        class="zmdi zmdi-comments"></i><span>{{ rand(25, 98) }}
                                                        Comments</span></a>
                                                <a href="#"><i
                                                        class="zmdi zmdi-share"></i><span>{{ rand(25, 98) }}
                                                        Share</span></a>
                                            </div>
                                            <p>{{ Illuminate\Support\Str::limit($value->mo_ta, 300) }}</p>
                                            <a href="#" class="button-2 text-dark-red">Xem Thêm...</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-5">
                                        <div class="blog-photo">
                                            <a href="/blog-kien-thuc/view/{{ $value->slug }}"><img
                                                    style="height: 320px;" src="{{ $value->hinh_anh }}"
                                                    alt="" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single-blog end -->
                    @endforeach
                </div>
            </div>
        </div>
        <!-- BLGO-AREA END -->

        <!-- QUICKVIEW PRODUCT -->
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
                                    <!--modal tab start-->
                                    <div class="portfolio-thumbnil-area-2">
                                        <div class="tab-content active-portfolio-area-2">
                                            <template v-for="(v, k) in dataView.hinh_anh">
                                                <div :class="{ 'tab-pane': true, 'active': k === 0 }" role="tabpanel"
                                                    :id="'view' + (k + 1)">
                                                    <div class="product-img">
                                                        <a href="#"><img :src="v"
                                                                alt="Single portfolio" /></a>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-info">
                                    <h1>@{{ dataView.ten_san_pham }}</h1>
                                    <div class="price-box-3">
                                        <hr />
                                        <template>
                                            <template v-if="dataView.size_active!=0">
                                                <div class="s-price-box" v-if="priceSelectedSize != 0">
                                                    <span class="new-price">@{{ formatVND(priceSelectedSize) }}</span>
                                                </div>
                                                <div class="s-price-box" v-else>
                                                    <span class="new-price">@{{ formatVND(dataView.min) }}</span>
                                                    <span class="new-price">-</span>
                                                    <span class="new-price">@{{ formatVND(dataView.max) }}</span>
                                                </div>
                                            </template>
                                            <template v-else>
                                                <div class="s-price-box">
                                                    <span class="new-price">@{{ formatVND(dataView.gia_ban) }}</span>
                                                </div>
                                            </template>
                                        </template>
                                        <hr />
                                    </div>
                                    <template v-for="(v,k) in dataView.size_customs">
                                        <div class="form-check form-check-inline">
                                            <input @change="selectedSizeCheck()" v-model="selectedSize"
                                                class="form-check-input" type="radio" :checked="k === 0"
                                                name="inlineRadioOptions" :id="'inlineRadio' + k"
                                                :value="v.size">
                                            <label class="form-check-label"
                                                :for="'inlineRadio' + k">@{{ v.size }}</label>
                                        </div>
                                    </template>
                                    <br>
                                    <h5 style="color:red;">@{{ warningSelectSize }}</h5>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <div class="numbers-row">
                                                <input type="number" id="soLuong" value="1" min="1">
                                            </div>
                                            <button class="single_add_to_cart_button" type="submit"
                                                v-on:click.prevent="addToCart(dataView)">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="quick-desc">
                                        @{{ dataView.gioi_thieu }}
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
        @include('Client.share.footer')
    </div>
    @include('Client.share.js')
    <script>
        new Vue({
            el: '#app',
            data: {
                dataView: {},
                viewCheck: 0,
                listCart: [],
                listWishList: [],
                tongTien: 0,
                selectedSize: 0,
                priceSelectedSize: 0,
                warningSelectSize: null,
                id_user: "{{ Auth::guard('khach')->user() ? Auth::guard('khach')->user()->id : -1 }}",
            },
            created() {
                this.loadCart();
            },
            methods: {
                formatString(str, num) {
                    if (str.length <= num) {
                        return str;
                    }

                    let subString = str.substr(0, num - 1);
                    return subString.substr(0, subString.lastIndexOf(' ')) + '...';
                },
                selectedSizeCheck() {
                    return this.priceSelectedSize = this.dataView.size_customs.find(s => s.size === this
                        .selectedSize).gia_ban;
                },
                view(data) {
                    if (this.dataView) {
                        this.dataView = {};
                    }
                    if (data.size_active === 1) {
                        data['min'] = Math.min(...data.size_customs.map(item => item.gia_ban));
                        data['max'] = Math.max(...data.size_customs.map(item => item.gia_ban));
                    }
                    this.dataView = data;
                    this.viewCheck = 1;
                    return $('#productModal').modal('show');
                },
                loadCart() {
                    const userId = Number(this.id_user);
                    this.listCart = JSON.parse(localStorage.getItem('itemList')) || [];
                    this.listCart = this.listCart.filter(item => item.auth === userId);
                    this.listWishList = JSON.parse(localStorage.getItem('listWishList')) || [];
                    this.listWishList = this.listWishList.filter(item => item.auth === userId);
                    this.tongTien = this.listCart.reduce((total, item) => {
                        return total + (item.gia_ban * item.so_luong);
                    }, 0);
                },
                removeFromCart(itemId) {
                    var itemList = JSON.parse(localStorage.getItem('itemList')) || [];
                    var indexToRemove = itemList.findIndex(item => item.id === itemId);
                    if (indexToRemove !== -1) {
                        itemList.splice(indexToRemove, 1);
                        localStorage.setItem('itemList', JSON.stringify(itemList));
                    }
                    this.loadCart();
                },
                addToCart(dataItems) {
                    if (dataItems.size_active == 1) {
                        if (this.priceSelectedSize == 0) {
                            return Swal.fire({
                                title: "Thất Bại!",
                                text: "Thất Bại , Bạn Cần Chọn Mã Sản Phẩm Trước!",
                                icon: "error"
                            });
                            this.warningSelectSize = 'Thất Bại , Bạn Cần Chọn Mã Sản Phẩm Trước';
                            return $('#productModal').modal('hide');
                        }
                    }
                    const soLuong = Number($("#soLuong").val());
                    if (Number(this.id_user) < 0) {
                        return Swal.fire({
                            title: "Thất Bại!",
                            text: "Bạn Cần Đăng Nhập Trước!",
                            icon: "error"
                        });
                    }
                    var data = {
                        auth: Number(this.id_user),
                        id: dataItems.id,
                        size: this.selectedSize,
                        hinh_anh: dataItems.hinh_anh,
                        size_active: dataItems.size_active,
                        gia_ban: this.priceSelectedSize == 0 ? dataItems.gia_ban : this.priceSelectedSize,
                        ten_san_pham: dataItems.ten_san_pham,
                        so_luong: soLuong ? soLuong : 1,
                    };

                    var check = this.listCart.find(item => item.id === data.id);
                        var check2 = this.listCart.find(item => item.id === data.id && item.size == data.size);
                        if (check) {
                            if (check2) {
                                check2.so_luong = +data.so_luong + +check2.so_luong;
                            } else {
                                check.so_luong = +data.so_luong + +check.so_luong;
                            }
                        }else{
                            this.listCart.push(data);
                        }
                    localStorage.setItem('itemList', JSON.stringify(this.listCart));
                    this.priceSelectedSize = 0;
                    $('#productModal').modal('hide');
                    Swal.fire({
                        title: "Thành công!",
                        text: "Đã Thêm Sản Phẩm Vào Giỏ Hàng!",
                        icon: "success"
                    });
                    return this.loadCart();;
                },
                addToCart2(dataItems) {
                    if (Number(this.id_user) < 0) {
                        return Swal.fire({
                            title: "Thất Bại!",
                            text: "Bạn Cần Đăng Nhập Trước!",
                            icon: "error"
                        });
                    }
                    if (dataItems.size_active == 1) {
                        let options = '';
                        dataItems.size_customs.forEach((v, k) => {
                            options += `<option value="${v.size}">${v.size}</option>`;
                        });
                        return Swal.fire({
                            title: 'Chọn kích thước',
                            html: `<select id="sizeSelect" class="form-control">${options}</select>
                                    </br>
                                    <label>Số lượng</label>
                                    <input type="text" id="so_luong" value="1" class="form-control"/>`,
                            showCancelButton: true,
                            confirmButtonText: 'Xác nhận',
                            cancelButtonText: 'Hủy bỏ',
                            focusConfirm: false,
                        }).then(result => {
                            if (result.isConfirmed) {
                                this.soLuong = document.getElementById('so_luong').value;
                                this.selectedSize = document.getElementById('sizeSelect').value;
                                var data = {
                                    auth: Number(this.id_user),
                                    id: dataItems.id,
                                    size_customs: dataItems.size_customs,
                                    size_active: dataItems.size_active,
                                    size: this.selectedSize,
                                    so_luong: this.soLuong,
                                    hinh_anh: dataItems.hinh_anh,
                                    gia_ban: dataItems.size_customs.find(s => s.size === this
                                        .selectedSize).gia_ban,
                                    ten_san_pham: dataItems.ten_san_pham,
                                };

                                var check = this.listCart.find(item => item.id === data.id);
                                var check2 = this.listCart.find(item => item.id === data.id && item.size ==
                                    data.size);
                                if (check) {
                                    if (check2 == undefined) {
                                        this.listCart.push(data);
                                    } else {
                                        check.so_luong = +data.so_luong + +check.so_luong;
                                    }
                                } else {
                                    this.listCart.push(data);
                                }
                                localStorage.setItem('itemList', JSON.stringify(this.listCart));
                                this.loadCart();
                                return Swal.fire({
                                    title: "Thành Công!",
                                    text: "Đã Thêm Sản Phẩm Vào Giỏ Hàng!",
                                    icon: "success"
                                });
                            } else {
                                return Swal.fire({
                                    title: "Thất Bại!",
                                    text: "Thất Bại , Bạn Cần Chọn Mã Sản Phẩm Trước!",
                                    icon: "error"
                                });
                            }
                        });
                    }
                    var data = {
                        auth: Number(this.id_user),
                        id: dataItems.id,
                        size_customs: dataItems.size_customs,
                        size_active: dataItems.size_active,
                        hinh_anh: dataItems.hinh_anh,
                        gia_ban: dataItems.gia_ban,
                        so_luong: 1,
                        ten_san_pham: dataItems.ten_san_pham,
                    };
                    var check = this.listCart.find(item => item.id === data.id);
                        var check2 = this.listCart.find(item => item.id === data.id && item.size == data.size);
                        if (check) {
                            if (check2) {
                                check2.so_luong = +data.so_luong + +check2.so_luong;
                            } else {
                                check.so_luong = +data.so_luong + +check.so_luong;
                            }
                        }else{
                            this.listCart.push(data);
                        }
                    localStorage.setItem('itemList', JSON.stringify(this.listCart));
                    this.loadCart();
                    Swal.fire({
                        title: "Thành công!",
                        text: "Đã Thêm Sản Phẩm Vào Giỏ Hàng!",
                        icon: "success"
                    });
                },
                addWishList(dataItems) {
                    if (Number(this.id_user) < 0) {
                        return Swal.fire({
                            title: "Thất Bại!",
                            text: "Bạn Cần Đăng Nhập Trước!",
                            icon: "error"
                        });
                    }
                    if (dataItems.size_active == 1) {
                        let options = '';
                        dataItems.size_customs.forEach((v, k) => {
                            options += `<option value="${v.size}">${v.size}</option>`;
                        });
                        return Swal.fire({
                            title: 'Chọn kích thước',
                            html: `<select id="sizeSelect" class="form-control">${options}</select>`,
                            showCancelButton: true,
                            confirmButtonText: 'Xác nhận',
                            cancelButtonText: 'Hủy bỏ',
                            focusConfirm: false,
                        }).then(result => {
                            if (result.isConfirmed) {
                                this.selectedSize = document.getElementById('sizeSelect').value;
                                var data = {
                                    auth: Number(this.id_user),
                                    id: dataItems.id,
                                    size_customs: dataItems.size_customs,
                                    size_active: dataItems.size_active,
                                    size_selected: this.selectedSize,
                                    hinh_anh: dataItems.hinh_anh,
                                    gia_ban: dataItems.size_customs.find(s => s.size === this
                                        .selectedSize).gia_ban,
                                    ten_san_pham: dataItems.ten_san_pham,
                                };

                                var check = this.listWishList.find(item => item.id === data.id);
                                var check2 = this.listWishList.find(item => item.id === data.id && item
                                    .size == data.size);
                                if (check) {
                                    if (check2 == undefined) {
                                        this.listWishList.push(data);
                                    } else {
                                        return Swal.fire({
                                            title: "Thất Bại!",
                                            text: "Sản Phẩm Đã Tồn Tại!",
                                            icon: "error"
                                        });
                                    }
                                } else {
                                    this.listWishList.push(data);
                                }
                                localStorage.setItem('listWishList', JSON.stringify(this.listWishList));
                                this.loadCart();
                                return Swal.fire({
                                    title: "Thành Công!",
                                    text: "Đã Thêm Sản Phẩm Vào Mục Ưa Thích!",
                                    icon: "success"
                                });
                            } else {
                                return Swal.fire({
                                    title: "Thất Bại!",
                                    text: "Thất Bại , Bạn Cần Chọn Mã Sản Phẩm Trước!",
                                    icon: "error"
                                });
                            }
                        });
                    }
                    var data = {
                        auth: Number(this.id_user),
                        id: dataItems.id,
                        size_customs: dataItems.size_customs,
                        size_active: dataItems.size_active,
                        hinh_anh: dataItems.hinh_anh,
                        gia_ban: dataItems.gia_ban,
                        ten_san_pham: dataItems.ten_san_pham,
                    };

                    var check = this.listWishList.find(item => item.id === data.id);
                    if (check) {
                        return Swal.fire({
                            title: "Thất Bại!",
                            text: "Sản Phẩm Đã Tồn Tại!",
                            icon: "error"
                        });
                    } else {
                        this.listWishList.push(data);
                    }
                    localStorage.setItem('listWishList', JSON.stringify(this.listWishList));
                    this.loadCart();
                    console.log('heleel');
                    Swal.fire({
                        title: "Thành công!",
                        text: "Đã Thêm Sản Phẩm Vào Mục Yêu Thích!",
                        icon: "success"
                    });
                },
                jsonDec(jsonData) {
                    const parsedData = JSON.parse(jsonData);
                    return parsedData;
                },
                closeModal() {
                    return this.dataView = {};
                },
                formatVND(amount) {
                    return new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(amount);
                },
                login() {
                    var paramObj = {};
                    $.each($('#formdata').serializeArray(), function(_, kv) {
                        if (paramObj.hasOwnProperty(kv.name)) {
                            paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                            paramObj[kv.name].push(kv.value);
                        } else {
                            paramObj[kv.name] = kv.value;
                        }
                    });
                    axios
                        .post('/login-khach-check', paramObj)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                window.location.href = "/";
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                    setTimeout(() => {
                        this.loading = false;
                    }, 2000);
                },
            },
        });
    </script>
    <!-- jquery.nicescroll.min js -->
    <script src="/Client_assets/js/jquery.nicescroll.min.js"></script>
    <!-- countdon.min js -->
    <script src="/Client_assets/js/countdon.min.js"></script>
    <!-- wow js -->
    <script src="/Client_assets/js/wow.min.js"></script>
    <!-- plugins js -->
    <script src="/Client_assets/js/plugins.js"></script>
    <!-- main js -->
    <script src="/Client_assets/js/main.min.js"></script>
</body>
