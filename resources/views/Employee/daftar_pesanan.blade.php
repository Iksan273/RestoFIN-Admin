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
                                    <h5>List Menu</h5>
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
                                                    <th>Action Pembayaran</th>
                                                    <th>Status Makanan</th>
                                                    <th>Action Makanan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>John Doe</td>
                                                    <td>5</td>
                                                    <td>101</td>
                                                    <td> <button class="btn btn-gradient-info" data-bs-toggle="modal"
                                                            data-bs-target="#viewDetailOrderModal"><i></i>View</button></td>
                                                    <td>2023-09-15 12:34</td>
                                                    <td>Rp 150.000</td>
                                                    <td>Transfer Bank</td>
                                                    <td>Lunas</td>
                                                    <td><button class="btn btn-gradient-info" data-bs-toggle="modal"
                                                            data-bs-target="#updateModalPembayaran"><i
                                                                class="fas fa-edit"></i></button>

                                                        <button class="btn btn-gradient-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModalPembayaran"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td> <!-- Action Pembayaran -->
                                                    <td>Siap</td>
                                                    <td><button class="btn btn-gradient-info" data-bs-toggle="modal"
                                                            data-bs-target="#updateModalMakanan"><i
                                                                class="fas fa-edit"></i></button>
                                                    </td> <!-- Action Makanan -->
                                                </tr>
                                                <div class="modal fade" id="viewDetailOrderModal" tabindex="-1" role="dialog" aria-labelledby="viewDetailOrderLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewDetailOrderLabel">Detail Pesanan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="order-details">
                                                                    <p><strong>Nomor Pesanan:</strong> <span id="orderNumber"></span></p>
                                                                    <p><strong>Nomor Meja:</strong> <span id="tableNumber"></span></p>
                                                                    <ul>
                                                                        <li><strong>Nama Menu:</strong> Ayam Goreng - <strong>Jumlah:</strong> 2</li>
                                                                        <li><strong>Nama Menu:</strong> Nasi Putih - <strong>Jumlah:</strong> 3</li>
                                                                        <li><strong>Nama Menu:</strong> Es Teh Manis - <strong>Jumlah:</strong> 2</li>
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
