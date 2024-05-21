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
                                                @foreach ($reservation as $data)
                                                <tr>
                                                    <td>{{ $data->nama }}</td>
                                                    <td>{{ $data->person }}</td>
                                                    <td>{{ $data->reservation_date }}</td>
                                                    <td>{{ $data->phone }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->keterangan }}</td>
                                                    <td>
                                                        <span class="badge {{ $data->status == 'Accepted' ? 'text-bg-success' : 'text-bg-primary' }}">
                                                            {{ $data->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('employee.editReservasi', $data->id) }}"
                                                            class="btn btn-gradient-info"><i class="fas fa-edit"></i></a>

                                                        <button class="btn btn-gradient-success" data-bs-toggle="modal"
                                                            data-bs-target="#updateModal-{{ $data->id }}"><i
                                                                class="fas fa-check"></i></button>
                                                        <button class="btn btn-gradient-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal-{{ $data->id }}"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <!-- Modal for Update -->
                                                <div class="modal fade" id="updateModal-{{ $data->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="updateModalLabel-{{ $data->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateModalLabel-{{ $data->id }}">Konfirmasi
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
                                                                        id="customer-phone">{{ $data->phone }}</span></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('reservasi.accept', $data->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        id="confirm-update-{{ $data->id }}">Konfirmasi</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal for Delete -->
                                                <div class="modal fade" id="deleteModal-{{ $data->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteModalLabel-{{ $data->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel-{{ $data->id }}">Hapus
                                                                    Reservasi</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus reservasi atas nama {{ $data->nama }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('reservasi.delete', $data->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger"
                                                                        id="confirm-delete-{{ $data->id }}">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <!-- Data lainnya -->
                                            </tbody>
                                            <tfoot>
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
