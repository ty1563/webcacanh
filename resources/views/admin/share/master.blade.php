<!doctype html>
<html lang="en">

<head>
    @include('admin.share.css')
    @yield('css')
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
    <div class="wrapper">
        <div class="header-wrapper">
            @include('admin.share.header')
            @include('admin.share.menu')
        </div>
        <div class="page-wrapper">
            <div class="page-content">
                @yield('noi_dung')
            </div>
        </div>
    </div>
    @include('admin.share.theme')
    @include('admin.share.js')
    @yield('js')

</body>

</html>
