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
                    <img src="/img/cover/cover.webp" style="object-fit: cover; width: 18rem;">

                    <a href="#"
                        style="background-color: #6499E9; border-radius: 8px; margin-top: 24px; font-size: 16px;"
                        class="btn btn-primary" style="urbanist-semibold">Pinjam Buku</a>

                    <a href="#"
                        style="background-color: white; border: 1px solid #6499E9; border-radius: 8px; color: #6499E9; margin-top: 16px; font-size: 16px;"
                        class="btn btn-primary" style="urbanist-semibold">Tambah ke Daftar Baca</a>
                </div>
            </div>
            <div class="col-md-6 ms-5">
                <div class="d-flex flex-column mb-3 align-items-start">
                    <span class="badge text-bg-success">Tersedia</span>

                    <span class="amaranth-regular" style="margin: 16px 0 32px 0; font-size: 52px; color: black;">Judul Buku</span>

                    <span class="urbanist-regular" style="font-size: 18px;">Deskripsi Buku yang ada dibelakang buku atau deskripsi singkat tentang buku ini menceritakan
                        tentang apa. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </span>

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
                                <td>Nama Penulis</td>
                            </tr>
                            <tr>
                                <td>Penerbit</td>
                                <td>Penerbit</td>
                            </tr>
                            <tr>
                                <td>Tahun Terbit</td>
                                <td>Tahun Terbit</td>
                            </tr>
                            <tr>
                                <td>Bahasa</td>
                                <td>Bahasa</td>
                            </tr>
                            <tr>
                                <td>Stok Buku</td>
                                <td>Stok Buku</td>
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
