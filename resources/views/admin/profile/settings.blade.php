@extends('layouts.admin')

@section('header')
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/animate/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
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
                        <h2 class="content-header-title float-start mb-0">Account Settings</h2>
                        {{-- @if (session('error') or $errors->any())
                            <div id="type-gagal" class="alert alert-danger" style="display: none;">
                            </div>
                        @endif --}}
                        <div class="breadcrumb-wrapper">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- account setting page -->
            <section id="page-account-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column nav-left">
                            <!-- general -->
                            <li class="nav-item">
                                <a class="nav-link active" id="account-pill-general" data-bs-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                    <i data-feather="user" class="font-medium-3 me-1"></i>
                                    <span class="fw-bold">General</span>
                                </a>
                            </li>
                            <!-- change password -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-password" data-bs-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                    <i data-feather="lock" class="font-medium-3 me-1"></i>
                                    <span class="fw-bold">Change Password</span>
                                </a>
                            </li>
                            {{-- <!-- information -->
                            <li class="nav-item">
                                <a class="nav-link" id="account-pill-info" data-bs-toggle="pill" href="#account-vertical-info" aria-expanded="false">
                                    <i data-feather="info" class="font-medium-3 me-1"></i>
                                    <span class="fw-bold">Information</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <!--/ left menu section -->

                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- general tab -->
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                        @if ($errors->any() or session('error'))
                                            <br>
                                            <div class="alert alert-danger" role="alert">
                                                <h4 class="alert-heading">Error</h4>
                                                <div class="alert-body">
                                                    @if($errors->any())
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    @endif
                                                    @if(session()->has('error'))
                                                        <li>{{ session('error') }}</li>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        <form method="POST" enctype="multipart/form-data" class="{{--validate-form--}} mt-2" action="{{route('profile.update', Auth::user()->id)}}">
                                        <!-- header section -->
                                        @csrf
                                            <div class="d-flex">
                                                @if (Auth::user()->image != null)
                                                    <img src="{{asset('storage/gambar/profil/'.Auth::user()->image)}}" id="account-upload-img" class="rounded me-50" alt="profile image" height="80" width="80" />
                                                @else
                                                    <img src="{{asset('app-assets/images/portrait/small/avatar-s-11.jpg')}}" id="account-upload-img" class="rounded me-50" alt="profile image" height="80" width="80" />
                                                @endif
                                                <!-- upload and reset button -->
                                                <div class="mt-75 ms-1">
                                                    <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                                    <input type="file" id="account-upload" hidden accept="image/*" name="image"/>
                                                    <p>Allowed JPG or PNG. Max size of 800kB</p>
                                                </div>
                                                <!--/ upload and reset button -->
                                            </div><br>
                                        <!--/ header section -->

                                        <!-- form -->
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{Auth::user()->name}}" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="name">Role</label>
                                                        <input type="text" class="form-control" id="name" name="" placeholder="Name" value="{{Auth::user()->role}}" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="email">E-mail</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{Auth::user()->email}}" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="name">Jabatan</label>
                                                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Name" value="{{Auth::user()->jabatan}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="email">Alamat</label>
                                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Email" value="{{Auth::user()->alamat}}" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="name">Status</label>
                                                        <input type="text" class="form-control" id="name" name="" placeholder="Name" value="{{Auth::user()->status}}" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="email">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" id="tanggal" name="tanggal_lahir" placeholder="Email" value="{{\Illuminate\Support\Carbon::parse(Auth::user()->tanggal_lahir)->format('Y-m-d')}}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-2 me-1">Save changes</button>
                                                </div>
                                            </div>
                                            <!--/ form -->
                                        </form>
                                    </div>
                                    <!--/ general tab -->

                                    <!-- change password -->
                                    <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                       <!-- form -->
                                        @if ($errors->any() or session('error'))
                                            <br>
                                            <div class="alert alert-danger" role="alert">
                                                <h4 class="alert-heading">Error</h4>
                                                <div class="alert-body">
                                                    @if($errors->any())
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    @endif
                                                    @if(session()->has('error'))
                                                        <li>{{ session('error') }}</li>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        <form class="" action="{{route('profile.update-password', Auth::user()->id)}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="account-old-password">Old Password</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" class="form-control" id="account-old-password" name="password" placeholder="Old Password" />
                                                            <div class="input-group-text cursor-pointer">
                                                                <i data-feather="eye"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="account-new-password">New Password</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" id="account-new-password" name="new_password" class="form-control" placeholder="New Password" />
                                                            <div class="input-group-text cursor-pointer">
                                                                <i data-feather="eye"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                                                        <div class="input-group form-password-toggle input-group-merge">
                                                            <input type="password" class="form-control" id="account-retype-new-password" name="confirm_new_password" placeholder="New Password" />
                                                            <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/ form -->
                                    </div>
                                    <!--/ change password -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ right content section -->
                </div>
            </section>
            <!-- / account setting page -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('script')
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/file-uploaders/dropzone.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/pages/page-account-settings.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>
<!-- END: Page JS-->

<script>
    $(function() {
        // form validation
        $('.validate-form').validate({
            rules: {
                "name": {
                    required: true,
                },
                "email": {
                    required: true,
                    email: true,
                },
                "role": {
                    required: true,
                }
            },
            messages: {
                "name": {
                    required: "Please enter name",
                },
                "email": {
                    required: "Please enter email",
                    email: "Please enter valid email",
                },
                "role": {
                    required: "Please select role",
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            }
        });
    });
</script>

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
