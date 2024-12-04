@extends('layouts.admin')

@section('header')
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/editors/quill/katex.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/editors/quill/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/animate/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-quill-editor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/page-blog.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
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
                            <h2 class="content-header-title float-start mb-0">User Detail</h2>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Blog Edit -->
                <div class="blog-edit-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-75">
                                            @if (Auth::user()->image != null)
                                                <img src="{{asset('storage/gambar/profil/'.Auth::user()->image)}}" width="38" height="38" alt="Avatar" />
                                            @else
                                                <img src="{{asset('app-assets/images/portrait/small/avatar-s-9.jpg')}}" width="38" height="38" alt="Avatar" />
                                            @endif
                                        </div>
                                        <div class="author-info">
                                            <h6 class="mb-25">{{Auth::user()->name}}</h6>
                                            @php
                                                use Carbon\Carbon;
                                            @endphp
                                            <p class="card-text">{{ Carbon::now()->format('F j, Y') }}</p>
                                        </div>
                                    </div>
                                    <!-- Form -->
                                    {{-- @if ($errors->any())
                                        <br>
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Error</h4>
                                            <div class="alert-body">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif --}}
                                    <form action="" method="" class="mt-2" enctype="multipart/form-data">
                                        {{-- @csrf --}}
                                        {{-- first line --}}
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="name">Nama</label>
                                                    <input type="text" id="name" class="form-control" name="name" autocomplete="false" value="{{$user->name}}" disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="emaila">Email</label>
                                                    <input type="email" id="email" class="form-control" name="email" autocomplete="false" value="{{$user->email}}" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- second line --}}
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="password">Password</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="false" disabled/>
                                                        <div class="input-group-text cursor-pointer">
                                                            <i data-feather="eye"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="mb-2">
                                                    <label class="form-label" for="role">Role</label>
                                                    <select name="role" id="role" class="form-select" disabled>
                                                        <option value="Admin"  @if($user->role == 'Admin') selected @endif>Petugas Perpustakaan</option>
                                                        <option value="PenanggungJawab"  @if($user->role == 'PenanggungJawab') selected @endif>Penanggung Jawab Perpustakaan</option>
                                                        <option value="KepalaSekolah"  @if($user->role == 'KepalaSekolah') selected @endif>Kepala Sekolah</option>
                                                        <option value="Administrasi"  @if($user->role == 'Administrasi') selected @endif>Administrasi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="password">NIP</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="text" class="form-control" id="NIP" name="NIP" placeholder="NIP" autocomplete="false" value="{{$user->NIP}}" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="password">Tanggal Lahir</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal_lahir" autocomplete="false" value="{{substr($user->tanggal_lahir, 0, 10)}}" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="password">Alamat</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" autocomplete="false" value="{{$user->alamat}}" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="password">Jabatan</label>
                                                    <div class="input-group form-password-toggle input-group-merge">
                                                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="jabatan" autocomplete="false" value="{{$user->jabatan}}" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="mb-2">
                                                    <label class="form-label" for="status">Status</label>
                                                    <select name="status" id="status" class="form-select" disabled>
                                                        <option value="aktif" @if($user->status == 'aktif') selected @endif>Aktif</option>
                                                        <option value="non-aktif" @if($user->status == 'non-aktif') selected @endif>Non-Aktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- image --}}
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div class="border rounded p-2">
                                                    <h4 class="mb-1">ProfileImage</h4>
                                                    <div class="d-flex flex-column flex-md-row">
                                                        @if ($user->image != null)
                                                            <img src="{{asset('storage/gambar/profil/'.$user->image)}}" id="blog-feature-image" class="rounded me-2 mb-1 mb-md-0" width="110" height="110" alt="Blog Featured Image"/>
                                                        @else
                                                            <img src="{{asset('app-assets/images/portrait/small/avatar-s-11.jpg')}}" id="blog-feature-image" class="rounded me-2 mb-1 mb-md-0" width="110" height="110" alt="Blog Featured Image" />
                                                        @endif
                                                        <div class="featured-info">
                                                            <small class="text-muted">Required image resolution 400x400, image size 2mb.</small>
                                                            <p class="my-50">
                                                                <a id="blog-image-text">C:\fakepath\banner.jpg</a>
                                                            </p>
                                                            <div class="d-inline-block">
                                                                <input class="form-control" type="file" name="image" id="blogCustomFile" accept="image/*"  disabled/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- button --}}
                                        {{-- <div class="row">
                                            <div class="col-12 mt-50">
                                                <button type="submit" class="btn btn-primary me-1">Save Changes</button>
                                                <a type="reset" class="btn btn-outline-secondary" href="{{url()->previous()}}">Cancel</a>
                                            </div>
                                        </div> --}}
                                    </form>
                                    <!--/ Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Blog Edit -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('script')

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/editors/quill/quill.min.js')}}"></script> --}}
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{asset('app-assets/js/scripts/pages/page-blog-edit.js')}}"></script> --}}
    <script src="{{asset('app-assets/js/scripts/pages/page-portofolio-create.js')}}"></script>
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

@endsection
