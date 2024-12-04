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
                            {{-- <form class="row contact-form" id="contact-form-data">
                                <div class="col-12" id="result"></div>
                                <div class="col-12 col-lg-10 d-inline-block d-lg-flex align-items-center text-center text-lg-left">
                                    <div class="row no-gutters w-100">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group d-block">
                                                <div class="product-price mt-4">
                                                    <div id="slider-range" class="w-100"></div>
                                                    <p class="price-num mt-3 mt-lg-2" style="color: #fff;">Price: <span id="min-p"></span>  <span id="max-p"></span></p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4 m-auto">
                                            <div class="form-group">
                                                <label><i class="lni lni-dinner"></i></label>
                                                <select class="form-control w-100" id="set1">
                                                    <option class="selected hidden disabled" hidden>Restaurant Type</option>
                                                    <option value="Mega Restaurant">Mega Restaurant</option>
                                                    <option value="The Fast Food">The Fast Food</option>
                                                    <option value="The Green Bakery">Green Bakery</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4 m-auto">
                                            <div class="form-group">
                                                <label><i class="lni lni-map-marker"></i></label>

                                                <select class="form-control" id="set2">
                                                    <option class="selected" hidden>Restaurant Location</option>
                                                    <option value="New York">New York</option>
                                                    <option value="London">London</option>
                                                    <option value="Paris">Paris</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2 d-flex align-items-center">
                                    <a href="restaurant-listing.html" class="btn main-btn rounded-pill w-100 contact_btn">FILTER</a>
                                </div>
                            </form> --}}
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
                                                                    <img src="{{asset('assets/landing-page/food-delivery/img/test1.jpg')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-5 mb-md-0"></div>
                                                                <h4 class="main-heading text-white">{{$cari->judul}}</h4>
                                                                <div class="mb-3 mb-md-5"></div>
                                                                <h5 class="text-white">{{$cari->pengarang}}</h5>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="text-white">Deskripsi</h5><br>
                                                                <p class="rate text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
                                                <p class="text">{{$i->pengarang}} </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item2.png')}}">
                                            <div class="item-badge rounded-circle">50<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">The Fast Food</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item3.png')}}">
                                            <div class="item-badge rounded-circle">45<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">Green Bakery</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item4.png')}}">
                                            <div class="item-badge rounded-circle">25<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">Eat Frio</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item5.png')}}">
                                            <div class="item-badge rounded-circle">50<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">Turkish Cousine</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item6.png')}}">
                                            <div class="item-badge rounded-circle">45<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">Pizzario</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item1.png')}}">
                                            <div class="item-badge rounded-circle">25<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">Mega Restaurant</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item2.png')}}">
                                            <div class="item-badge rounded-circle">50<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">The Fast Food</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item3.png')}}">
                                            <div class="item-badge rounded-circle">45<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">Green Bakery</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item6.png')}}">
                                            <div class="item-badge rounded-circle">45<span>mins</span></div>
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">Pizzario</h4>
                                                <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul>
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
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
