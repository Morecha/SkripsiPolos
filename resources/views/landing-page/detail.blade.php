@extends('layouts.landing-page')

    @section('meta')
        <!-- description -->
        <meta name="description" content="Food Delivery is a highly creative, modern, visually stunning and Bootstrap responsive multipurpose studio and portfolio HTML5 template with 8 ready home page demos.">
        <!-- keywords -->
        <meta name="keywords" content="Food Delivery, modern, clean, bootstrap responsive, html5, css3, portfolio, blog, studio, templates, multipurpose, one page, corporate, start-up, studio, branding, designer, freelancer, carousel, parallax, photography, studio, masonry, grid, faq">
        <!-- Page Title -->
        <title> Food Delivery | Restaurant Detail</title>
    @endsection

    @section('style')
    <link href="{{asset('assets/landing-page/vendor/css/swiper.min.css')}}" rel="stylesheet">
    <!-- Style Sheet -->
    <link href="{{asset('assets/landing-page/food-delivery/css/nouislider.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/food-delivery/css/range-slider.css')}}" rel="stylesheet">

    <style>
        .text-white {
            color: #ffffff; /* Warna putih */
        }
        .info p {
            color: #ffffff;
        }
    </style>
    @endsection

    @section('content')
        <!--Banner Sec start-->
        {{-- <section class="secondary-pages-banner cursor-light bg-1" id="main-banner">
            <!-- END REVOLUTION SLIDER -->
            <img src="{{asset('assets/landing-page/food-delivery/img/slider-ele3.png')}}" class="secondary-item1">
            <img src="{{asset('assets/landing-page/food-delivery/img/slider-ele1.png')}}" class="secondary-item2">
            <div class="banner-content text-center">
                <div class="heading-area">
                    <h4 class="heading">Restaurant Detail</h4>
                    <div class="crumbs">
                        <nav aria-label="breadcrumb" class="breadcrumb-items">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../index-food-delivery.html" class="link">Home</a></li>
                                <li class="breadcrumb-item"><a href="restaurant-detail.html" class="link">Restaurant Detail</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--Banner Sec End-->

        <!--Detail page-->
        <section class="detail-page-sec padding-top padding-bottom bg-2" id="detail-page-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="info">
                                                        <img src="{{asset('assets/landing-page/food-delivery/img/item1.png')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-5 mb-md-0"></div>
                                                    <h4 class="main-heading text-white">{{$inventaris->judul}}</h4>
                                                    <div class="mb-3 mb-md-5"></div>
                                                    <p class="text-white">
                                                        <h6 class="text-white">Status : {{$inventaris->status}}</h6><br>
                                                        <h6 class="text-white">Pengarang : {{$inventaris->pengarang}}</h6><br>
                                                        <h6 class="text-white">Penerbit : {{$inventaris->penerbit}}</h6><br>
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5 class="text-white">Deskripsi</h5><br>
                                                    <p class="rate text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis blandit vel nunc nec mollis. Vestibulum fringilla lacinia varius. Sed vulputate eleifend semper. Nulla purus neque, semper vel tellus sed, rutrum accumsan felis. Morbi vestibulum tortor ac orci accumsan elementum. Curabitur augue erat, aliquet eu tincidunt sed,</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5"></div>
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <div class="food-list">
                                            {{-- <div class="list-overlay"></div> --}}
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Keterangan</h6>
                                                    <p class="text text-white">{!! $inventaris->deskripsi !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="food-list">
                                            {{-- <div class="list-overlay"></div> --}}
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">History Peminjaman</h6>
                                                    <p class="text text-white">
                                                        <ul class="text-white">
                                                            @foreach ($pivot as $item)
                                                                {{$item->created_at->format('d-m-Y')}} - {{$item->buku->kode_buku}}<br>
                                                            @endforeach
                                                        </ul>
                                                    </p>
                                                </div>
                                                {{-- <p class="rate">$30</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!--Detail ;page End-->
    @endsection

    @section('footer-script')
        <script src="{{asset('assets/landing-page/vendor/js/swiper.min.js')}}"></script>
        <script src="{{asset('assets/landing-page/food-delivery/js/nouislider.min.js')}}"></script>
    @endsection
