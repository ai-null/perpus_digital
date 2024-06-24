@extends('components.head')

@section('content')
    @include('components.nav')
    <div class="container" style="margin-top: 50px; padding-bottom: 48px;">
        <span class="align-items-center justify-content-between" style="color: #BDBDBD; font-size: 16px;"><a
                href="{{ route('dashboard') }}" style="text-decoration: none;color: #BDBDBD;">Koleksi Buku</a> <img
                src="/img/icon/ic_chevron_right.webp" height="24px" width="24px"> <span style="color: #6499E9;">Detail
                Buku</span></span>

        <div class="row justify-content-start" style="margin-top: 28px;">
            <div class="col-auto me-3">
                <div class="d-flex flex-column mb-3">
                    <img src="{{ $book->cover }}" style="object-fit: cover; width: 18rem;">

                    <a href="#"
                        style="background-color: #6499E9; border-radius: 8px; margin-top: 24px; font-size: 16px;"
                        class="btn btn-primary" style="urbanist-semibold">Pinjam Buku</a>

                    <a href="#"
                        style="background-color: white; border: 1px solid #6499E9; border-radius: 8px; color: #6499E9; margin-top: 16px; font-size: 16px;"
                        class="btn btn-primary" style="urbanist-semibold">Tambah ke Daftar Baca</a>
                </div>
            </div>
            <div class="col ms-5">
                <div class="d-flex flex-column mb-3 align-items-start">
                    @if ($book->stock > 0)
                        <span class="badge text-bg-success">Tersedia</span>
                    @else
                        <span class="badge text-bg-danger">Tidak tersedia</span>
                    @endif

                    <span class="amaranth-regular" style="margin: 16px 0 0 0; font-size: 52px; color: black; line-height: 1.2;"> {{ $book->title }} </span>

                    <div class="row mb-2 mt-3">
                        @foreach ($categories as $key => $value)
                            <div class="col-auto" style="padding: 0px 0px 0px 10px;">
                                <span class="badge text-bg-primary"> {{ $value->category }} </span>
                            </div>
                        @endforeach
                    </div>

                    <span class="urbanist-regular" style="font-size: 18px;"> {{ $book->description }} </span>

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
                        
                    
                    <table>
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
                                <td>Kategori</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
