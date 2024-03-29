<script src="/Admin_assets/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/Admin_assets/assets/js/jquery.min.js"></script>
<script src="/Admin_assets/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="/Admin_assets/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="/Admin_assets/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="/Admin_assets/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="/Admin_assets/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/Admin_assets/assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="/Admin_assets/assets/plugins/chartjs/js/Chart.extension.js"></script>
<script src="/Admin_assets/assets/js/index.js"></script>
<!--app JS-->
<script src="/Admin_assets/assets/js/app.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.querySelector('div.loader-fullscreen-wrapper').style.display = 'none';
        }, 500); // 1.5 giây
    });
</script>
