@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-sm-4">
            <form id="formdata" v-on:submit.prevent="add()">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Thêm Mới Thương Hiệu
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mt-1">
                            <label class="form-label">Tên Thương Hiệu</label>
                            <input name="ten_thuong_hieu" type="text" class="form-control">
                        </div>
                        <div class="mt-1">
                            <label class="form-label">Thông Tin Thương Hiệu</label>
                            <textarea class="form-control" name="thong_tin_thuong_hieu" cols="10" rows="3"></textarea>
                        </div>
                        <div class="mt-1">
                            <label class="form-label">Danh mục</label>
                            <select name="id_danh_muc" class="form-control">
                                <template v-for="(v,k) in listDanhMuc">
                                    <option v-bind:value="v.id">@{{v.ten_danh_muc}}</option>
                                </template>
                            </select>
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
                                Danh Sách Thương Hiệu
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
                            <th class="text-center align-middle">Tên Thương Hiệu</th>
                            <th class="text-center align-middle">Thông Tin Thương Hiệu</th>
                            <th class="text-center align-middle">Danh Mục</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                        <tr v-for="(v,k) in listThuongHieu">
                            <th class="text-center align-middle">@{{ k + 1 }}</th>
                            <td class="text-center align-middle">@{{ v.ten_thuong_hieu }}</td>
                            <td class="text-center align-middle">
                                <textarea cols="30" rows="4">@{{ v.thong_tin_thuong_hieu }}</textarea>
                            </td>
                            <td class="text-center align-middle">@{{ v.ten_danh_muc }}</td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-primary" @click="openModal(),dataCapNhat=v">
                                    Cập Nhật
                                </button>
                                <button type="button" class="btn btn-danger" @click="deleteDanhMuc(v.id)">Xóa Bỏ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="modalCapNhat">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cập Nhật Thương Hiệu : <span style="color:red;">@{{dataCapNhat.ten_thuong_hieu}}</span></h5>
                            </div>
                            <div class="modal-body">
                                <div class="mt-1">
                                    <label class="form-label">Tên Thương Hiệu</label>
                                    <input v-model="dataCapNhat.ten_thuong_hieu" type="text" class="form-control">
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Thông Tin Thương Hiệu</label>
                                    <textarea class="form-control" v-model="dataCapNhat.thong_tin_thuong_hieu" cols="10" rows="3"></textarea>
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Danh mục</label>
                                    <select v-model="dataCapNhat.id_danh_muc" class="form-control">
                                        <template v-for="(v,k) in listDanhMuc">
                                            <option v-bind:value="v.id">@{{v.ten_danh_muc}}</option>
                                        </template>
                                    </select>
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
                listDanhMuc : [],
                listThuongHieu : [],
                dataCapNhat: {},
                keySearch : null,
            },
            created() {
                this.load();
            },
            methods: {
                deleteDanhMuc(id) {
                    if(confirm("Bạn Có Chắc Chắn Muốn Xóa?")){
                        axios
                        .delete('/admin/thuong-hieu/delete/' + id)
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
                        .put('/admin/thuong-hieu/update', this.dataCapNhat)
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
                        .post('/admin/thuong-hieu/create', paramObj)
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
                        keySearch : this.keySearch,
                    };
                    axios
                        .post('/admin/danh-muc/data')
                        .then((res) => {
                         if(res.data.status){
                            this.listDanhMuc = res.data.data;
                        } else {
                            toastr.error(res.data.message);
                        }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                    axios
                        .post('/admin/thuong-hieu/data',data)
                        .then((res) => {
                         if(res.data.status){
                            this.listThuongHieu = res.data.data;
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
