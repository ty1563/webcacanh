<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đăng Nhập</title>
{{-- box icon  --}}
<link rel="stylesheet" href="/boxicon/css/boxicons.min.css">
<link rel="stylesheet" href="/Login_Client/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.2/axios.min.js"
    integrity="sha512-NCiXRSV460cHD9ClGDrTbTaw0muWUBf/zB/yLzJavRsPNUl9ODkUVmUHsZtKu17XknhsGlmyVoJxLg/ZQQEeGA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toast-css/1.1.0/grid.min.css"
    integrity="sha512-YOGZZn5CgXgAQSCsxTRmV67MmYIxppGYDz3hJWDZW4A/sSOweWFcynv324Y2lJvY5H5PL2xQJu4/e3YoRsnPeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .loader-fullscreen-wrapper {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 2147483647;
        background-color: #ebebeb;
    }

    .loader {
        position: relative;
        padding: 30px;
        width: 80px;
        height: 80px;
        margin: auto;
        border-radius: 100%;
        box-shadow: 4px 4px 12px 0px #BBB;
        background: #ebebeb;
    }

    .loader-fullscreen {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 80px;
        height: 80px;
        transform: translate(-50%, -50%);
        background: transparent;
    }


    .loader-fullscreen>.circle,
    .loader>.circle {
        position: absolute;
        width: 76px;
        height: 76px;
        opacity: 0;
        transform: rotate(225deg);
        animation-iteration-count: infinite;
        animation-name: orbit;
        animation-duration: 5.3s;
    }


    .loader-fullscreen>.circle:before,
    .loader>.circle:before {
        content: '';
        position: absolute;
        width: 8px;
        height: 8px;
        border-radius: 100%;
        background: #242323;
    }


    .loader-fullscreen>.circle:nth-child(2),
    .loader>.circle:nth-child(2) {
        animation-delay: 250ms;
    }

    .loader-fullscreen>.circle:nth-child(3),
    .loader>.circle:nth-child(3) {
        animation-delay: 500ms;
    }

    .loader-fullscreen>.circle:nth-child(4),
    .loader>.circle:nth-child(4) {
        animation-delay: 750ms;
    }

    .loader-fullscreen>.circle:nth-child(5),
    .loader>.circle:nth-child(5) {
        animation-delay: 1000ms;
    }


    /* animation */

    @keyframes orbit {
        0% {
            transform: rotate(225deg);
            opacity: 1;
            animation-timing-function: ease-out;
        }

        7% {
            transform: rotate(345deg);
            animation-timing-function: linear;
        }

        30% {
            transform: rotate(455deg);
            animation-timing-function: ease-in-out;
        }

        39% {
            transform: rotate(690deg);
            animation-timing-function: linear;
        }

        70% {
            transform: rotate(815deg);
            opacity: 1;
            animation-timing-function: ease-out;
        }

        75% {
            transform: rotate(945deg);
            opacity: 0;
        }
    }
</style>
