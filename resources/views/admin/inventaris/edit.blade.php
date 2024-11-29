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

    <style>
        .ck-editor__editable {
            min-height: 250px;
        }

        .ck-content .image {
            max-width: 10%;
            margin: 20px auto;
        }

        .ck.ck-editor {
            background-color: #7367f0;
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
                            <h2 class="content-header-title float-start mb-0">User Create</h2>
                            @if (session('error') or $errors->any())
                                <div id="type-gagal" class="alert alert-danger" style="display: none;">
                                </div>
                            @endif
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
                                    @if ($errors->any())
                                        <br>
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Error</h4>
                                            <div class="alert-body">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{route('inventaris.update',$data->id)}}" method="POST" class="mt-2" enctype="multipart/form-data">
                                        @csrf
                                        {{-- first line --}}
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="judul">Judul</label>
                                                    <input type="text" id="judul" class="form-control" name="judul" autocomplete="false" placeholder="judul" value="{{$data->judul}}"/>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="id_pengajuan">pengajuan</label>
                                                    @if ($data->id_pengajuan != null)
                                                        <input type="text" id="id_pengajuan" class="form-control" name="id_pengajuan" autocomplete="false" value="{{$data->id_pengajuan}}" disabled/>
                                                    @else
                                                        <input type="text" id="id_pengajuan" class="form-control" name="id_pengajuan" autocomplete="false" value="kosong" disabled/>
                                                        <input type="hidden" name="id_pengajuan">
                                                    @endif
                                                </div>
                                            </div> --}}
                                        </div>
                                        {{-- second line --}}
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="pengarang">pengarang</label>
                                                    <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="pengarang" autocomplete="false" value="{{$data->pengarang}}"/>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="mb-2">
                                                    <label class="form-label" for="penerbit">penerbit</label>
                                                    <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="penerbit" autocomplete="false" value="{{$data->penerbit}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="kode_ddc">kode (DDC)</label>
                                                    <input type="text" class="form-control" id="kode_ddc" name="kode_ddc" placeholder="kode_ddc" autocomplete="false" value="{{$data->kode_ddc}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="status">Status</label>
                                                    <input type="text" class="form-control" id="status" name="status" placeholder="status" autocomplete="false" value="{{$data->status}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="eksemplar">eksemplar</label>
                                                    <input type="number" class="form-control" id="eksemplar" name="eksemplar" placeholder="eksemplar" autocomplete="false" value="{{$data->eksemplar}}"
                                                    @if ($pengadaan != null)
                                                        max="{{$pengadaan->eksemplar}}"
                                                    @endif
                                                    @if ($jumlah_buku != null)
                                                        min="{{$jumlah_buku}}"
                                                    @endif
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-2">
                                                    <label class="form-label">deskripsi</label><br>
                                                    <textarea name="deskripsi" id="textarea" cols="30" rows="5">
                                                        {!! $data->deskripsi !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div class="border rounded p-2">
                                                    <h4 class="mb-1">Inventaris Image</h4>
                                                    <div class="d-flex flex-column flex-md-row">
                                                        @if ($data->image == null)
                                                            <img src="{{asset('app-assets/images/book/template/3fe9c8a1dbfb5b3910e306183ec5d669.jpg')}}" id="blog-feature-image" class="rounded me-2 mb-1 mb-md-0" width="110" height="110" alt="Blog Featured Image" />
                                                        @else
                                                            <img src="{{asset('storage/gambar/inventaris/'.$data->image)}}" id="blog-feature-image" class="rounded me-2 mb-1 mb-md-0" width="110" height="110" alt="Blog Featured Image" />
                                                        @endif
                                                        <div class="featured-info">
                                                            <small class="text-muted">image max size 2mb.</small>
                                                            <p class="my-50">
                                                                <a href="#" id="blog-image-text">C:\fakepath\banner.jpg</a>
                                                            </p>
                                                            <div class="d-inline-block">
                                                                <input class="form-control" type="file" name="image" id="blogCustomFile" accept="image/*"/>
                                                            </div>
                                                        </div>
                                                    </div>
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
    <script src="{{ asset('app-assets/vendors/ckeditor5/ckeditor.js') }}"></script>
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

<script>
    ClassicEditor
        .create(document.querySelector('#textarea'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', '|',
                'insertTable', '|',
                'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo', '|',
                'indent', 'outdent',
            ],
        })
        .then(editor => {
            editor.ui.view.editable.element.style.height = '250px';
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
