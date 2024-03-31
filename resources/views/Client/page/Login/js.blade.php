		<!-- jquery latest version -->
		<script src="/Client_assets/js/vendor/jquery-3.6.0.min.js"></script>
		<script src="/Client_assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
		<!-- bootstrap js -->
		<script src="/Client_assets/js/bootstrap.bundle.min.js"></script>
		<!-- jquery.meanmenu js -->
		<script src="/Client_assets/js/jquery.meanmenu.js"></script>
		<!-- slick.min js -->
		<script src="/Client_assets/js/slick.min.js"></script>
		<!-- jquery.treeview js -->
		<script src="/Client_assets/js/jquery.treeview.js"></script>
		<!-- lightbox.min js -->
		<script src="/Client_assets/js/lightbox.min.js"></script>
		<!-- jquery-ui js -->
		<script src="/Client_assets/js/jquery-ui.min.js"></script>
		<!-- jquery.nivo.slider js -->
		<script src="/Client_assets/lib/js/jquery.nivo.slider.js"></script>
		<script src="/Client_assets/lib/home.js"></script>
		<!-- jquery.nicescroll.min js -->
		<script src="/Client_assets/js/jquery.nicescroll.min.js"></script>
		<!-- countdon.min js -->
		<script src="/Client_assets/js/countdon.min.js"></script>
		<!-- wow js -->
		<script src="/Client_assets/js/wow.min.js"></script>
		<!-- plugins js -->
		<script src="/Client_assets/js/plugins.js"></script>
		<!-- main js -->
		<script src="/Client_assets/js/main.min.js"></script>
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
