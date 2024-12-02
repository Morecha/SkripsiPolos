@extends('layouts.admin')

@section('header')
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-file-uploader.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
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
                            <h2 class="content-header-title float-start mb-0">Tambah Anggota Masal</h2>
                            @if (session('error'))
                                <div id="type-gagal" class="alert alert-danger" style="display: none;">
                                </div>
                            @endif
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Dropzone section start -->
                <section id="dropzone-examples">
                    <!-- single file upload starts -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Single File Upload</h4>
                                </div>
                                <div class="card-body">
                                    {{-- <p class="card-text">
                                        By default, dropzone is a multiple file uploader and does not have specific option allowing us to switch to
                                        single file uploading mode, but this functionality can be achieved by adding more options to the plugin
                                        settings, such as
                                        <code>maxfilesexceeded</code> callback and <code>maxFiles</code> option set to 1.
                                        <code>maxFiles: 1</code> is used to tell dropzone that there should be only one file.
                                    </p>
                                    <button id="select-files" class="btn btn-outline-primary mb-1">
                                        <i data-feather="file"></i> Click me to select files
                                    </button>
                                    <form action="{{route('anggota.store_masal')}}" class="dropzone dropzone-area" id="dpz-single-file" method="POST" enctype="multipart/form-data">
                                        <div class="dz-message">Drop files here or click to upload.</div>
                                    </form> --}}
                                    <form action="{{route('anggota.store_masal')}}" class="mt-2" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="data">Upload File</label>
                                                    <input type="file" id="data" class="form-control" name="data" autocomplete="false"/>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- button --}}
                                        <div class="row">
                                            <div class="col-12 mt-50">
                                                <button type="submit" class="btn btn-primary me-1">Save Changes</button>
                                                <a type="reset" class="btn btn-outline-secondary" href="{{url()->previous()}}">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single file upload ends -->
                </section>
                <!-- Dropzone section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('script')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/file-uploaders/dropzone.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/forms/form-file-uploader.js')}}"></script>
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
                    buttonsStyling: false,
                    background: '#283046', // Warna latar belakang Vuexy Dark
                    color: '#d0d2d6',     // Warna teks default Vuexy
                    // Opsional: Sesuaikan warna ikon untuk tema gelap
                    iconColor: '#ea5455',
                });
            }
        });
    </script>
@endsection
