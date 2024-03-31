<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('Client.share.css')
    @yield("css")
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
        @include('Client.share.mobile-header')
        @include('Client.share.header')
        @include('Client.share.mobile-menu')
        @yield("noi_dung")
        @include("Client.share.footer")
    </div>
    @include('Client.share.js')
    @yield("js")
</body>

</html>
