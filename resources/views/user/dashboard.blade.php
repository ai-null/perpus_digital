@extends('components.head')

@section('content')
    @include('components.nav')

    <div
        style="background-image: url('img/cover/cover_curved_blue_dashboard.webp');
    background-position: top; background-repeat: no-repeat;
    z-index: -99;
    background-size: contain; width: 100%; height: 100%;position: absolute;">
    </div>

    <div class="container" style="margin-top: 81px; padding-bottom: 48px;">
        <span class="row align-items-center justify-content-between">
            <div class="col">
                <div class="amaranth-regular" style="font-size: 32px; color: white;">Daftar Koleksi Buku</div>
                <div class="urbanist-regular" style="font-size: 20px; color: white;">Cari buku yang kamu inginkan untuk
                    dipelajari
                    lebih lanjut sekarang.</div>
            </div>

            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle"
                        style="background-color: white; color: black; font-size: 16px; border: none; height: 48px;"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori Buku
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="input-group" style="height: 48px;">
                    <input type="text" class="form-control" placeholder="Cari Judul Buku,Penulis atau Penerbit"
                        aria-label="Cari Judul Buku,Penulis atau Penerbit" aria-describedby="book-searchbox">
                    <span class="input-group-text" id="book-searchbox">
                        <img src="/img/icon/ic_search.png" width="24px" height="24px" alt="search">
                    </span>
                </div>
            </div>
        </span>


        {{-- CONTENT --}}
        <div>
            <div class="row justify-content-center">

                @php
                    $numberOfCards = rand(3, 10); // Generate a random number between 3 and 10
                @endphp

                @for ($i = 0; $i < $numberOfCards; $i++)
                    <div class="col-sm-3 mx-3 mt-5 card"
                        style="width: 18rem; padding: 0px; border-radius: 16px; overflow: hidden; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15); border: none;">
                        <img src="/img/cover/cover.webp" height="440px" width="100%" style="object-fit: cover;"
                            class="card-img-top" alt="...">
                        <div class="card-body position-absolute" style="bottom: 0; width: 100%; background-color: white !important; border-radius: 16px;">
                            <h5 class="card-title amaranth-regular" style="font-size: 20px; color: black;">Atomic Habits
                            </h5>
                            <p class="card-text urbanist-regular" style="font-size: 14px; color: #7F7F7F;">Nama Penulis.</p>
                            <a href="{{ route('borrow_book') }}" class="urbanis-semibold btn btn-primary"
                                style="background-color: #6499E9; border: none; border-radius: 4px; color: white; font-size: 16px;">Pinjam</a>
                        </div>
                    </div>
                @endfor
            </div>

            <nav aria-label="Page navigation example" class="mt-4" style="float: right;">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
        </div>
    </div>
@endsection
