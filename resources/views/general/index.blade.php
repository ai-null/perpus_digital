@extends('components.head')

@section('content')

@include('components.nav')

<div class="container">
    <div class="row gx-5 mt-5">
        <div class="col overflow-hidden mt-2">
            <div class="amaranth-regular" style="font-size: 56px; color: black; line-height: 70px;">
                Sumber Pengetahuan
                <span style="color: #6499E9; margin-top: 0px">Tanpa</span> Batas
            </div>
            <p class="urbanist-medium mt-4" style="font-color: #7F7F7F;">
                SMAM7 library adalah website yang menyediakan akses peminjaman atau pengembalian materi bacaan dan sumber
                pengetahuan. SMAM7 library hadir untuk memudahkan pembelajaran dan eksplorasi pengetahuan.
            </p>

            <a href="{{route('login')}}" style="background-color: #6499E9; margin-top: 80px; font-size: 16px;" class="btn btn-primary" style="urbanist-semibold">Mulai Sekarang</a>
        </div>
        <div class="col-sm-6">
            <img class="img-fluid" src="/img/cover/side_illustration.webp" alt="illustration">
        </div>
    </div>
</div>

@endsection