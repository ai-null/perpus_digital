@extends('components.head')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

    @include('components.nav')

    <div class="container mt-5" style=" padding-bottom: 48px;">
        {{-- CONTENT --}}
        <div class="amaranth-regular" style="font-size: 32px; color: black;">
            Peminjaman Buku
        </div>
        <div class="urbanist-regular" style="font-size: 20px; color: #7F7F7F; margin-top: 8px;">
            Disini kamu bisa melihat buku yang kamu pinjam saat ini.
        </div>

        <div style="margin-top: 28px;">
            @if (session('status') == 'success')
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>Sukses mengubah data peminjaman.</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('status') == 'error')
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div>Gagal mengubah data peminjaman.</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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

            <table id="myTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>No. Peminjaman</th>
                        <th>Info Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($books as $book)
                        <tr>
                            <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                <b>#{{ $book->pivot->id }}</b>
                            </td>
                            <td>
                                <div class="row row-cols-auto">
                                    <div class="col">
                                        <img src="{{ env('COVER_PATH') . $book->cover }}"
                                            width="80px" alt="cover">
                                    </div>
                                    <div class="col-auto col-8">
                                        <span class="row amaranth-regular"
                                            style="font-size: 16px; color: black;">{{ $book->title }}</span>
                                        <span class="row urbanist-medium"
                                            style="font-size: 12px; color: #7F7F7F;">{{ $book->author }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;"> 
                            {{  date('F j, Y', strtotime($book->pivot->created_at)) }}
                            </td>
                            <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;"> 
                                {{  date('F j, Y', strtotime($book->pivot->return_at)) }}
                            </td>
                            <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                @switch($book->pivot->status)
                                    @case(config('constants.peminjaman.status.0'))
                                        <span class="badge text-bg-danger">Dibatalkan</span>
                                    @break

                                    @case(config('constants.peminjaman.status.1'))
                                        <span class="badge text-bg-warning">Dalam Proses</span>
                                    @break

                                    @case(config('constants.peminjaman.status.2'))
                                        <span class="badge text-bg-primary">Dipinjam</span>
                                    @break

                                    @case(config('constants.peminjaman.status.3'))
                                        <span class="badge text-bg-danger">Ditolak</span>
                                    @break

                                    {{-- @case(config('constants.peminjaman.status.4'))
                                        <span class="badge text-bg-warning">Pengembalian</span>
                                    @break --}}

                                    @case(config('constants.peminjaman.status.5'))
                                        <span class="badge text-bg-danger">Hilang</span>
                                    @break

                                    @case(config('constants.peminjaman.status.6'))
                                        <span class="badge text-bg-success">Dikembalikan</span>
                                    @break

                                    @default
                                        <span class="badge text-bg-primary">Dalam Proses</span>
                                @endswitch

                                @if ($book->is_late)
                                    <span class="badge text-bg-danger">Pengembalian telat</span>
                                @endif
                            </td>
                            <td>
                                @switch($book->pivot->status)
                                    @case(config('constants.peminjaman.status.1'))
                                        <form action="{{ route('user.peminjaman.cancel') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $book->pivot->id }}">
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </form>
                                    @break

                                    {{-- @case(config('constants.peminjaman.status.2'))
                                        <form action="{{ route('user.peminjaman.return') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $book->pivot->id }}">
                                            <button type="submit" class="btn btn-warning">Kembalikan</button>
                                        </form>
                                    @break --}}

                                    @default
                                        -
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script>
        new DataTable('#myTable', {
            order: {
                idx: 0,
                dir: 'desc'
            }
        });
    </script>
@endsection
