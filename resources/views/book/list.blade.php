@extends('components.admin.head')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    {{-- CONTENT --}}
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Daftar Buku</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Daftar Buku
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
                            <div class="alert alert-danger mt-4 alert-dismissible" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>isbn</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Tanggal ditambahkan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($paginator as $book)
                                    <tr>
                                        <td> {{ $book->isbn }} </td>
                                        <td> <img src="{{ $book->cover }}" width="80px" alt="cover"> </td>
                                        <td> {{ $book->title }} </td>
                                        <td> {{ $book->author }} </td>
                                        <td> {{ $book->publisher }} </td>
                                        <td> {{ $book->publishing_year }} </td>
                                        <td> {{ date('d-M-Y', strtotime($book->created_at)) }}</td>
                                        <td>
                                            <div class="col">
                                                <a href="{{ route('book.edit', ['id' => base64_encode(strval($book->id))]) }}"
                                                    class="btn btn-warning">edit</a>
                                                <form action="{{ route('book.delete') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $book->id }}">
                                                    <button class="btn btn-danger mt-2">hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script>
        new DataTable('#myTable', {
            order: {
                idx: 6,
                dir: 'desc'
            }
        });
    </script>
@endsection
