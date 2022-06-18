<!--=======================================
SECCION EN MENU (Dispositivos moviles)
========================================-->
<div class="mobile-menu">
    <div class="container">
        <div class="mobile-menu-wrapper">
            <div class="logo">
                <a href="<?=$_ENV["RUTA"]?>" class="logo"><img src="<?=$_ENV["RUTA"]?>public/img/icono1.png" style="height:50px;" alt="logo"></a>
            </div>
            <div class="open-menu"><i class="fa-solid fa-bars"></i></div>
        </div>
        <nav id="mobile-nav">
            <ul class="home-nav">
                <li class="home">
                    <a href="index.html">Home</a>
                    <ul>
                        <li><a href="index.html">Home-1</a></li>
                        <li><a href="index-2.html">Home-2</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="depart-nav">
                <li class="depart">
                    <a href="department.html">Department</a>
                </li>
            </ul>
            <ul class="doctor-nav">
                <li class="doctor">
                    <a href="doctor.html">Doctors</a>
                    <ul>
                        <li><a href="doctor.html">Doctors</a></li>
                        <li><a href="doctor-single.html">Doctor Single</a></li>
                        <li><a href="doctor-timeline.html">Doctor Timeline</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="service-nav">
                <li class="service">
                    <a href="service.html">Services</a>
                    <ul>
                        <li><a href="service.html">Services</a></li>
                        <li><a href="service-single.html">Service Single</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="shop-nav">
                <li class="shop">
                    <a href="shop.html">Shop</a>
                    <ul>
                        <li><a href="shop.html">Shop</a></li>
                        <li><a href="shop-single.html">Shop Single</a></li>
                        <li><a href="cart.html">Shop Cart</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="blog-nav">
                <li class="blog">
                    <a href="blog.html">Blog</a>
                    <ul>
                        <li><a href="blog.html">Blog Page</a></li>
                        <li><a href="blog-single.html">Blog Single</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="short-nav">
                <li class="short">
                    <a href="contact.html">Pages</a>
                    <ul>
                        <li><a href="about.html">About Page</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="404.html">404 Error</a></li>
                    </ul>
                </li>
            </ul>

        </nav>
    </div>
</div>
<!--============================================
SECCION EN MENU (Laptop y dispositivos grandes)
=============================================-->
<header class="header-section d-none d-lg-block">
    <!-- INFO GENERAL -->
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-between align-items-center px-15">
                <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                    <div class="header-logo">
                        <a href="<?=$_ENV["RUTA"]?>" class="logo"><img src="<?=$_ENV["RUTA"]?>public/img/icono1.png" style="height:50px;" alt="logo"></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10">
                    <ul class="header-contact-info d-flex align-items-center">
                        <li class="item">
                            <div class="item-inner">
                                <div class="item-thumb">
                                    <img src="<?=$_ENV["RUTA"]?>public/img/icons/phone.svg" style="<?=ESTILOS_ICONOS?>" alt="Number Contact">
                                </div>
                                <div class="item-content">
                                    <small>Número :</small><br>
                                    <small class="font-weight-bold"><?=NUMERO_PSICOLOGA?></small>
                                </div>
                            </div>
                        </li>
                        <li class="item">
                            <div class="item-inner">
                                <div class="item-thumb">
                                    <img src="<?=$_ENV["RUTA"]?>public/img/icons/email.svg" style="<?=ESTILOS_ICONOS?>" alt="Email Contact">
                                </div>
                                <div class="item-content">
                                    <small>Email :</small><br>
                                    <small class="font-weight-bold"><?=CORREO_PSICOLOGA?></small>
                                </div>
                            </div>
                        </li>
                        <li class="item">
                            <div class="item-inner">
                                <div class="item-thumb">
                                    <img src="<?=$_ENV["RUTA"]?>public/img/icons/location.svg" style="<?=ESTILOS_ICONOS?>" alt="Address Contact">
                                </div>
                                <div class="item-content">
                                    <small>Dirección :</small><br>
                                    <small class="font-weight-bold"><?=ADDRESS_PSICOLOGA?></small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- MENU -->
    <div class="header-bottom">
        <nav class="container">
            <div class="primary-menu">
                <div class="menu-area">
                    <div class="row justify-content-between px-15">
                        <ul class="main-menu d-flex">
                            <li class="active">
                                <a href="#">Home</a>
                                <ul class="submenu">
                                    <li class="active"><a href="index.html">home page one</a></li>
                                    <li><a href="index-2.html">home page two</a></li>
                                </ul>
                            </li>
                            <li><a href="department.html">Departments</a></li>
                            <li><a href="#">Doctors</a>
                                <ul class="submenu">
                                    <li><a href="doctor.html">Doctor Page</a></li>
                                    <li><a href="doctor-single.html">Doctor Single</a></li>
                                    <li><a href="doctor-timeline.html">Doctor Timeline</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Services</a>
                                <ul class="submenu">
                                    <li><a href="service.html">Services Page</a></li>
                                    <li><a href="service-single.html">Services Single</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Shop</a>
                                <ul class="submenu">
                                    <li><a href="shop.html">Shop Page</a></li>
                                    <li><a href="shop-single.html">Shop Single</a></li>
                                    <li><a href="cart.html">Shop Cart</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Blog</a>
                                <ul class="submenu">
                                    <li><a href="blog.html">Blog Page</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Pages</a>
                                <ul class="submenu">
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="404.html">404</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- ==========Header Section Ends Here========== -->

