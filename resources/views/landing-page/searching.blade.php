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
    @endsection

    @section('content')
        <!--Banner Sec start-->
        <section class="main-banner cursor-light bg-1" id="main-banner">
            <h4 class="d-none">heading</h4>
            <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="megaone-food-slider1" data-source="gallery" style="background:transparent;padding:0px;">
                <!-- START REVOLUTION SLIDER 5.4.8.1 fullscreen mode -->
                <div id="rev_slider_1_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.8.1">
                    <ul>	<!-- SLIDE  -->
                        <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <!--<img src="img/transparent.png" data-bgcolor='#ffffff' style='background:#ffffff' alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg" data-no-retina>-->
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption   tp-resizeme"
                                id="slide-1-layer-2"
                                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                data-y="['middle','middle','middle','middle']" data-voffset="['-170','-186','-172','-100']"
                                data-fontsize="['18','40','25','20']"
                                data-lineheight="['70','70','40','40']"
                                data-width="['none','none','280','200']"
                                data-height="['none','150','150','150']"
                                data-whitespace="nowrap"

                                data-type="text"
                                data-responsive_offset="on"

                                data-frames='[{"delay":339.84375,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:.7;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['center','center','center','center']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"

                                style="z-index: 5; white-space: nowrap; font-size: 28px; line-height: 70px; font-weight: 300;opacity: .8; color: #ffffff; letter-spacing: 0;font-family:'Roboto', sans-serif;">SDN Bandungrejosari 4 Malang</div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption   tp-resizeme rs-parallaxlevel-1"
                                id="slide-1-layer-3"
                                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                data-y="['middle','middle','middle','middle']" data-voffset="['-30','-84','-97','-20']"
                                data-fontsize="['90','70','70','20']"
                                data-lineheight="['85','85','60','50']"
                                data-width="['470','670','670','400']"
                                data-height="none"
                                data-whitespace="normal"

                                data-type="text"
                                data-responsive_offset="on"

                                data-frames='[{"delay":829.8828125,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['center','center','center','center']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"

                                style="z-index: 6;font-size: 75px; line-height: 85px; font-weight: 400; letter-spacing: 0;font-family: 'Grand Hotel', cursive;"><span class="color-white">Buku adalah jendela Dunia</span> </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption   tp-resizeme"
                                id="slide-1-layer-4"
                                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                data-y="['middle','middle','middle','middle']" data-voffset="['133','25','60','160']"
                                data-fontsize="['15','18','18','20']"
                                data-lineheight="['30','26','26','26']"
                                data-width="['580','570','580','400']"
                                data-height="none"
                                data-whitespace="normal"

                                data-type="text"
                                data-responsive_offset="on"

                                data-frames='[{"delay":1319.921875,"speed":1500,"frame":"0","from":"y:50px;opacity:0;","to":"o:.7;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['center','center','center','center']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"

                                style="z-index: 7; min-width: 570px; max-width: 570px; white-space: normal; font-size: 18px; line-height: 26px; font-weight: 300; color: #ffffff;opacity: .8; letter-spacing: 0;font-family:'Roboto', sans-serif;">"The only thing that you absolutely have to know is the location of the library."<br>
                                — Albert Einstein</div>

                            <!-- LAYER NR. 5 -->
                            <!--                    ele 1-->
                            <div class="tp-caption   tp-resizeme"
                                id="slide-1-layer-6"
                                data-x="['left','left','left','left']" data-hoffset="['-50','137','5000','5000']"
                                data-y="['top','top','top','top']" data-voffset="['250','538','642','526']"
                                data-width="none"
                                data-height="none"
                                data-whitespace="normal"

                                data-type="image"
                                data-responsive_offset="on"

                                data-frames='[{"delay":719.921875,"speed":1500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"

                                style="z-index: 9;">
                                <div class="rs-looped rs-pendulum"  data-easing="" data-startdeg="-5" data-enddeg="5" data-speed="3" data-origin="80% 60%"><img src="{{asset('assets/landing-page/food-delivery/img/slider-ele1.png')}}" alt="" data-ww="['267px','184px','145px','145px']" data-hh="['270px','186px','146px','146px']" data-no-retina> </div></div>

                            <!-- LAYER NR. 6 -->
                            <!--                    //ele 3-->
                            <div class="tp-caption   tp-resizeme"
                                id="slide-1-layer-8"
                                data-x="['right','right','right','right']" data-hoffset="['-230','-144','-100','-50']"
                                data-y="['middle','top','bottom','bottom']" data-voffset="['40','100','112','80']"
                                data-width="none"
                                data-height="none"
                                data-whitespace="normal"
                                data-visibility="['on','on','off','off']"

                                data-type="image"
                                data-basealign="slide"
                                data-responsive_offset="on"

                                data-frames='[{"delay":359.9609375,"speed":1500,"frame":"0","from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"

                                style="z-index: 10;"><img data-depth="0.03" src="{{asset('assets/landing-page/food-delivery/img/percobaan.png')}}" alt="" data-ww="['545px','327px','264px','174px']" data-hh="['498px','299px','251px','161px']" data-no-retina> </div>

                            <!-- LAYER NR. 10 -->
                            <!--                    ele 5-->
                            <div class="tp-caption   tp-resizeme rs-parallaxlevel-0"
                                id="slide-1-layer-13"
                                data-x="['left','center','left','left']" data-hoffset="['1025','330','396','250']"
                                data-y="['top','top','top','top']" data-voffset="['210','130','78','60']"
                                data-width="none"
                                data-height="none"
                                data-whitespace="normal"
                                data-visibility="['on','on','off','off']"

                                data-type="image"
                                data-responsive_offset="on"

                                data-frames='[{"delay":50,"speed":1500,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"

                                style="z-index: 14;">
                                <div class="rs-looped rs-pendulum"  data-easing="easeInOutQuart" data-startdeg="-5" data-enddeg="5" data-speed="5" data-origin="80% 50%"><img src="{{asset('assets/landing-page/food-delivery/img/slider-ele5.png')}}" alt="" data-ww="['90px','105px','105px','105px']" data-hh="['85px','103px','103px','103px']" data-no-retina> </div></div>

                            <!-- LAYER NR. 11 -->
                            <!--                    ele 4-->
                            <div class="tp-caption   tp-resizeme"
                                id="slide-1-layer-15"
                                data-x="['left','left','left','left']" data-hoffset="['-1','-1','0','0']"
                                data-y="['bottom','bottom','bottom','bottom']" data-voffset="['10','0','0','0']"
                                data-width="none"
                                data-height="none"
                                data-whitespace="normal"
                                data-visibility="['on','on','off','off']"

                                data-type="image"
                                data-basealign="slide"
                                data-responsive_offset="on"

                                data-frames='[{"delay":9.9609375,"speed":1500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-textAlign="['inherit','inherit','inherit','inherit']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"

                                style="z-index: 15;"><img data-depth="0.05" src="{{asset('assets/landing-page/food-delivery/img/slider-ele4.png')}}" alt="" data-ww="['199px','191px','200px','150px']" data-hh="['270px','301px','259px','200px']" data-no-retina> </div>
                        </li>
                    </ul>
                    <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>	</div>
            </div>
        </section>
        <!--Banner Sec End-->

        <!--Slider form start-->
        <div class="slider-form">
            <div class="container">
                <div class="row">
                    <!--                <div class="col-12" id="result"></div>-->
                    <div class="col-12 wow fadeInUp">
                        <form class="row contact-form rounded-pill link no-gutters" id="contact-form-data">

                            <div class="col-12 col-lg-8 d-inline-block d-lg-flex align-items-center">
                                <div class="form-group">
                                    <label><i class="fas fa-map-marker-alt" aria-hidden="true"></i></label>
                                    <input type="text" name="userName" placeholder="Kata Kunci" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <a href="food-delivery/restaurant-listing.html" class="btn main-btn rounded-pill w-100 contact_btn"><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i>CEK BUKU
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Slider form end-->

        <!--Food Gallery Start-->
        <section class="gallery-sec padding-top padding-bottom bg-2" id="gallery-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row no-gutters">
                            <div class="col-12 col-lg-6 text-center text-lg-left">
                                <div class="heading-area">
                                    <span class="sub-heading">Informasi Tentang Perpustakaan kami</span>
                                    <h4 class="heading">Buku adalah Jendela Dunia</h4>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 my-auto">
                                <div class="mini-services">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="mini-service-card">
                                                <i class="las la-swatchbook"></i>
                                                <h4 class="number">1052+</h4>
                                                <p class="text">Buku yang diMiliki</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="mini-service-card">
                                                <i class="las la-book-open"></i>
                                                <h4 class="number">9800+</h4>
                                                <p class="text">Buku yang tersedia saat ini</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="mini-service-card">
                                                <i class="las la-book"></i>
                                                <h4 class="number">3785+</h4>
                                                <p class="text">Buku yang dipinjam</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row padding-top portfolio-area">
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="food-delivery/restaurant-detail.html">
                                        <div class="item-img-holder position-relative">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/item1.png')}}">
                                            {{-- <div class="item-badge rounded-circle">25<span>mins</span></div> --}}
                                        </div>
                                        <div class="item-detail-area">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="item-name">Mega Restaurant</h4>
                                                {{-- <ul class="item-reviews">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                </ul> --}}
                                            </div>
                                            <p class="text">Curabitur mollis bibendum luctus.. </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="food-delivery/restaurant-detail.html">
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
                                    <a href="food-delivery/restaurant-detail.html">
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
                                    <a href="food-delivery/restaurant-detail.html">
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
                                    <a href="food-delivery/restaurant-detail.html">
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
                                    <a href="food-delivery/restaurant-detail.html">
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
                                <a href="food-delivery/restaurant-listing.html" class="btn main-btn rounded-pill w-100">
                                    Jelajahi Buku yang kamu cari disini
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Food Gallery End end-->

        <!--Testimonial sec start-->
        <section id="client" class="testimonial padding-top padding-bottom position-relative parallax">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--Testimonials with background 02-->
                        <div class="feedback-slides">
                            <div class="client-thumbnails">
                                <div>
                                    <div class="item">
                                        <div class="img-fill"><img src="{{asset('assets/landing-page/food-delivery/img/client2.jpg')}}" alt="client"></div>
                                        <div class="title">
                                            <h3 class="user-name">John Terry</h3>
                                            <p class="user-designation">New York City</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="img-fill"><img src="{{asset('assets/landing-page/food-delivery/img/client1.jpg')}}" alt="client"></div>

                                        <div class="title">
                                            <h3 class="user-name">Jessica D Miller</h3>
                                            <p class="user-designation">New York City</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="img-fill"><img src="{{asset('assets/landing-page/food-delivery/img/client3.jpg')}}" alt="client"></div>

                                        <div class="title">
                                            <h3 class="user-name">David Muller</h3>
                                            <p class="user-designation">New York City</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="img-fill"><img src="{{asset('assets/landing-page/food-delivery/img/client4.jpg')}}" alt="client"></div>

                                        <div class="title">
                                            <h3 class="user-name">Julia Tracker</h3>
                                            <p class="user-designation">New York City</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="client-feedback">
                                <div>
                                    <div class="item">
                                        <div class="single-feedback">
                                            <p class="text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida eu arcu a pharetra. Cras varius semper pharetra. Pellentesque sed feugiat nisi.”</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="single-feedback">
                                            <p class="text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida eu arcu a pharetra. Cras varius semper pharetra.”</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="single-feedback">
                                            <p class="text">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, incididunt ut labore et dolore magna. Quis ipsum suspendisse ultrices gravida.”</p>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="single-feedback">
                                            <p class="text">“ Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida eu arcu a pharetra. Cras varius semper pharetra. Pellentesque sed feugiat nisi. ”</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Testimonials with background ends-->
                    </div>
                </div>
            </div>
        </section>
        <!--Testimonial sec End-->

        <!--App D sec start-->
        {{-- <section class="app-sec padding-top padding-bottom text-center bg-2" id="app-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="heading-area padding-bottom">
                            <span class="sub-heading">Better experience on obile ordering.</span>
                            <h4 class="heading">download our latest app from mobile stores.</h4>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row apps-details">
                            <div class="col-12 col-md-6">
                                <a href="https://www.apple.com/ios/app-store/">
                                    <div class="app-l">
                                        <div class="img-holder">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/app1.png')}}">
                                        </div>
                                        <h4 class="app-loc">iOS App Store</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="https://play.google.com/store/apps?hl=en">
                                    <div class="app-l">
                                        <div class="img-holder">
                                            <img src="{{asset('assets/landing-page/food-delivery/img/app2.png')}}">
                                        </div>
                                        <h4 class="app-loc">Google App Store</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--App D sec End-->

        <!--About sec Start-->
        {{-- <section class="about-sec padding-bottom padding-top bg-1" id="about-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 text-center text-lg-left">
                        <div class="heading-area">
                            <span class="sub-heading">Basic info about food delivery.</span>
                            <h4 class="heading">we are behind the delicious food delivery.</h4>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-flex align-items-center text-center text-lg-left">
                        <div class="detail-area">
                            <p class="text">
                                Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus. Nam porttitor justo sed mi finibus, vel tristique risus faucibus.
                            </p>
                            <p class="text mt-2">
                                Curabitur mollis bibendum luctus. Duis suscipit vitae dui sed suscipit. Vestibulum auctor nunc vitae diam eleifend, in maximus metus sollicitudin. Quisque vitae sodales lectus.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row features padding-top">
                    <div class="col-12 col-lg-4 text-center">
                        <div class="feature-card">
                            <i class="lni lni-bulb"></i>
                            <p class="text">We have new ideas for your food business.</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 text-center">
                        <div class="feature-card active">
                            <i class="las la-bicycle"></i>
                            <p class="text">Join our amazing delivery staff.</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 text-center">
                        <div class="feature-card">
                            <i class="lni lni-heart"></i>
                            <p class="text">We love our valued food customers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--About sec End-->
    @endsection

    @section('footer-script')
        <!-- custom script-->
        <script src="{{asset('assets/landing-page/food-delivery/js/select2.min.js')}}"></script>
    @endsection
