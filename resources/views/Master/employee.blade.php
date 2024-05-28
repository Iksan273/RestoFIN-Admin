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
                                        <li class="breadcrumb-item"><a href="#!">Master-Employee</a></li>

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
                                    <h5>List Pegawai</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employee as $data)


                                                <tr>
                                                    <td>{{ $data->firstname }}</td>
                                                    <td>{{ $data->lastname }}</td>
                                                    <td>{{ $data->username }}</td>
                                                    <td>{{ $data->role }}</td>
                                                    <td>
                                                        <a href="{{ route('edit-employee', ['id' => $data->id]) }}" class="btn btn-gradient-info"><i class="fas fa-edit"></i></a>

                                                        <button class="btn btn-gradient-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $data->id }}"><i
                                                                class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade md-effect-1" id="deleteModal{{ $data->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">
                                                                    Delete Employee</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Anda yakin akan menghapus employee dengan nama {{ $data->username }} <strong id="username"></strong>?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <form method="POST" action="{{ route('employee.delete', ['id' => $data->id]) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
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
@endsection
