@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="\Admin_assets\assets\images\avatars\avatar-1.png" alt="Admin"
                            class="rounded-circle p-1 bg-primary" width="110">
                        <div class="mt-3">
                            <h4>@{{ info.ho_ten }}</h4>
                            <p class="text-secondary mb-1">@{{ info.username }}</p>
                            <p class="text-muted font-size-sm">@{{ info.is_master===1 ? "Master" : "Admin"}}</p>
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
                            <span class="text-secondary">@{{ data ? data.github : "none" }}</span>
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
                            <span class="text-secondary">@{{data ? data.twitter : "none"}}</span>
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
                            <span class="text-secondary">@{{data ? data.instagram : "none"}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-facebook me-2 icon-inline text-primary">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>Facebook</h6>
                            <span class="text-secondary">@{{data ? data.facebook : "none"}}</span>
                        </li>
                    </ul>
                    <ul v-show="view===2" class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg width="24" height="24" aria-hidden="true" focusable="false" class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" ><path d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>
                                Số Điện Thoại</h6>
                            <span class="text-secondary">@{{info ? info.sdt : "none"}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg  width="24" height="24" viewBox="0 0 8 6" xmlns="http://www.w3.org/2000/svg">
                                <path d="m0 0h8v6h-8zm.75 .75v4.5h6.5v-4.5zM0 0l4 3 4-3v1l-4 3-4-3z"/>
                            </svg>
                            Email</h6>
                            <span class="text-secondary">@{{data ? data.email : "none"}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><img width="24" height="24" alt="Pin Location SVG Vector Icon" fetchpriority="high" decoding="async" data-nimg="1" src="/pin.svg">
                                Địa Chỉ 1</h6>
                            <span class="text-secondary">@{{data ? data.dia_chi_1 : "none"}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><img width="24" height="24" alt="Pin Location SVG Vector Icon" fetchpriority="high" decoding="async" data-nimg="1" src="/pin.svg">
                                Địa Chỉ 2</h6>
                            <span class="text-secondary">@{{data ? data.dia_chi_2 : "none"}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <form id="formdata" v-on:submit.prevent="updateInfo()">
                    <div class="card-body">
                        <input type="hidden" name="id" :value="info.id">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Facebook</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input :value="data ? data.facebook : ''" name="facebook" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Mobile</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input :value="data ? data.mobile : ''" name="mobile" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Messenger</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input :value="data ? data.messenger : ''" name="messenger" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Zalo</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input :value="data ? data.zalo : ''" name="zalo" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Twitter</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input :value="data ? data.twitter : '' " name="twitter" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Instagram</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input :value="data ? data.instagram : '' " name="instagram" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Github</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input name="github" :value="data ? data.github : '' " type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Địa Chỉ 1</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input :value="data ? data.dia_chi_1 : ''" name="dia_chi_1" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Địa Chỉ 2</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input :value="data ? data.dia_chi_2 : ''" name="dia_chi_2" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary text-end">
                                <input type="submit" class="btn btn-primary px-4" value="Lưu Cập Nhật">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                info: @json($info),
                data : @json($data),
                view : 1,
            },
            created() {

            },
            methods: {
                updateInfo(){
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
                        .put('/admin/admin/updateInfo', paramObj)
                        .then((res) => {
                         if(res.data.status){
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
            },
        });
    </script>
@endsection
