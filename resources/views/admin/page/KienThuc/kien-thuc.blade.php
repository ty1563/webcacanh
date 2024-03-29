@extends('admin.share.master')
@section('css')
    <style>
        .tags-input {
            display: inline-block;
            position: relative;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 5px;
            width: 100%;
        }

        .tags-input ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .tags-input li {
            display: inline-block;
            background-color: #f2f2f2;
            color: #333333;
            border-radius: 20px;
            padding: 5px 10px;
            margin-right: 5px;
            margin-bottom: 5px;

        }

        .tags-input input[type="text"] {
            border: none;
            outline: none;
            padding: 5px;
            font-size: 14px;
            width: 100%;
        }

        .tags-input input[type="text"]:focus {
            outline: none;
        }

        .tags-input .delete-button {
            background-color: transparent;
            border: none;
            color: rgb(52, 50, 50);
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
@endsection
@section('noi_dung')
    <div class="row" id="app">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <form v-on:submit.prevent="add()" id="form_data">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">Thêm Bài Viết</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input id="floatingInputGrid" name="title" class="form-control" type="text">
                                        <label>Tiêu Đề</label>
                                    </div>
                                    <div class="form-floating mt-1">
                                        <select id="floatingTextarea" name="tinh_trang" class="form-control">
                                            <option value="1">Hiển Thị</option>
                                            <option value="0">Tạm Tắt</option>
                                        </select>
                                        <label>Tình Trạng</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-floating">
                                        <textarea id="floatingInputGrid" name="mo_ta" class="form-control" cols="30" rows="3"
                                            style="height: 120px;"></textarea>
                                        <label for="floatingInputGrid">Mô Tả</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 mt-1">
                                        <div class="tags-input form-control">
                                            <ul>
                                                <li v-for="(v, k) in listTags">
                                                    @{{ v }}
                                                    <button class="delete-button" @click.prevent="removeTag(k)">X</button>
                                                </li>
                                            </ul>
                                            <input type="text" v-model="newTag" @keydown.enter.prevent="addTag()"
                                                placeholder="Nhập Vào Các Tag Liên Quan" @click="showGoiY = true" />
                                            <div v-if="showGoiY" class="tag-list mt-3">
                                                <div>
                                                    <b>Các Tag Gợi Ý Có Thể Chọn</b>
                                                    (<a href="#" @click="showGoiY=fasle" style="color:#a04747">Ẩn Gợi
                                                        Ý</a>)
                                                </div>
                                                <ul>
                                                    <li v-for="(tag, index) in listGoiY" @click="selectTag(tag)">
                                                        @{{ tag }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-1">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" @click="openModal()">Chọn Sản
                                                Phẩm Liên Quan</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hình Ảnh</label>
                                            <div class="input-group">
                                                <input id="hinh_anh" class="form-control" type="text" name="filepath"
                                                    placeholder="Tải Lên Hình Ảnh">
                                                <span class="input-group-prepend">
                                                    <a id="lfm" data-input="hinh_anh" data-preview="holder"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nội Dung</label>
                                <input name="noi_dung" id="noi_dung" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Thêm Bài Viết</button>
                        </div>
                    </div>

                </form>
                <div class="modal fade" id="chuyenMucModal" tabindex="-1" aria-labelledby="permissionModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="permissionModalLabel">Chọn Các Sản Phẩm Liên Quan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <template v-for="(v,k) in listSanPham">
                                <template>
                                    <label>
                                        <input type="checkbox" :name="v.id" @change="check(v.id)">
                                        @{{ v.ten_san_pham }}
                                    </label>
                                    <br>
                                </template>
                            </template>
                            <input value="-1" type="checkbox"> Khác
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" data-bs-dismiss="modal" @click="saveSelected()"
                                class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <h5 class="mt-4" style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">Danh Sách Bài Viết</h5>
        <div class="col-md-12">
            <div class="card">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Tiêu Đề</th>
                            <th class="text-center align-middle">Hình Ảnh</th>
                            <th class="text-center align-middle">SP Liên Quan</th>
                            <th class="text-center align-middle">Tag</th>
                            <th class="text-center align-middle">Mô Tả</th>
                            <th class="text-center align-middle">Nội Dung</th>
                            <th class="text-center align-middle">Tình Trạng</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                        <tr v-for="(v,k) in listKienThuc">
                            <th class="text-center align-middle">@{{ k + 1 }}</th>
                            <td class="text-center align-middle">@{{ v.title }}</td>
                            <td class="text-center align-middle"><img :src="v.hinh_anh" alt="" height="100" width="120"></td>
                            <td class="text-center align-middle">
                                <template v-for="(v1,k1) in v.list_san_pham">
                                        <span>@{{v1}}</span><br>
                                </template>
                            </td>
                            <td class="text-center align-middle">@{{ decJson(v.list_tag) }}</td>
                            <td class="text-center align-middle"><button class="btn btn-info"
                                @click="checklink(v.mo_ta)">!</button></td>
                            <td class="text-center align-middle"><button class="btn btn-info"
                                    @click="checklink(v.noi_dung)">!</button></td>
                            <td class="text-center align-middle">@{{ v.tinh_trang == 0 ? "Tạm Tắt" : "Đang Mở" }}</td>
                            <td class="text-center align-middle">
                                <button @click="xoa(v.id)" class="btn btn-danger">Xóa Bỏ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="modalCheck" tabindex="-1" role="dialog"
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
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                listSanPham: [],
                listKienThuc: [],
                listNews: [],
                dataCapNhat: {},
                listSelected: [],
                listGoiY: [
                    "Thủy sinh",
                    "Cá cảnh",
                    "Cây nước",
                    "Hồ cá",
                    "Setup hồ thủy sinh",
                    "Bảo dưỡng thủy sinh",
                    "Cá Betta",
                    "Cá Koi",
                    "Sinh vật lọc nước",
                    "Đèn thủy sinh",
                    "CO2 cho thủy sinh",
                    "Kiểm soát pH",
                    "Nhiệt độ nước",
                    "Nitrat trong hồ cá",
                    "Chăm sóc cá nước ngọt",
                    "Chăm sóc cá nước mặn",
                    "Hệ thống lọc nước",
                    "Quy trình chuẩn bị nước mới",
                    "Sinh vật đáy",
                    "Kiểu dáng hồ cá"
                ],
                selectedTags: [],
                listTags: [],
                newTag: '',
                showGoiY: false,
            },
            created() {
                this.load();
                this.loadKienThuc();
            },
            methods: {
                decJson(data){
                    return JSON.parse(data);
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
                    paramObj['noi_dung'] = CKEDITOR.instances['noi_dung'].getData();
                    paramObj['list_san_pham'] = this.listSelected;
                    paramObj['list_tag'] = this.listTags;
                    axios
                        .post('/admin/kien-thuc/create', paramObj)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadKienThuc();
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
                        .post('/admin/san-pham/data')
                        .then((res) => {
                            if (res.data.status) {
                                this.listSanPham = res.data.data;
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadKienThuc(){
                    axios
                        .post('/admin/kien-thuc/data')
                        .then((res) => {
                            if (res.data.status) {
                                this.listKienThuc = res.data.data;
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
                            .delete('/admin/kien-thuc/delete/'+ id)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadKienThuc();
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
                selectTag(tag) {
                    if (tag !== '' && !this.listTags.includes(tag)) {
                        this.listTags.push(tag);
                    } else {
                        toastr.error("Từ Khóa Đã Tồn Tại");
                    }
                },
                addTag() {
                    const trimmedTag = this.newTag.trim();
                    if (trimmedTag !== '' && !this.listTags.includes(trimmedTag)) {
                        this.listTags.push(trimmedTag);
                        this.newTag = '';
                    } else {
                        toastr.error("Từ Khóa Đã Tồn Tại Hoặc Trống");
                    }
                },
                removeTag(index) {
                    this.listTags.splice(index, 1);
                },

                saveSelected() {
                    console.log(this.listSelected);
                },
                check(id) {
                    if (event.target.checked) {
                        if (!this.listSelected.includes(id)) {
                            this.listSelected.push(id);
                        }
                    } else {
                        this.listSelected = this.listSelected.filter(item => item !== id);
                    }

                },
                openModal() {
                    $('#chuyenMucModal').modal('show');
                },
                dong() {
                    $('#modalCheck').modal('hide');
                },
                checklink(noi_dung) {
                    document.getElementById('chiTiet').innerHTML = noi_dung;
                    $('#modalCheck').modal('show');
                },
            },
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('noi_dung', {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',

        });
        CKEDITOR.replace('noi_dung');
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
