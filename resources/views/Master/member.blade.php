@extends('Layouts.user')
@section('content')
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
                                        <li class="breadcrumb-item"><a href="#!">Master-Member</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-red order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Jumlah Member</h6>
                                    <h2 class="text-start"><span>{{ $memberCount }}</span><i
                                            class="feather icon-user float-end"></i></h2>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-green order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Point Terbanyak (Member)</h6>
                                    <h2 class="text-start"><span>{{ $memberWithMostPoints->firstname }} {{ $memberWithMostPoints->lastname }}</span><i
                                            class="feather icon-award float-end"></i></h2>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card bg-c-blue order-card">
                                <div class="card-body">
                                    <h6 class="m-b-20">Jumlah Order Terbanyak (Member)</h6>
                                    <h2 class="text-start"><span>{{ $memberWithMostOrders->firstname }} {{ $memberWithMostOrders->lastname }} ({{ $countOrder }})</span><i
                                            class="feather icon-shopping-cart float-end"></i></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>List Member</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Point</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($member as $data)
                                                <tr>
                                                    <td>{{ $data->firstname }}</td>
                                                    <td>{{ $data->lastname }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->phone }}</td>
                                                    <td>{{ number_format($data->point, 0, '.', '') }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Point</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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
