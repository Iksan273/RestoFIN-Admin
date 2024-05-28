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
                                        <li class="breadcrumb-item"><a href="#!">Penambahan Member Poin By Admin</a>
                                        </li>
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
                                    <h5>Penambahan Poin Member</h5>
                                </div>
                                <form action="{{ route('memberpoint.addPoint') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Nomor Telepon:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Masukkan Nomor Telepon" name="phone" id="phoneInput" required>
                                                <button class="btn btn-primary" type="button" id="checkMemberBtn">Cek
                                                    Member</button>
                                            </div>
                                            <div id="memberInfo" style="margin-top: 10px;"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Jumlah Point:</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Jumlah Point"
                                                name="point" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Keterangan:</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Keterangan"
                                                name="keterangan" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary me-2">Update Poin</button>
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

@section('script')
    <script>
        $(document).ready(function() {
            $('#checkMemberBtn').click(function() {
                var phone = $('#phoneInput').val();
                if (!phone) {
                    $('#memberInfo').html(
                        '<div class="alert alert-warning">Harap masukkan nomor telepon.</div>');
                    return;
                }
                $.ajax({
                    url: '{{ route('fetch-user') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        phone: phone
                    },
                    success: function(response) {

                        $('#memberInfo').html('Nama: ' + response.name + '<br>Email: ' +
                            response.email + '<br>Poin: ' + response.points);

                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            if (xhr.status === 404) {
                                $('#memberInfo').html('<div class="alert alert-warning">' +
                                    'Member tidak ditemukan.' + '</div>');
                            } else {
                                $('#memberInfo').html('<div class="alert alert-danger">' +
                                    xhr.responseJSON.error + '</div>');
                            }
                        } else {
                            $('#memberInfo').html(
                                '<div class="alert alert-danger">Gagal mengambil data dari server.</div>'
                                )
                        };
                    }
                });
            });
        });
    </script>
@endsection
