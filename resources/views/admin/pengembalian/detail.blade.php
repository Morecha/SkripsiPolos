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
                            <h2 class="content-header-title float-start mb-0">Detail Pengembalian</h2>
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

                                    </div>
                                        {{-- first line --}}
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="jenis_peminjaman">Jenis Peminjaman</label>
                                                    <select class="form-select" id="jenis_peminjaman" name="jenis_peminjaman" disabled>
                                                    <option value="" selected>{{ $peminjaman->jenis_peminjaman }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="lama_peminjaman">Tanggal Peminjaman</label>
                                                    <input type="text" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" autocomplete="lama_peminjaman" value="{{ $peminjaman->created_at }}" disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="tanggal_pengembalian">Tanggal Pengembalian</label>
                                                    <input type="text" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" value="{{ $peminjaman->updated_at }}" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="id_anggota">Anggota</label>
                                                    {{-- <input type="text" id="id_anggota" class="form-control" name="id_anggota" autocomplete="off" placeholder="Anggota"/> --}}
                                                    <select class="select2 form-select" name="id_anggota" id="select2" disabled>
                                                        @if ($peminjaman->id_anggota != null)
                                                        <option value="" selected disabled>{{$peminjaman->anggota->name}}</option>
                                                        @else
                                                        <option value="" selected disabled>{{$peminjaman->user->name}}</option>
                                                        @endif
                                                    </select>
                                                    <input type="hidden" id="id_user" name="id_user" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label class="form-label" for="lama_peminjaman">Lama Peminjaman (hari)</label>
                                                    <input type="number" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" autocomplete="lama_peminjaman" value="{{ $peminjaman->lama_peminjaman }}" disabled/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="divider divider-success">
                                            <div class="divider-text">Deskripsi</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-2">
                                                    <label class="form-label">Deskripsi</label><br>
                                                    {!! $peminjaman->detail !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="divider divider-success">
                                            <div class="divider-text">Jenis Buku</div>
                                        </div>
                                        @foreach ($peminjaman->pivot as $pivot)
                                        {{-- @dd($pivot->buku->kode_buku); --}}
                                        <div class="border rounded p-2">
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col-md-8 col-12">
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-2">
                                                                    <label class="form-label" for="lama_peminjaman">Nama Buku</label>
                                                                    <input type="text" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" autocomplete="lama_peminjaman" value="{{ $pivot->buku->inventaris->judul }}" disabled/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-2">
                                                                    <label class="form-label" for="lama_peminjaman">Kode Buku</label>
                                                                    <input type="text" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" autocomplete="lama_peminjaman" value="{{ $pivot->buku->kode_buku }}" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-2">
                                                                    <label class="form-label" for="lama_peminjaman">Status Pengembalian</label>
                                                                    <input type="text" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" autocomplete="lama_peminjaman" value="{{ $pivot->status }}" disabled/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-2">
                                                                    <label class="form-label" for="lama_peminjaman">Pengarang</label>
                                                                    <input type="text" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" autocomplete="lama_peminjaman" value="{{ $pivot->buku->inventaris->pengarang }}" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="mb-2">
                                                                    <label class="form-label" for="lama_peminjaman">Status Buku (Saat Ini)</label>
                                                                    <input type="text" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="lama peminjaman" autocomplete="lama_peminjaman" value="{{ $pivot->buku->posisi }}" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        {{-- gambar --}}
                                                        <div class="mb-2">
                                                            {{-- <label class="form-label" for="lama_peminjaman">Gambar</label> --}}
                                                            @if ($pivot->buku->image != null)
                                                                <img src="{{asset('storage/gambar/buku/'.$pivot->buku->image)}}" id="blog-feature-image" class="rounded me-2 mb-1 mb-md-0" width="110" height="110" alt="Blog Featured Image" style="margin: 10px;"/>
                                                            @else
                                                                <img src="{{asset('app-assets/images/book/template/3fe9c8a1dbfb5b3910e306183ec5d669.jpg')}}" id="blog-feature-image" class="rounded me-2 mb-1 mb-md-0" width="110" height="130" alt="Blog Featured Image" style="margin: 10px;"/>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        @endforeach
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

    <script>
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
