@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="card">
            <div class="card-header">
                <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">
                    Quản Lý Khách Hàng
                </h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="search" v-model="searchKey" v-on:keyup="load(1)" class="form-control text-darkmod text-center"
                            placeholder="Nhập từ Khóa Tìm Kiếm" />
                        </div>
                    </div>
                    <tr>
                        <td class="text-center">#</td>
                        <td class="text-center">Username</td>
                        <td class="text-center">email</td>
                        <td class="text-center">Coin</td>
                        <td class="text-center">Tình Trạng</td>
                        <td class="text-center">Action</td>
                    </tr>
                    <tr v-for="(v,k) in listKH">
                        <td class="text-center">@{{ k + 1 }}</td>
                        <td class="text-center">@{{ v.username }}</td>
                        <td class="text-center">@{{ v.email }}</td>
                        {{-- <td class="text-center">@{{ chuyenTien(v.coin) }}</td> --}}
                        <td class="text-center">
                            <input type="number" v-model="v.coin" @change="updateCoin(v.id, v.coin)"
                                class="form-control">
                        </td>
                        <td v-if="v.status==1" class="text-center">
                            <Button v-on:click="change(v.id)" class="btn btn-info">Mở</Button>
                        </td>
                        <td v-else class="text-center">
                            <Button v-on:click="change(v.id)" class="btn btn-danger">Khóa</Button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary" @click="openModal(),dataCapNhat = v">
                                Thay Đổi Mật Khẩu
                            </button>
                            <button class="btn btn-danger" @click="xoa(v.id)">Xóa</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer" style="background: none">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item" :class="{ 'disabled': !pagination.prev_page_url }">
                            <a class="page-link" href="#" v-on:click="load(pagination.current_page - 1)">Trang Trước</a>
                        </li>
                        <li class="page-item" :class="{ 'disabled': !pagination.next_page_url }">
                            <a class="page-link" href="#" v-on:click="load(pagination.current_page + 1)">Trang Kế</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="modal fade" id="modalCapNhat">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)" class="modal-title">Cập Nhật Mật Khẩu Khách Hàng : <span style="color:red;">@{{dataCapNhat.username}}</span></h5>
                        </div>
                        <div class="modal-body">
                            <div class="mt-1">
                                <label class="form-label">Mật Khẩu Mới</label>
                                <input id="newPassword1" type="text" class="form-control">
                                <label class="form-label">Nhập Lại Mật Khẩu Mới</label>
                                <input id="newPassword2" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="closeModal()">Đóng</button>
                            <button type="button" class="btn btn-primary" @click="saveModal()">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                listKH: [],
                searchKey: null,
                view: window.innerWidth,
                dataCapNhat : {},
            },
            created() {
                this.load(1);
            },
            methods: {
                saveModal(){
                    var data = {
                        'id'           : this.dataCapNhat.id,
                        'newPassword1' : $("#newPassword1").val(),
                        'newPassword2' : $("#newPassword2").val(),
                    };
                    axios
                        .put('/admin/khach-hang/changePassword', data)
                        .then((res) => {
                         if(res.data.status){
                            toastr.success(res.data.message);
                            $('#modalCapNhat').modal('hide');
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
                closeModal() {
                    $('#modalCapNhat').modal('hide');
                },
                openModal() {
                    $('#modalCapNhat').modal('show');
                },
                updateCoin(id, coin) {
                    var data = {
                        'id': id,
                        'coin': coin,
                    };
                    axios
                        .post('/admin/khach-hang/update', data)
                        .then((res) => {
                            if (res.data.status) {
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
                chuyenTien(soTien) {
                    const formatter = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });
                    return formatter.format(soTien);
                },
                xoa(id) {
                    if (confirm(
                            "Bạn Chắc Chắn Muốn Xóa?"
                        )) {
                        axios
                            .delete('/admin/khach-hang/delete/'+ id)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.load(1);
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
                change(id) {
                    axios
                        .post('/admin/khach-hang/change/' + id, id)
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
                load(page) {
                    var data = {
                        'keySearch': this.searchKey,
                    };
                    axios
                        .post('/admin/khach-hang/data?page=' + page,data)
                        .then((res) => {
                            if (res.data.status) {
                                this.listKH = res.data.data.data;
                                this.pagination = res.data.data;
                            } else {

                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
            },
        });
    </script>
@endsection
