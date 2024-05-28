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
                                        <li class="breadcrumb-item"><a href="#!">Master-Edit Employee</a></li>

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
                                    <h5>Edit Employee</h5>
                                </div>
                                <form action="{{ route('employee.update', ['id' => $employee->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                        <div class="form-group">
                                            <label class="form-label">First Name:</label>
                                            <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" value="{{ $employee->firstname }}">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Last Name:</label>
                                            <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" value="{{ $employee->lastname }}">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Username:</label>
                                            <input type="text" class="form-control" name="username" placeholder="Enter Username" value="{{ $employee->username }}">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Password:</label>
                                            <input type="text" class="form-control" name="password" placeholder="Enter password">
                                            <small>Kosongkan jika tidak ingin mengganti password</small>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Role:</label>
                                            <input type="text" class="form-control" name="role" placeholder="Enter Role" value="{{ $employee->role }}">

                                        </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>

                                </div>
                            </form>
                        </div>

                        </div>

                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>
        </div>
    </div>
@endsection
