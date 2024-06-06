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
                                        <h5 class="m-b-10">Employee</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#!">Employee-Daftar Pesanan</a></li>

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
                                    <h5>List Pesanan Selesai</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>No Meja</th>
                                                    <th>No Pesanan</th>
                                                    <th>Detail Pesanan</th>
                                                    <th>Waktu Pesanan</th>
                                                    <th>Total Pembayaran</th>
                                                    <th>Metode Pembayaran</th>
                                                    <th>Status Pembayaran</th>
                                                    <th>Status Makanan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->user ? $data->user->firstname . ' ' . $data->user->lastname : $data->guest . '(Guest)' }}
                                                    <td>{{ $data->no_meja }}</td>
                                                    <td>{{ $data->order_number }}</td>
                                                    <td> <button class="btn btn-gradient-info text-center" data-bs-toggle="modal"
                                                            data-bs-target="#viewDetailOrderModal{{ $data->id }}"><i></i>View</button></td>
                                                    <td>{{ $data->order_date }}</td>
                                                    <td>Rp{{ number_format($data->total_price, 0, ',', '.') }}</td>
                                                    <td>{{ $data->payment_method }}</td>
                                                    <td>{{ $data->status_pembayaran }}</td>
                                                    <td>{{ $data->status_makanan }}</td>
                                                </tr>
                                                <div class="modal fade" id="viewDetailOrderModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="viewDetailOrderLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewDetailOrderLabel">Detail Pesanan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="order-details">
                                                                    <p><strong>Nomor Pesanan:{{ $data->order_number }}</strong> <span id="orderNumber"></span></p>
                                                                    <p><strong>Nomor Meja:{{ $data->no_meja }}</strong> <span id="tableNumber"></span></p>
                                                                    <ul>
                                                                        @foreach ($data->orderItems as $item)
                                                                            <li><strong>Nama Menu:</strong> {{ $item->menu->title }} - <strong>Jumlah:</strong> {{ $item->jumlah }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="button" class="btn btn-primary" onclick="printOrderDetails()">Cetak PDF</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="modal fade md-effect-1" id="updateModalMakanan" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">
                                                                    Update Status Makanan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Kamu yakin ingin Mengubah Status Makanan Menjadi Selesai
                                                                    ? <strong id="username"></strong>?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    id="confirm-delete">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade md-effect-1" id="updateModalPembayaran"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">
                                                                    Update Status Pembayaran</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Kamu yakin ingin Mengubah Status Pembayaranb Menjadi
                                                                    Sukses ? <strong id="username"></strong>?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    id="confirm-delete">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade md-effect-1" id="deleteModalPembayaran"
                                                    tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">
                                                                    Delete Pesanan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Kamu yakin ingin menghapus pesanan dengan no ini ?
                                                                    <strong id="username"></strong>?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    id="confirm-delete">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Menu</th>
                                                    <th>Foto</th>
                                                    <th>Deskripsi</th>
                                                    <th>Price</th>
                                                    <th>Kategori</th>
                                                    <th>Action</th>
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

<script>
    function printOrderDetails() {
        // Implementasi fungsi untuk mencetak detail pesanan menjadi PDF
        // Contoh sederhana menggunakan window.print(), bisa disesuaikan dengan kebutuhan
        window.print();
    }
    </script>
