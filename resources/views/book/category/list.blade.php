@extends('components.admin.head')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    {{-- CONTENT --}}
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Daftar Kategori</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Daftar Kategori
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div>{{session('success')}}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    {{-- SHOW CATEGORIES --}}
                    <div class="col">
                        <div class="card">
                            <div class="card-body">

                                <table id="myTable" class="stripe row-border order-column" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>nama kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($paginator as $key=>$category)
                                            <tr>
                                                <td> {{ $key+1 }} </td>
                                                <td> {{ $category->category }} </td>
                                                <td>
                                                    <div class="row text-center">
                                                        <div class="col align-self-center"><a style="width: 100%;"
                                                                href="{{ route('book.add') }}"
                                                                class="btn btn-warning">edit</a></div>
                                                        <form action="{{ route('category.delete') }}" method="POST"
                                                            class="col align-self-center">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $category->id }}">
                                                            <button style="width: 100%;"
                                                                class="btn btn-danger">hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ADD CATEGORIES --}}
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('category') }}" method="POST">
                                    @csrf
                                    <h4>Tambah Kategori</h4>

                                    <label for="kategori" class="form-label">Nama Kategori</label>
                                    <input name="category" type="text" class="form-control" id="kategori" required>

                                    <button type="submit" class="btn btn-primary mt-3 align-end">Tambahkan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script>
        new DataTable('#myTable', {
            columnDefs: [{
                targets: 0
            }],
            fixedColumns: true,
            paging: false,
            scrollY: 300
        });
    </script>
@endsection