<!-- ==========Banner Section Start Here========== -->
<section class="banner-section">
    <div class="banner-slider">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="banner-item" style="background-image: url(https://labartisan.net/demo/template/medixin/medixin/assets/images/banner/1.jpg);">
                    <div class="container">
                        <div class="banner-inner">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h2 class="wow fadeInDown" data-wow-duration="2s" data-wow-delay=".1s">Best
                                            Medical
                                            Clinic
                                        </h2>
                                        <h1 class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".1s">
                                            <b>Bringing
                                                Health</b> To Life For The Whole Family...
                                        </h1>
                                        <a href="#" class="lab-btn wow fadeInUp" data-wow-duration="2s"
                                           data-wow-delay=".1s"><span>Get
                                                    Appoinments <i class="icofont-rounded-double-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-thumb">
                                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/banner/01.png" alt="banner-img">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="swiper-slide">
                <div class="banner-item" style="background-image: url(https://labartisan.net/demo/template/medixin/medixin/assets/images/banner/1.jpg);">
                    <div class="container">
                        <div class="banner-inner">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h2 class="wow fadeInDown" data-wow-duration="2s" data-wow-delay=".1s">Best
                                            Medical
                                            Clinic
                                        </h2>
                                        <h1 class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".1s">
                                            <b>Bringing
                                                Health</b> To Life For The Whole Family...
                                        </h1>
                                        <a href="#" class="lab-btn wow fadeInUp" data-wow-duration="2s"
                                           data-wow-delay=".1s"><span>Get
                                                    Appoinments <i class="icofont-rounded-double-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-thumb">
                                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/banner/02.png" alt="banner-img">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="swiper-slide">
                <div class="banner-item" style="background-image: url(https://labartisan.net/demo/template/medixin/medixin/assets/images/banner/1.jpg);">
                    <div class="container">
                        <div class="banner-inner">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="banner-content">
                                        <h2 class="wow fadeInDown" data-wow-duration="2s" data-wow-delay=".1s">Best
                                            Medical
                                            Clinic
                                        </h2>
                                        <h1 class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".1s">
                                            <b>Bringing
                                                Health</b> To Life For The Whole Family...
                                        </h1>
                                        <a href="#" class="lab-btn wow fadeInUp" data-wow-duration="2s"
                                           data-wow-delay=".1s"><span>Get
                                                    Appoinments <i class="icofont-rounded-double-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner-thumb">
                                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/banner/03.png" alt="banner-img">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <div class="banner-pagination"></div>
    </div>
</section>
<!-- ==========Banner Section Ends Here========== -->

