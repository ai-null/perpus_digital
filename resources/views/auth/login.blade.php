@extends('components.head')

@section('content')
    <div class="container">
        <div class="row" style="height: 1vh; width: 100%; top: 0; left: 0;">
            <div class="col-5 t-50">
                <div style="display: grid;">
                    <span>Selamat Datang</span>
                    <span>di SMAM7 Library</span>

                    <span>Masuk untuk pinjam buku yang kamu inginkan</span>
                </div>

                <form action="post">
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="number" class="form-control" placeholder="Masukkan NISN" id="nisn"
                            aria-describedby="nisn-input">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Masukkan Kata Sandi" id="password"
                            aria-describedby="password-input">
                        </div>
                    </div>

                    <button class="w-100 btn btn-primary">Masuk</button>

                    <span>Belum punya akun? <a href="/register">Daftar Sekarang</a></span>
                </form>
            </div>
            <div class="col-5">
                <img src="/img/cover.webp" alt="login">
            </div>
        </div>
    </div>
@endsection
