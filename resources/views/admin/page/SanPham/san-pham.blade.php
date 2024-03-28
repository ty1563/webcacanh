@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="row" v-show="type === 0">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="card">
                    <form v-on:submit.prevent="add()" id="formdata">
                        <div class="card-header">
                            <h5>Thêm Mới Sản Phẩm</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" name="ten_san_pham"
                                        placeholder="Nhập Tên Của Sản Phẩm">
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Hình Ảnh Sản Phẩm</label>
                                    <div class="input-group">
                                        <input id="hinh_anh" name="hinh_anh" class="form-control" type="text"
                                            name="filepath" placeholder="Tối Đa 5 Hình">
                                        <span class="input-group-prepend">
                                            <a id="lfm" data-input="hinh_anh" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label">Danh Mục</label>
                                    <select name="id_danh_muc" class="form-control">
                                        <template v-for="(v,k) in listDanhMuc">
                                            <option v-bind:value="v.id">@{{ v.ten_danh_muc }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Thương Hiệu</label>
                                    <select name="id_thuong_hieu" class="form-control">
                                        <template v-for="(v,k) in listThuongHieu">
                                            <option v-bind:value="v.id">@{{ v.ten_thuong_hieu }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Tình Trạng</label>
                                    <select name="tinh_trang" class="form-control">
                                        <option value="1" selected>Mở</option>
                                        <option value="0">Đóng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1" v-show="size_active === 0">
                                <div class="col-md-4">
                                    <button type="button" style="border-radius: 5px;margin-top: 30px;" @click="size_active = 1">Kích Hoạt
                                        Biến
                                        Thể Size</button>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Giá Bán</label>
                                    <input type="text" class="form-control" name="gia_ban"
                                        placeholder="Nhập Giá Bán Của Sản Phẩm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Xếp Hạng</label>
                                    <input type="number" class="form-control" name="xep_hang">
                                </div>
                            </div>
                            <div class="row" v-show="size_active === 1">
                                <div v-for="(bienThe, chiSo) in bienTheSize">
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="form-label">Kích Cỡ</label>
                                            <input class="form-control" type="text" v-model="bienThe.kichCo"
                                                placeholder="Kích cỡ">
                                        </div>
                                        <div class="col-md">
                                            <label class="form-label">Giá Bán</label>
                                            <input class="form-control" type="number" v-model="bienThe.giaBan"
                                                placeholder="Giá bán">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-1">
                                    <button type="button" style="border-radius: 5px;" @click="themBienThe()">Thêm Kích
                                        Cỡ</button>
                                </div>
                            </div>
                            <div class="m-1">
                                <label class="form-label">Mô Tả</label>
                                <textarea placeholder="Mô Tả Thông Tin Về Sản Phẩm" class="form-control" name="mo_ta" cols="10" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Thêm Mới</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>

        {{-- Cap Nhat --}}
        <div class="row" v-show="type===1">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="card">
                    <form v-on:submit.prevent="update()" id="formdata2">
                        <div class="card-header">
                            <h5>Cập Nhật Sản Phẩm : <span style="color: red">@{{ dataCapNhat.ten_san_pham }}</span></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" v-model="dataCapNhat.ten_san_pham"
                                        placeholder="Nhập Tên Của Sản Phẩm">
                                </div>
                                <div class="col-md">
                                    <label>Hình Ảnh</label>
                                    <div class="input-group">
                                        <input v-model="dataCapNhat.hinh_anh" id="iloveu" class="form-control" type="text" name="filepath">
                                        <span class="input-group-prepend">
                                            <a id="lfm_edit" data-input="iloveu" data-preview="iloveu2" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                    </div>
                                    <div id="iloveu2" style="margin-top:15px;max-height:100px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label class="form-label">Danh Mục</label>
                                    <select v-model="dataCapNhat.id_danh_muc" class="form-control">
                                        <template v-for="(v,k) in listDanhMuc">
                                            <option v-bind:value="v.id">@{{ v.ten_danh_muc }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Thương Hiệu</label>
                                    <select v-model="dataCapNhat.id_thuong_hieu" class="form-control">
                                        <template v-for="(v,k) in listThuongHieu">
                                            <option v-bind:value="v.id">@{{ v.ten_thuong_hieu }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <label class="form-label">Tình Trạng</label>
                                    <select v-model="dataCapNhat.tinh_trang" class="form-control">
                                        <option value="1" selected>Mở</option>
                                        <option value="0">Đóng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-1" v-show="dataCapNhat.size_active === 0">
                                <div class="col-md-4">
                                    <label class="form-label">Giá Bán</label>
                                    <input type="text" class="form-control" v-model="dataCapNhat.gia_ban"
                                        placeholder="Nhập Giá Bán Của Sản Phẩm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Xếp Hạng</label>
                                    <input type="number" class="form-control" v-model="dataCapNhat.xep_hang">
                                </div>
                            </div>
                            <div class="row" v-show="dataCapNhat.size_active === 1">
                                <div v-for="(bienThe1, chiSo1) in dataCapNhat.size_customs">
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="form-label">Kích Cỡ</label>
                                            <input class="form-control" type="text" v-model="bienThe1.size"
                                                placeholder="Kích cỡ">
                                        </div>
                                        <div class="col-md">
                                            <label class="form-label">Giá Bán</label>
                                            <input class="form-control" type="number" v-model="bienThe1.gia_ban"
                                                placeholder="Giá bán">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-1">
                                    <button type="button" style="border-radius: 5px;" @click="themBienTheEdit">Thêm Kích
                                        Cỡ</button>
                                </div>
                            </div>
                            <div class="m-1">
                                <label class="form-label">Mô Tả</label>
                                <textarea placeholder="Mô Tả Thông Tin Về Sản Phẩm" class="form-control" v-model="dataCapNhat.mo_ta" cols="10"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success" @click="capNhat()">Lưu Cập Nhật</button>
                            <button type="button" class="btn btn-danger" @click="type=0">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Danh Sách Sản Phẩm
                        </h5>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Tên Sản Phẩm</th>
                            <th class="text-center align-middle">Hình Ảnh</th>
                            <th class="text-center align-middle">Mô Tả</th>
                            <th class="text-center align-middle">Giá Bán</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                        <tr v-for="(v,k) in listSanPham">
                            <th class="text-center align-middle">@{{ k + 1 }}</th>
                            <td class="text-center align-middle">@{{ v.ten_san_pham }}</td>
                            <td class="text-center align-middle">
                                <div :id="'carouselExampleIndicators' + k" class="carousel slide">
                                    <div class="carousel-inner">
                                        <template v-for="(v1, k1) in v.hinh_anh.split(',')">
                                            <div v-if="k1==0" class="carousel-item active">
                                                <img style="width: 100px;height: 80px;" v-bind:src="v1" alt="v1">
                                            </div>
                                            <div v-else class="carousel-item">
                                                <img style="width: 100px;height: 80px;" v-bind:src="v1" alt="v1">
                                            </div>
                                        </template>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        v-bind:data-bs-target="'#carouselExampleIndicators' + k" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        v-bind:data-bs-target="'#carouselExampleIndicators' + k" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>

                                </div>
                            </td>
                            <td class="text-center align-middle"><button class="btn btn-info" type="button"
                                    @click="info(v.mo_ta)">!</button>
                            </td>
                            <template>
                                <td class="text-center align-middle" v-if="v.size_active===0">@{{ formatCurrency(v.gia_ban) }}</td>
                                <td class="text-center align-middle" v-else>
                                    <span v-for="(value,key) in v.size_customs">Biến Thể : @{{ value.size }} | Giá
                                        :@{{ formatCurrency(value.gia_ban) }} <br></span>
                                </td>
                            </template>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-primary" @click="type=1,dataCapNhat=v">Cập
                                    Nhật</button>
                                <button type="button" class="btn btn-danger" @click="deleteSanPham(v.id)">Xóa
                                    Bỏ</button>
                            </td>
                        </tr>
                    </table>
                    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div id="chiTiet" class="dev1m-card mt-2"
                                        style="width: 100%;max-width: 500px;overflow: hidden;">

                                    </div>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-danger" @click="dong()">Đóng</button>
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
                listDanhMuc: [],
                listThuongHieu: [],
                listSanPham: [],
                dataCapNhat: {},
                size_active: 0,
                type: 0,
                bienTheSize: [{
                    kichCo: '',
                    giaBan: 0
                }],
            },
            created() {
                this.loadSP();
                this.load();
            },
            methods: {
                capNhat(){
                    axios
                        .put('/admin/san-pham/update', this.dataCapNhat)
                        .then((res) => {
                         if(res.data.status){
                            this.loadSP();
                            this.type = 0;
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
                deleteSanPham(id) {
                    if (confirm("Bạn Có Chắc Chắn Muốn Xóa Sản Phẩm Này?")) {
                        axios
                            .delete('/admin/san-pham/delete/' + id)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadSP();
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
                dong() {
                    $('#modalInfo').modal('hide');
                },
                info(data) {
                    document.getElementById('chiTiet').innerHTML = data;
                    $('#modalInfo').modal('show');
                },
                formatCurrency(value) {
                    return value.toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });
                },
                add() {
                    var data = {};
                    $.each($('#formdata').serializeArray(), function(_, kv) {
                        if (data.hasOwnProperty(kv.name)) {
                            data[kv.name] = $.makeArray(data[kv.name]);
                            data[kv.name].push(kv.value);
                        } else {
                            data[kv.name] = kv.value;
                        }
                    });
                    data.mo_ta = CKEDITOR.instances['mo_ta'].getData();
                    data.bienTheSize = this.bienTheSize;
                    data.size_active = this.size_active;
                    axios
                        .post('/admin/san-pham/create', data)
                        .then((res) => {
                            if (res.data.status) {
                                this.loadSP();
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
                themBienThe() {
                    this.bienTheSize.push({
                        kichCo: '',
                        giaBan: 0
                    });
                },
                themBienTheEdit() {
                    let kichCoMoi = {
                        id: this.dataCapNhat.size_customs[0].id + 213213,
                        size: '',
                        gia_ban: '',
                        id_san_pham: this.dataCapNhat.size_customs[0].id_san_pham,
                        created_at: new Date().toISOString()
                    };
                    this.dataCapNhat.size_customs.push(kichCoMoi);
                },
                loadSP() {
                    axios
                        .post('/admin/san-pham/data')
                        .then((res) => {
                            if (res.data.status) {
                                this.listSanPham = res.data.data;
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
                        keySearch: this.keySearch,
                    };
                    axios
                        .post('/admin/danh-muc/data')
                        .then((res) => {
                            if (res.data.status) {
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
                        .post('/admin/thuong-hieu/data')
                        .then((res) => {
                            if (res.data.status) {
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
            },
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta', {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',

        });
        CKEDITOR.replace('mo_ta');
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
