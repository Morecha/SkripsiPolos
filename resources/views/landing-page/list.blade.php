@extends('layouts.landing-page')

    @section('meta')
        <!-- description -->
        <meta name="description" content="Food Delivery is a highly creative, modern, visually stunning and Bootstrap responsive multipurpose studio and portfolio HTML5 template with 8 ready home page demos.">
        <!-- keywords -->
        <meta name="keywords" content="Food Delivery, modern, clean, bootstrap responsive, html5, css3, portfolio, blog, studio, templates, multipurpose, one page, corporate, start-up, studio, branding, designer, freelancer, carousel, parallax, photography, studio, masonry, grid, faq">
        <!-- Page Title -->
        <title> Food Delivery | Restaurants</title>
    @endsection

    @section('style')
        <!-- Style Sheet -->
        <link href="{{asset('assets/landing-page/food-delivery/css/nouislider.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/landing-page/food-delivery/css/range-slider.css')}}" rel="stylesheet">
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

            p.text.text-white {
                color: #ffffff !important; /* Tambahkan !important untuk memaksa prioritas */
            }

            .deskripsi {
                display: -webkit-box;
                -webkit-line-clamp: 5; /* Jumlah baris yang ditampilkan */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .pengarang {
                display: -webkit-box;
                -webkit-line-clamp: 3; /* Jumlah baris yang ditampilkan */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
    @endsection

    @section('content')

        {{-- session --}}
        @if (session('error') or $errors->any())
            <div id="type-gagal" class="alert alert-danger" style="display: none;">
            </div>
        @endif
        {{-- endsession --}}

        <!--Banner Sec start-->
        <section class="secondary-pages-banner cursor-light bg-1" id="main-banner">
            <!-- END REVOLUTION SLIDER -->
            <img src="{{asset('assets/landing-page/food-delivery/img/percobaan.png')}}" class="secondary-item1">
            <img src="{{asset('assets/landing-page/food-delivery/img/book-transparant.png')}}" class="secondary-item2">
            <div class="banner-content text-center">
                <div class="heading-area">
                    @if($inven_cari != null)
                        <h4 class="heading">Hasil Pencarian</h4>
                    @else
                        <h4 class="heading">Daftar Buku</h4>
                    @endif
                    <div class="crumbs">
                        <nav aria-label="breadcrumb" class="breadcrumb-items">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('landing-page.searching')}}" class="link">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('landing-page.list')}}" class="link">Daftar Buku</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!--Banner Sec End-->

        @if (@isset($inven_cari) && $inven_cari->isNotEmpty())
            <!--Slider form start-->
            <div class="detail-page-sec padding-top-half bg-2" id="filter-form">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-white">Hasil Pencarian</h1>

                        </div>
                    </div>
                </div>
            </div>
            <!--Slider form end-->
        @endif

        <section class="detail-page-sec padding-top-half bg-2" id="detail-page-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    @if (@isset($inven_cari) && $inven_cari->isNotEmpty())
                                        @foreach ($inven_cari as $cari)
                                            <div class="col-12 col-md-12">
                                                <a href="{{route('landing-page.detail', $cari->id)}}">
                                                    <div class="food-list ml-0">
                                                        <div class="list-overlay"></div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="info">
                                                                    @if ($cari->image != null)
                                                                        <img src="{{asset('storage/gambar/inventaris/'.$cari->image)}}">
                                                                    @else
                                                                        <img src="{{asset('assets/landing-page/food-delivery/img/test1.jpg')}}">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-5 mb-md-0"></div>
                                                                <h4 class="main-heading text-white">{{$cari->judul}}</h4>
                                                                <div class="mb-3 mb-md-5"></div>
                                                                <h5 class="text-white pengarang">{{$cari->pengarang}}</h5>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="text-white">Deskripsi</h5><br>
                                                                <div class="text text-white deskripsi">{!! $cari->deskripsi !!}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="detail-page-sec padding-top bg-2" id="filter-form">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-white">Daftar Buku</h1>
                    </div>
                </div>
            </div>
        </div>

        <!--Food Gallery Start-->
        <section class="gallery-sec padding-top-half padding-bottom bg-2" id="gallery-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row portfolio-area" id="portfolio-area">
                            @foreach ( $inventaris as $i)
                                <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                    <div class="portfolio-inner-content">
                                        <a href="{{route('landing-page.detail', $i->id)}}">
                                            <div class="item-img-holder position-relative">
                                                @if ($i->image != null)
                                                    <img src="{{asset('storage/gambar/inventaris/'.$i->image)}}">
                                                @else
                                                    <img src="{{asset('assets/landing-page/food-delivery/img/item1.png')}}">
                                                @endif
                                                <div class="item-badge rounded-circle">{{$i->buku_count}}<span>buku</span></div>
                                            </div>
                                            <div class="item-detail-area">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="item-name">{{$i->judul}}</h4>
                                                </div>
                                                <p class="text pengarang">{{ $i->pengarang }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <a href="javascript:void(0);" id="loadMore" class="btn main-btn rounded-pill w-100">
                                    <i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i>TAMPILKAN LEBIH BANYAK BUKU
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Food Gallery End end-->
    @endsection

    @section('footer-script')
        <!-- custom script-->
        <script src="{{asset('assets/landing-page/food-delivery/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/landing-page/food-delivery/js/nouislider.min.js')}}"></script>
        <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>

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
