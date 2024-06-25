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
                                        <img src="{{ env('AWS_STORAGE_PATH') . '/public/covers/' . $book->cover }}"
                                            width="80px" alt="cover">
                                    </div>
                                    <div class="col">
                                        <span class="row amaranth-regular"
                                            style="font-size: 16px; color: black;">{{ $book->title }}</span>
                                        <span class="row urbanist-medium"
                                            style="font-size: 12px; color: #7F7F7F;">{{ $book->author }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;"> {{ $book->created_at }}
                            </td>
                            <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;"> {{ $book->created_at }}
                            </td>
                            <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                @switch($book->pivot->status)
                                    @case(config('constants.peminjaman.status.1'))
                                        <span class="badge text-bg-warning">Dalam Proses</span>
                                    @break

                                    @case(config('constants.peminjaman.status.2'))
                                        <span class="badge text-bg-primary">Dipinjam</span>
                                        @break

                                        @case(config('constants.peminjaman.status.3'))
                                            <span class="badge text-bg-danger">Ditolak</span>
                                        @break

                                        @case(config('constants.peminjaman.status.4'))
                                            <span class="badge text-bg-warning">Pengembalian</span>
                                        @break

                                        @case(config('constants.peminjaman.status.5'))
                                            <span class="badge text-bg-danger">Hilang</span>
                                        @break

                                        @case(config('constants.peminjaman.status.6'))
                                            <span class="badge text-bg-success">Dikembalikan</span>
                                        @break

                                        @default
                                            <span class="badge text-bg-primary">Dalam Proses</span>
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