<!-- ==========Feature Section Start Here========== -->
<section class="feature-section padding-tb bg-color">
    <div class="container">
        <div class="feature-section-wrapper">
            <div class="section-header wow fadeInUp" data-wow-delay="" data-wow-duration="1s">
                <h2><span>We Offer Specialized</span> </h2>
                <h2> Orthopedics To Meet Your Needs</h2>
            </div>
            <div class="section-content">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <div class="lab-item feature-item wow fadeInLeft" data-wow-delay=".2s"
                             data-wow-duration="1s">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/feature/1.png" alt="feature img">
                                </div>
                                <div class="lab-content">
                                    <h4>Medical Treatment</h4>
                                    <p>Lorem ipsum dolor sit amete consectetur adipisicing elite. vlote optio animi?
                                    </p>
                                    <a href="#" class=""><span>Read More <i
                                                    class="icofont-rounded-double-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <div class="lab-item feature-item wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/feature/2.png" alt="feature img">
                                </div>
                                <div class="lab-content">
                                    <h4>Emergency Help</h4>
                                    <p>Lorem ipsum dolor sit amete consectetur adipisicing elite. vlote optio animi?
                                    </p>
                                    <a href="#" class=""><span>Read More <i
                                                    class="icofont-rounded-double-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <div class="lab-item feature-item wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/feature/3.png" alt="feature img">
                                </div>
                                <div class="lab-content">
                                    <h4>Medical Professionals</h4>
                                    <p>Lorem ipsum dolor sit amete consectetur adipisicing elite. vlote optio animi?
                                    </p>
                                    <a href="#" class=""><span>Read More <i
                                                    class="icofont-rounded-double-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                        <div class="lab-item feature-item wow fadeInRight" data-wow-delay=".2s"
                             data-wow-duration="1s">
                            <div class="lab-inner">
                                <div class="lab-thumb">
                                    <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/feature/4.png" alt="feature img">
                                </div>
                                <div class="lab-content">
                                    <h4>Qualified Doctors</h4>
                                    <p>Lorem ipsum dolor sit amete consectetur adipisicing elite. vlote optio animi?
                                    </p>
                                    <a href="#" class=""><span>Read More <i
                                                    class="icofont-rounded-double-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========Feature Section Ends Here========== -->

<!-- ==========Department Section Start Here========== -->
<section class="department-section padding-tb style-1">
    <div class="container">
        <div class="department-wrapper">
            <div class="section-header">
                <h2><span>We Are The </span></h2>
                <h2>Best Our Departments Centers</h2>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="">
                            <div class="department-top">
                                <ul class="nav dep-tab" role="tablist">
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                                        <a class="" href="#one" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/01.png" alt="depart"></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                                        <a class="active" href="#two" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/02.png" alt="depart"></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                                        <a class="" href="#three" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/03.png" alt="depart"></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                                        <a class="" href="#four" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/04.png" alt="depart"></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                                        <a class="" href="#five" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/05.png" alt="depart"></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                                        <a class="" href="#six" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/06.png" alt="depart"></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s">
                                        <a class="" href="#seven" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/07.png" alt="depart"></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
                                        <a class="" href="#eight" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/08.png" alt="depart"></a>
                                    </li>
                                    <li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".8s">
                                        <a class="" href="#nine" role="tab" data-toggle="tab"><img
                                                    src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/icon/09.png" alt="depart"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="department-bottom wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="one">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/07.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 1</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="two">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/08.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 2</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="three">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/09.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 3</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="four">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/10.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 4</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="five">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/4.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 5</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="six">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/5.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 6</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="seven">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/6.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 7</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="eight">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/07.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 8</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="nine">
                                    <div class="row flex-row-reverse align-items-center">
                                        <div class="col-12 col-lg-6">
                                            <div class="post-thumb">
                                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/depart/10.jpg" alt="depart">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="post-content">
                                                <h3>Speciality Rhinology 9</h3>
                                                <p>Procedur arrain manu producs rather convenet cuvate mantna this
                                                    man
                                                    Manucur produc rather conven cuvatie mantan this conven cuvate
                                                    bad
                                                    Credibly envisioneer ubiquitous niche markets transparent
                                                    relations
                                                    Dramatically enable worldwide action items whereas magnetic
                                                    source motin was procedur arramin</p>
                                                <ul>
                                                    <li>Qualified Doctors</li>
                                                    <li>Feel like Home Services</li>
                                                    <li>24×7 Emergency Services</li>
                                                    <li>Outdoor Checkup</li>
                                                    <li>General Medical</li>
                                                    <li>Easy and Affordable Billing</li>
                                                </ul>
                                                <a href="#" class="lab-btn"><span>Appointment Now <i
                                                                class="icofont-rounded-double-right"></i></span></a>
                                            </div>
                                        </div>
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
<!-- ==========Department Section Ends Here========== -->

