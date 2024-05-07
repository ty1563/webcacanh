@extends('Client.share.master')
@section('noi_dung')
    <!-- HEADING-BANNER START -->
    @if (count($data) > 0)
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
                                    <li><a href="/">Home</a></li>
                                    <li>Product</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- HEADING-BANNER END -->
    <div class="wrapper" id="appp">
        <!-- PRODUCT-AREA START -->
        <div class="product-area pt-80 pb-80 product-style-2">
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
                                                    <li><a
                                                            href="?idDanhMuc={{ $value1->id }}">{{ $value1->ten_danh_muc }}</a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>

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
                                    <li><a href="#grid-view" data-bs-toggle="tab"><i class="zmdi zmdi-view-module"></i></a>
                                    </li>
                                    <li><a class="active" href="#list-view" data-bs-toggle="tab"><i
                                                class="zmdi zmdi-view-list"></i></a></li>
                                </ul>
                                <div class="showing text-end d-none d-md-block">
                                    <p class="mb-0">Showing 01-{{ count($data) }} of {{ count($data) }} Results</p>
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
                                                        <a style="height: 280px;" :href="'/product/view/' + v.slug_san_pham"><img
                                                                :src="v.hinh_anh[0]" alt="" /></a>
                                                    </div>
                                                    <div class="product-info clearfix text-center">
                                                        <div class="fix">
                                                            <h4 class="post-title"><a
                                                                    :href="'/product/view/' + v.slug_san_pham">@{{ v.ten_san_pham }}</a>
                                                            </h4>
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
                                                            <a href="cart.html" data-bs-toggle="tooltip"
                                                                data-placement="top" title="Add To Cart"><i
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
                                                        <a style="height: 280px;" :href="'/product/view/' + v.slug_san_pham"><img
                                                                :src="v.hinh_anh[0]" alt="" /></a>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="fix">
                                                            <h4 class="post-title floatleft"><a
                                                                    :href="'/product/view/' + v.slug_san_pham">@{{ v.ten_san_pham }}</a>
                                                            </h4>
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
                                                            <span class="pro-price"
                                                                v-if="v.size_active==0">@{{ formatVnd(v.gia_ban) }}</span>
                                                            <span class="pro-price" v-else>@{{ formatVnd(v.min_gia_ban) }} -
                                                                @{{ formatVnd(v.max_gia_ban) }}</span>
                                                        </div>
                                                        <div class="product-description">
                                                            <p>@{{ v.gioi_thieu }}</p>
                                                        </div>
                                                        <div class="clearfix">
                                                            <div class="product-action clearfix">
                                                                <a style="width: 33%;" href="" v-on:click.prevent="addWishList(v)"
                                                                    data-bs-toggle="tooltip" data-placement="top"
                                                                    title="Wishlist"><i
                                                                        class="zmdi zmdi-favorite-outline"></i></a>
                                                                <a style="width: 33%;" href="#" data-bs-toggle="tooltip"
                                                                    data-placement="top" title="Compare"><i
                                                                        class="zmdi zmdi-refresh"></i></a>
                                                                <a style="width: 33%;" href="" v-on:click.prevent="addToCart2(v)"
                                                                    data-bs-toggle="tooltip" data-placement="top"
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
                        </div>
                        <!-- Shop-Content End -->
                    </div>
                </div>

            </div>
        </div>
        <!-- PRODUCT-AREA END -->

    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#appp',
            data: {
                listCart: [],
                listWishList: [],
                listSanPham: @json($data),
                id_user: "{{ Auth::guard('khach')->user() ? Auth::guard('khach')->user()->id : -1 }}",
                tongTien: 0,
            },
            created() {
                this.loadCart();
            },
            methods: {

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
                    } else {
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
                    } else {
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
