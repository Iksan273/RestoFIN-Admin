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
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label class="form-label">First Name:</label>
                                            <input type="text" class="form-control" placeholder="Enter First Name">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Last Name:</label>
                                            <input type="text" class="form-control" placeholder="Enter Last Name">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Username:</label>
                                            <input type="text" class="form-control" placeholder="Enter Username">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Role:</label>
                                            <input type="text" class="form-control" placeholder="Enter Role">

                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary me-2">Submit</button>

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
