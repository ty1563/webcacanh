<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('Client.share.css')
    @yield('css')
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
    <div class="wrapper">
        @include('Client.share.mobile-header')
        <!-- HEADER-AREA START -->
        <header id="sticky-menu" class="header">
            <div class="header-area">
                <div class="container-fluid">
                    <div class="row"   id="master">
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
                                        <a class="cart-icon" href="/cart">
                                            <i class="zmdi zmdi-shopping-cart"></i>
                                            {{-- <span>@{{ listCart.length }}</span> --}}
                                        </a>
                                        {{-- <div class="mini-cart-brief text-left">
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
                                                <a href="/cart" class="button-one floatleft text-uppercase"
                                                    data-text="View cart">Wishlist</a>
                                                <a href="/checkout" class="button-one floatright text-uppercase"
                                                    data-text="Check out">Check out</a>
                                            </div>
                                        </div> --}}
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
                        <li><a href="/product"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z">
                                    </path>
                                </svg>
                                Sản phẩm</a>
                            <div class="sub-menu menu-scroll">
                                <ul>
                                    @php
                                        $danhMuc = \App\Models\DanhMuc::get();
                                    @endphp
                                    @if (count($danhMuc) > 0)
                                        @foreach ($danhMuc as $value)
                                            <li><a href="/product?idDanhMuc={{$value->id}}">{{ $value->ten_danh_muc }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </li>

                        <li><a href="/blog-kien-thuc"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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

        @include('Client.share.mobile-menu')
        @yield('noi_dung')
        @include('Client.share.footer')
    </div>
    @include('Client.share.js')
    @yield('js')
    <script>
        new Vue({
            el: '#master',
            data: {
                dataView: {},
                viewCheck: 0,
                listCart: [],
                tongTien: 0,
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
                loadCart() {
                    const userId = Number(this.id_user);
                    this.listCart = JSON.parse(localStorage.getItem('itemList')).filter(item => item.auth ===
                        userId) || [];
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
                formatVND(amount) {
                    return new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(amount);
                },
            },
        });
    </script>
    <script src="/Client_assets/js/main.min.js"></script>

</body>

</html>
