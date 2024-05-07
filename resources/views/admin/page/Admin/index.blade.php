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
                                    <th class="text-center align-middle">Thông Tin</th>
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
                                    <td class="text-center align-middle"><button class="btn btn-info" @click="showInfo(v.id)">!</button></td>
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
                        <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div id="chiTiet" class="dev1m-card mt-2"
                                        style="width: 100%;max-width: 500px;overflow: hidden;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <img src="\Admin_assets\assets\images\avatars\avatar-1.png" alt="Admin"
                                                        class="rounded-circle p-1 bg-primary" width="110">
                                                    <div class="mt-3">
                                                        <h4>@{{ data.ho_ten }}</h4>
                                                        <p class="text-secondary mb-1">@{{ data.username }}</p>
                                                        <p class="text-muted font-size-sm">@{{ data.is_master==1 ? "Master" : "Admin"}}</p>
                                                        <div>
                                                            <button class="btn" :class="view === 1 ? 'btn-primary' : 'btn-outline-primary'" @click="view = 1">Mạng Xã Hội</button>
                                                            <button class="btn" :class="view === 2 ? 'btn-primary' : 'btn-outline-primary'" @click="view = 2">Liên Hệ</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="my-4">
                                                <ul v-show="view===1" class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-github me-2 icon-inline">
                                                                <path
                                                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                                </path>
                                                            </svg>Github</h6>
                                                        <span class="text-secondary">@{{ info ? info.github : "none" }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-twitter me-2 icon-inline text-info">
                                                                <path
                                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                                </path>
                                                            </svg>Twitter</h6>
                                                        <span class="text-secondary">@{{info ? info.twitter : "none"}}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-instagram me-2 icon-inline text-danger">
                                                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                                            </svg>Instagram</h6>
                                                        <span class="text-secondary">@{{info ? info.instagram : "none"}}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-facebook me-2 icon-inline text-primary">
                                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                            </svg>Facebook</h6>
                                                        <span class="text-secondary">@{{info ? info.facebook : "none"}}</span>
                                                    </li>
                                                </ul>
                                                <ul v-show="view===2" class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg width="24" height="24" aria-hidden="true" focusable="false" class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" ><path d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>
                                                            Số Điện Thoại</h6>
                                                        <span class="text-secondary">@{{info ? data.sdt : "none"}}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg  width="24" height="24" viewBox="0 0 8 6" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="m0 0h8v6h-8zm.75 .75v4.5h6.5v-4.5zM0 0l4 3 4-3v1l-4 3-4-3z"/>
                                                        </svg>
                                                        Email</h6>
                                                        <span class="text-secondary">@{{info ? info.email : "none"}}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><img width="24" height="24" alt="Pin Location SVG Vector Icon" fetchpriority="high" decoding="async" data-nimg="1" src="/pin.svg">
                                                            Địa Chỉ 1</h6>
                                                        <span class="text-secondary">@{{info ? info.dia_chi_1 : "none"}}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><img width="24" height="24" alt="Pin Location SVG Vector Icon" fetchpriority="high" decoding="async" data-nimg="1" src="/pin.svg">
                                                            Địa Chỉ 2</h6>
                                                        <span class="text-secondary">@{{info ? info.dia_chi_2 : "none"}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-danger" @click="dong()">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <label>
                                            <input type="checkbox" v-model="select.khach_hangs">
                                            Quản Lý Khách Hàng
                                        </label>
                                        <label>
                                            <input type="checkbox" v-model="select.vouchers">
                                            Quản Lý Voucher
                                        </label>
                                        <label>
                                            <input type="checkbox" v-model="select.don_hangs">
                                            Quản Lý Đơn Hàng
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
                view : 1,
                data : [],
                info : [],
            },
            created() {
                this.load();
            },
            methods: {
                dong() {
                    $('#modalInfo').modal('hide');
                },
                showInfo(id){
                    this.data = this.listAdmin.find(admin => admin.id === id);
                    this.info = this.data.thong_tin_admins[0];
                    $('#modalInfo').modal('show');
                },
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
                        .post('/admin/admin/data')
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
