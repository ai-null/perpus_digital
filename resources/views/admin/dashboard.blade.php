@extends('components.admin.head')

@section('head')
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
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
                    <div class="col"> <!--begin::Small Box Widget 1-->
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>{{ $general['request'] }}</h3>
                                <p>Request Peminjaman Baru</p>
                            </div>
                        </div> <!--end::Small Box Widget 1-->
                    </div> <!--end::Col-->
                    <div class="col"> <!--begin::Small Box Widget 3-->
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ $general['borrowed'] }}</h3>
                                <p>Buku Dipinjam</p>
                            </div>
                        </div> <!--end::Small Box Widget 3-->
                    </div> <!--end::Col-->
                    <div class="col"> <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                {{-- <h3>53<sup class="fs-5">%</sup></h3> --}}
                                <h3>{{ $general['accepted'] }}</h3>
                                <p>Peminjaman Buku Sukses</p>
                            </div>
                        </div> <!--end::Small Box Widget 2-->
                    </div> <!--end::Col-->
                    <div class="col"> <!--begin::Small Box Widget 4-->
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>{{ $general['vanished'] }}</h3>
                                <p>Buku Hilang</p>
                            </div>
                        </div> <!--end::Small Box Widget 4-->
                    </div> <!--end::Col-->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info mb-3">
                            <strong>Data diambil pada: 
                                {{ date('F j', strtotime($compareDate)) }}
                                - 
                                {{ date('F j, Y', strtotime($today)) }}
                            </strong>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Buku paling populer</div>
                            </div>
                            <div id="column-chart-book"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kategori paling populer</h3>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div id="pie-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col -->

                    <div class="col col-auto col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Pembaca terbanyak</div>
                            </div>
                            <div id="column-chart"></div>
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
                idx: 0,
                dir: 'desc'
            }
        });

        //-------------
        // - PIE CHART -
        //-------------
        const pie_chart_options = {
            series: [
                @foreach ($popularCategories as $category)
                    {{ $category->borrowed }},
                @endforeach
            ],
            chart: {
                type: "donut",
            },
            labels: [
                @foreach ($popularCategories as $category)
                    '{{ $category->category }}',
                @endforeach
            ],
            dataLabels: {
                enabled: false,
            },
            colors: [
                "#0d6efd",
                "#20c997",
                "#ffc107",
                "#d63384",
                "#6f42c1",
                "#adb5bd",
            ],
        };

        const pie_chart = new ApexCharts(
            document.querySelector("#pie-chart"),
            pie_chart_options,
        );
        pie_chart.render();

        //-----------------
        // - END PIE CHART -
        //-----------------


        //-------------
        // - COLUMN CHART PEMBACA -
        //-------------
        const columnChartOptions = {
            chart: {
                type: "bar",
            },
            series: [{
                data: [
                    @foreach ($popularUser as $user)
                        {
                            x: '{{ $user->name }}',
                            y: {{ $user->borrowed }},
                        },
                    @endforeach
                ]
            }]
        };

        const columnChart = new ApexCharts(
            document.querySelector("#column-chart"),
            columnChartOptions,
        );
        columnChart.render();

        //-----------------
        // - END COLUMN CHART PEMBACA -
        //-----------------

        //-------------
        // - COLUMN CHART BUKU -
        //-------------
        const columnChartBookOptions = {
            chart: {
                type: "bar",
                height: '400px' 
            },
            series: [{
                data: [
                    @foreach ($popularBook as $book)
                        {
                            x: '{{ $book->title }}',
                            y: {{ $book->borrowed }},
                        },
                    @endforeach
                ]
            }]
        };

        const columnChartBook = new ApexCharts(
            document.querySelector("#column-chart-book"),
            columnChartBookOptions,
        );
        columnChartBook.render();

        //-----------------
        // - END COLUMN CHART BUKU -
        //-----------------
    </script>
@endsection
