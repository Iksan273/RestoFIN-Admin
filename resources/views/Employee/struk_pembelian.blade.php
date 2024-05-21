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
                                        <li class="breadcrumb-item"><a href="#!">Employee-Struk Pembelian</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>List Struk Pembelian</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama Member</th>
                                                    <th>Status</th>
                                                    <th>Point</th>
                                                    <th>Action</th>
                                                    <th>Tanggal Upload</th>
                                                    <th>Tanggal Update (Admin)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($strukOnline as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->user->firstname }} {{ $data->user->lastname }}</td>
                                                    <td> <span class="badge {{ $data->status == 'Accepted' ? 'text-bg-success' : 'text-bg-primary' }}">
                                                        {{ $data->status }}
                                                    </span></td>
                                                    <td>{{ $data->point }}</td>
                                                    <td>
                                                        <button class="btn btn-gradient-info" data-bs-toggle="modal"
                                                            data-bs-target="#updateModal{{ $data->id }}"><i
                                                                class="fas fa-edit"></i></button>

                                                        <button class="btn btn-gradient-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $data->id }}"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                    <td>{{ $data->created_at->format('Y-m-d H:i') }}</td>
                                                    <td>{{ $data->updated_at->format('Y-m-d H:i') }}</td>
                                                </tr>
                                                <div class="modal fade md-effect-1" id="deleteModal{{ $data->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">
                                                                    Delete Struk Pembelian</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Kamu yakin ingin menghapus Struk {{ $data->user->firstname}} {{ $data->user->lastname }} <strong
                                                                        id="username"></strong>?
                                                                </p>
                                                            </div>
                                                            <form action="{{ route('struk.delete', $data->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger"
                                                                        id="confirm-delete">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade md-effect-1" id="updateModal{{ $data->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateModalLabel">
                                                                    Update Struk Pembelian</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('struk.update', $data->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-3">
                                                                        <label for="fileImage" class="form-label">Gambar File</label>
                                                                        <img id="fileImage" src="{{ asset('promo/images/'.$data->file) }}" alt="File Image" style="width: 100%; height: auto;">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="pointInput" class="form-label">Poin</label>
                                                                        <input type="number" class="form-control" id="pointInput" placeholder="Masukkan Poin" name="point" value="{{ $data->point }}">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                    </div>
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
                                                    <th>ID</th>
                                                    <th>Nama Member</th>
                                                    <th>Status</th>
                                                    <th>Point</th>
                                                    <th>Action</th>
                                                    <th>Tanggal Upload</th>
                                                    <th>Tanggal Update (Admin)</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
