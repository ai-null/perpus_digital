@extends('components.head')

@section('content')
    @include('components.nav')

    <div
        style="background-image: url('img/cover/cover_curved_blue_dashboard.webp');
    background-position: top; background-repeat: no-repeat;
    z-index: -99;
    background-size: contain; width: 100%; height: 100%;position: absolute;">
    </div>

    <div class="container" style="margin-top: 81px;">
        <span>
            <div class="amaranth-regular" style="font-size: 32px; color: white;">Daftar Koleksi Buku</div>
            <div class="urbanist-regular" style="font-size: 20px; color: white;">Cari buku yang kamu inginkan untuk dipelajari
                lebih lanjut sekarang.</div>


        </span>


        {{-- CONTENT --}}
        <div>
            <div class="row justify-content-center">

                @php
                    $numberOfCards = rand(3, 10); // Generate a random number between 3 and 10
                @endphp

                @for ($i = 0; $i < $numberOfCards; $i++)
                    <div class="col-sm-3 mx-3 mt-5 card"
                        style="width: 18rem; padding: 0px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15); border: none;">
                        <img src="/img/cover/cover.webp" height="300px" width="100%" style="object-fit: cover;"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title amaranth-regular" style="font-size: 20px; color: black;">Atomic Habits</h5>
                            <p class="card-text urbanist-regular" style="font-size: 14px; color: #7F7F7F;">Nama Penulis.</p>
                            <a href="#" class="urbanis-semibold btn btn-primary"
                                style="background-color: #6499E9; border: none; border-radius: 4px; color: white; font-size: 16px;">Pinjam</a>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
