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
                            <h2 class="content-header-title float-start mb-0">Inventaris</h2>
                            @if (session('error') or $errors->any())
                            <h1>error masuk</h1>
                                <div id="type-gagal" class="alert alert-danger" style="display: none;">
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
                                    <h4 class="card-title">Inventaris List</h4>
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>judul</th>
                                                <th>kode buku</th>
                                                <th>jumlah buku</th>
                                                <th>buku terdaftar</th>
                                                <th>status</th>
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
                                                    {{-- <td></td> --}}
                                                    <td>{{ $data->judul }}</td>
                                                    <td>{{ $data->kode_ddc }}</td>
                                                    <td>{{ $data->eksemplar }}</td>
                                                    <td>{{ $data->buku_count }}</td>
                                                    <td>
                                                        <span class="badge badge-light-warning">{{ $data->status }}</span>
                                                    </td>
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
                                                                                {{-- <li><span class="label">pengadaan</span> = {{$data->id_pengadaan}}</li> --}}
                                                                                <li><span class="label">pengarang</span> = {{$data->pengarang}}</li>
                                                                                <li><span class="label">penerbit</span> = {{$data->penerbit}}</li>
                                                                                <li><span class="label">kode buku</span> = {{$data->kode_ddc}}</li>
                                                                                <li><span class="label">status</span> = {{$data->status}}</li>
                                                                                <li><span class="label">eksemplar</span> = {{$data->eksemplar}}</li>
                                                                                <li><span class="label">tangga masuk</span> = {{$data->created_at}}</li>
                                                                                <li><span class="label">Deskripsi</span> = {!!$data->deskripsi!!}</li>
                                                                                @if ($data->image != null)
                                                                                    <li><span class="label">Image</span> =
                                                                                        <img src="{{asset('storage/gambar/inventaris/'.$data->image)}}" id="blog-feature-image" class="rounded me-2 mb-1 mb-md-0" width="110" height="110" alt="Blog Featured Image" style="margin: 10px;"/>
                                                                                    </li>
                                                                                @endif
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
                                                                    href="{{ route('buku.list',$data->id) }}">
                                                                    <i data-feather="eye" class="me-50"></i>
                                                                    <span>List Buku</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                href="{{route('inventaris.generate', $data->id)}}"
                                                                onclick="event.preventDefault();
                                                                    document.getElementById('generate-form-{{ $data->id }}').submit();">
                                                                    <i data-feather="refresh-cw" class="me-50"></i>
                                                                    <form id="generate-form-{{ $data->id }}" method="POST" action="{{route('inventaris.generate', $data->id)}}" style="display: none;">
                                                                        @csrf
                                                                    </form>
                                                                    <span>Generate Buku</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('buku.list_cetak',$data->id) }}">
                                                                    <i data-feather="printer" class="me-50"></i>
                                                                    <span>Cetak Nomor Buku</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('inventaris.edit',$data->id) }}">
                                                                    <i data-feather="edit-2" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{route('inventaris.delete', $data->id)}}"
                                                                    onclick="event.preventDefault();
                                                                    document.getElementById('delete-form-{{ $data->id }}').submit();">
                                                                    <i data-feather="trash" class="me-50"></i>
                                                                    <form id="delete-form-{{ $data->id }}" method="POST" action="{{route('inventaris.delete', $data->id)}}" style="display: none;">
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
    <script src="{{asset('app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('app-assets/js/scripts/pages/app-invoice-list.js')}}"></script> --}}
    <script src="{{ asset('app-assets/js/scripts/pages/datatables-demo.js') }}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
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
                    buttonsStyling: false
                });
            }
        });
    </script>
@endsection
