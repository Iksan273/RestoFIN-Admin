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
                                        <li class="breadcrumb-item"><a href="#!">Master-Edit Menu</a></li>
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
                                    <h5>Edit Menu</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label class="form-label">Nama Menu:</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Nama Menu">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Foto:</label>
                                            <input type="file" class="form-control" onchange="previewFile()">
                                            <small class="form-text text-muted">Silahkan upload gambar baru jika ingin mengganti foto, jika tidak silahkan di biarkan.</small>
                                            <div class="preview-container" style="margin-top: 20px; border: 1px dashed #ccc; padding: 10px; display: flex; justify-content: center; align-items: center; height: 200px; width: 200px;">
                                                <img id="previewImg" src="" alt="Preview Image" style="max-width: 100%; max-height: 100%; display: none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Deskripsi:</label>
                                            <textarea class="form-control" placeholder="Masukkan Deskripsi Menu"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Harga:</label>
                                            <input type="number" class="form-control" placeholder="Masukkan Harga Menu">
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
