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
                                        <h5 class="m-b-10">Employee</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#!">Employee-Daftar Transaksi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Daftar Transaksi</h5>
                                    <button class="btn btn-gradient-success" onclick="location.href='{{ route('exportExcel') }}'">Download Excel</button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>No Order</th>
                                                    <th>Metode Pembayaran</th>
                                                    <th>Total Pembayaran</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Transaksi</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transactions as  $data)


                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->order->order_number }}</td>
                                                    <td>{{ $data->payment_method }}</td>
                                                    <td>Rp{{ number_format($data->total_amount, 0, ',', '.') }}</td>
                                                    <td>{{ $data->status }}</td>
                                                    <td>{{ $data->order_date }}</td>
                                                    <td>
                                                        <button class="btn btn-gradient-info" data-bs-toggle="modal" data-bs-target="#printModal">Cetak Nota</button>
                                                    </td>
                                                </tr>
                                                <!-- Data lainnya -->
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>No Order</th>
                                                    <th>Metode Pembayaran</th>
                                                    <th>Total Pembayaran</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Transaksi</th>
                                                    <th>Action</th>
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

    <!-- Modal for Print Preview -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">Preview Cetak Nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content for print preview can be dynamically loaded here -->
                    <p>Isi dari nota yang akan dicetak akan ditampilkan di sini.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="window.print();">Cetak</button>
                </div>
            </div>
        </div>
    </div>
@endsection
