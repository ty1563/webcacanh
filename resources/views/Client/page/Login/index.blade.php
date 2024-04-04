<!DOCTYPE html>
<html lang="en">

<head>
@include('Client.page.Login.css')
</head>
<body>
    <div class="loader-fullscreen-wrapper">
        <div class="loader-fullscreen">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
    </div>
    <div class="login" id="app">
        <img src="/logo.svg" alt="">
        <h3><span>@{{ status }}</span></h3>
        <h2>Thế Giới Cá Cảnh</h2>
        <form v-show="check==0" class="login-form" id="formdata" v-on:submit.prevent="login()">
            <input type="username" v-model="username" placeholder="Nhập UserName/Email Của Bạn">
            <input type="password" v-model="password" placeholder="Nhập Mật Khẩu Của Bạn">
            {{-- <button type="submit">Đăng Nhập</button> --}}
            <button type="submit" :disabled="loading">
                <template v-if="loading">
                    Đang xử lý...
                </template>
                <template v-else>
                    Đăng Nhập
                </template>
            </button>
            <span>Chưa Có Tài Khoản ? <a v-on:click="check=1;status='Đăng Ký'" href="#">Đăng Ký Ngay</a></span>
        </form>
        <form v-show="check==1" class="login-form" id="formdata1" v-on:submit.prevent="sign()">
            <input type="email" v-model="email" placeholder="Nhập Email Của Bạn">
            <input type="username" v-model="username" placeholder="Nhập Username Của Bạn">
            <input type="password" v-model="password" placeholder="Nhập Mật Khẩu Của Bạn">
            {{-- <button type="submit">Đăng Ký</button> --}}
            <button type="submit" :disabled="loading">
                <template v-if="loading">
                    Đang xử lý...
                </template>
                <template v-else>
                    Đăng Ký
                </template>
            </button>
            <span>Bạn Đã Có Tài Khoản ? <a v-on:click="check=0;status='Đăng Nhập'" href="#">Đăng Nhập
                    Ngay</a></span>
        </form>
        <br>
        <span><a href="/recover">Quên Mật Khẩu?</a></span>
    </div>
    @include('Client.page.Login.js')
    <script>
        new Vue({
            el: '#app',
            data: {
                username: null,
                password: null,
                email: null,
                check: 0,
                status: 'Đăng Nhập',
                loading: false,
            },
            created() {

            },
            methods: {
                login() {
                    this.loading = true;
                    $data = {
                            'username': this.username,
                            'password': this.password,
                            'email': this.username,
                        },

                        axios
                        .post('/login-khach-check', $data)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                window.location.href = "/";
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                    setTimeout(() => {
                        this.loading = false;
                    }, 2000);
                },
                sign() {
                    this.loading = true;
                    $data = {
                            'username': this.username,
                            'password': this.password,
                            'email': this.email,
                        },
                        axios
                        .post('/sign-khach-check', $data)
                        .then((res) => {
                            if (res.data.status) {
                                window.location.href = "/";
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
                    setTimeout(() => {
                        this.loading = false;
                    }, 2000);
                }
            },
        });
    </script>
</body>

</html>
