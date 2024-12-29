
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Meta Tags -->
     <meta charset="utf-8">
     <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
     <!-- Author -->
     <meta name="author" content="Themes Industry">
     @yield('meta')
    <!-- Favicon -->
    <link href="" rel="icon">
    <!-- Bundle -->
    <link href="{{asset('assets/landing-page/vendor/css/bundle.min.css')}}" rel="stylesheet">
    <!-- Plugin Css -->

    <link href="{{asset('assets/landing-page/food-delivery/css/line-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/vendor/css/revolution-settings.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/vendor/css/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/vendor/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/vendor/css/cubeportfolio.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/vendor/css/LineIcons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/food-delivery/css/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/food-delivery/css/slick.css')}}" rel="stylesheet">
    <link href="{{asset('assets/landing-page/vendor/css/wow.css')}}" rel="stylesheet">
    <!-- Style Sheet -->
    @yield('style')
    <link href="{{asset('assets/landing-page/food-delivery/css/style.css')}}" rel="stylesheet">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="90">

<!-- Preloader -->
<div class="preloader">
    <div class="center">
        <div class="spinner">
            <div class="blob top"></div>
            <div class="blob bottom"></div>
            <div class="blob left"></div>
            <div class="blob move-blob"></div>
        </div>
    </div>
</div>
<!-- Preloader End -->

<!--Header Start-->
<header id="home" class="cursor-light">

    <div class="inner-header nav-icon">
        <div class="main-navigation">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <a class="navbar-brand link" href="index-food-delivery.html">
                        </a>
                    </div>
                    <div class="col-lg-6 simple-navbar d-none d-lg-flex align-items-center justify-content-center">
                        <nav class="navbar navbar-expand-lg">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="navbar-nav ml-auto mr-auto">
                                    <a class="nav-link link" href="{{route('landing-page.searching')}}">Cari Buku</a>
                                    <a class="nav-link link" href="{{route('landing-page.list')}}">Daftar Buku</a>
                                    <a class="nav-link link" href="{{route('landing-page.presensi.individu')}}">Presensi</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <!--Side Nav-->
    <div class="side-menu hidden side-menu-opacity">
        <div class="bg-overlay"></div>
        <div class="inner-wrapper">
            <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>
            <div class="container">
                <div class="row w-100 side-menu-inner-content">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <a href="index-food-delivery.html" class="navbar-brand"><img src="{{asset('assets/landing-page/food-delivery/img/logo-white-small.png')}}" alt="logo"></a>
                    </div>
                    <div class="col-12 col-lg-8">
                        <nav class="side-nav w-100">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="{{route('landing-page.searching')}}">Cari Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="{{route('landing-page.list')}}">Daftar Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="#about-sec">Presensi</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a id="close_side_menu" href="javascript:void(0);"></a>

</header>
<!--Header End-->

@yield('content')

<div class="foot-effect"></div>
<!--Footer Start-->
<footer class="footer-style-1 bg-2">

    <div class="container">
        <div class="row align-items-center">
            <!--Social-->
            <div class="col-12">
                <div class="footer-social text-center">
                    <p>apliasi perpustakaan SDN Bandungrejosari 4 Malang</p><br><p>Satu untuk semua</p>
                </div>
            </div>
            <!--Text-->
            <div class="col-12 text-center mt-3">
                <p class="company-about fadeIn">© 2020 MegaOne. Made With Love By <a>Themesindustry</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!--Footer End-->

<!--Animated Cursor-->
<div class="aimated-cursor">
    <div class="cursor">
        <div class="cursor-loader"></div>
    </div>
</div>
<!--Animated Cursor End-->

<!--Scroll Top Start-->
<span class="scroll-top-arrow"><i class="fas fa-angle-up"></i></span>
<!--Scroll Top End-->

<!-- JavaScript -->
<script src="{{asset('assets/landing-page/vendor/js/bundle.min.js')}}"></script>
<!-- Plugin Js -->
<script src="{{asset('assets/landing-page/vendor/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/parallaxie.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/wow.min.js')}}"></script>
<!-- REVOLUTION JS FILES -->
<script src="{{asset('assets/landing-page/vendor/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/jquery.themepunch.revolution.min.js')}}"></script>
<!-- SLIDER REVOLUTION EXTENSIONS -->
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.migration.min.j')}}s"></script>
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('assets/landing-page/vendor/js/extensions/revolution.extension.video.min.js')}}"></script>
<!--Tilt Js-->
<script src="{{asset('assets/landing-page/vendor/js/TweenMax.min.js')}}"></script>
<!-- custom script-->
<script src="{{asset('assets/landing-page/food-delivery/js/slick.min.js')}}"></script>
<script src="{{asset('assets/landing-page/food-delivery/js/notify.min.js')}}"></script>
{{-- <script src="{{asset('assets/landing-page/vendor/js/contact_us.js')}}"></script> --}}
<script src="{{asset('assets/landing-page/food-delivery/js/script.js')}}"></script>
@yield('footer-script')

</body>
</html>
