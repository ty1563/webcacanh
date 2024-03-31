@extends('admin.share.master')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-sm-4">
            <form id="formdata" v-on:submit.prevent="add()">
                <div class="card">
                    <div class="card-header">
                        <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">
                            Thêm Mới Voucher Giảm Giá
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mt-1">
                            <label class="form-label">Mã Code</label>
                            <input name="code" type="text" class="form-control" placeholder="Vd : HappyNewYear">
                        </div>
                        <div class="mt-1">
                            <label class="form-label">Mô Tả</label>
                            <textarea class="form-control" name="mo_ta" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mt-1">
                            <label class="form-label">Giảm Giá</label>
                            <input name="giam_gia" placeholder="Giá giảm là Vnđ" type="text" class="form-control">
                        </div>
                        <div class="mt-1">
                            <label class="form-label">Tối Đa Người Dùng</label>
                            <input name="max_uses" type="text" class="form-control"
                                placeholder="GIới hạn người dùng (Mặt Định 1000)">
                        </div>
                        <div class="form-group">
                            <label for="het_han">Ngày Hết Hạn</label>
                            <input type="date" id="het_han" name="het_han" class="form-control" required>
                        </div>

                        <div class="mt-1">
                            <label class="form-label">Trạng Thái</label>
                            <select name="status" class="form-control">
                                <option value="1">Kích Hoạt</option>
                                <option value="0">Không Kích Hoạt</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-success" type="submit">Thêm Mới Voucher</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)">
                                Danh Sách Voucher
                            </h5>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-floating">
                                <input @input="load()" type="text" class="form-control" id="floatingInput"
                                    v-model="keySearch">
                                <label for="floatingInput">Lọc Theo Từ Khóa</label>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Code</th>
                            <th class="text-center align-middle">Mô Tả</th>
                            <th class="text-center align-middle">Giảm Giá</th>
                            <th class="text-center align-middle">Đã Dùng</th>
                            <th class="text-center align-middle">Hết Hạn</th>
                            <th class="text-center align-middle">Trạng Thái</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                        <tr v-for="(v,k) in listVoucher">
                            <th class="text-center align-middle">@{{ k + 1 }}</th>
                            <td class="text-center align-middle">@{{ v.code }}</td>
                            <td class="text-center align-middle">
                                <textarea cols="30" rows="3">@{{ v.mo_ta }}</textarea>
                            </td>
                            <td class="text-center align-middle">@{{ formatPrice(v.giam_gia) }}</td>
                            <td class="text-center align-middle">@{{ v.used }} / @{{ v.max_uses }}</td>
                            <td class="text-center align-middle">@{{ v.het_han }}</td>
                            <td class="text-center align-middle">@{{ v.status == 1 ? "Hoạt Động" : "Đã Dừng" }}</td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-primary" @click="openModal(),dataCapNhat=v">
                                    Cập Nhật
                                </button>
                                <button type="button" class="btn btn-danger" @click="deleteVoucher(v.id)">Xóa Bỏ</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="modalCapNhat">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="text-shadow: 1px 1px 1px rgb(65, 167, 37)" class="modal-title">Cập Nhật
                                    Voucher</span></h5>
                            </div>
                            <div class="modal-body">
                                <div class="mt-1">
                                    <label class="form-label">Mã Code</label>
                                    <input v-model="dataCapNhat.code" type="text" class="form-control"
                                        placeholder="Vd : HappyNewYear">
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Mô Tả</label>
                                    <textarea class="form-control" v-model="dataCapNhat.mo_ta" cols="30" rows="3"></textarea>
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Giảm Giá</label>
                                    <input v-model="dataCapNhat.giam_gia" placeholder="Giá giảm là Vnđ" type="text"
                                        class="form-control">
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Tối Đa Người Dùng</label>
                                    <input v-model="dataCapNhat.max_uses" type="text" class="form-control"
                                        placeholder="GIới hạn người dùng (Mặt Định 1000)">
                                </div>
                                <div class="form-group">
                                    <label for="het_han_edit">Ngày Hết Hạn</label>
                                    <input type="date" id="het_han_edit" v-model="formattedHetHan"
                                        class="form-control" required>
                                </div>
                                <div class="mt-1">
                                    <label class="form-label">Trạng Thái</label>
                                    <select v-model="dataCapNhat.status" class="form-control">
                                        <option value="1">Kích Hoạt</option>
                                        <option value="0">Không Kích Hoạt</option>
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
                listVoucher: [],
                dataCapNhat: {},
                keySearch: null,
            },
            created() {
                this.load();
            },
            computed: {
                formattedHetHan: {
                    // Getter chuyển đổi từ 'DD/MM/YYYY' sang 'YYYY-MM-DD'
                    get() {
                        if (this.dataCapNhat.het_han) {
                            const [day, month, year] = this.dataCapNhat.het_han.split('/');
                            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
                        }
                        return '';
                    },
                    // Setter chuyển đổi từ 'YYYY-MM-DD' sang 'DD/MM/YYYY'
                    set(newValue) {
                        const [year, month, day] = newValue.split('-');
                        this.dataCapNhat.het_han = `${day}/${month}/${year}`;
                    }
                }
            },
            methods: {
                formatPrice(price) {
                    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
                deleteVoucher(id) {
                    if (confirm(
                            "Xóa Chuyên Mục Sẽ Ảnh Hưởng Rất Nhiều Đến Những Danh Mục Và Sản Phẩm Liên Quan , Bạn Có Chắc Chắn Muốn Xóa?"
                        )) {
                        axios
                            .delete('/admin/voucher/delete/' + id)
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
                        .put('/admin/voucher/update', this.dataCapNhat)
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
                        .post('/admin/voucher/create', paramObj)
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
                        'keySearch': this.keySearch,
                    };
                    axios
                        .post('/admin/voucher/data', data)
                        .then((res) => {
                            if (res.data.status) {
                                this.listVoucher = res.data.data;
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
