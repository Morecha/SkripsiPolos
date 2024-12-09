@extends('layouts.landing-page')

    @section('meta')
        <!-- description -->
        <meta name="description" content="MegaOne is a highly creative, modern, visually stunning and Bootstrap responsive multipurpose studio and portfolio HTML5 template with 8 ready home page demos.">
        <!-- keywords -->
        <meta name="keywords" content="Creative, modern, clean, bootstrap responsive, html5, css3, portfolio, blog, studio, templates, multipurpose, one page, corporate, start-up, studio, branding, designer, freelancer, carousel, parallax, photography, studio, masonry, grid, faq">
        <!-- Page Title -->
        <title>Perpustakaan</title>
    @endsection

    <!-- Style Sheet -->
    @section('style')
        <link href="{{asset('assets/landing-page/food-delivery/css/select2.min.css')}}" rel="stylesheet">

        <style>
            .item-img-holder {
                width: 100%; /* Atur sesuai kebutuhan layout */
                height: 200px; /* Sesuaikan dengan tinggi yang diinginkan */
                position: relative;
                overflow: hidden; /* Sembunyikan bagian gambar yang kelebihan */
                border-radius: 8px; /* Opsional untuk sudut membulat */
            }

            .item-img-holder img.portfolio-image {
                width: 100%; /* Gambar memenuhi lebar */
                height: 100%; /* Gambar memenuhi tinggi */
                object-fit: cover; /* Gambar diatur untuk menyesuaikan container */
            }

        </style>
    @endsection

    @section('content')
        <!--Banner Sec start-->
        <section class="secondary-pages-banner cursor-light bg-1" id="main-banner">
            <!-- END REVOLUTION SLIDER -->
            <img src="{{asset('assets/landing-page/food-delivery/img/percobaan.png')}}" class="secondary-item1">
            <img src="{{asset('assets/landing-page/food-delivery/img/book-transparant.png')}}" class="secondary-item2">
            <div class="banner-content text-center">
                <div class="heading-area">
                        <h4 class="heading">Presensi</h4>
                    <div class="crumbs">
                        <nav aria-label="breadcrumb" class="breadcrumb-items">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('landing-page.searching')}}" class="link">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('landing-page.list')}}" class="link">Presensi</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!--Banner Sec End-->
        <!--Slider form start-->
        <div class="slider-form" style="position: absolute; z-index: 12; top: 50%; transform: translateY(-50%); left: 0; right: 0;">
            <div class="container">
                <div class="row">
                    <!--<div class="col-12" id="result"></div>-->
                    <div class="col-12 wow fadeInUp">
                        <form action="{{route('landing-page.presensi.individu')}}" method="GET" class="row contact-form rounded-pill link no-gutters" id="contact-form-data">
                            <div class="col-12 col-lg-8 d-inline-block d-lg-flex align-items-center">
                                <div class="form-group">
                                    <label><i class="fas fa-map-marker-alt" aria-hidden="true"></i></label>
                                    <input type="text" name="search" placeholder="Kata Kunci" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <button type="submit" class="btn main-btn rounded-pill w-100 contact_btn"><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i>Cari Anggota
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Slider form end-->


        <!--Food Gallery Start-->
        <section class="detail-page-sec padding-top padding-bottom bg-2" id="detail-page-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {{-- <div class="tab-content" id="pills-tabContent"> --}}
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    @if($anggota_cari != null)
                                        @foreach ($anggota_cari as $index)
                                            <div class="col-12 col-md-6">
                                                <div class="food-list ml-0">
                                                    @if($index->status == "aktif")
                                                        <div class="list-overlay"></div>
                                                        @endif
                                                        <div class="rates d-flex justify-content-between">
                                                            <div class="info">
                                                                <h6 class="main-heading">{{$index->name}}</h6>
                                                                <p class="text">
                                                                    Angkatan : {{$index->angkatan}}<br>
                                                                    NIS : {{$index->NIS}}
                                                                </p>
                                                            </div>
                                                            @if($index->status != "aktif")
                                                            <h5 class="text-white">Tidak Aktif</h5>
                                                            @endif
                                                            @if ($index->status == "aktif")
                                                                <a href="{{route('landing-page.store.presensi.individu', $index->id)}}">
                                                                   <i class="text-white">absensi</i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
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
        </section>
        <!--Food Gallery End end-->
    @endsection

    @section('footer-script')
        <!-- custom script-->
        <script src="{{asset('assets/landing-page/food-delivery/js/select2.min.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')}}"></script>

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
