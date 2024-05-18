@extends('components.head')

@section('content')
    @include('components.nav')

    <div class="text-center mt-5">
        <span class="amaranth-bold" style="color: white; font-size: 80px;">Galery<br/>SMAM7 Library</span>
    </div>

    <div style="position: absolute; z-index: -99; top: 80px; left: 0; width: 100%; height: 100%;">
        {{-- BACKGROUND --}}
        <div style="
        filter: blur(3px); -webkit-filter: blur(3px);background-image: url('img/cover/gallery_cover.webp');
        background-position: center; background-repeat: no-repeat; background-size: cover; width: 100%; height: 100%;">
        </div>

        <div style="position: relative; z-index: 1; width: 100%;top: -25%;">
            <div class="row justify-content-md-center"
                style="position: relative; width: 75%; left: 50%;transform: translate(-50%, 0%);">
                <div class="col">
                    <div class="card position-relative top-50 start-50 translate-middle" style="cursor: pointer; box-shadow: 0px 4px 10px #00000010">
                        <div class="card-body" style="display:grid;">
                            <div style="width: 100%;position: relative;background-color: #6499E9;height: 108px;border-radius: 0 0 8px 8px;"></div>
                            <img src="img/cover/gallery_1.jpeg" style="height: 292px;width: 100%;z-index: -1;background-repeat: no-repeat;background-size: cover;position: relative;top: -10%;">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card position-relative top-50 start-50 translate-middle" style="cursor: pointer; box-shadow: 0px 4px 10px #00000010">
                        <div class="card-body" style="display:grid;">
                            <div style="width: 100%;position: relative;background-color: #6499E9;height: 108px;border-radius: 0 0 8px 8px;"></div>
                            <img src="img/cover/gallery_1.jpeg" style="height: 292px;width: 100%;z-index: -1;background-repeat: no-repeat;background-size: cover;position: relative;top: -10%;">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card position-relative top-50 start-50 translate-middle" style="cursor: pointer; box-shadow: 0px 4px 10px #00000010">
                        <div class="card-body" style="display:grid;">
                            <div style="width: 100%;position: relative;background-color: #6499E9;height: 108px;border-radius: 0 0 8px 8px;"></div>
                            <img src="img/cover/gallery_1.jpeg" style="height: 292px;width: 100%;z-index: -1;background-repeat: no-repeat;background-size: cover;position: relative;top: -10%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="position: relative; top: -25%; padding: 90px 98px;">
            <span class="amaranth-bold" style="color: #6499E9; font-size: 32px;">Momen di Perpustakaan</span>

            <img src="img/cover/gallery_1.jpeg" width="100%" style="margin-top: 32px;">
            <img src="img/cover/gallery_2.jpeg" width="100%" style="margin-top: 32px;">
        </div>
    </div>
@endsection
