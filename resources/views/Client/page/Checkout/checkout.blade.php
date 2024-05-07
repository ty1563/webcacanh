@extends('Client.share.master')
@section('noi_dung')
    <!-- HEADING-BANNER START -->
    <div class="heading-banner-area overlay-bg"
        style="background:rgba(0,0,0,0) url('https://images.ctfassets.net/wowgx05xsdrr/7vdRFJD5V9NgHnz9T9zWuH/0d25b227eb67c68001df046af3529540/4590CD_Ecommerce-Conversion-Rate-Optimization_May-2022_Header.jpg?fm=webp&w=3840&q=75') no-repeat scroll center center/cover">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-banner">
                        <div class="heading-banner-title">
                            <h2></h2>
                        </div>
                        <div class="breadcumbs pb-15">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HEADING-BANNER END -->
    <!-- CHECKOUT-AREA START -->
    <div class="shopping-cart-area  pt-80 pb-80" id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping-cart">
                        <!-- Nav tabs -->
                        <ul class="cart-page-menu nav row clearfix mb-30">
                            <li style="width: 33%;">
                                <a href="/cart">Cart</a>
                            </li>
                            <li style="width: 33%;">
                                <a :class="orderComplete == 0 ? 'active' : ''" href="#">check out</a>
                            </li>
                            <li style="width: 33%;">
                                <a :class="orderComplete == 1 ? 'active' : ''" href="#">order complete</a>
                            </li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- check-out start -->
                            <div v-show="orderComplete == 0" class="tab-pane active" id="check-out">
                                <form v-on:submit.prevent="datHang()" id="formdata">
                                    <div class="shop-cart-table check-out-wrap">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="billing-details pr-20">
                                                    <h4 class="title-1 title-border text-uppercase mb-30">Thông Tin Giao
                                                        Hàng
                                                    </h4>
                                                    <input type="text" name="ten" placeholder="Tên Gọi...">
                                                    <input type="text" name="email" placeholder="Email Liên Hệ...">
                                                    <input type="text" name="phone"
                                                        placeholder="Số Điện Thoại Liên Hệ...">
                                                    <select class="custom-select mb-15" id="city" name="city"
                                                        @change="fetchHuyen(),city=1">
                                                        <option value="" selected>Chọn tỉnh thành</option>
                                                        <template v-for="(v,k) in listCity">
                                                            <option :value="v.code">@{{ v.name }}</option>>
                                                        </template>
                                                    </select>
                                                    <select v-show="city==1" class="custom-select mb-15" id="huyen"
                                                        name="huyen" @change="fetchXa(),huyen=1">
                                                        <option value="" selected>Chọn quận huyện</option>
                                                        <template v-for="(v,k) in listHuyen">
                                                            <option :value="v.code">@{{ v.name }}</option>>
                                                        </template>
                                                    </select>
                                                    <select v-show="huyen==1" class="custom-select mb-15" id="xa"
                                                        name="xa">
                                                        <option value="" selected>Chọn phường xã</option>
                                                        <template v-for="(v,k) in listXa">
                                                            <option :value="v.code">@{{ v.name }}</option>>
                                                        </template>
                                                    </select>
                                                    <textarea name="dia_chi_cu_the" class="custom-textarea" placeholder="Địa Chỉ Cụ Thể..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-xs-30">
                                                <div class="billing-details pl-20">
                                                    <div class="our-order payment-details">
                                                        <h4 class="title-1 title-border text-uppercase mb-30">Danh Sách Sản
                                                            Phẩm</h4>
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th><strong>Product</strong></th>
                                                                    <th class="text-end"><strong>Total</strong></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(v,k) in listCart">
                                                                    <td>@{{ v.ten_san_pham }} (@{{ v.size }})
                                                                        x@{{ v.so_luong }}</td>
                                                                    <td class="text-end">@{{ formatVND(v.gia_ban * v.so_luong) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-primary">Tổng Tiền</td>
                                                                    <td class="text-end text-primary">@{{ formatVND(tongTien) }}
                                                                    </td>
                                                                </tr>
                                                                <tr v-show="chietKhau!=0">
                                                                    <td class="text-primary">Chiết Khấu</td>
                                                                    <td class="text-end text-primary">
                                                                        -@{{ formatVND(chietKhau) }}</td>
                                                                </tr>
                                                                <tr v-show="chietKhau!=0">
                                                                    <td>Thành Tiền</td>
                                                                    <td class="text-end">@{{ formatVND(thanhTien) }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="payment-method mt-3 pl-20">
                                                    <div class="payment-accordion">
                                                        <h4 class="title-1 title-border text-uppercase">Mã Giảm Giá</h4>
                                                        <p class="text-gray">Nhập mã giảm giá của bạn nếu có!</p>
                                                        <input type="text" v-model="maGiamGia"
                                                            placeholder="Enter your code here.">
                                                        <button type="button" @click="giamGia()" data-text="apply coupon"
                                                            class="button-one submit-button mt-15">apply coupon</button>
                                                    </div>
                                                </div>
                                                <div class="payment-method mt-3 pl-20">

                                                    <h4 class="title-1 title-border text-uppercase mb-30">Phương Thức Thanh
                                                        Toán
                                                    </h4>
                                                    <div class="payment-accordion">
                                                        <h3 class="payment-accordion-toggle"
                                                            :style="{
                                                                border: selectedAccordion === 0 ? '1px solid red' :
                                                                    'none'
                                                            }"
                                                            @click="methodSelected(0)">Thanh Toán Khi Nhận Hàng
                                                        </h3>
                                                        <div class="payment-content default"
                                                            v-show="selectedAccordion === 0">
                                                            <p>Nhận hàng kiểm tra và thanh toán, hỗ trợ hoàn trả trong 7
                                                                ngày.</p>
                                                        </div>
                                                        <!-- Accordion end -->
                                                        <!-- Accordion start -->
                                                        <h3 class="payment-accordion-toggle"
                                                            :style="{
                                                                border: selectedAccordion === 1 ? '1px solid red' :
                                                                    'none'
                                                            }"
                                                            @click="methodSelected(1)">Thanh Toán Online
                                                        </h3>
                                                        <div class="payment-content" v-show="selectedAccordion === 1">
                                                            <p>Chuyển tiền thanh toán trực tiếp bằng ngân hàng Việt Nam.</p>
                                                        </div>
                                                        <!-- Accordion start -->
                                                        <button class="button-one submit-button mt-15"
                                                            data-text="place order" type="submit">Đặt Hàng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- order-complete start -->
                            <div v-show="orderComplete ==1">
                                <form action="#">
                                    <div class="thank-recieve bg-white mb-30">
                                        <p>Cảm ơn . Đơn hàng của bạn đã được xác nhận.</p>
                                    </div>
                                    <div class="order-info bg-white text-center clearfix mb-30">
                                        <div class="single-order-info">
                                            <h4 class="title-1 text-uppercase text-light-black mb-0">Mã Đơn Hàng</h4>
                                            <p class="text-uppercase text-light-black mb-0">
                                                <strong>@{{ hash }}</strong>
                                            </p>

                                        </div>
                                        <div class="single-order-info">
                                            <h4 class="title-1 text-uppercase text-light-black mb-0">Ngày Đặt Hàng</h4>
                                            <p class="text-uppercase text-light-black mb-0">
                                                <strong>@{{ date }}</strong>
                                            </p>
                                        </div>
                                        <div class="single-order-info">
                                            <h4 class="title-1 text-uppercase text-light-black mb-0">Tổng Tiền Cần Thanh Toán
                                            </h4>
                                            <p class="text-uppercase text-light-black mb-0">
                                                <strong>@{{ formatVND(thanhToan) }}</strong>
                                            </p>
                                        </div>
                                        <div class="single-order-info">
                                            <h4 class="title-1 text-uppercase text-light-black mb-0">Phương Thức Thanh Toán
                                            </h4>
                                            <p class="text-uppercase text-light-black mb-0">
                                                <strong>@{{ phuongThuc }}</strong>
                                            </p>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- order-complete end -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CHECKOUT-AREA END -->
@endsection
@section('js')
    <script>
        new Vue({
            el: '#checkout',
            data: {
                listCart: [],
                listCity: [],
                listHuyen: [],
                listXa: [],
                huyen: null,
                xa: null,
                maGiamGia: null,
                city: null,
                chietKhau: 0,
                thanhTien: 0,
                tongTien: 0,
                orderComplete: @json($complete),
                date : @json($date),
                phuongThuc : @json($phuong_thuc),
                hash : @json($hash),
                thanhToan : @json($thanhToan),
                clear : @json($clear),
                id_user: "{{ Auth::guard('khach')->user() ? Auth::guard('khach')->user()->id : -1 }}",
                selectedAccordion: 0,
            },
            created() {
                if(this.clear==1){
                    this.clearItemList();
                }
                this.loadCart();
                this.fetchData();
            },
            methods: {
                methodSelected(index) {
                    this.selectedAccordion = index;
                },
                datHang() {
                    let method = this.selectedAccordion;
                    var diaChi = {};
                    $.each($('#formdata').serializeArray(), function(_, kv) {
                        if (diaChi.hasOwnProperty(kv.name)) {
                            diaChi[kv.name] = $.makeArray(diaChi[kv.name]);
                            diaChi[kv.name].push(kv.value);
                        } else {
                            diaChi[kv.name] = kv.value;
                        }
                    });
                    diaChi.city = this.listCity.filter(item => item.code === diaChi.city)[0].name;
                    diaChi.huyen = this.listHuyen.filter(item => item.code === diaChi.huyen)[0].name;
                    diaChi.xa = this.listXa.filter(item => item.code === diaChi.xa)[0].name;
                    var data = {
                        'diaChi': diaChi,
                        'maGiamGia': this.maGiamGia,
                        'phuongThuc': 0,
                        'listCart': this.listCart,
                    }
                    if (method == 1) {
                        data.type = 1;
                        axios
                            .post('/api/checkout/dat-hang/' + this.id_user, data)
                            .then((res) => {
                                if (res.data.status) {
                                    if (res.data.redirect) {
                                        Swal.fire({
                                            title: "Thành công!",
                                            text: res.data.message,
                                            icon: "success"
                                        });
                                        return setTimeout(() => {
                                             window.location.href = res.data.redirect;
                                        }, 1500);
                                    }
                                    this.orderComplete = 1;
                                    this.hash = res.data.hash;
                                    this.thanhToan = res.data.tongTien;
                                    this.phuongThuc = res.data.phuongThuc;
                                    this.date = res.data.date;
                                    this.clearItemList();
                                } else {
                                    toastr.error(res.data.message);
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    } else {
                        data.type = 0;
                        axios
                            .post('/api/checkout/dat-hang/' + this.id_user, data)
                            .then((res) => {
                                if (res.data.status) {
                                    Swal.fire({
                                        title: "Thành công!",
                                        text: res.data.message,
                                        icon: "success"
                                    });
                                    this.orderComplete = 1;
                                    this.hash = res.data.hash;
                                    this.thanhToan = res.data.tongTien;
                                    this.phuongThuc = res.data.phuongThuc;
                                    this.date = res.data.date;
                                    this.clearItemList();
                                } else {
                                    toastr.error(res.data.message);
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    }

                },
                clearItemList() {
                    localStorage.removeItem('itemList');
                },
                giamGia() {
                    axios
                        .post('/voucher/' + this.maGiamGia)
                        .then((res) => {
                            if (res.data.status) {
                                this.chietKhau = res.data.chietKhau;
                                this.thanhTien = this.tongTien - res.data.chietKhau;
                                Swal.fire({
                                    title: "Thành công!",
                                    text: res.data.message,
                                    icon: "success"
                                });
                            } else {
                                Swal.fire({
                                    title: "Thất Bại!",
                                    text: res.data.message,
                                    icon: "error"
                                });
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                fetchXa() {
                    const huyenCode = $("#huyen").val();
                    axios
                        .get('https://api.mysupership.vn/v1/partner/areas/commune?district=' + huyenCode)
                        .then((res) => {
                            this.listXa = res.data.results;
                        });
                },
                fetchHuyen() {
                    const cityCode = $("#city").val();
                    axios
                        .get('https://api.mysupership.vn/v1/partner/areas/district?province=' + cityCode)
                        .then((res) => {
                            this.listHuyen = res.data.results;
                        });
                },
                fetchData() {
                    axios
                        .get('https://api.mysupership.vn/v1/partner/areas/province')
                        .then((res) => {
                            this.listCity = res.data.results;
                        });
                },
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
