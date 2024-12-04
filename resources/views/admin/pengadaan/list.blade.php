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
                            <h2 class="content-header-title float-start mb-0">Pengadaan</h2>
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
                                    <h4 class="card-title">Pengadaan List</h4>
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul</th> {{--kasih pop up detail--}}
                                                <th>Total</th>
                                                <th>diterima</th>
                                                <th>status</th>
                                                <th>Kode</th>
                                                <th>Detail</th>
                                                <th>options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($data as $data)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $data->judul }}</td>
                                                    <td>{{ $data->eksemplar }}</td>
                                                    <td>{{ $data->diterima }}</td>
                                                    <td>
                                                        <span class="badge badge-light-warning">{{ $data->status }}</span>
                                                    </td>
                                                    <td><b>{{ $data->kode_ddc }}</b></td>
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
                                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <ul class="custom-list">
                                                                                <li><span class="label">Judul Buku</span> = {{$data->judul}}</li>
                                                                                <li><span class="label">pengarang</span> = {{$data->pengarang}}</li>
                                                                                <li><span class="label">penerbit</span> = {{$data->penerbit}}</li>
                                                                                <li><span class="label">kode buku</span> = {{$data->kode_ddc}}</li>
                                                                                <li><span class="label">status</span> = {{$data->status}}</li>
                                                                                <li><span class="label">eksemplar</span> = {{$data->eksemplar}}</li>
                                                                                <li><span class="label">tangga masuk</span> = {{$data->created_at}}</li>
                                                                                <li><span class="label">Deskripsi</span> = {!!$data->deskripsi!!}</li>
                                                                            </ul>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('pengadaan.edit',$data->id) }}">
                                                                    <i data-feather="edit-2" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                @if ($data->eksemplar-$data->diterima > 0)
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('pengadaan.inventaris',$data->id) }}">
                                                                        <i data-feather="arrow-up-right" class="me-50"></i>
                                                                        <span>Inventaris</span>
                                                                    </a>
                                                                @endif
                                                                <a class="dropdown-item delete-button"
                                                                    href="{{route('pengadaan.delete', $data->id)}}"
                                                                    {{-- onclick="event.preventDefault();
                                                                    document.getElementById('delete-form-{{ $data->id }}').submit();"> --}}
                                                                    data-id="{{ $data->id }}">
                                                                    <i data-feather="trash" class="me-50"></i>
                                                                    <form id="delete-form-{{ $data->id }}" method="POST" action="{{route('pengadaan.delete', $data->id)}}" style="display: none;">
                                                                        @csrf
                                                                    </form>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
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
    <script src="{{asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
    {{-- <script src="{{ asset('app-assets/js/scripts/pages/datatables-demo.js') }}"></script> --}}
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
        $(document).ready(function() {
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                confirmDelete(id);
            });
        });

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
                buttonsStyling: false
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
                        }
                    });
                }
            });
        }
    </script> --}}

    <script>
        $(document).ready(function() {
            var gagal = $('#type-gagal');
            if (gagal.length) {
                Swal.fire({
                    title: 'Gagal !',
                    text: '{{ session('error') }}',
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }
        });
    </script>
@endsection
