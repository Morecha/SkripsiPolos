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
                        {{-- <ul class="row nav nav-pills" id="pills-tab" role="tablist">
                            <li class="col-6 col-lg-3 nav-item pr-1">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                    <i class="lni lni-fresh-juice pill-icon"></i>
                                    <span class="pill-name">Breakfast</span>
                                </a>
                            </li>
                            <li class="col-6 col-lg-3 nav-item pl-1">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    <i class="lni lni-chef-hat pill-icon"></i>
                                    <span class="pill-name">Lunch</span>
                                </a>
                            </li>
                            <li class="col-6 col-lg-3 nav-item pr-1">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    <i class="lni lni-dinner pill-icon"></i>
                                    <span class="pill-name">Dinner</span>
                                </a>
                            </li>
                            <li class="col-6 col-lg-3 nav-item pl-1">
                                <a class="nav-link" id="pills-deal-tab" data-toggle="pill" href="#pills-deal" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    <i class="lni lni-gift pill-icon"></i>
                                    <span class="pill-name">Deals</span>
                                </a>
                            </li>
                        </ul> --}}
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Surmai Chilli</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$85</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Plain Pancakes</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$30</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Plain Pancakes</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$30</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row">
                                    <div class="col-12 col-md-6">

                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Plain Pancakes</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$30</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Sode Kadai</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$60</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Mutton Handi</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$25</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Twisted Sticks</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$70</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Garlic Chilli Karahi</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$50</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Surmai Chilli</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$85</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Toasted Jam</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$35</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Prawns Butter Garlic</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$80</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Plain Pancakes</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$70</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Organic Fruit Salad</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$120</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Twisted Sticks</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$85</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Toasted Jam</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$35</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Prawns Butter Garlic</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$80</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Plain Pancakes</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$70</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Organic Fruit Salad</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$120</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">

                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Malai Boti</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$30</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Sode Kadai</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$60</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Mutton Handi</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$25</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Twisted Sticks</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$70</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Garlic Chilli Karahi</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$50</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-deal" role="tabpanel" aria-labelledby="pills-deal-tab">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Prawns Butter Garlic</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$80</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Plain Pancakes</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$70</p>
                                            </div>
                                        </div>
                                        <div class="food-list ml-0">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Organic Fruit Salad</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$120</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">

                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Malai Boti</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$30</p>
                                            </div>
                                        </div>
                                        <div class="food-list">
                                            <div class="list-overlay"></div>
                                            <div class="rates d-flex justify-content-between">
                                                <div class="info">
                                                    <h6 class="main-heading">Sode Kadai</h6>
                                                    <p class="text">Lorem ipsum dolor sit amet, consectetur elit.</p>
                                                </div>
                                                <p class="rate">$60</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> --}}
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
