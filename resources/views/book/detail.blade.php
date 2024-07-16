@extends('components.head')

@section('style')
    <style>
        .table-modal {
            table-layout: fixed;
            width: 100%;
        }

        td {
            max-lines: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    @include('components.nav')
    {{-- MODAL --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Peminjaman Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ $book->cover }}" class="img-fluid" style="object-fit: cover;">
                        </div>
                        <div class="col-auto col-lg-9">
                            <h5>Informasi Buku</h5>
                            <table class="table-modal">
                                <tbody class="urbanist-semibold" style="font-size: 16px;">
                                    <tr>
                                        <td>Nama Penulis</td>
                                        <td> {{ $book->author }} </td>
                                    </tr>
                                    <tr>
                                        <td>Penerbit</td>
                                        <td> {{ $book->publisher }} </td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Terbit</td>
                                        <td> {{ $book->publishing_year }} </td>
                                    </tr>
                                    <tr>
                                        <td>Bahasa</td>
                                        <td> {{ $book->language }} </td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>
                                            <div class="row">
                                                @foreach ($categories as $key => $value)
                                                    <div class="col-auto" style="padding: 0px 0px 0px 10px;">
                                                        <span class="badge text-bg-primary"> {{ $value->category }} </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="hr" />
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-warning" role="alert">
                                <b>Mohon Diperhatikan!!</b><br/>
                                Maksimal peminjaman buku adalah <b>7 Hari</b> sejak proses peminjaman telah dikonfirmasi oleh petugas perpustakaan. 
                                <br/><br/>Pastikan petugas perpustakaan berada ditempat saat mengembalikan buku bacaan. Terima kasih
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <form action="{{ route('book.borrow', base64_encode($book->id)) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Pinjam</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTAINER --}}
    <div class="container" style="margin-top: 50px; padding-bottom: 48px;">
        <span class="align-items-center justify-content-between" style="color: #BDBDBD; font-size: 16px;"><a
                href="{{ route('dashboard') }}" style="text-decoration: none;color: #BDBDBD;">Koleksi Buku</a> <img
                src="/img/icon/ic_chevron_right.webp" height="24px" width="24px"> <span style="color: #6499E9;">Detail
                Buku</span></span>

        <div class="row justify-content-start" style="margin-top: 28px;">
            <div class="col-auto me-3">
                <div class="d-flex flex-column mb-3">
                    <img src="{{ $book->cover }}" style="object-fit: cover; width: 18rem;">
                    <button
                        style="width: 100%; background-color: #6499E9; border-radius: 8px; margin-top: 24px; font-size: 16px;"
                        class="btn btn-primary" style="urbanist-semibold" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">Pinjam Buku</button>

                    {{-- <form action="{{ route('book.borrow', base64_encode($book->id)) }}" method="POST">
                        @csrf
                        <button 
                            style="width: 100%; background-color: white; border: 1px solid #6499E9; border-radius: 8px; color: #6499E9; margin-top: 16px; font-size: 16px;"
                            class="btn btn-primary" type="button" style="urbanist-semibold">Tambah ke Daftar Baca</button>
                    </form> --}}
                </div>
            </div>
            <div class="col ms-5">
                <div class="d-flex flex-column mb-3 align-items-start">
                    @if ($book->stock > 0)
                        <span class="badge text-bg-success">Tersedia</span>
                    @else
                        <span class="badge text-bg-danger">Tidak tersedia</span>
                    @endif

                    <span class="amaranth-regular"
                        style="margin: 16px 0 0 0; font-size: 52px; color: black; line-height: 1.2;"> {{ $book->title }}
                    </span>

                    <span class="urbanist-regular mt-4" style="font-size: 18px;"> {{ $book->description }} </span>

                    {{-- DIVIDER --}}
                    <div style="width: 100%; border: 1px solid #D8D8D8; margin: 32px 0 20px 0;"></div>


                    <style>
                        table {
                            border-collapse: collapse;
                        }

                        table tbody {
                            border-top: 15px solid transparent;
                        }

                        table tr {
                            border-top: 16px solid transparent;
                        }
                    </style>


                    <table style="width: 32rem;">
                        <thead>
                            <tr>
                                <th class="amaranth-regular" style="font-size: 20px;">Informasi Buku</th>
                            </tr>
                        </thead>
                        <tbody class="urbanist-semibold" style="font-size: 16px;">
                            <tr>
                                <td>Nama Penulis</td>
                                <td> {{ $book->author }} </td>
                            </tr>
                            <tr>
                                <td>Penerbit</td>
                                <td> {{ $book->publisher }} </td>
                            </tr>
                            <tr>
                                <td>Tahun Terbit</td>
                                <td> {{ $book->publishing_year }} </td>
                            </tr>
                            <tr>
                                <td>Bahasa</td>
                                <td> {{ $book->language }} </td>
                            </tr>
                            <tr>
                                <td>Stok Buku</td>
                                <td> {{ $book->stock }} </td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>
                                    <div class="row mb-2">
                                        @foreach ($categories as $key => $value)
                                            <div class="col-auto" style="padding: 0px 0px 0px 10px;">
                                                <span class="badge text-bg-primary"> {{ $value->category }} </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
