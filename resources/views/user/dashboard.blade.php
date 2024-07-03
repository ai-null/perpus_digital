@extends('components.head')

@section('style')
    <style>
        .dropdown-menu {
            max-height: 300px;
            overflow-y: scroll;
        }
    </style>
@endsection

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
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Semua</a></li>
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item" href="{{ route('dashboard', ['category' => $category->id]) }}">{{ $category->category }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-sm-4">
                <form style="height: 48px;" class="input-group" action="{{ route('dashboard') }}">
                    <input type="text" class="form-control" placeholder="Cari Judul Buku,Penulis atau Penerbit"
                    aria-label="Cari Judul Buku,Penulis atau Penerbit" name="search" aria-describedby="book-searchbox">
                    <button type="submit" class="input-group-text" id="book-searchbox">
                        <img src="/img/icon/ic_search.png" width="24px" height="24px" alt="search">
                    </button>
                </form>
            </div>
        </span>


        {{-- CONTENT --}}
        <div>
            <div class="row justify-content-center">
                @foreach ($paginator->items() as $book)
                    <div class="col-sm-3 mx-3 mt-5 card"
                        style="width: 18rem; padding: 0px; border-radius: 16px; overflow: hidden; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15); border: none;">
                        <img src="{{ $book->cover }}" height="440px" width="100%" style="object-fit: cover;"
                            class="card-img-top" alt="...">
                        <div class="card-body position-absolute"
                            style="bottom: 0; width: 100%; background-color: white !important; border-radius: 16px;">
                            <h5 class="card-title amaranth-regular" style="font-size: 20px; color: black;">
                                {{ $book->title }}
                            </h5>
                            <p class="card-text urbanist-regular" style="font-size: 14px; color: #7F7F7F;">
                                {{ $book->author }}.</p>
                            <a href="{{ route('book.detail', ['id' => base64_encode(strval($book->id))]) }}"
                                class="urbanis-semibold btn btn-primary"
                                style="background-color: #6499E9; border: none; border-radius: 4px; color: white; font-size: 16px;">Pinjam</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <nav aria-label="Page navigation example" class="mt-5">
                {{ $paginator->withQueryString()->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
@endsection
