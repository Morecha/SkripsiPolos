@extends('layouts.admin')

@section('header')
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">

    {{-- try leaflet --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/maps/leaflet.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-ecommerce.css')}}">

    {{-- try leaflet --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/maps/map-leaflet.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <script>
        window.chartData = @json($chartData);
    </script>
@endsection

<!-- BEGIN: Body-->

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <div class="col-lg-8 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h4 class="card-title">Statistics</h4>
                                        <span class="card-subtitle text-muted">Commercial networks and enterprises</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas class="line-chart-ex chartjs" data-height="300"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Report Card -->
                        <div class="col-lg-4 col-12">
                            <div class="row match-height">
                                <!-- Bar Chart - Orders -->
                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-success p-50 m-0">
                                                <div class="avatar-content">
                                                    <i data-feather="book" class="font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="fw-bolder mt-1">{{ $buku }}</h2>
                                            <p class="card-text">Total Buku</p><br>
                                        </div>
                                        <div id="gained-chart"></div>
                                    </div>
                                </div>
                                <!--/ Bar Chart - Orders -->

                                <!-- Line Chart - Profit -->
                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-warning p-50 m-0">
                                                <div class="avatar-content">
                                                    <i data-feather="archive" class="font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="fw-bolder mt-1">{{$inventaris}}</h2>
                                            <p class="card-text">Inventaris</p><br>
                                        </div>
                                        <div id="gained-chart"></div>
                                    </div>
                                </div>
                                <!--/ Line Chart - Profit -->

                                <!-- Earnings Card -->
                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-info p-50 m-0">
                                                <div class="avatar-content">
                                                    <i data-feather="users" class="font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="fw-bolder mt-1">{{$anggota}}</h2>
                                            <p class="card-text">Anggota</p><br>
                                        </div>
                                        <div id="gained-chart"></div>
                                    </div>
                                </div>
                                <!--/ Earnings Card -->

                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start pb-0">
                                            <div class="avatar bg-light-primary p-50 m-0">
                                                <div class="avatar-content">
                                                    <i data-feather="shopping-bag" class="font-medium-5"></i>
                                                </div>
                                            </div>
                                            <h2 class="fw-bolder mt-1">{{$pengadaan}}</h2>
                                            <p class="card-text">Pengadaan</p><br>
                                        </div>
                                        <div id="gained-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Revenue Report Card -->
                    </div>

                    <!-- List DataTable -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card invoice-list-wrapper">
                                <div class="card-datatable table-responsive">
                                    <table class="invoice-list-table table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Jenis Peminjaman</th>
                                                <th>Nama</th>
                                                <th>Total</th>
                                                <th>lama peminjaman</th>
                                                <th>tanggal Mulai</th>
                                                <th>Tanggal Akhir</th>
                                                <th>tenggat waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($tabel_peminjaman as $tabel_peminjaman)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $tabel_peminjaman->jenis_peminjaman }}</td>
                                                <td>{{ $tabel_peminjaman->nama_peminjaman }}</td>
                                                <td>{{ $tabel_peminjaman->jumlah_buku }}</td>
                                                <td>{{ $tabel_peminjaman->lama_peminjaman }}</td>
                                                <td>{{ $tabel_peminjaman->created_at }}</td>
                                                <td>{{ $tabel_peminjaman->due_date }}</td>
                                                <td>
                                                    @php
                                                        $isLate = str_contains($tabel_peminjaman->tenggat_waktu, '-');
                                                    @endphp
                                                    <span class="badge {{ $isLate ? 'badge-light-danger' : 'badge-light-warning' }}">
                                                        {{ $tabel_peminjaman->tenggat_waktu }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ List DataTable -->

                    {{-- <div class="row match-height">
                        <!-- Avg Sessions Chart Card starts -->
                        <div class="col-lg-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row pb-50">
                                        <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                            <div class="mb-1 mb-sm-0">
                                                <h2 class="fw-bolder mb-25">2.7K</h2>
                                                <p class="card-text fw-bold mb-2">Avg Sessions</p>
                                                <div class="font-medium-2">
                                                    <span class="text-success me-25">+5.2%</span>
                                                    <span>vs last 7 days</span>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary">View Details</button>
                                        </div>
                                        <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1">
                                            <div class="dropdown chart-dropdown">
                                                <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Last 7 Days
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem5">
                                                    <a class="dropdown-item" href="#">Last 28 Days</a>
                                                    <a class="dropdown-item" href="#">Last Month</a>
                                                    <a class="dropdown-item" href="#">Last Year</a>
                                                </div>
                                            </div>
                                            <div id="avg-sessions-chart"></div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row avg-sessions pt-50">
                                        <div class="col-6 mb-2">
                                            <p class="mb-50">Goal: $100000</p>
                                            <div class="progress progress-bar-primary" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <p class="mb-50">Users: 100K</p>
                                            <div class="progress progress-bar-warning" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100" style="width: 60%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-50">Retention: 90%</p>
                                            <div class="progress progress-bar-danger" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100" style="width: 70%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-50">Duration: 1yr</p>
                                            <div class="progress progress-bar-success" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width: 90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Avg Sessions Chart Card ends -->

                        <!-- Support Tracker Chart Card starts -->
                        <div class="col-lg-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between pb-0">
                                    <h4 class="card-title">Support Tracker</h4>
                                    <div class="dropdown chart-dropdown">
                                        <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 7 Days
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem4">
                                            <a class="dropdown-item" href="#">Last 28 Days</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                            <h1 class="font-large-2 fw-bolder mt-2 mb-0">163</h1>
                                            <p class="card-text">Tickets</p>
                                        </div>
                                        <div class="col-sm-10 col-12 d-flex justify-content-center">
                                            <div id="support-trackers-chart"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-1">
                                        <div class="text-center">
                                            <p class="card-text mb-50">New Tickets</p>
                                            <span class="font-large-1 fw-bold">29</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="card-text mb-50">Open Tickets</p>
                                            <span class="font-large-1 fw-bold">63</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="card-text mb-50">Response Time</p>
                                            <span class="font-large-1 fw-bold">1d</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Support Tracker Chart Card ends -->
                    </div>

                    <div class="row match-height">
                        <!-- Timeline Card -->
                        <div class="col-lg-4 col-12">
                            <div class="card card-user-timeline">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" class="user-timeline-title-icon"></i>
                                        <h4 class="card-title">User Timeline</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="timeline ms-50">
                                        <li class="timeline-item">
                                            <span class="timeline-point timeline-point-indicator"></span>
                                            <div class="timeline-event">
                                                <h6>12 Invoices have been paid</h6>
                                                <p>Invoices are paid to the company</p>
                                                <div class="d-flex align-items-center">
                                                    <img class="me-1" src="../../../app-assets/images/icons/json.png" alt="data.json" height="23" />
                                                    <h6 class="more-info mb-0">data.json</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-item">
                                            <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                                            <div class="timeline-event">
                                                <h6>Client Meeting</h6>
                                                <p>Project meeting with Carl</p>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-50">
                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-9.jpg" alt="Avatar" width="38" height="38" />
                                                    </div>
                                                    <div class="more-info">
                                                        <h6 class="mb-0">Carl Roy (Client)</h6>
                                                        <p class="mb-0">CEO of Infibeam</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-item">
                                            <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                            <div class="timeline-event">
                                                <h6>Create a new project</h6>
                                                <p>Add files to new design folder</p>
                                                <div class="avatar-group">
                                                    <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Billy Hopkins" class="avatar pull-up">
                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-9.jpg" alt="Avatar" width="33" height="33" />
                                                    </div>
                                                    <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Amy Carson" class="avatar pull-up">
                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-6.jpg" alt="Avatar" width="33" height="33" />
                                                    </div>
                                                    <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Brandon Miles" class="avatar pull-up">
                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-8.jpg" alt="Avatar" width="33" height="33" />
                                                    </div>
                                                    <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Daisy Weber" class="avatar pull-up">
                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" width="33" height="33" />
                                                    </div>
                                                    <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Jenny Looper" class="avatar pull-up">
                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-20.jpg" alt="Avatar" width="33" height="33" />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-item">
                                            <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                            <div class="timeline-event">
                                                <h6>Update project for client</h6>
                                                <p class="mb-0">Update files as per new design</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/ Timeline Card -->

                        <!-- Sales Stats Chart Card starts -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-start pb-1">
                                    <div>
                                        <h4 class="card-title mb-25">Sales</h4>
                                        <p class="card-text">Last 6 months</p>
                                    </div>
                                    <div class="dropdown chart-dropdown">
                                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Last 28 Days</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-inline-block me-1">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="circle" class="font-small-3 text-primary me-50"></i>
                                            <h6 class="mb-0">Sales</h6>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="circle" class="font-small-3 text-info me-50"></i>
                                            <h6 class="mb-0">Visits</h6>
                                        </div>
                                    </div>
                                    <div id="sales-visit-chart" class="mt-50"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Sales Stats Chart Card ends -->

                        <!-- App Design Card -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card card-app-design">
                                <div class="card-body">
                                    <span class="badge badge-light-primary">03 Sep, 20</span>
                                    <h4 class="card-title mt-1 mb-75 pt-25">App design</h4>
                                    <p class="card-text font-small-2 mb-2">
                                        You can Find Only Post and Quotes Related to IOS like ipad app design, iphone app design
                                    </p>
                                    <div class="design-group mb-2 pt-50">
                                        <h6 class="section-label">Team</h6>
                                        <span class="badge badge-light-warning me-1">Figma</span>
                                        <span class="badge badge-light-primary">Wireframe</span>
                                    </div>
                                    <div class="design-group pt-25">
                                        <h6 class="section-label">Members</h6>
                                        <div class="avatar">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-9.jpg" width="34" height="34" alt="Avatar" />
                                        </div>
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content">PI</div>
                                        </div>
                                        <div class="avatar">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-14.jpg" width="34" height="34" alt="Avatar" />
                                        </div>
                                        <div class="avatar">
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" width="34" height="34" alt="Avatar" />
                                        </div>
                                        <div class="avatar bg-light-secondary">
                                            <div class="avatar-content">AL</div>
                                        </div>
                                    </div>
                                    <div class="design-planning-wrapper mb-2 py-75">
                                        <div class="design-planning">
                                            <p class="card-text mb-25">Due Date</p>
                                            <h6 class="mb-0">12 Apr, 21</h6>
                                        </div>
                                        <div class="design-planning">
                                            <p class="card-text mb-25">Budget</p>
                                            <h6 class="mb-0">$49251.91</h6>
                                        </div>
                                        <div class="design-planning">
                                            <p class="card-text mb-25">Cost</p>
                                            <h6 class="mb-0">$840.99</h6>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary w-100">Join Team</button>
                                </div>
                            </div>
                        </div>
                        <!--/ App Design Card -->
                    </div> --}}


                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('script')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    {{-- try leaflet --}}
    <script src="{{ asset('app-assets/vendors/js/maps/leaflet.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/charts/chart-chartjs.js') }}"></script>
    {{-- <script src="{{asset('app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script> --}}
    {{-- <script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script> --}}
    {{-- <script src="{{asset('app-assets/js/scripts/pages/app-invoice-list.js')}}"></script> --}}

    {{-- try leaflet --}}
    <script src="{{ asset('app-assets/js/scripts/maps/map-leaflet.js') }}"></script>
    <!-- END: Page JS-->

@endsection