<!-- ==========Counter Section Start Here========== -->
<div class="counter-section style-1 padding-60">
    <div class="container">
        <div class="section-wrapper">
            <div class="counter-item wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
                <div class="counter-item-inner">
                    <div class="counter-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/counter/01.png" alt="counter">
                    </div>
                    <div class="counter-content">
                        <h3 class="number"><span class="counter">500</span></h3>
                        <p class="post-content">Patients Every Day</p>
                    </div>
                </div>
            </div>
            <div class="counter-item wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                <div class="counter-item-inner">
                    <div class="counter-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/counter/02.png" alt="counter">
                    </div>
                    <div class="counter-content">
                        <h3 class="number"><span class="counter">400</span></h3>
                        <p class="post-content">Qualified Doctors</p>
                    </div>
                </div>
            </div>
            <div class="counter-item wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                <div class="counter-item-inner">
                    <div class="counter-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/counter/03.png" alt="counter">
                    </div>
                    <div class="counter-content">
                        <h3 class="number"><span class="counter">12</span></h3>
                        <p class="post-content">Years Experience</p>
                    </div>
                </div>
            </div>
            <div class="counter-item wow fadeInRight" data-wow-duration="1s" data-wow-delay=".4s">
                <div class="counter-item-inner">
                    <div class="counter-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/counter/04.png" alt="counter">
                    </div>
                    <div class="counter-content">
                        <h3 class="number"><span class="counter">350</span></h3>
                        <p class="post-content">Diagnosis Verity</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==========Counter Section Ends Here========== -->

<!-- ==========Service Section Start Here========== -->
<section class="service-section style-1 padding-tb bg-color">
    <div class="container">
        <div class="section-header wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
            <h2><span>We Are</span></h2>
            <h2>Offering Reliable Services</h2>
        </div>
        <div class="section-wrapper">
            <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                <div class="service-inner">
                    <div class="service-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/service/01.jpg" alt="service">
                    </div>
                    <div class="service-content">
                        <h4><a href="#">Family Health Solutions</a></h4>
                        <p>Proced arrain manu produc rather conve quvat mantan this conven multscplinari testin
                            motin was procedur aamng proced arrain manu produc rather conve quvat mantan this
                            convenmultscplinari testiners motin was procedur arraming</p>
                        <a href="#" class="lab-btn"><span>Read More <i
                                        class="icofont-rounded-double-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="service-item wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">
                <div class="service-inner">
                    <div class="service-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/service/02.jpg" alt="service">
                    </div>
                    <div class="service-content">
                        <h4><a href="#">Eye Care Solutions</a></h4>
                        <p>Cabor levera then andin the
                            Qualit bwdh then covae thm
                            Uabor evera then andin meqe
                            Any value cordin</p>
                        <a href="#" class="lab-btn"><span>Read More <i
                                        class="icofont-rounded-double-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="service-item wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                <div class="service-inner">
                    <div class="service-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/service/03.jpg" alt="service">
                    </div>
                    <div class="service-content">
                        <h4><a href="#">Children’s Health</a></h4>
                        <p>Cabor levera then andin the
                            Qualit bwdh then covae thm
                            Uabor evera then andin meqe
                            Any value cordin</p>
                        <a href="#" class="lab-btn"><span>Read More <i
                                        class="icofont-rounded-double-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                <div class="service-inner">
                    <div class="service-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/service/04.jpg" alt="service">
                    </div>
                    <div class="service-content">
                        <h4><a href="#">Dental Surgery</a></h4>
                        <p>Proced arrain manu produc rather conve quvat mantan this conven multscplinari testin
                            motin was procedur aamng proced arrain manu produc rather conve quvat mantan this
                            convenmultscplinari testiners motin was procedur arraming</p>
                        <a href="#" class="lab-btn"><span>Read More <i
                                        class="icofont-rounded-double-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========Service Section Ends Here========== -->


