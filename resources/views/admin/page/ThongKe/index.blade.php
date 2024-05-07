@extends('admin.share.master')
@section('noi_dung')
    @php
        use Carbon\Carbon;
        $doanh_thu_hom_nay = \App\Models\DonHang::whereDate('created_at', Carbon::today())->sum('total');
        $doanh_thu_hom_qua = \App\Models\DonHang::whereDate('created_at', Carbon::yesterday())->sum('total');
        if ($doanh_thu_hom_qua != 0) {
            $tang_truong_ngay = (($doanh_thu_hom_nay - $doanh_thu_hom_qua) / $doanh_thu_hom_qua) * 100;
        } else {
            $tang_truong_ngay = 100;
        }
        $doanh_thu_thang = \App\Models\DonHang::whereMonth('created_at', Carbon::now()->month)->sum('total');
        $doanh_thu_thang_truoc = \App\Models\DonHang::whereMonth('created_at', Carbon::now()->month - 1)->sum('total');
        if ($doanh_thu_thang_truoc != 0) {
            $tang_truong_thang = (($doanh_thu_thang - $doanh_thu_thang_truoc) / $doanh_thu_thang_truoc) * 100;
        } else {
            $tang_truong_thang = 100;
        }
        $don_hang_thang = \App\Models\DonHang::whereMonth('created_at', Carbon::now()->month)->count();
        $total_don_hang = \App\Models\DonHang::count();
        $total_doanh_thu = \App\Models\DonHang::sum('total');
        $don_hang_thang_truoc = \App\Models\DonHang::whereMonth('created_at', Carbon::now()->month - 1)->count();
        if ($don_hang_thang < $don_hang_thang_truoc) {
            $don_hang_tang_truong = 'Ít Hơn ' . abs($don_hang_thang - $don_hang_thang_truoc);
        } else {
            $don_hang_tang_truong = 'Nhiều Hơn ' . abs($don_hang_thang - $don_hang_thang_truoc);
        }
    @endphp
    <div class="page-content" id="app">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4">
            <div class="col">
                <div class="card radius-10 bg-gradient-cosmic">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-auto">
                                <p class="mb-0 text-white">Tổng Đơn Hàng</p>
                                <h4 class="my-1 text-white">{{ $total_don_hang }} Đơn Hàng</h4>
                                <p class="mb-0 font-13 text-white">Khoảng {{ number_format($total_doanh_thu, 0, ',', '.') }}
                                    đ</p>
                            </div>
                            <div id="chart1"><canvas width="81" height="35"
                                    style="display: inline-block; width: 81px; height: 35px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-auto">
                                <p class="mb-0 text-white">Doanh Thu Hôm Nay</p>
                                <h4 class="my-1 text-white">{{ number_format($doanh_thu_hom_nay, 0, ',', '.') }} đ</h4>
                                <p class="mb-0 font-13 text-white">
                                    {{ $tang_truong_ngay < 0 ? '-' : '+' }}{{ round(abs($tang_truong_ngay)) }}% So Với Hôm
                                    Qua</p>
                            </div>
                            <div id="chart2"><canvas width="80" height="40"
                                    style="display: inline-block; width: 80px; height: 40px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-auto">
                                <p class="mb-0 text-white">Đơn Hàng Trong Tháng</p>
                                <h4 class="my-1 text-white">{{ $don_hang_thang }} Đơn Hàng</h4>
                                <p class="mb-0 font-13 text-white">{{ $don_hang_tang_truong }} ĐH Với Tháng Trước</p>
                            </div>
                            <div id="chart3"><canvas width="75" height="40"
                                    style="display: inline-block; width: 75px; height: 40px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 bg-gradient-kyoto">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-auto">
                                <p class="mb-0 text-dark">Doanh Thu Tháng</p>
                                <h4 class="my-1 text-dark">{{ number_format($doanh_thu_thang, 0, ',', '.') }} đ</h4>
                                <p class="mb-0 font-13 text-dark">
                                    {{ $tang_truong_ngay < 0 ? '-' : '+' }}{{ round(abs($tang_truong_ngay)) }}% Với Tháng
                                    Trước</p>
                            </div>
                            <div id="chart4"><canvas width="100" height="25"
                                    style="display: inline-block; width: 100px; height: 25px; vertical-align: top;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="card radius-10">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h2>Biểu Đồ Doanh Thu Tháng</h2>
                    </div>
                    <div class="col">
                        Từ Ngày: <input class="form-control" @change="updateChart()" type="date" v-model="startDate">
                    </div>
                    <div class="col">
                        Đến Ngày: <input class="form-control" @change="updateChart()" type="date" v-model="endDate">
                    </div>
                </div>
                <canvas id="ChartDoanhThu"  height="100"></canvas>
            </div>
        </div>
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h2 class="mb-0">Đơn Hàng Gần Đây</h2>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">User</th>
                                <th class="text-center">Hash</th>
                                <th class="text-center">Thanh Toán</th>
                                <th class="text-center">Tổng Tiền</th>
                                <th class="text-center">Ngày Đặt</th>
                                <th class="text-center">Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v,k) in listDonHang">
                                <td class="text-center">@{{ v.khach_hangs.username }}</td>
                                <td class="text-center">#@{{ v.hash }}</td>
                                <td class="text-center">
                                    <span v-if="v.thanh_toan==1"
                                        class="badge bg-gradient-quepal text-white shadow-sm w-100">Thanh toán online</span>
                                    <span v-else class="badge bg-gradient-bloody text-white shadow-sm w-100">Thanh toán nhận
                                        hàng</span>
                                </td>
                                <td class="text-center">@{{ formatVND(v.total) }}</td>
                                <td class="text-center">@{{ v.thoi_gian_dat_hang }}</td>
                                <td class="text-center">
                                    <span v-if="v.giao_hang==2"
                                        class="badge bg-gradient-quepal text-white shadow-sm w-100">Đã Giao Hàng</span>
                                    <span v-if="v.giao_hang==0"
                                        class="badge bg-gradient-bloody text-white shadow-sm w-100">Đang Lấy Hàng</span>
                                    <span v-if="v.giao_hang==1"
                                        class="badge bg-gradient-blooker text-white shadow-sm w-100">Đang Giao Hàng</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
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
                listDonHang: [],
                startDate: null,
                endDate: null,
                ChartDoanhThu: null,
            },
            created() {
                this.loadChart();
                this.load();
            },
            methods: {
                updateChart() {
                    if (typeof this.ChartDoanhThu !== 'undefined') {
                        this.ChartDoanhThu.destroy();
                    }
                    this.loadChart();
                },
                loadChart() {
                    var data = {
                        from: this.startDate,
                        to: this.endDate,
                    };
                    axios
                        .post('/admin/thong-ke/data-chart', data)
                        .then((res) => {
                            if (res.data.status) {
                                var scaledOrders = res.data.orders.map(function(order) {
                                    return order * 100000;
                                });
                                var ctx = document.getElementById('ChartDoanhThu').getContext('2d');
                                this.ChartDoanhThu = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: res.data.labels,
                                        datasets: [{
                                                label: 'Doanh thu',
                                                data: res.data.revenues,
                                                borderColor: 'rgb(75, 192, 192)',
                                                borderWidth: 1,
                                                fill: true
                                            },
                                            {
                                                label: 'Đơn hàng (Scale X 100.000 lần)',
                                                data: scaledOrders,
                                                borderColor: 'rgb(192, 75, 75)',
                                                borderWidth: 1,
                                                fill: false
                                            }
                                        ]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                id: 'revenue-axis',
                                                type: 'linear',
                                                position: 'left',
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }, ]
                                        }
                                    }

                                });
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
                        .post('/admin/thong-ke/data-don-hang')
                        .then((res) => {
                            if (res.data.status) {
                                this.listDonHang = res.data.data;
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
                formatVND(amount) {
                    return new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(amount);
                },
            },
        });
    </script>
@endsection
