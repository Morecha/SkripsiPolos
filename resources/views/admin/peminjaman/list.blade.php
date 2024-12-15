@extends('layouts.admin')

@section('header')
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->
    <style>
        .custom-list {
            list-style-type: none;
            padding: 0;
        }
        .custom-list li {
            display: flex;
        }
        .custom-list li::before {
            content: '*';
            margin-right: 8px;
        }
        .custom-list .label {
            min-width: 100px; /* Adjust width as needed */
        }
        .hidden {
            display: none;
        }
    </style>
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Peminjaman</h2>
                            @if (session('error') or $errors->any())
                                <div id="type-gagal" class="alert alert-danger" style="display: none;">
                                </div>
                            @endif
                            @if (session('warning'))
                                <div id="type-warning" class="alert alert-warning" style="display: none;">
                                </div>
                            @endif
                            @if (session('success'))
                                <div id="type-success" class="alert alert-success" style="display: none;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Peminjaman List</h4>
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive table-hover" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Jenis Peminjaman</th>
                                                <th>Nama Peminjam</th>
                                                <th>jumlah buku</th>
                                                <th>Lama Peminjaman</th>
                                                <th>Kode Buku</th>
                                                <th>Mulai Peminjaman</th>
                                                <th>options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($peminjaman as $data)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $data->jenis_peminjaman }}</td>
                                                    @if ($data->jenis_peminjaman == 'kelompok')
                                                        <td>{{ $data->id_user }}</td>
                                                    @else
                                                        <td>{{ $data->id_anggota }}</td>
                                                    @endif
                                                    <td>{{ $data->pivot_count }}</td>
                                                    <td>{{ $data->lama_peminjaman }}</td>
                                                    {{-- <td>{{$data->id}}</td> --}}
                                                    <td>
                                                        <div class="scrolling-inside-modal">
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-sm btn-flat-info waves-effect" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable{{ $data->id }}">
                                                                Detail
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModalScrollable{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Daftar Buku yang dipinjam</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <ul class="custom-list">
                                                                                    @foreach ($data->pivot as $q)
                                                                                        {{-- {{$q->kode_buku}} --}}
                                                                                        <li><span class="label">{{$q->buku->kode_buku}}</span></li>
                                                                                    @endforeach
                                                                            </ul>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $data->created_at }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('peminjaman.detail', $data->id) }}">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>Detail Peminjaman</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('peminjaman.edit',$data->id) }}">
                                                                    <i data-feather="edit-2" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('pengembalian.create',$data->id) }}">
                                                                    <i data-feather="bookmark" class="me-50"></i>
                                                                    <span>Pengembalian</span>
                                                                </a>
                                                                <a class="dropdown-item delete-button"
                                                                    href="{{route('peminjaman.delete', $data->id)}}"
                                                                    data-id="{{ $data->id }}">
                                                                    <i data-feather="trash" class="me-50"></i>
                                                                    <form id="delete-form-{{ $data->id }}" method="POST" action="{{route('peminjaman.delete', $data->id)}}" style="display: none;">
                                                                        @csrf
                                                                    </form>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- <td class="hidden">
                                                        @foreach ($peminjaman as $p)
                                                            @foreach ($p->pivot as $q)
                                                                {{$q->kode_buku}}
                                                            @endforeach
                                                        @endforeach
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--/ Ajax Sourced Server-side -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('script')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('app-assets/js/scripts/pages/app-invoice-list.js')}}"></script> --}}
    {{-- <script src="{{ asset('app-assets/js/scripts/pages/datatables-demo.js') }}"></script> --}}
    <script src="{{asset('app-assets/js/scripts/components/components-modals.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        $(document).ready(function() {
            var gagal = $('#type-gagal');
            if (gagal.length) {
                Swal.fire({
                    title: 'Gagal !',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false,
                    background: '#283046', // Warna latar belakang Vuexy Dark
                    color: '#d0d2d6',     // Warna teks default Vuexy
                    // Opsional: Sesuaikan warna ikon untuk tema gelap
                    iconColor: '#ea5455',
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var gagal = $('#type-warning');
            if (gagal.length) {
                Swal.fire({
                    title: 'Warning !',
                    text: '{{ session('warning') }}',
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false,
                    background: '#283046', // Warna latar belakang Vuexy Dark
                    // color: '#d0d2d6',     // Warna teks default Vuexy
                    // // Opsional: Sesuaikan warna ikon untuk tema gelap
                    // iconColor: '#ea5455',
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var gagal = $('#type-success');
            if (gagal.length) {
                Swal.fire({
                    title: 'Success !',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false,
                    background: '#283046', // Warna latar belakang Vuexy Dark
                    // color: '#d0d2d6',     // Warna teks default Vuexy
                    // // Opsional: Sesuaikan warna ikon untuk tema gelap
                    // iconColor: '#ea5455',
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                confirmDelete(id);
            });
            $('.datatables-ajax').dataTable({
                dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                // columnDefs: [
                //     {
                //         targets: [7],
                //         visible: false,
                //         searchable: true,
                //     },
                // ],
            });
        });

        table.on('draw', function() {
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                confirmDelete(id);
            });
        })

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false,
                background: '#283046', // Warna latar belakang Vuexy Dark
                color: '#d0d2d6',     // Warna teks default Vuexy
                // Opsional: Sesuaikan warna ikon untuk tema gelap
                iconColor: '#ea5455',
            }).then(function(result) {
                if (result.value) {
                    // Tidak lagi submit form secara otomatis di sini
                    // Form akan di-submit hanya jika pengguna menekan tombol "Yes"
                    document.getElementById('delete-form-' + id).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your data is safe :)',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        },
                        background: '#283046', // Warna latar belakang Vuexy Dark
                        color: '#d0d2d6',     // Warna teks default Vuexy
                        // Opsional: Sesuaikan warna ikon untuk tema gelap
                        iconColor: '#ea5455',
                    });
                }
            });
        }
    </script>

    {{-- <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                columnDefs: [
                    {
                        targets: [3], // Indeks kolom yang ingin disembunyikan
                        visible: false, // Sembunyikan kolom
                        searchable: true, // Tetap dapat dicari
                    },
                ],
            });
        });
    </script> --}}
@endsection
