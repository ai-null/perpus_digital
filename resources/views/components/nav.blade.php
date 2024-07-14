<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 5px 80px 5px 100px"
    style="background-color: white;">
    <a class="navbar-brand" href="{{ url('/') }}">
        <div class="row align-items-center">
            <img class="col" src="/img/icon/ic_logo.webp" alt="logo" class="mr-2" height="72" width="72">
            <div class="col">
                <div class="row amaranth-regular" style="font-size: 24px; color: #6499E9;">
                    {{ config('app.school_name') }}</div>
                <div class="row urbanist-medium" style="font-size: 16px; color: black;">
                    {{ config('app.app_category') }}
                </div>
            </div>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="ml-5 collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto"></ul>

        <!-- Right Side Of Navbar -->
        <div class="d-flex align-items-center text-center">
            <!-- Authentication Links -->
            @guest
                <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                    style="border: 1px solid transparent; font-size: 16px; color: {{ request()->is('/') ? '#3962D7' : '#BDBDBD' }}; margin-right: 14px; padding: 14px 22px;"
                    href="{{ route('index') }}">Beranda</a>

                <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                    style="border: 1px solid transparent; font-size: 16px; color: {{ request()->is('contacts') ? '#3962D7' : '#BDBDBD' }}; margin-right: 14px; padding: 14px 22px;"
                    href="{{ route('contacts') }}">Kontak</a>

                <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                    style="border: 1px solid transparent; font-size: 16px; color: {{ request()->is('gallery') ? '#3962D7' : '#BDBDBD' }}; margin-right: 24px; padding: 14px 22px;"
                    href="{{ route('gallery') }}">Galeri</a>

                <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                    style="border: 1px solid transparent;font-size: 16px; background-color: #DAE9FF; color: #3962D7; margin-right: 24px; padding: 14px 22px;"
                    href="{{ route('login') }}">Masuk</a>

                <a class="btn btn-primary nav-link urbanist-semibold"
                    style="background-color: #6499E9; font-size: 16px;color: white; padding: 14px 22px;"
                    href="{{ route('register') }}">Daftar</a>
            @endguest

            @auth
                <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                    style="border: 1px solid transparent; font-size: 16px; color: {{ request()->is('dashboard') ? '#3962D7' : '#BDBDBD' }}; margin-right: 14px; padding: 14px 22px;"
                    href="{{ route('dashboard') }}">Koleksi Buku</a>

                <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                    style="border: 1px solid transparent; font-size: 16px; color: {{ Route::is('user.peminjaman.list') ? '#3962D7' : '#BDBDBD' }}; margin-right: 24px; padding: 14px 22px;"
                    href="{{ route('user.peminjaman.list') }}">Aktivitas</a>

                <a href="#">
                    <img class="nav-link" height="48px" width="48px" src="/img/icon/ic_bell.webp" alt="notification">
                </a>

                <div class="nav-link"
                    style="margin: 0 8px 0 24px; height: 62px; width: 62px; border-radius: 100px; background-color: #D9D9D9;">
                </div>

                <div class="nav-link" style="border: 1px solid #6499E9; border-radius: 40px;">
                    <div class="dropdown" style="padding: 8px 12px; cursor: pointer;">
                        <div class="row text-start align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="col">
                                <div class="urbanist-semibold"
                                    style="font-size: 14px;
                                color: black; overflow: hidden;-webkit-line-clamp: 1;
                                line-clamp: 1;">
                                    {{ Auth::user()->name }}</div>
                                <div class="urbanist-regular" style="font-size: 12px; color: #7F7F7F;">{{ Auth::user()->nisn }}</div>
                            </div>
                            <div class="col-auto">
                                <img src="/img/icon/ic_arrow_down.webp" height="24px" width="24px" alt="more options">
                            </div>
                        </div>

                        {{-- DROPDOWN MENU --}}

                        <ul class="dropdown-menu">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                {{-- <li><a class="dropdown-item" href="#">Profile</a></li> --}}
                                {{-- <li><a class="dropdown-item" href="#">Riwayat Pinjam</a></li> --}}
                                {{-- <li><a class="dropdown-item" href="#">Daftar Baca</a></li> --}}
                                <li><button type="submit" class="dropdown-item">
                                        Keluar
                                    </button>
                                </li>
                            </form>
                        </ul>
                    </div>
                </div>


                {{-- <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li> --}}
            @endauth
        </div>
    </div>
</nav>