<!-- ==========Doctor Section Start Here========== -->
<section class="doctor-section style-1 padding-tb">
    <div class="container">
        <div class="section-header wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
            <h2><span>Meet Our</span></h2>
            <h2>Medixin Professional Doctors</h2>
        </div>
        <div class="section-wrapper">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="doctor-item style-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                        <div class="doctor-inner">
                            <div class="doctor-thumb">
                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/team/01.jpg" alt="doctor">
                            </div>
                            <div class="doctor-content">
                                <div class="doctor-name">
                                    <h4><a href="#">Dr. Jason Kovalsky</a></h4>
                                    <p class="digi">Cardiologist</p>
                                </div>
                                <ul class="doctor-contact">
                                    <li><span>Phone :</span> 658 222 127 964</li>
                                    <li><span>Email :</span> info@example.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="doctor-item style-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="doctor-inner">
                            <div class="doctor-thumb">
                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/team/02.jpg" alt="doctor">
                            </div>
                            <div class="doctor-content">
                                <div class="doctor-name">
                                    <h4><a href="#">Patricia Mcneel</a></h4>
                                    <p class="digi">Pediatrist</p>
                                </div>
                                <ul class="doctor-contact">
                                    <li><span>Phone :</span> 658 222 127 964</li>
                                    <li><span>Email :</span> info@example.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="doctor-item style-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="doctor-inner">
                            <div class="doctor-thumb">
                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/team/03.jpg" alt="doctor">
                            </div>
                            <div class="doctor-content">
                                <div class="doctor-name">
                                    <h4><a href="#">William Khanna</a></h4>
                                    <p class="digi">Throat Specialist</p>
                                </div>
                                <ul class="doctor-contact">
                                    <li><span>Phone :</span> 658 222 127 964</li>
                                    <li><span>Email :</span> info@example.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="doctor-item style-1 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="doctor-inner">
                            <div class="doctor-thumb">
                                <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/team/04.jpg" alt="doctor">
                            </div>
                            <div class="doctor-content">
                                <div class="doctor-name">
                                    <h4><a href="#">Eric Patterson</a></h4>
                                    <p class="digi">Therapy</p>
                                </div>
                                <ul class="doctor-contact">
                                    <li><span>Phone :</span> 658 222 127 964</li>
                                    <li><span>Email :</span> info@example.com</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="doctor-btn text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
            <a href="#" class="lab-btn"><span> view all doctors <i
                            class="icofont-rounded-double-right"></i></span></a>
        </div>
    </div>
</section>
<!-- ==========Doctor Section Ends Here========== -->


<!-- ==========Appointment Section Start Here========== -->
<section class="appointment-section style-1">
    <div class="container">
        <div class="section-wrapper">
            <div class="appointment-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
                <div class="time-info">
                    <div class="al-title">
                        <h2><span>24 Hours </span></h2>
                        <h2>Opening Our Services</h2>
                    </div>
                    <div class="dep-item">
                        <div class="dep-item-inner">
                            <div class="day-name">Satarday</div>
                            <div class="day-time">8:00 am-10:00 pm</div>
                        </div>
                    </div>
                    <div class="dep-item">
                        <div class="dep-item-inner">
                            <div class="day-name">Sunday</div>
                            <div class="day-time">6:00 am-8:00 pm</div>
                        </div>
                    </div>
                    <div class="dep-item">
                        <div class="dep-item-inner">
                            <div class="day-name">Monday</div>
                            <div class="day-time">6:00 am-2:00 pm</div>
                        </div>
                    </div>
                    <div class="dep-item">
                        <div class="dep-item-inner">
                            <div class="day-name">Tuesday</div>
                            <div class="day-time">7:00 am-9:00 pm</div>
                        </div>
                    </div>
                    <div class="dep-item">
                        <div class="dep-item-inner">
                            <div class="day-name">Widnessday</div>
                            <div class="day-time">10:00 am-12:00 pm</div>
                        </div>
                    </div>
                    <div class="dep-item">
                        <div class="dep-item-inner">
                            <div class="day-name">Thirsday</div>
                            <div class="day-time">2:00 am-6:00 pm</div>
                        </div>
                    </div>
                    <div class="dep-item">
                        <div class="dep-item-inner">
                            <div class="day-name">Friday</div>
                            <div class="day-time">Closed</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="appointment-right wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s">
                <div class="ar-title">
                    <h2><span>Make An</span></h2>
                    <h2>Appointment Now</h2>
                </div>
                <form action="#">
                    <input type="text" id="fname" name="firstname" placeholder="Your Name">
                    <select id="country" name="country">
                        <option value="1">Select Departments</option>
                        <option value="2">Dental</option>
                        <option value="3">U.C</option>
                    </select>
                    <input type="text" id="lname" name="lastname" placeholder="Phone Number">
                    <input type="date" id="start" name="trip-start" value="2021-02-21">
                    <button class="lab-btn" type="submit"><span>Appointment Now <i
                                    class="icofont-double-right"></i></span> </button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ==========Appointment Section Ends Here========== -->


