@extends('components.admin.head')

@section('head')
<link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
@endsection

@section('content')
    {{-- CONTENT --}}
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Dashboard
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->

                <div class="row">
                    <div class="col-3">
                        <div> <!--begin::Small Box Widget 1-->
                            <div class="small-box text-bg-warning">
                                <div class="inner">
                                    <h3>{{ $general['request'] }}</h3>
                                    <p>Request Peminjaman Baru</p>
                                </div>
                            </div> <!--end::Small Box Widget 1-->
                        </div> <!--end::Col-->
                        <div> <!--begin::Small Box Widget 3-->
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>{{ $general['borrowed'] }}</h3>
                                    <p>Buku Dipinjam</p>
                                </div>
                            </div> <!--end::Small Box Widget 3-->
                        </div> <!--end::Col-->
                        <div> <!--begin::Small Box Widget 2-->
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    {{-- <h3>53<sup class="fs-5">%</sup></h3> --}}
                                    <h3>{{ $general['accepted'] }}</h3>
                                    <p>Peminjaman Buku Sukses</p>
                                </div>
                            </div> <!--end::Small Box Widget 2-->
                        </div> <!--end::Col-->
                        <div> <!--begin::Small Box Widget 4-->
                            <div class="small-box text-bg-danger">
                                <div class="inner">
                                    <h3>{{ $general['vanished'] }}</h3>
                                    <p>Buku Hilang</p>
                                </div>
                            </div> <!--end::Small Box Widget 4-->
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-auto">
                        {{-- <div class="card text-white bg-primary bg-gradient border-primary mb-4"> --}}
                        <div class="card text-white border-primary mb-4">
                            <div class="card-header border-0">
                                <h3 class="card-title" style="color: black;">Data Peminjaman</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Info Buku</th>
                                            <th>Nama Siswa</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman as $data)
                                            <tr>
                                                <td class="urbanist-medium" style="font-size: 16px; color: #7F7F7F;">
                                                    <b>#{{ $data->id }}</b>
                                                </td>
                                                <td>
                                                    <div class="row row-cols-auto">
                                                        <div class="col-4">
                                                            <img src="{{ env('AWS_STORAGE_PATH') . '/public/covers/' . $data->cover }}"
                                                                width="80px" alt="cover">
                                                        </div>
                                                        <div class="col-7 ms-2">
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
                                                    @switch($data->status)
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
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row (main row) -->
        </div> <!--end::Container-->
        </div> <!--end::App Content-->
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script>
        new DataTable('#myTable', {
            paging: false,
            // scrollCollapse: false,
            scrollY: '300px',
            order: {
                idx: 1,
                dir: 'desc'
            }
        });
    </script>
@endsection
