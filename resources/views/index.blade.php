@extends('Layouts.user')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">Dashboard</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <!-- table card-1 start -->
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-blue order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Total Order Hari Ini</h6>
                                        <h2 class="text-start"><span>{{ $totalOrdersToday }}</span><i
                                                class="feather icon-shopping-cart float-end"></i></h2>
                                        <p class="m-b-0 text-end">Orderan Selesai
                                        </p>
                                </div>
                            </div>
                        </div>
                        <!-- table card-1 end -->
                        <!-- table card-2 start -->
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-green order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Total Pendapatan Hari Ini</h6>
                                    <h2 class="text-start"><span>Rp. {{ number_format($todaySales, 0, ',', '.') }}</span><i
                                            class="feather icon-shopping-cart float-end"></i></h2>
                                    <p class="m-b-0 text-end">Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <!-- table card-2 end -->
                        <!-- Widget primary-success card start -->
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-blue order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Total Rating</h6>
                                    <h2 class="text-start"><span>{{ $averageRating }}</span><i
                                            class="feather icon-star-on float-end"></i></h2>
                                    <p class="m-b-0 text-end">Pelanggan</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <div class="card prod-p-card bg-c-red">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-25">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Order Bulan Ini</h6>
                                            <h3 class="m-b-0 text-white">{{ $totalOrdersThisMonth }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span
                                            class="label label-danger m-r-10">+{{ $percentageIncrease }}%</span>Dari Bulan
                                        Lalu
                                        ({{ $totalLastMonthOrders }})</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card prod-p-card bg-c-yellow">
                                <div class="card-body">
                                    <div class="row align-items-center m-b-25">
                                        <div class="col">
                                            <h6 class="m-b-5 text-white">Total Member</h6>
                                            <h3 class="m-b-0 text-white">{{ $totalMembers }}</h3>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tags text-c-yellow f-18"></i>
                                        </div>
                                    </div>
                                    <p class="m-b-0 text-white"><span class="label  m-r-10"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Menu Terlaris</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>Nama Menu</th>
                                                    <th>Jumlah di pesan</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($topMenu as $data)
                                                    <tr>

                                                        <td>{{ $data->menu->title }}</td>
                                                        <td>{{ $data->order_count }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>

                                                    <th>Nama Menu</th>
                                                    <th>Jumlah di pesan</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>List Promo</h5>
                                </div>
                                <div class="card-body">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table-2" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>deskripsi</th>
                                                    <th>tanggal mulai</th>
                                                    <th>tanggal berakhir</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($promo as $data )
                                                <tr>
                                                    <td>{{ $data->title }}</td>
                                                    <td>{{ $data->description }}</td>
                                                    <td>{{ $data->start_date}}</td>
                                                    <td>{{ $data->end_date}}</td>

                                                </tr>

                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>deskripsi</th>
                                                    <th>tanggal mulai</th>
                                                    <th>tanggal berakhir</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
    </div>
@endsection
