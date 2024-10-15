@extends('components.admin.head')

@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
@endsection

@section('content')
    {{-- CONTENT --}}
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Peminjaman</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Peminjaman
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                <div class="card">
                    <div class="card-body">
                        <div class="container mt-5" style=" padding-bottom: 48px;">
                            <div style="margin-top: 28px;">
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-4 alert-dismissible" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <table id="myTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No. Peminjaman</th>
                                            <th>Info Buku</th>
                                            <th>Nama Siswa</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($peminjaman as $data)
                                            <tr>
                                                <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                                    <b>#{{ $data->id }}</b>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="{{ env('COVER_PATH') . $data->cover }}"
                                                                width="100%" alt="cover">
                                                        </div>
                                                        <div class="col-auto col-8" style="overflow: hidden">
                                                            <span class="row amaranth-regular"
                                                                style="font-size: 16px; color: black;">{{ $data->title }}</span>
                                                            <span class="row urbanist-medium"
                                                                style="font-size: 12px; color: #7F7F7F;">{{ $data->author }}</span>
                                                            <span class="row urbanist-medium"
                                                                style="font-size: 12px; color: #7F7F7F;">ISBN :
                                                                {{ $data->isbn }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                                    {{ $data->name }}
                                                </td>
                                                <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                                    {{  date('F j, Y', strtotime($data->created_at)) }}
                                                </td>
                                                <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                                    {{  date('F j, Y', strtotime($data->return_at)) }}
                                                </td>
                                                <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                                    @switch($data->status)
                                                        @case(config('constants.peminjaman.status.0'))
                                                            <span class="badge text-bg-danger">Dibatalkan</span>
                                                        @break

                                                        @case(config('constants.peminjaman.status.1'))
                                                            <span class="badge text-bg-warning">Pengajuan</span>
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

                                                    @if ($data->is_late)
                                                        <span class="badge text-bg-danger">Pengembalian telat</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->status == config('constants.peminjaman.status.1'))
                                                        <div class="row">
                                                            <div class="col">
                                                                <form action="{{ route('peminjaman.update') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="status"
                                                                        value="{{ base64_encode(config('constants.peminjaman.status.2')) }}">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $data->id }}">
                                                                    <button style="font-size: 14px;"
                                                                        class="btn btn-success">Terima</button>
                                                                </form>
                                                            </div>
                                                            <div class="col">
                                                                <form action="{{ route('peminjaman.update') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="status"
                                                                        value="{{ base64_encode(config('constants.peminjaman.status.3')) }}">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $data->id }}">
                                                                    <button style="font-size: 14px;"
                                                                        class="btn btn-danger mt-2">Tolak</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @elseif ($data->status == config('constants.peminjaman.status.2'))
                                                        <div class="row">
                                                            <div class="col">
                                                                <form action="{{ route('peminjaman.update') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="status"
                                                                        value="{{ base64_encode(config('constants.peminjaman.status.6')) }}">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $data->id }}">
                                                                    <button style="font-size: 14px;"
                                                                        class="btn btn-success">Buku dikembalikan</button>
                                                                </form>
                                                            </div>
                                                            <div class="col">
                                                                <form action="{{ route('peminjaman.update') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="status"
                                                                        value="{{ base64_encode(config('constants.peminjaman.status.5')) }}">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $data->id }}">
                                                                    <button style="font-size: 14px;"
                                                                        class="btn btn-danger mt-2">Buku hilang</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
                <script>
                    new DataTable('#myTable', {
                        order: {
                            idx: 4,
                            dir: 'desc'
                        }
                    });
                </script>

            </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>
@endsection
