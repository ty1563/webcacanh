@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="d-flex justify-content-between align-items-center m-1">
                            <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">Danh Sách Admin</h5>
                            <button v-if="{{Auth::guard("admin")->user()->is_master}} === 1" class="btn btn-success ml-auto" data-bs-toggle="modal" data-bs-target="#themMoiModal">Thêm
                                Mới</button>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">Tên</th>
                                    <th class="text-center align-middle">Username</th>
                                    <th class="text-center align-middle">Email</th>
                                    <th class="text-center align-middle">Quyền</th>
                                    <th v-if="{{Auth::guard("admin")->user()->is_master}} === 1" class="text-center align-middle">Action</th>
                                </tr>
                                <tr v-for="(v,k) in listAdmin">
                                    <th class="text-center align-middle">@{{ k + 1 }}</th>
                                    <td class="text-center align-middle">
                                        <b style="color:green" v-if="{{Auth::guard("admin")->user()->id}} == v.id">@{{v.ho_ten}}</b>
                                        <b v-else>@{{v.ho_ten}}</b>
                                    </td>
                                    <td class="text-center align-middle">@{{ v.username }}</td>
                                    <td class="text-center align-middle">@{{ v.email }}</td>
                                    <td class="text-center align-middle">
                                        <template v-if="v.is_master != 1" v-for="(v1,k1) in v.quyen">
                                            @{{ v1 }}
                                            <br>
                                        </template>
                                        <template v-else>
                                            Master
                                        </template>
                                    </td>
                                    <td class="text-center align-middle" v-if="{{Auth::guard("admin")->user()->is_master}} == 1">
                                        <button  v-if="v.is_master != 1" @click="id_quyen = v.id , fill(v.quyen)" type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#permissionModal">
                                            Xét Quyền
                                        </button>
                                        <button v-if="v.is_master != 1" v-on:click="xoa(v.id)" class="btn btn-danger">Xóa Bỏ</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"
                                            style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">Thêm Mới
                                            Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form v-on:submit.prevent="add()" id="form_data">
                                        <div class="modal-body">
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="ho_ten">
                                                <label>Họ Tên</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="number" maxlength="11" class="form-control" name="sdt">
                                                <label>SDT</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="text" class="form-control" name="username">
                                                <label>Username</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="email" class="form-control" name="email">
                                                <label>Email</label>
                                              </div>
                                            <div class="form-floating mb-2">
                                                <input type="password" class="form-control" name="password">
                                                <label>Password</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="permissionModalLabel">Xét quyền</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>
                                            <input type="checkbox" v-model="select.chuyen_mucs">
                                            Quản Lý Chuyên Mục
                                        </label>
                                        <label>
                                            <input type="checkbox" v-model="select.danh_mucs">
                                            Quản Lý Danh Mục
                                        </label>
                                        <label>
                                            <input type="checkbox" v-model="select.san_phams">
                                            Quản Lý Sản Phẩm
                                        </label>
                                        <label>
                                            <input type="checkbox" v-model="select.thuong_hieus">
                                            Quản Lý Thương Hiệu
                                        </label>
                                        <label>
                                            <input type="checkbox" v-model="select.kien_thucs">
                                            Quản Lý Bài Viết Kiến Thức
                                        </label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" data-bs-dismiss="modal" v-on:click="select_quyen()"
                                            class="btn btn-primary">Lưu</button>
                                    </div>
                                </div>
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
                listAdmin: [],
                edit: {},
                ten_chuyen_muc: '',
                select: {
                    chuyen_mucs: false,
                    san_phams: false,
                    nha_cung_caps: false,
                    nhap_khos: false,
                },
                list_select: [],
                quyen: null,
                id_quyen: null,

            },
            created() {
                this.load();
            },
            methods: {
                fill($quyen) {
                    for (let key in this.select) {
                        this.select[key] = false;
                    }

                    $quyen.forEach(item => {
                        if (this.select.hasOwnProperty(item)) {
                            this.select[item] = true;
                        }
                    });
                },
                select_quyen() {
                    this.list_select = Object.keys(this.select).filter(key => this.select[
                        key]);
                    this.quyen = this.list_select.join(',');
                    var data = {
                        'id': this.id_quyen,
                        'quyen': this.quyen,
                    };
                    axios
                        .post('/admin/admin/quyen', data)
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
                },
                add() {
                    var paramObj = {};
                    $.each($('#form_data').serializeArray(), function(_, kv) {
                        if (paramObj.hasOwnProperty(kv.name)) {
                            paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                            paramObj[kv.name].push(kv.value);
                        } else {
                            paramObj[kv.name] = kv.value;
                        }
                    });
                    axios
                        .post('/admin/admin/add', paramObj)
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
                },
                load() {
                    axios
                        .post('/admin/admin/data', 1)
                        .then((res) => {
                            if (res.data.status) {
                                this.listAdmin = res.data.data;
                                console.log(res.data.data);
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
                updateInfo() {
                    axios
                        .post('/admin/chuyen-muc/edit', this.edit)
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
                xoa(id) {
                    if (confirm(
                            "Bạn Chắc Chắn Muốn Xóa?"
                        )) {
                        axios
                            .post('/admin/admin/delete/' + id, id)
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
                }
            },
        });
    </script>
    <script>
        var route_prefix = "/laravel-filemanager";
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $("#lfm").filemanager('image', {
            prefix: route_prefix
        });
        $("#lfm_edit").filemanager('image', {
            prefix: route_prefix
        });
    </script>
@endsection
