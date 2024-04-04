@extends('Client.share.master')
@section('noi_dung')
    <!-- HEADING-BANNER START -->
    <div class="heading-banner-area overlay-bg"
        style="background:rgba(0,0,0,0) url('{{ $data->hinh_anh[0] }}') no-repeat scroll center center/cover">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-banner">
                        <div class="heading-banner-title">
                            <h2>{{ $data->ten_san_pham }}</h2>
                        </div>
                        <div class="breadcumbs pb-15">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="/product">Product</a></li>
                                <li>{{ Illuminate\Support\Str::limit($data->ten_san_pham, 30) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HEADING-BANNER END -->
    <!-- PRODUCT-AREA START -->
    <div class="product-area single-pro-area pt-80 pb-80 product-style-2">
        <div class="container">
            <div class="row" id="app">
                <div class="col-lg-9">
                    <div class="row shop-list single-pro-info">
                        <!-- Single-product start -->
                        <div class="col-lg-12">
                            <div class="single-product clearfix">
                                <!-- Single-pro-slider Big-photo start -->
                                <div class="single-pro-slider single-big-photo view-lightbox slider-for">
                                    @foreach ($data->hinh_anh as $value)
                                        <div>
                                            <img src="{{ $value }}" alt="" />
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Single-pro-slider Big-photo end -->
                                <div class="product-info">
                                    <div class="fix">
                                        <h4 class="post-title floatleft">{{ $data->ten_san_pham }}</h4>
                                        <span class="pro-rating floatright">
                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                            <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                            <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                            {{-- <span>( 27 Rating )</span> --}}
                                        </span>
                                    </div>
                                    <div class="fix mb-20">
                                        <span class="pro-price">
                                            @if ($data->size_active)
                                                {{ \App\Helpers\Helper::formatVnd($data->min_gia_ban, 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($data->max_gia_ban, 0, ',', '.') }}
                                            @else
                                                {{ \App\Helpers\Helper::formatVnd($data->gia_ban, 0, ',', '.') }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="product-description">
                                        <p>{!! $data->gioi_thieu !!}</p>
                                    </div>
                                    <!-- Size start -->
                                    @if ($data->size_active == 1)
                                        <div class="size-filter single-pro-size mb-35 clearfix">
                                            <ul>
                                                <li><span class="color-title text-capitalize">Loại :</span></li>
                                                <template v-for="(v,k) in dataSanPham.size_customs">
                                                    <li><a @click.prevent="selectedSize = v.size;gia_ban=v.gia_ban"
                                                            :style="{
                                                                'text-shadow': selectedSize === v.size ?
                                                                    '1px 1px 2px red' : ''
                                                            }"
                                                            href="#">@{{ v.size }}</a>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                    @endif
                                    <!-- color start -->
                                    <div class="color-filter single-pro-color mb-20 clearfix" v-show="selectedSize != 0">
                                        <ul>
                                            <li><span class="color-title text-capitalize">Giá : </span></li>
                                            <li><a href="#"><span>@{{ soLuong > 0 ? formatVND(gia_ban * soLuong) : 0 }}</span></a></li>
                                        </ul>
                                    </div>
                                    <!-- color end -->
                                    <!-- Size end -->
                                    <div class="clearfix">
                                        <div>
                                            <input type="text" value="01" v-model="soLuong" id="soLuong"
                                                name="qtybutton" class="cart-plus-minus-box">
                                        </div>
                                        <div class="product-action clearfix">
                                            <a style="width: 50%;" href="#"
                                                @click.prevent="addWishList({{ $data }})" data-bs-toggle="tooltip"
                                                data-placement="top" title="Wishlist"><i
                                                    class="zmdi zmdi-favorite-outline"></i></a>
                                            <a @click.prevent="addToCart({{ $data }})" style="width: 50%;"
                                                href="#" data-bs-toggle="tooltip" data-placement="top"
                                                title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                        </div>
                                    </div>
                                    <!-- Single-pro-slider Small-photo start -->
                                    <div class="single-pro-slider single-sml-photo slider-nav">
                                        @foreach ($data->hinh_anh as $value)
                                            <div>
                                                <img src="{{ $value }}" alt="" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Single-pro-slider Small-photo end -->
                                </div>
                            </div>
                        </div>
                        <!-- Single-product end -->
                    </div>
                    <!-- single-product-tab start -->
                    <div class="single-pro-tab">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="single-pro-tab-menu">
                                    <!-- Nav tabs -->
                                    <ul class="nav d-block">
                                        <li><a href="#description" class="active" data-bs-toggle="tab">Giới Thiệu</a></li>
                                        <li><a href="#information" data-bs-toggle="tab">Chi Tiết Sản Phẩm</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="description">
                                        <div class="pro-tab-info pro-description">
                                            <h3 class="tab-title title-border mb-30">Giới Thiệu Sản Phẩm</h3>
                                            <p>{!! $data->gioi_thieu !!}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="information">
                                        <div class="pro-tab-info pro-information">
                                            <h3 class="tab-title title-border mb-30">Chi Tiết Sản Phẩm</h3>
                                            <p>{!! $data->mo_ta !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single-product-tab end -->
                </div>
                <div class="col-lg-3 mt-tab-30">
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
                    <aside class="widget widget-product mb-30">
                        <div class="widget-title">
                            <h4>Sản Phẩm Liên Quan</h4>
                        </div>
                        <div class="widget-info sidebar-product clearfix">
                            @if (count($spLienQuan) > 0)
                                @foreach ($spLienQuan as $value)
                                    <!-- Single-product start -->
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="/product/view/{{ $value->slug_san_pham }}"><img
                                                    src="{{ $value->hinh_anh[0] }}" alt="" /></a>
                                        </div>
                                        <div class="product-info">
                                            <h4 class="post-title"><a href="#">{{ $value->ten_san_pham }}</a></h4>
                                            <span class="pro-price">
                                                @if ($value->size_active)
                                                    {{ \App\Helpers\Helper::formatVnd($value->min_gia_ban, 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($value->max_gia_ban, 0, ',', '.') }}
                                                @else
                                                    {{ \App\Helpers\Helper::formatVnd($value->gia_ban, 0, ',', '.') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single-product end -->
                                @endforeach
                            @endif
                        </div>
                    </aside>
                    <!-- Widget-product end -->
                    <!-- Widget-banner start -->
                    <aside class="widget widget-banner">
                        <div class="widget-info widget-banner-img">
                            <a href="#"><img src="img/banner/5.jpg" alt="" /></a>
                        </div>
                    </aside>
                    <!-- Widget-banner end -->
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
                listCart: [],
                listWishList: [],
                dataSanPham: @json($data),
                selectedSize: 0,
                soLuong: 1,
                gia_ban: 0,
                auth: "{{ Auth::guard('khach')->check() ? Auth::guard('khach')->user()->id : -1 }}",
            },
            created() {
                this.loadList();
            },
            methods: {
                loadList() {
                    const userId = Number(this.auth);
                    this.listCart = JSON.parse(localStorage.getItem('itemList')).filter(item => item.auth ===
                        userId) || [];
                    this.listWishList = JSON.parse(localStorage.getItem('listWishList')).filter(item => item
                        .auth === Number(this.auth)) || [];
                },
                addToCart(dataItems) {
                    this.checkLogin();
                    if (dataItems.size_active == 1) {
                        if (Number(this.selectedSize) == 0) {
                            return Swal.fire({
                                title: "Thất Bại!",
                                text: "Vui Lòng Chọn Loại Trước!",
                                icon: "error"
                            });
                        }
                        if (Number(this.soLuong) < 1) {
                            return Swal.fire({
                                title: "Thất Bại!",
                                text: "Số Lượng Phải > 0!",
                                icon: "error"
                            });
                        }
                    }
                    var data = {
                        auth: Number(this.auth),
                        id: dataItems.id,
                        size_customs: dataItems.size_customs,
                        size_active: dataItems.size_active,
                        size: this.selectedSize,
                        hinh_anh: dataItems.hinh_anh,
                        so_luong: this.soLuong,
                        gia_ban: dataItems.size_active == 1 ? this.gia_ban : dataItems.gia_ban,
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
                    this.loadList();
                    Swal.fire({
                        title: "Thành công!",
                        text: "Đã Thêm Sản Phẩm Vào Giỏ Hàng!",
                        icon: "success"
                    });
                },
                addWishList(dataItems) {
                    this.checkLogin();
                    if (dataItems.size_active == 1) {
                        if (Number(this.selectedSize) == 0) {
                            return Swal.fire({
                                title: "Thất Bại!",
                                text: "Vui Lòng Chọn Loại Trước!",
                                icon: "error"
                            });
                        }
                        if (Number(this.soLuong) < 1) {
                            return Swal.fire({
                                title: "Thất Bại!",
                                text: "Số Lượng Phải > 0!",
                                icon: "error"
                            });
                        }
                    }
                    var data = {
                        auth: Number(this.auth),
                        id: dataItems.id,
                        size_customs: dataItems.size_customs,
                        size_active: dataItems.size_active,
                        size_selected: this.selectedSize,
                        hinh_anh: dataItems.hinh_anh,
                        gia_ban: dataItems.size_active == 1 ? this.gia_ban : dataItems.gia_ban,
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
                    this.loadList();
                    return Swal.fire({
                        title: "Thành công!",
                        text: "Đã Thêm Sản Phẩm Vào Mục Yêu Thích!",
                        icon: "success"
                    });
                },
                checkLogin() {
                    if (Number(this.auth) < 0) {
                        return Swal.fire({
                            title: "Thất Bại!",
                            text: "Bạn Cần Đăng Nhập Trước!",
                            icon: "error"
                        });
                    }
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
@endsection
