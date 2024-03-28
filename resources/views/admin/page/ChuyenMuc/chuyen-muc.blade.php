@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-sm-4">
            <form id="formdata" v-on:submit.prevent="add()">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Thêm Mới Chuyên Mục
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mt-1">
                            <label class="form-label">Tên Chuyên Mục</label>
                            <input name="ten_chuyen_muc" type="text" class="form-control">
                        </div>
                        <div class="mt-1">
                            <label class="form-label">Giới Thiệu</label>
                            <textarea class="form-control" name="gioi_thieu" cols="10" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-success" type="submit">Thêm Mới</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5>
                                Danh Sách Chuyên Mục
                            </h5>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-floating">
                                <input @input="load()" type="text" class="form-control" id="floatingInput" v-model="keySearch">
                                <label for="floatingInput">Lọc Theo Từ Khóa</label>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Tên Chuyên Mục</th>
                            <th class="text-center align-middle">Giới Thiệu</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                        <tr v-for="(v,k) in listChuyenMuc">
                            <th class="text-center align-middle">@{{ k + 1 }}</th>
                            <td class="text-center align-middle">@{{ v.ten_chuyen_muc }}</td>
                            <td class="text-center align-middle">
                                <textarea cols="30" rows="4">@{{ v.gioi_thieu }}</textarea>
                            </td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-primary" @click="openModal(),dataCapNhat=v">
                                    Cập Nhật
                                </button>
                                <button type="button" class="btn btn-danger" @click="deleteChuyenMuc(v.id)">Xóa Bỏ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="modalCapNhat">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cập Nhật Chuyên Mục : <span style="color:red;">@{{dataCapNhat.ten_chuyen_muc}}</span></h5>
                            </div>
                            <div class="modal-body">
                                <div class="mt-1">
                                    <label class="form-label">Tên Chuyên Mục</label>
                                    <input v-model="dataCapNhat.ten_chuyen_muc" type="text" class="form-control">
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Giới Thiệu</label>
                                    <textarea class="form-control" v-model="dataCapNhat.gioi_thieu" cols="10" rows="3"></textarea>
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
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                listChuyenMuc: [],
                dataCapNhat: {},
                keySearch : null,
            },
            created() {
                this.load();
            },
            methods: {
                deleteChuyenMuc(id) {
                    if(confirm("Xóa Chuyên Mục Sẽ Ảnh Hưởng Rất Nhiều Đến Những Danh Mục Và Sản Phẩm Liên Quan , Bạn Có Chắc Chắn Muốn Xóa?")){
                        axios
                        .delete('/admin/chuyen-muc/delete/' + id)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.load();
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
                saveModal() {
                    axios
                        .put('/admin/chuyen-muc/update', this.dataCapNhat)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.load();
                                this.closeModal();
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
                add() {
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
                        .post('/admin/chuyen-muc/create', paramObj)
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
                    var data = {
                        'keySearch' : this.keySearch,
                    };
                    axios
                        .post('/admin/chuyen-muc/data',data)
                        .then((res) => {
                            if (res.data.status) {
                                this.listChuyenMuc = res.data.data;
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
            },
        });
    </script>
@endsection