<!-- ==========Blog Section Start Here========== -->
<section class="blog-section padding-tb bg-color">
    <div class="container">
        <div class="section-header wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
            <h2><span>News Feed</span></h2>
            <h2>Be The First To New Stories</h2>
        </div>
        <div class="section-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                    <div class="post-item-inner">
                        <div class="post-thumb">
                            <a href="https://labartisan.net/demo/template/medixin/medixin/assets/images/blog/1.jpg" data-rel="lightcase:myCollection"><img
                                        src="https://labartisan.net/demo/template/medixin/medixin/assets/images/blog/1.jpg" alt="blog post images"></a>
                        </div>
                        <div class="post-content">
                            <span class="meta">By <a href="#">Admin</a> March 24, 2021</span>
                            <h4><a href="#">Globa Empoer Extenve Chanels Extensve Creat Method</a></h4>
                            <p>Complete actuaze centi centrcing colora and sharin without anstaled anding bases
                                aweme medicalplus Template.</p>
                        </div>
                        <div class="blog-footer">
                            <a href="#" class="viewall">Read More <i class="icofont-double-right"></i></a>
                            <a href="#" class="blog-comment"><i class="icofont-comment"></i> 30</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="post-item-inner">
                        <div class="post-thumb">
                            <a href="https://labartisan.net/demo/template/medixin/medixin/assets/images/blog/2.jpg" data-rel="lightcase:myCollection"><img
                                        src="https://labartisan.net/demo/template/medixin/medixin/assets/images/blog/2.jpg" alt="blog"></a>
                        </div>
                        <div class="post-content">
                            <span class="meta">By <a href="#">Admin</a> March 4, 2021</span>
                            <h4><a href="#">Why do you need dental check up regularly for better..</a></h4>
                            <p>Complete actuaze centi centrcing colora and sharin without anstaled anding bases
                                aweme medicalplus Template.</p>
                        </div>
                        <div class="blog-footer">
                            <a href="#" class="viewall">Read More <i class="icofont-double-right"></i></a>
                            <a href="#" class="blog-comment"><i class="icofont-comment"></i> 30</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="post-item-inner">
                        <div class="post-thumb">
                            <a href="https://labartisan.net/demo/template/medixin/medixin/assets/images/blog/3.jpg" data-rel="lightcase:myCollection"><img
                                        src="https://labartisan.net/demo/template/medixin/medixin/assets/images/blog/3.jpg" alt="blog"></a>
                        </div>
                        <div class="post-content">
                            <span class="meta">By <a href="#">Admin</a> June 02, 2021</span>
                            <h4><a href="#">Lorem ipsum dolor sit, amet consectetur adipisicing. </a></h4>
                            <p>Complete actuaze centi centrcing colora and sharin without anstaled anding bases
                                aweme medicalplus Template.</p>
                        </div>
                        <div class="blog-footer">
                            <a href="#" class="viewall">Read More <i class="icofont-double-right"></i></a>
                            <a href="#" class="blog-comment"><i class="icofont-comment"></i> 30</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========Blog Section Ends Here========== -->


<!-- ==========Sponsor Section Start Here========== -->
<div class="sponsor-section">
    <div class="container">
        <div class="sponsor-area">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="sponsor-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/sponsor/1.png" alt="sponso-img">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="sponsor-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/sponsor/2.png" alt="sponso-img">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="sponsor-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/sponsor/3.png" alt="sponso-img">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="sponsor-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/sponsor/4.png" alt="sponso-img">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="sponsor-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/sponsor/5.png" alt="sponso-img">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="sponsor-thumb">
                        <img src="https://labartisan.net/demo/template/medixin/medixin/assets/images/sponsor/6.png" alt="sponso-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==========Sponsor Section Ends Here========== -->


<!-- ==========Newsletter Section Ends Here========== -->
<section class="newsletter-section style-1">
    <div class="container">
        <div class="section-wrapper">
            <div class="left wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".1s">
                <div class="news-title">
                    <h2>Join Our Newsletter</h2>
                </div>
            </div>
            <div class="right wow fadeInRight" data-wow-duration="1s" data-wow-delay=".1s">
                <div class="news-input">
                    <label for="text"><i class="icofont-paper-plane"></i></label>
                    <input type="text" name="text" id="text" placeholder="Enter Your Email">
                    <button class="" type="submit" value="Submit-Now" name="submit">Subscribe Now</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========Newsletter Section Ends Here========== -->


