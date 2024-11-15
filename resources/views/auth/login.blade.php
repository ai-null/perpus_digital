@extends('components.head')

@section('content')
    <div class="container-fluid">
        <div class="row" style="height: 100vh; top: 0; left: 0; background: white;">
            <div class="col-5 col-sm-3 position-relative urbanist-semibold" style="width: 60%; color: black;">
                <div class="position-absolute top-50 start-50 translate-middle" style="width: 70%; padding: 50px;">
                    <div style="display: grid;" class="text-center">
                        <span class="amaranth-regular" style="color: black; font-size: 32px;">Selamat Datang</span>
                        <span class="amaranth-regular" style="color: black; font-size: 32px;">di <span
                                class="amaranth-regular" style="color: #6499E9;">SMAM7</span> Library</span>

                        <span class="urbanist-medium" style="margin-top: 16px; color: #BDBDBD; font-size: 16px;">Masuk untuk
                            pinjam buku yang kamu inginkan</span>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-4 alert-dismissible" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="post" action="{{ route('login') }}" autocomplete="on" style="margin-top: 52px;">
                        @csrf
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="number" name="nisn" class="form-control" placeholder="Masukkan NISN"
                                id="nisn" aria-describedby="nisn-input">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan Kata Sandi" id="password" aria-describedby="password-input">
                            </div>
                        </div>

                        <button class="w-100 btn btn-primary" type="submit"
                            style="margin-top: 48px; background-color: #6499E9;">Masuk</button>

                        <div style="margin-top: 56px;" class="text-center">
                            <span>Belum punya akun? <a style="color: #1746A2; text-decoration: none;"
                                    href="{{ route('register') }}">Daftar Sekarang</a></span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4 position-relative" style="background: transparent;">
                <img class="position-absolute top-50 start-50 translate-middle"
                    style="padding: 50px; width: max-content; height: 100vh;" src="/img/cover/cover.webp" alt="login">
            </div>
        </div>
    </div>
@endsection
