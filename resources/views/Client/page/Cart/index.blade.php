@extends('Client.share.master')
@section('noi_dung')
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
                                <li>Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPPING-CART-AREA START -->
    <div class="shopping-cart-area  pt-80 pb-80" id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping-cart">
                        <!-- Nav tabs -->
                        <ul class="cart-page-menu nav row clearfix mb-30">
                            <li style="width: 33%;"><a class="active" href="#shopping-cart" data-bs-toggle="tab">Cart</a>
                            </li>
                            <li style="width: 33%;"><a href="/checkout">CheckOut</a></li>
                            <li style="width: 33%;"><a href="#">Order Complete</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- shopping-cart start -->
                            <div class="tab-pane active" id="shopping-cart">
                                <form action="#">
                                    <div class="shop-cart-table">
                                        <div class="table-content table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="product-thumbnail">Tên Sản Phẩm</th>
                                                        <th class="product-price">Giá Bán</th>
                                                        <th class="product-quantity">Số Lượng</th>
                                                        <th class="product-subtotal">Thành Tiền</th>
                                                        <th class="product-remove">Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(v,k) in listCart">
                                                        <td class="product-thumbnail  text-left">
                                                            <!-- Single-product start -->
                                                            <div class="single-product">
                                                                <div class="product-img">
                                                                    <a :href="'/product/view/' + v.id"><img
                                                                            :src="v.hinh_anh[0]" alt="" /></a>
                                                                </div>
                                                                <div class="product-info">
                                                                    <h4 class="post-title"><a class="text-light-black"
                                                                            :href="'/product/view/' + v.id">@{{ formatString(v.ten_san_pham, 40) }}</a>
                                                                    </h4>
                                                                    <p class="mb-0">Biến Thể : @{{ v.size ? v.size : 'Không Có' }}</p>
                                                                </div>
                                                            </div>
                                                            <!-- Single-product end -->
                                                        </td>
                                                        <td class="product-price">@{{ formatVND(v.gia_ban) }}</td>
                                                        <td class="product-quantity">
                                                            <div @click.stop="updateSL(v,0,k)" class="cart-plus-minus">
                                                                <div class="dec qtybutton">-</div>
                                                                <input @input="updateSL(v,2,k)" type="text"
                                                                    :value="v.so_luong" :id="'so_luong' + k"
                                                                    class="cart-plus-minus-box">
                                                                <div @click.stop="updateSL(v,1,k)" class="inc qtybutton">+</div>
                                                            </div>
                                                        </td>
                                                        <td class="product-subtotal">@{{ formatVND(v.gia_ban*v.so_luong) }}</td>
                                                        <td class="product-remove">
                                                            <a href="#" @click="removeFromCart(v.id)"><i class="zmdi zmdi-close"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="div text-center">
                                    <button type="button" @click="checkout()" data-text="Đi Đến Thanh Toán" class="button-one submit-button mt-15">Đi
                                        Đến Thanh Toán</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPPING-CART-AREA END -->
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                listCart: [],
                tongTien: 0,
                id_user: "{{ Auth::guard('khach')->user() ? Auth::guard('khach')->user()->id : -1 }}",
            },
            created() {
                this.loadCart();
            },
            methods: {
                checkout(){
                    var itemList = JSON.parse(localStorage.getItem('itemList')) || [];
                    if(itemList.length < 1)
                        return;
                    window.location.href = '/checkout';
                },
                removeFromCart(itemId) {
                    var itemList = JSON.parse(localStorage.getItem('itemList')) || [];
                    var indexToRemove = itemList.findIndex(item => item.id === itemId);
                    if (indexToRemove !== -1) {
                        itemList.splice(indexToRemove, 1);
                        localStorage.setItem('itemList', JSON.stringify(itemList));
                    }
                    this.loadCart();
                    return Swal.fire({
                                title: "Thành Công!",
                                text: "Xóa Thành Công",
                                icon: "success"
                            });
                },
                updateSL(data, type, k) {
                    var index = this.listCart.findIndex(item => item.id === data.id && item.size === data.size);
                    if (index !== -1 && this.listCart[index].so_luong >= 1) {
                        if (type === 1) {
                            this.listCart[index].so_luong = parseInt(this.listCart[index].so_luong)+1;
                        } else if (type === 0 && this.listCart[index].so_luong > 1) {
                            this.listCart[index].so_luong = parseInt(this.listCart[index].so_luong)-1;
                        } else {
                            const soLuong = parseInt($("#so_luong" + k).val());
                            if (!isNaN(soLuong) && soLuong >= 1) {
                                this.listCart[index].so_luong = parseInt(soLuong);
                            }
                        }
                        localStorage.setItem('itemList', JSON.stringify(this.listCart));
                        return this.loadCart();
                    }
                },
                formatString(str, num) {
                    if (str.length <= num) {
                        return str;
                    }
                    let subString = str.substr(0, num - 1);
                    return subString.substr(0, subString.lastIndexOf(" ")) + "...";
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