<!-- ==========Footer Section Ends Here========== -->
<section class="footer-section style-1">
    <div class="container">
        <div class="section-wrapper">
            <div class="footer-top">
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                        <div class="contact-info">
                            <h3>Contact Info</h3>
                            <p>Rapidiously seize wireless strategic theme areas and corporate testing
                                procedures.
                                Uniquely</p>
                            <ul class="lab-ul">
                                <li><i class="icofont-home"></i> Suite 02 New Jersey Road usa</li>
                                <li><i class="icofont-phone"></i> +880 142 258 123, 02-96936</li>
                                <li><i class="icofont-envelope"></i> <a href="#"> info@example.com</a></li>
                                <li><i class="icofont-globe"></i> <a href="#"> info@example.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="doctor-info mb-5 mb-sm-0">
                            <h3>Our Doctors</h3>
                            <ul class="lab-ul">
                                <li><i class="icofont-double-right"></i><a href="#"> Dr. Nick Sims</a></li>
                                <li><i class="icofont-double-right"></i><a href="#"> Dr. Michael Linden</a></li>
                                <li><i class="icofont-double-right"></i><a href="#"> Dr. Max Turner</a></li>
                                <li><i class="icofont-double-right"></i><a href="#"> Dr. Amy Adams</a></li>
                                <li><i class="icofont-double-right"></i><a href="#"> Dr. Julia Jameson</a></li>
                                <li><i class="icofont-double-right"></i><a href="#"> Dr. Michael Linden</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="service-info  mb-5 mb-sm-0">
                            <h3>Our Services</h3>
                            <ul class="lab-ul">
                                <li><i class="icofont-double-right"></i><a href="#">Outpatient Surgery</a></li>
                                <li><i class="icofont-double-right"></i><a href="#">Cardiac Clinic</a></li>
                                <li><i class="icofont-double-right"></i><a href="#">Ophthalmology Clinic</a>
                                </li>
                                <li><i class="icofont-double-right"></i><a href="#">Gynaecological Clinic</a>
                                </li>
                                <li><i class="icofont-double-right"></i><a href="#">Outpatient
                                        Rehabilitation</a>
                                </li>
                                <li><i class="icofont-double-right"></i><a href="#">Ophthalmology Clinic</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s">
                        <div class="time-info">
                            <h3>opening hours</h3>
                            <div class="dep-item">
                                <div class="dep-item-inner d-flex justify-content-between">
                                    <div class="day-name">Satarday</div>
                                    <div class="day-time">8:00 am-10:00 pm</div>
                                </div>
                            </div>
                            <div class="dep-item">
                                <div class="dep-item-inner d-flex justify-content-between">
                                    <div class="day-name">Sunday</div>
                                    <div class="day-time">6:00 am-8:00 pm</div>
                                </div>
                            </div>
                            <div class="dep-item">
                                <div class="dep-item-inner d-flex justify-content-between">
                                    <div class="day-name">Monday</div>
                                    <div class="day-time">6:00 am-2:00 pm</div>
                                </div>
                            </div>
                            <div class="dep-item">
                                <div class="dep-item-inner d-flex justify-content-between">
                                    <div class="day-name">Tuesday</div>
                                    <div class="day-time">7:00 am-9:00 pm</div>
                                </div>
                            </div>
                            <div class="dep-item">
                                <div class="dep-item-inner d-flex justify-content-between">
                                    <div class="day-name">Widnessday</div>
                                    <div class="day-time">10:00 am-12:00 pm</div>
                                </div>
                            </div>
                            <div class="dep-item">
                                <div class="dep-item-inner d-flex justify-content-between">
                                    <div class="day-name">Thirsday</div>
                                    <div class="day-time">2:00 am-6:00 pm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="copyright text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay=".1s">
                        <span>Copyright &copy; 2021 <a href="index.html">Medixin</a>. Designed by <a
                                    href="https://www.templatemonster.com/authors/labartisan/">LabArtisan</a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========Footer Section Ends Here========== -->
<!-- scrollToTop start here -->
<a href="#" class="scrollToTop"><i class="fa-solid fa-angles-up"></i></a>
<!-- scrollToTop ending here -->