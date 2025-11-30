<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Ganitalay</title>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  


    <style>
        .dropdown-toggle::after {
            content: "\f107";
            font-family: "FontAwesome";
            vertical-align: unset;
            border: 0 !important;
            display: none !important;
        }

        /* ----- Proper Fixed Footer ----- */
        .footer-wrap {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            text-align: center;
            padding: 12px;
            font-weight: 600;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.08);
            z-index: 999;
        }

        /* Prevent content hiding behind footer */
        .content-wrapper {
            padding-bottom: 80px !important;
        }
    </style>

</head>
<body>

    <!-- Navbar -->
    @include('layouts.header')

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Content Wrapper -->
   <div class="main-container">

       <div class="pd-ltr-20">
            @yield('content')
       </div>

    </div>

    <!-- Footer -->
    <div class="footer-wrap">
        MAAP Epic Communications Pvt.Ltd @20222
    </div>

    <!-- JS Files -->
    <script src="{{asset('vendors/scripts/core.js')}}"></script>
    <script src="{{asset('vendors/scripts/script.min.js')}}"></script>
    <script src="{{asset('vendors/scripts/process.js')}}"></script>
    <script src="{{asset('vendors/scripts/layout-settings.js')}}"></script>
    <script src="{{asset('src/plugins/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendors/scripts/dashboard.js')}}"></script>
	<!-- buttons for Export datatable -->
	<script src="{{asset('src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('vendors/scripts/datatable-setting.js')}}"></script>

	<!-- buttons for Export datatable -->
	<script src="{{asset('src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('src/plugins/datatables/js/vfs_fonts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

  <script>
    $(document).ready(function() {
        // Initialize DataTable once
        var table = $('#example').DataTable({
            destroy: true // allows reinitialization if needed
        });

        // Text input filters
        $('#search_name').on('keyup', function() {
            table.column(1).search(this.value).draw(); // Name column (adjust index)
        });

        $('#search_email').on('keyup', function() {
            table.column(2).search(this.value).draw(); // Email column (adjust index)
        });

        // Dropdown filters
        $('#status').on('change', function() {
            table.column(3).search(this.value).draw(); // Status column (adjust index)
        });

        $('#senior_status').on('change', function() {
            table.column(4).search(this.value).draw(); // Senior Status column (adjust index)
        });

    });
</script>
@stack('scripts')
</body>
</html>
