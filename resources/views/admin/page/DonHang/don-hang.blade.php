@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">
                        Danh Sách Đơn Hàng
                    </h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên KH</th>
                            <th class="text-center">Địa Chỉ</th>
                            <th class="text-center">Liên Hệ</th>
                            <th class="text-center">Hash</th>
                            <th class="text-center">Tiền Hàng</th>
                            <th class="text-center">Mã Giảm Giá</th>
                            <th class="text-center">Thanh Toán</th>
                            <th class="text-center">Giao Hàng</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <tr v-for="(v,k) in listDonHang">
                            <th class="text-center align-middle">#</th>
                            <td class="text-center align-middle">@{{ v.ten }} <br>( @{{ v.khach_hangs.username }} )</td>
                            <td class="text-center align-middle">@{{ v.dia_chi }}</td>
                            <td class="text-center align-middle">@{{ v.phone }} <br> @{{ v.email }}</td>
                            <td class="text-center align-middle">@{{ v.hash }}</td>
                            <td class="text-center align-middle">@{{ formatVND(v.tien_hang) }}</td>
                            <td class="text-center align-middle">@{{ v.ma_giam_gia ? v.ma_giam_gia : "Không" }}</td>
                            <template>
                                <td v-if="v.thanh_toan == 0" class="text-center align-middle">
                                    <button class="btn btn-primary" @click="changeThanhToan(v.hash)">Chưa Thanh
                                        Toán</button>
                                </td>
                                <td v-else class="text-center align-middle">
                                    <button class="btn btn-success" @click="changeThanhToan(v.hash)">Đã Thanh Toán</button>
                                </td>
                            </template>
                            <template>
                                <td v-if="v.giao_hang == 0" class="text-center align-middle">
                                    <button class="btn btn-primary" @click="changeGiaoHang(v.hash,v.giao_hang)">Đang Lấy
                                        Hàng</button>
                                </td>
                                <td v-if="v.giao_hang==1" class="text-center align-middle">
                                    <button class="btn btn-warning" @click="changeGiaoHang(v.hash,v.giao_hang)">Đang Giao
                                        Hàng</button>
                                </td>
                                <td v-if="v.giao_hang == 2" class="text-center align-middle">
                                    <button class="btn btn-success" @click="changeGiaoHang(v.hash,v.giao_hang)">Đã
                                        Giao</button>
                                </td>
                            </template>
                            <td class="text-center align-middle">
                                <button @click.prevent="deleteDonHang(v.id)" class="btn btn-danger">Hủy Đơn Hàng</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                listDonHang: [],
            },
            created() {
                this.load();
            },
            methods: {
                deleteDonHang(id){
                    axios
                        .delete('/admin/don-hang/delete/'+id)
                        .then((res) => {
                         if(res.data.status){
                            this.load();
                            toastr.success(res.data.message);
                        } else {
                            toastr.error(res.data.message);
                        }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                changeGiaoHang(hash, code) {
                    axios
                        .post('/admin/don-hang/change/giao-hang/' + hash + "/" + code)
                        .then((res) => {
                            if (res.data.status) {
                                this.load();
                                toastr.success(res.data.message);
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                changeThanhToan(hash) {
                    axios
                        .post('/admin/don-hang/change/thanh-toan/' + hash)
                        .then((res) => {
                            if (res.data.status) {
                                this.load();
                                toastr.success(res.data.message);
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                load() {
                    axios
                        .post('/admin/don-hang/data')
                        .then((res) => {
                            if (res.data.status) {
                                this.listDonHang = res.data.data;
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
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
