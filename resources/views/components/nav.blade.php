<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 5px 80px 5px 100px">
    <a class="navbar-brand" href="{{ url('/') }}">
        <div class="row align-items-center">
            <img class="col" src="/img/ic_logo.webp" alt="logo" class="mr-2" height="72" width="72">
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
        <div class="d-flex">
            <!-- Authentication Links -->
            <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                style="border: 1px solid transparent; color: black; margin-right: 14px; padding: 14px 22px;"
                href="{{ route('dashboard') }}">Beranda</a>

            <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                style="border: 1px solid transparent; color: black; margin-right: 24px; padding: 14px 22px;"
                href="{{ route('contacts') }}">Kontak</a>

            <a class="btn btn btn-outline-light nav-link urbanist-semibold"
                style="border: 1px solid transparent; color: #6499E9; margin-right: 24px; padding: 14px 22px;"
                href="{{ route('login') }}">Masuk</a>

            <a class="btn btn-primary nav-link urbanist-semibold"
                style="background-color: #6499E9; color: white; padding: 14px 22px;" href="{{route('register')}}">Daftar</a>
            {{-- @else
            @if ($count > 0)
                <li class="nav-item">
                    <a class="nav-link" href="/keranjang">Keranjang <span
                            class="badge badge-primary">{{ $count }}</span></a>
                </li>
            @endif
            <li class="nav-item dropdown">
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
        </div>
    </div>
</nav>
