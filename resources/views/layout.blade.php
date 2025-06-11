<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/"
    data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        @keyframes glow {

            0%,
            100% {
                background-color: #ea868f;
                box-shadow: 0 0 5px #ea868f;
            }

            50% {
                background-color: #f5b7b1;
                box-shadow: 0 0 20px #f1948a;
            }
        }

        .glow {
            animation: glow 1.5s ease-in-out infinite;
            transition: all 0.3s ease-in-out;
            color: white;
        }

        .stable-color {
            background-color: #ea868f !important;
            transition: all 0.3s ease-in-out;
        }

        .durum-aktif {
            font-weight: bold;
            color: #28a745;
            background-color: #d4edda;
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
        }

        .durum-link {
            color: #007bff;
            text-decoration: none;
            padding: 2px 4px;
            border-radius: 3px;
            transition: all 0.2s;
        }

        .durum-link:hover {
            background-color: #e9ecef;
            text-decoration: underline;
        }

        .durum-ayirici {
            color: #6c757d;
            margin: 0 5px;
        }

        .durum-guncellendi {
            background-color: #fff3cd !important;
            transition: all 0.5s ease;
        }

        /* Disabled link stili */
        .durum-link.disabled {
            cursor: not-allowed !important;
            text-decoration: none;
            color: gray !important;
            opacity: 0.6;
            pointer-events: none;
        }

        .pagination .page-item .page-link {
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .pagination .page-item .page-link:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>
@yield('css')
</head>


<body>



    <!-- Layout wrapper -->
    <div class="">
        <div class="">
            <!-- Menu -->
            {{-- @include('partials.leftmenu') --}}
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="">
                <!-- Navbar -->
                @include('partials.nav')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Head veya body içine eklenebilir -->


    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>







   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('js')
</body>

</html>
