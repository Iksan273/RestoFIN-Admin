<!DOCTYPE html>
<html lang="en">

<head>

    <title>Dasho - Bootstrap 5 Admin Template</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Dasho Bootstrap admin template made using Bootstrap 5 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="admin templates, bootstrap admin templates, bootstrap 5, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Dasho, Dasho bootstrap admin template">
    <meta name="author" content="Phoenixcoded" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css') }}">
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/data-tables/css/datatables.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Rating css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/ratting/css/bars-1to10.css') }}">

</head>

<body class="">


    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 ">
        <div class="navbar-wrapper ">
            <div class="navbar-brand header-logo">
                <a href="index.html" class="b-brand">

                    <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="logo images">
                    <img src="{{ asset('assets/images/logo-icon.svg') }}" alt="logo" class="logo-thumb images">
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div   " id="layout-sidenav">
                <ul class="nav pcoded-inner-navbar sidenav-inner">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-home"></i></span><span class="pcoded-mtext">Master</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{ route('master.dashboard') }}" class="">Omset</a></li>
                            <li class=""><a href="{{ route('master.member') }}" class="">Member</a></li>
                            <li class=""><a href="{{ route('master.employee') }}" class="">Employee</a>
                            </li>
                            <li class=""><a href="{{ route('add.employee') }}" class="">Tambah Employee</a>
                            </li>
                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="fas fa-clipboard-list"></i></span><span
                                class="pcoded-mtext">Pesanan</span></a>
                        <ul class="pcoded-submenu">


                            <li class=""><a href="{{ route('employee.daftarPesanan') }}" class="">List
                                    Pesanan</a></li>
                            <li class=""><a href="{{ route('employee.daftarPesananPending') }}"
                                    class="">List Pesanan Pending</a></li>
                            <li class=""><a href="{{ route('employee.daftarPesananSelesai') }}"
                                    class="">List Pesanan Selesai </a></li>
                            <li class=""><a href="{{ route('employee.Addorder') }}"
                                    class="">Add Order </a></li>



                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="fas fa-file-invoice-dollar"></i></span><span
                                class="pcoded-mtext">Transaksi</span></a>
                        <ul class="pcoded-submenu">


                            <li class=""><a href="{{ route('employee.daftarTransaksi') }}" class="">Daftar
                                    Transaksi</a>

                            </li>
                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="fas fa-layer-group"></i></span><span
                                class="pcoded-mtext">Kategori</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{ route('employee.kategori') }}" class="">List
                                    Kategori</a>
                            </li>
                            <li class=""><a href="{{ route('employee.addKategori') }}" class="">Tambah
                                    Kategori</a>
                            </li>
                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="fas fa-book"></i></span><span class="pcoded-mtext">Menu</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{ route('employee.menu') }}" class="">List
                                    Menu</a>
                            </li>
                            <li class=""><a href="{{ route('employee.addMenu') }}" class="">Add
                                    Menu</a>
                            </li>
                            <li class=""><a href="{{ route('employee.rekomendasi') }}" class="">List
                                    Rekomendasi
                                    Menu</a></li>
                            <li class=""><a href="{{ route('employee.addRekomendasi') }}" class="">Add
                                    Rekomendasi
                                    Menu</a></li>
                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="fas fa-bullhorn"></i></span><span class="pcoded-mtext">Promo</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{ route('employee.promo') }}" class="">List
                                    Promo</a>
                            </li>
                            <li class=""><a href="{{ route('employee.addPromo') }}" class="">Add
                                    Promo</a>
                            </li>
                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="fas fa-calendar-alt"></i></span><span
                                class="pcoded-mtext">Reservasi</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{ route('employee.reservasi') }}" class="">List
                                    Reservasi</a></li>
                            <li class=""><a href="{{ route('employee.addReservasi') }}" class="">Add
                                    Reservasi</a></li>

                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="fas fa-shopping-cart"></i></span><span class="pcoded-mtext">Pembelian
                                Online</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{ route('employee.struk') }}" class="">List
                                    Pembelian</a></li>
                            <li class=""><a href="{{ route('employee.addStruk') }}" class="">Add</a>
                            </li>

                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                    class="fas fa-coins"></i></span><span class="pcoded-mtext">Member
                                Point</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{ route('employee.pointAddAdmin') }}"
                                    class="">Penambahan Point by admin</a></li>
                            <li class=""><a href="{{ route('employee.pointMinusAdmin') }}"
                                    class="">Mengurangi Point by admin</a></li>

                            <li class=""><a href="{{ route('employee.pointMinus') }}"
                                    class="">Mengurangi Point dengan promo</a></li>

                        </ul>
                    </li>
                    <li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image"
                        class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-link">
                            <span class="pcoded-micon"><i class="fas fa-sign-out-alt"></i></span>
                            <span class="pcoded-mtext">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>


                </ul>
                </li>


                </ul>



            </div>

        </div>
    </nav>
    <!-- [ navigation menu ] end -->



    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <a href="index.html" class="b-brand">

                <img src="assets/images/logo.svg" alt="" class="logo images">
                <img src="assets/images/logo-icon.svg" alt="" class="logo-thumb images">
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <a href="#!" class="mob-toggler"></a>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <div class="main-search open">
                        <div class="input-group">
                            <input type="text" id="m-search" class="form-control" placeholder="Search . . .">
                            <a href="#!" class="input-group-append search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </a>
                            <span class="ms-1 input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
            </ul>

        </div>

    </header>


    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            @yield('content')

        </div>
    </div>


    <!-- Required Js -->
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>

    <!-- notification Js -->
    <script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>
    <script src="{{ asset('assets/js/pages/ac-notification.js') }}"></script>

    @yield('script')

    <!-- am chart js -->
    <script src="{{ asset('assets/plugins/chart-am4/js/core.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/charts.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/animated.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/maps.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/worldLow.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/continentsLow.js') }}"></script>

    <!-- dashboard-custom js -->
    <script src="{{ asset('assets/js/pages/dashboard-sale.js') }}"></script>

    <!-- datatable Js -->
    <script src="{{ asset('assets/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/data-basic-custom.js') }}"></script>

    <!-- am chart js -->
    <script src="{{ asset('assets/plugins/chart-am4/js/core.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/charts.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/animated.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/maps.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/worldLow.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-am4/js/continentsLow.js') }}"></script>

    <!-- chartjs js -->
    <script src="{{ asset('assets/plugins/chart-chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/chart-chart-custom.js') }}"></script>

    <!-- Float Chart js -->
    <script src="{{ asset('assets/plugins/flot/js/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot/js/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot/js/curvedLines.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot/js/jquery.flot.tooltip.min.js') }}"></script>

    <!-- peity chart js -->
    <script src="{{ asset('assets/plugins/chart-peity/js/jquery.peity.min.js') }}"></script>

    <!-- Rating Js -->
    <script src="{{ asset('assets/plugins/ratting/js/jquery.barrating.min.js') }}"></script>

    <!-- custom-chart js -->
    <script src="{{ asset('assets/js/pages/chart.js') }}"></script>

    <!-- google chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('assets/js/pages/chart-google-custom.js') }}"></script>





</body>

</html>
