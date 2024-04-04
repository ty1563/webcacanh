@extends('Client.share.master')
@section('noi_dung')
    <!-- HEADING-BANNER START -->
    <div class="heading-banner-area overlay-bg"
        style="background:rgba(0,0,0,0) url('https://static.vecteezy.com/system/resources/previews/011/084/753/large_2x/wish-list-text-button-best-service-speech-bubble-wish-list-colorful-web-banner-illustration-vector.jpg') no-repeat scroll center center/cover">
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
                                <li>Wishlist</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HEADING-BANNER END -->
    <!-- WISHLIST-AREA START -->
    <div class="shopping-cart-area pt-80 pb-80">
        <div class="container">
            <div class="row" id="Uwishlist">
                <div class="col-lg-12">
                    <div class="shop-cart-table">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Sản Phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-add-cart">Add to cart</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v,k) in listWishList">
                                        <td class="product-thumbnail  text-left">
                                            <!-- Single-product start -->
                                            <div class="single-product" style="float: left;">
                                                <div class="product-img">
                                                    <a href="single-product.html"><img :src="v.hinh_anh[0]"
                                                            alt="" /></a>
                                                </div>
                                                <div class="product-info">
                                                    <h4 class="post-title"><a class="text-light-black" href="#"><span
                                                                v-html="formatString(v.ten_san_pham, 30)"></span></a></h4>
                                                    <p class="mb-0">Mã : @{{ v.size_selected }}</p>
                                                </div>
                                            </div>
                                            <!-- Single-product end -->
                                        </td>
                                        <td class="product-price">@{{ formatCurrency(v.gia_ban) }}</td>
                                        <td class="product-add-cart">
                                            <a class="text-light-black" href="#"><i
                                                    class="zmdi zmdi-shopping-cart-plus"
                                                    v-on:click.prevent="addToCart(v)"></i></a>
                                        </td>
                                        <td class="product-remove">
                                            <a href="#" v-on:click.prevent="removeItems(v.id)"><i
                                                    class="zmdi zmdi-close"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- WISHLIST-AREA END -->
    @endsection
    @section('js')
        <script>
            new Vue({
                el: '#Uwishlist',
                data: {
                    listCart: [],
                    listWishList: [],
                    auth: "{{ Auth::guard('khach')->check() ? Auth::guard('khach')->user()->id : -1 }}",
                },
                created() {
                    this.loadList();
                },
                methods: {
                    formatString(str, num) {
                        if (str.length <= num) {
                            return str;
                        }

                        let result = '';
                        let i = 0;

                        while (i < str.length) {
                            let lastIndex = Math.min(i + num, str.length);
                            let spaceIndex = str.lastIndexOf(' ', lastIndex);

                            if (spaceIndex === -1 || spaceIndex <= i) {
                                result += str.substring(i, lastIndex) + '<br>';
                                i = lastIndex;
                            } else {
                                result += str.substring(i, spaceIndex + 1).trim() + '<br>';
                                i = spaceIndex + 1;
                            }
                        }

                        return result.trim();
                    },


                    loadList() {
                        const userId = Number(this.auth);
                        this.listCart = JSON.parse(localStorage.getItem('itemList')).filter(item => item.auth ===
                            userId) || [];
                        this.listWishList = JSON.parse(localStorage.getItem('listWishList')).filter(item => item
                            .auth === Number(this.auth)) || [];
                    },
                    removeItems(itemId) {
                        var itemList = JSON.parse(localStorage.getItem('listWishList')).filter(item => item.auth ===
                            Number(this.auth)) || [];
                        var indexToRemove = itemList.findIndex(item => item.id === itemId);
                        if (indexToRemove !== -1) {
                            itemList.splice(indexToRemove, 1);
                            localStorage.setItem('listWishList', JSON.stringify(itemList));
                        }
                        this.loadList();
                        Swal.fire({
                            title: "Thành công!",
                            text: "Đã Xóa Sản Phẩm",
                            icon: "success"
                        });
                    },
                    addToCart(dataItems) {
                        var data = {};
                        if (dataItems.size_active == 1) {
                            data = {
                                auth: Number(this.auth),
                                id: dataItems.id,
                                size: dataItems.size_selected,
                                size_active: dataItems.size_active,
                                size_customs: dataItems.size_customs,
                                hinh_anh: dataItems.hinh_anh,
                                gia_ban: dataItems.gia_ban,
                                ten_san_pham: dataItems.ten_san_pham,
                                so_luong: 1,
                            };
                        } else {
                            data = {
                                auth: Number(this.auth),
                                id: dataItems.id,
                                size: 0,
                                size_active: 0,
                                size_customs: dataItems.size_customs,
                                hinh_anh: dataItems.hinh_anh,
                                gia_ban: dataItems.gia_ban,
                                ten_san_pham: dataItems.ten_san_pham,
                                so_luong: 1,
                            };
                        }

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
                        this.removeItems(dataItems.id);
                        return this.loadList();;
                    },
                    formatCurrency(amount) {
                        return new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(amount);
                    }
                },
            });
        </script>
    @endsection
