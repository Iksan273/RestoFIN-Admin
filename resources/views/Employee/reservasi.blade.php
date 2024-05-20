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
                                        <li class="breadcrumb-item"><a href="#!">Employee-Menu</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Daftar Reservasi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Jumlah Orang</th>
                                                    <th>Tanggal Reservasi</th>
                                                    <th>No Telepon</th>
                                                    <th>Email</th>
                                                    <th>Keterangan</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Contoh data -->
                                                <tr>
                                                    <td>John Doe</td>
                                                    <td>4</td>
                                                    <td>2023-10-05</td>
                                                    <td>08123456789</td>
                                                    <td>johndoe@example.com</td>
                                                    <td>-</td>
                                                    <td>Pending</td>
                                                    <td>
                                                        <a href="{{ route('employee.editReservasi') }}"
                                                            class="btn btn-gradient-info"><i class="fas fa-edit"></i></a>

                                                        <button class="btn btn-gradient-success" data-bs-toggle="modal"
                                                            data-bs-target="#updateModal"><i
                                                                class="fas fa-check"></i></button>
                                                        <button class="btn btn-gradient-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <!-- Modal for Update -->
                                                <div class="modal fade" id="updateModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="updateModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateModalLabel">Konfirmasi
                                                                    Reservasi</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin mengonfirmasi reservasi ini?</p>
                                                                <p>Segera hubungi customer di nomor berikut untuk konfirmasi
                                                                    lebih lanjut:</p>
                                                                <!-- Tempatkan nomor telepon yang dinamis dari data reservasi -->
                                                                <p><strong>Nomor Telepon: </strong><span
                                                                        id="customer-phone">08123456789</span></p>
                                                                <form>
                                                                    <!-- Form fields for update -->
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    id="confirm-update">Konfirmasi</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal for Delete -->
                                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Hapus
                                                                    Reservasi</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus reservasi ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    id="confirm-delete">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Data lainnya -->
                                            </tbody>
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
