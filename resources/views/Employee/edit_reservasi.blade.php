@extends('Layouts.user')
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
@section('content')
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
                                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#!">Employee-Edit Reservasi</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tambah Reservasi</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('reservasi.update',$reservasi->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required value="{{ $reservasi->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Jumlah Orang</label>
                                            <input type="number" class="form-control" id="jumlah_orang" name="person" required value="{{ $reservasi->person }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_reservasi">Tanggal Reservasi</label>
                                            <input type="datetime-local" class="form-control" id="tanggal_reservasi" name="reservation_date" required value="{{ $reservasi->reservation_date  }}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon">No Telepon</label>
                                            <input type="text" class="form-control" id="no_telepon" name="phone" required  value="{{ $reservasi->phone }}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $reservasi->email }}" >
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Reservasi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
