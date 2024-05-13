@extends('components.head')

@section('content')
    @include('components.nav')

    <div class="text-center mt-5">
        <span class="amaranth-regular" style="color: black; font-size: 40px;">Kontak Kami</span>
        <br />
        <span class="urbanist-regular" style="color: #7F7F7F;font-size: 20px;margin-top: 8px;">Hubungi salah satu dibawah ini
            jika ada kendala
            dan butuh bantuan</span>
    </div>

    <div style="position: absolute; z-index: 1; top: 60%; width: 100%;transform: translate(0%, -50%);">
        <div class="row justify-content-md-center"
            style="position: relative; width: 75%; left: 50%;transform: translate(-50%);">
            <div class="col">
                <div class="card position-relative top-50 start-50 translate-middle" style="padding: 16px; cursor: pointer; box-shadow: 0px 4px 10px #00000010">
                    <div class="card-body" style="display:grid;">
                        <img src="/img/icon/ic_location.webp" height="40px" />
                        <span class="urbanist-semibold"
                            style="font-size: 20px; color: #1746A2; margin-top: 24px;">Lokasi</span>
                        <span class="amaranth-regular" style="font-size: 16px; color: #7F7F7F; margin-top: 4px;">Jl. Raya Sutorejo
                            No.98-100</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card position-relative top-50 start-50 translate-middle" style="padding: 16px; cursor: pointer; box-shadow: 0px 4px 10px #00000010">
                    <div class="card-body" style="display:grid;">
                        <img src="/img/icon/ic_whatsapp.webp" height="40px" />
                        <span class="urbanist-semibold"
                            style="font-size: 20px; color: #1746A2; margin-top: 24px;">Whatsapp</span>
                        <span class="amaranth-regular" style="font-size: 16px; color: #7F7F7F; margin-top: 4px;">Chat dengan admin perpustakaan</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card position-relative top-50 start-50 translate-middle" style="padding: 16px; cursor: pointer; box-shadow: 0px 4px 10px #00000010">
                    <div class="card-body" style="display:grid;">
                        <img src="/img/icon/ic_gmail.webp" height="40px" />
                        <span class="urbanist-semibold"
                            style="font-size: 20px; color: #1746A2; margin-top: 24px;">Email</span>
                        <span class="amaranth-regular" style="font-size: 16px; color: #7F7F7F; margin-top: 4px;">hubungi admin melalui email</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BACKGROUND --}}
    <div style="position: absolute; z-index: -99; top: 0; left: 0; width: 100%; height: 60%; background-color: #DAE9FF;">
    </div>
@endsection
