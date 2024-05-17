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
                                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#!">Employee-Tambah Promo</a></li>
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
                                    <h5>Form Tambah Promo</h5>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="namaPromo">Nama Promo</label>
                                            <input type="text" class="form-control" id="namaPromo" name="namaPromo" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fotoPromo">Foto Promo</label>
                                            <input type="file" class="form-control" onchange="previewFile()">
                                            <small class="form-text text-muted">Silahkan upload gambar Promo.</small>
                                            <div class="preview-container" style="margin-top: 20px; border: 1px dashed #ccc; padding: 10px; display: flex; justify-content: center; align-items: center; height: 200px; width: 200px;">
                                                <img id="previewImg" src="" alt="Preview Image" style="max-width: 100%; max-height: 100%; display: none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggalMulai">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="tanggalMulai" name="tanggalMulai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggalSelesai">Tanggal Selesai</label>
                                            <input type="date" class="form-control" id="tanggalSelesai" name="tanggalSelesai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount">Deskripsi</label>
                                            <textarea class="form-control" id="discount" name="discount" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="pointYangDigunakan">Point yang Digunakan</label>
                                            <input type="number" class="form-control" id="pointYangDigunakan" name="pointYangDigunakan" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tambah Promo</button>
                                    </form>
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
    function previewFile() {
        var preview = document.getElementById('previewImg');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.style.display = 'block';
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            preview.src = "";
        }
    }
    </script>
