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
    <div id="app" class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">
                        Tạo Mail Thông Báo
                    </h5>
                </div>
                <form id="formdata" v-on:submit.prevent="guiMail()">
                    <div class="card-body">
                        <button v-show="type==0" @click="type=1" type="button" class="btn btn-danger">Gửi Theo Email Tùy
                            Chọn</button>
                        <div v-show="type==1" class="form-group mt-1">
                            <div class="tags-input form-control">
                                <ul>
                                    <li v-for="(v, k) in listTags">
                                        @{{ v.email }}
                                        <button class="delete-button" @click.prevent="removeTag(k)">X</button>
                                    </li>
                                </ul>
                                <input type="text" v-model="keySearch" placeholder="Nhập Email Hoặc Username Người Dùng"
                                    @input="load()" @click="showGoiY = true" />
                                <div v-show="showGoiY" class="tag-list mt-3">
                                    <div>
                                        <b>Các Email Có Thể Chọn</b>
                                        (<a href="#" @click="showGoiY=fasle" style="color:#a04747">Ẩn</a>)
                                    </div>
                                    <ul>
                                        <li v-for="(tag, index) in listEmail" @click="selectTag(tag)">
                                            @{{ tag.email }} [@{{ tag.username }}]</li>
                                    </ul>
                                </div>
                            </div>
                            <button @click="type=0" type="button" class="btn btn-danger">Gửi Tất Cả Người Dùng</button>
                        </div>
                        <div class="form-group mt-1">
                            <label>Tiêu Đề</label>
                            <input type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group mt-1">
                            <label>Nội Dung Email</label>
                            <input type="text" id="noi_dung">
                        </div>
                    </div>
                    <div class="card-footer text-end" style="background: none;">
                        <button type="submit" class="btn btn-primary">Gửi Mail</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">DANH SÁCH NHỮNG MAIL ĐÃ ĐƯỢC GỬI</div>
                <div class="card-body">
                    <template v-for="(v,k) in emailSend">
                        <span>@{{ v.email }}</span> <br>
                    </template>
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
                listEmail: [],
                showGoiY: false,
                selectedTags: [],
                listTags: [],
                keySearch: null,
                type: 0,
                emailSend: [],
                lastEmailSendHash: '',
                fetchInterval: null,
                unchangedCount: 0,
                shouldFetch: true,
            },
            created() {
                this.load();
                this.clearData();
            },
            mounted() {
                this.capNhatTrangThai();
            },
            methods: {
                selectTag(tag) {
                    if (tag !== '' && !this.listTags.includes(tag)) {
                        this.listTags.push(tag);
                    } else {
                        toastr.error("Từ Khóa Đã Tồn Tại");
                    }
                },
                removeTag(index) {
                    this.listTags.splice(index, 1);
                },
                capNhatTrangThai() {
                    if (!this.shouldFetch) return;
                    axios.get('/admin/thong-bao/status')
                        .then(res => {
                            const newDataHash = JSON.stringify(res.data.data);
                            if (this.lastEmailSendHash === newDataHash) {
                                this.unchangedCount++;
                                if (this.unchangedCount >= 5) {
                                    this.shouldFetch = false;
                                }
                            } else {
                                this.unchangedCount = 0;
                                this.lastEmailSendHash = newDataHash;
                                this.emailSend = res.data.data;
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
                clearData() {
                    axios
                        .post('/admin/thong-bao/clearData')
                        .then((res) => {})
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                guiMail() {
                    this.shouldFetch = true;
                    this.clearData();
                    var paramObj = {};
                    paramObj.noi_dung = CKEDITOR.instances['noi_dung'].getData();
                    paramObj.title = $("#title").val();
                    paramObj.type = this.type;
                    paramObj.listEmail = this.listTags;
                    axios
                        .post('/admin/thong-bao/send-mail', paramObj)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.fetchInterval = setInterval(() => {
                                    if (this.shouldFetch) {
                                        this.capNhatTrangThai();
                                    } else {
                                        clearInterval(this.fetchInterval);
                                    }
                                }, 1500);
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
                check(id) {
                    if (event.target.checked) {
                        if (!this.listSelected.includes(id)) {
                            this.listSelected.push(id);
                        }
                    } else {
                        this.listSelected = this.listSelected.filter(item => item !== id);
                    }

                },
                load() {
                    var data = {
                        "keySearch": this.keySearch,
                    };
                    axios
                        .post('/admin/thong-bao/data', data)
                        .then((res) => {
                            if (res.data.status) {
                                this.listEmail = res.data.data;
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
    </script>
@endsection
