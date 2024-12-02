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
                            <h2 class="content-header-title float-start mb-0">Edit Peminjaman</h2>
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

                                    <form action="{{route('peminjaman.update', $dipinjam->id)}}" method="POST" class="mt-2" enctype="multipart/form-data">
                                        @csrf
                                        {{-- first line --}}
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="jenis_peminjaman">Jenis Peminjaman</label>
                                                    <select class="form-select" id="jenis_peminjaman" name="jenis_peminjaman" disabled>
                                                            <option value="individu" {{ $dipinjam->jenis_peminjaman == 'individu' ? 'selected' : '' }}>Individu</option>
                                                            <option value="kelompok" {{ $dipinjam->jenis_peminjaman == 'kelompok' ? 'selected' : '' }}>Kelompok</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="id_anggota">Peminjam</label>
                                                    {{-- <input type="text" id="id_anggota" class="form-control" name="id_anggota" autocomplete="off" placeholder="Anggota"/> --}}
                                                    <select class="select2 form-select" name="id_anggota" id="select2" {{ $dipinjam->jenis_peminjaman == 'individu' ? '' : 'disabled' }}>
                                                        @if ($dipinjam->jenis_peminjaman == 'kelompok')
                                                            <option value="{{ $dipinjam->user->id }}" selected>{{ $dipinjam->user->name }}</option>
                                                        @else
                                                            <!-- Default untuk individu -->
                                                            <option value="{{$dipinjam->anggota->id}}">{{$dipinjam->anggota->name}}</option>
                                                            @foreach ($list_anggota as $isi)
                                                                <option value="{{$isi->id}}" @if ($isi->status != 'aktif') disabled @endif">
                                                                    {{$isi->name}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" id="id_user" name="id_user" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="lama_peminjaman">Lama Peminjaman (hari)</label>
                                                    <input type="number" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" autocomplete="lama_peminjaman" value="{{ $dipinjam->lama_peminjaman }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" for="select2-nested">Kode Buku</label>
                                                <div id="kodeBukuContainer">
                                                    <!-- Wrapper untuk duplikasi select -->
                                                    @foreach ($dipinjam->pivot as $index => $item)
                                                    <div class="kode-buku-group mb-2">
                                                        <select class="select2 form-select" name="id_buku[]" id="select2-nested-{{$index}}">
                                                            <option value="{{$item->buku->id}}" selected>{{$item->buku->kode_buku}}</option>
                                                                @php
                                                                    $judul = '';
                                                                @endphp
                                                                @foreach ($buku as $bukuItem)
                                                                    @if ($judul != $bukuItem->inventaris->judul)
                                                                        <optgroup label="{{$bukuItem->inventaris->judul}}">
                                                                    @endif
                                                                    <option value="{{$bukuItem->id}}" @if ($bukuItem->posisi != 'ada') disabled @endif>
                                                                        {{$bukuItem->kode_buku}}
                                                                    </option>
                                                                    @if ($judul != $bukuItem->inventaris->judul)
                                                                        </optgroup>
                                                                        @php
                                                                            $judul = $bukuItem->inventaris->judul;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- Button untuk menambah kolom baru -->
                                                <button type="button" class="btn btn-secondary mt-2" id="addKodeBuku">Tambah Kode Buku</button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-2">
                                                    <label class="form-label">Deskripsi</label><br>
                                                    <textarea name="detail" id="textarea" cols="30" rows="5">{!!$dipinjam->detail!!}</textarea>
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
    <script src="{{asset('app-assets/js/scripts/forms/form-select2.js')}}"></script>
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

    {{-- <script>
        // Inisialisasi counter untuk membuat id unik
        let counter = 1;

        // Fungsi untuk menginisialisasi Select2 pada elemen select tertentu
        function initializeSelect2() {
            $('.select2').select2(); // Menginisialisasi Select2 pada semua elemen select dengan kelas select2

            document.querySelectorAll('.select2').forEach((dropdown, index, dropdowns) => {
            dropdown.addEventListener('change', function () {
                // Fokus ke dropdown berikutnya jika ada
                const nextDropdown = dropdowns[index + 1];
                if (nextDropdown) {
                    $(nextDropdown).select2('open'); // Buka dropdown berikutnya
                }
            });
        })
        }

        document.getElementById('addKodeBuku').addEventListener('click', function() {
            // Dapatkan container untuk grup kode buku
            var container = document.getElementById('kodeBukuContainer');

            // Dapatkan grup kode buku pertama untuk diduplikasi
            var kodeBukuGroup = container.querySelector('.kode-buku-group');

            // Hapus Select2 sebelum menduplikasi elemen
            $(kodeBukuGroup.querySelector('select')).select2('destroy');

            // Buat duplikat grup kode buku
            var newKodeBukuGroup = kodeBukuGroup.cloneNode(true);

            // Buat ID unik untuk select yang baru menggunakan counter
            var newId = 'select2-nested-' + counter;
            counter++; // Tingkatkan counter setelah membuat id

            // Atur id baru pada elemen select yang diduplikasi
            newKodeBukuGroup.querySelector('select').id = newId;

            // Hapus nilai yang dipilih sebelumnya di select baru
            newKodeBukuGroup.querySelector('select').selectedIndex = -1;

            // Tambahkan grup kode buku baru ke dalam container
            container.appendChild(newKodeBukuGroup);

            // Inisialisasi ulang Select2 untuk elemen yang baru ditambahkan
            initializeSelect2();
        });

        // Inisialisasi Select2 pada elemen yang ada saat pertama kali halaman dimuat
        initializeSelect2();
    </script> --}}


    <script>
        // Inisialisasi counter untuk membuat id unik
        let counter = {{$dipinjam->pivot->count()}}; // Mulai dari jumlah buku yang dipilih

        // Fungsi untuk menginisialisasi Select2 pada elemen select tertentu
        function initializeSelect2() {
            $('.select2').select2(); // Menginisialisasi Select2 pada semua elemen select dengan kelas select2

            document.querySelectorAll('.select2').forEach((dropdown, index, dropdowns) => {
                dropdown.addEventListener('change', function () {
                    // Fokus ke dropdown berikutnya jika ada
                    const nextDropdown = dropdowns[index + 1];
                    if (nextDropdown) {
                        $(nextDropdown).select2('open'); // Buka dropdown berikutnya
                    }
                });
            });
        }

        document.getElementById('addKodeBuku').addEventListener('click', function() {
            // Dapatkan container untuk grup kode buku
            var container = document.getElementById('kodeBukuContainer');

            // Dapatkan grup kode buku pertama untuk diduplikasi
            var kodeBukuGroup = container.querySelector('.kode-buku-group');

            // Hapus Select2 sebelum menduplikasi elemen
            $(kodeBukuGroup.querySelector('select')).select2('destroy');

            // Buat duplikat grup kode buku
            var newKodeBukuGroup = kodeBukuGroup.cloneNode(true);

            // Buat ID unik untuk select yang baru menggunakan counter
            var newId = 'select2-nested-' + counter;
            counter++; // Tingkatkan counter setelah membuat id

            // Atur id baru pada elemen select yang diduplikasi
            newKodeBukuGroup.querySelector('select').id = newId;

            // Hapus nilai yang dipilih sebelumnya di select baru
            newKodeBukuGroup.querySelector('select').selectedIndex = -1;

            // Tambahkan grup kode buku baru ke dalam container
            container.appendChild(newKodeBukuGroup);

            // Inisialisasi ulang Select2 untuk elemen yang baru ditambahkan
            initializeSelect2();
        });

        // Inisialisasi Select2 pada elemen yang ada saat pertama kali halaman dimuat
        initializeSelect2();
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
