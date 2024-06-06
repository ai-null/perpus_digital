@extends('components.admin.head')

@section('content')
    {{-- CONTENT --}}
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Tambah Buku</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tambah Buku
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger mt-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($success)
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <div>Sukses menambahkan buku.</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('addBook') }}" enctype="multipart/form-data">
                            @csrf

                            <h4>Data buku</h4>

                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="judul_buku" class="form-label">Judul Buku</label>
                                            <input name="title" type="text" class="form-control" id="judul_buku">
                                        </div>
                                        <div class="col mb-3">
                                            <label for="author" class="form-label">Penulis</label>
                                            <input name="author" type="text" class="form-control" id="author">
                                        </div>
                                    </div>

                                    <div class="col mb-4">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea name="description" type="text" class="form-control" id="description" aria-label="With textarea"> </textarea>
                                    </div>

                                    <h5>Informasi Tambahan</h5>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="publisher" class="form-label">Penerbit</label>
                                            <input type="text" name="publisher" class="form-control" id="publisher">
                                        </div>

                                        <div class="col mb-3">
                                            <label for="publishing_year" class="form-label">Tahun Terbit</label>
                                            <input type="number" name="publishing_year" class="form-control"
                                                id="publishing_year">
                                        </div>

                                        <div class="col mb-3">
                                            <label for="stock" class="form-label">Stok</label>
                                            <input type="number" name="stock" class="form-control" id="stock">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="ISBN" class="form-label">ISBN</label>
                                            <input type="text" name="ISBN" class="form-control" id="ISBN">
                                        </div>

                                        <div class="col mb-3">
                                            <label for="language" class="form-label">Bahasa</label>
                                            <input type="text" name="language" class="form-control" id="language">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-auto">
                                    <img id="imagePreview" style="height: 400px; width: 250px; object-fit: contain;"
                                        src="/img/cover/cover_placeholder.jpeg" alt="cover preview">
                                    <div class="input-group mt-3">
                                        <input type="file" accept="image/*" class="form-control" name="cover"
                                            id="cover">
                                        <label class="input-group-text" for="cover">Upload</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambahkan Buku</button>
                        </form>
                    </div>
                </div>
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>

    <script>
        document.getElementById('cover').addEventListener('change', function() {
            var reader = new FileReader()

            reader.onload = function(e) {
                var imagePreview = document.getElementById('imagePreview')
                imagePreview.src = e.target.result
            }

            reader.readAsDataURL(this.files[0])
        })
    </script>
@endsection
