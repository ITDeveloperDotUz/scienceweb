@extends('layouts.app')

@section('content')

    <!-- Banner Section -->
    <div class="banner-section">
        <div class="main-slider-carousel owl-carousel owl-theme">
            <div class="slide" data-bg-image="images/main-slider/banner1.jpg">
                <div class="auto-container w-100">
                    <div class="row clearfix">
                        <!-- Content Column -->
                        <div class="content-column col-lg-7 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="title">I-Edu Group </div>
                                <h1>База <span> Научных исследований</span> в Узбекистане</h1>
                                <div class="text">
                                    Мы оказываем услуги создания и продвижения <br>
                                    научных публикаций издателей в Республике Узбекистан
                                </div>
                                <div class="btn-box">
                                    <a href="{{ url('journals') }}" class="theme-btn btn-style-one"><span class="txt">Список журналов</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slide" data-bg-image="images/main-slider/banner2.jpg">
                <div class="auto-container w-100">
                    <div class="row clearfix">
                        <!-- Content Column -->
                        <div class="content-column col-lg-7 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="title">I-Edu Group </div>
                                <h1>База <span> Научных исследований</span> в Узбекистане</h1>
                                <div class="text">
                                    Мы оказываем услуги создания и продвижения <br>
                                    научных публикаций издателей в Республике Узбекистан
                                </div>
                                <div class="btn-box">
                                    <a href="{{ url('journals') }}" class="theme-btn btn-style-one"><span class="txt">Список журналов</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- End Banner Section -->

    <!-- CTA Section Start -->
    <div class="cta-section" data-bg-image="images/background/cta-bg.jpg">
        <div class="auto-container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <!-- CTA Content Start -->
                    <div class="cta-content">
                        <h3 class="title">Хотите получить консультацию по публикациям? <span class="text-bold">Позвоните прямо сейчас!</span></h3>
{{--                        <p>Мы обеспечиваем 24/7 поддержку на этой линии</p>--}}
                    </div>
                    <!-- CTA Content End -->
                </div>
                <div class="col-lg-5">
                    <!-- CTA Phone Number Start -->
                    <div class="cta-phone text-lg-end text-strat">
                        <h2 class="title">+998 97 450 16 77</h2>
                    </div>
                    <!-- CTA Phone Number Start -->
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Section End -->

    <!-- About Section -->
    <div class="about-section">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row align-items-center clearfix">
                    <!-- Image Column -->
                    <div class="image-column col-lg-6">
                        <div class="about-image">
                            <div class="about-inner-image">
                                <img src="images/about/home-about.png" alt="about">
                            </div>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="content-column col-lg-6 col-md-12 col-sm-12 mb-0">
                        <div class="about-column">
                            <div class="sec-title">
                                <div class="title">Мы поможем </div>
                                <h2>с <span>созданием</span> <br> и <span>продвижением</span> научных публикаций</h2>
                            </div>
                            <div class="text">
                                <p>Результаты экспертного заключения относятся исключительно к техническим деталям реализации
                                    сайта журнала, касающихся обязательных и рекомендуемых международных и российских требований
                                    различных реферативных баз данных, индексных и abstracts-каталогов, в том числе ВАК, Scopus,
                                    Web of Science, PubMed, DOAJ и соответствия лучшим практикам создания и поддержания сайтов
                                    научных журналов. Результаты экспертизы ни в коем случае не касаются научной составляющей и
                                    значимости публикуемых материалов, а также ценности их для научного сообщества.
                                </p>
                            </div>
                            <div class="signature">i-edu <span>U. Mirzalimov</span></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End About Section -->

    @include('layouts.top_articles')

    <!-- Services Section -->
    <div class="services-section">
        <div class="auto-container">
            <div class="sec-title">
{{--                <div class="title">Кратко о нас</div>--}}
                <h2><span>Кратко</span> о нас</h2>
            </div>
            <div class="inner-container">
                <div class="row g-0">

                    <!-- Service Block -->
                    <div class="service-block col-lg-3 col-md-6  col-sm-12">
                        <div class="inner-box">
{{--                            <div class="icon-box">--}}
{{--                                <span class="icon ti-blackboard"></span>--}}
{{--                            </div>--}}
                            <h5><a href="{{ url('page/what_we_offer') }}">ЧТО МЫ ПРЕДЛАГАЕМ</a></h5>
                            <div class="text">
                                Научным журналам – сайт, электронную редакцию, предпечатную подготовку и печать, DOI, продвижение в Google Scholar, развитие журнала...
                            </div>
                            <a class="read-more" href="{{ url('page/what_we_offer') }}">Подробнее <span class="ti-angle-right"></span></a>
                        </div>
                    </div>

                    <!-- Service Block -->
                    <div class="service-block col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
{{--                            <div class="icon-box">--}}
{{--                                <span class="icon ti-stats-up"></span>--}}
{{--                            </div>--}}
                            <h5><a href="{{ url('page/whom_we_offer') }}">ДЛЯ КОГО ПРЕДНАЗНАЧЕНО</a></h5>
                            <div class="text">
                                Выпускаете научный журнал? Если вы руководитель издательства, главный редактор, редактор или ответственный секретарь...
                            </div>
                            <a class="read-more" href="{{ url('page/whom_we_offer') }}">Подробнее <span class="ti-angle-right"></span></a>
                        </div>
                    </div>

                    <!-- Service Block -->
                    <div class="service-block col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
{{--                            <div class="icon-box">--}}
{{--                                <span class="icon ti-shield"></span>--}}
{{--                            </div>--}}
                            <h5><a href="{{ url('page/advantages') }}">ЗАЧЕМ ЭТО НУЖНО</a></h5>
                            <div class="text">
                                Повысим качество журнала. Упростим процесс издания, сделаем его дешевле и даже поможем зарабатывать на нём...
                            </div>
                            <a class="read-more" href="{{ url('page/advantages') }}">Подробнее <span class="ti-angle-right"></span></a>
                        </div>
                    </div>

                    <!-- Service Block -->
                    <div class="service-block col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
{{--                            <div class="icon-box">--}}
{{--                                <span class="icon ti-home"></span>--}}
{{--                            </div>--}}
                            <h5><a href="{{ url('page/why_scienceweb') }}">ПОЧЕМУ МЫ</a></h5>
                            <div class="text">
                                Мы доказали на практике эффективность наших решений. Есть много причин, по которым нам доверяют уже больше 300 журналов...
                            </div>
                            <a class="read-more" href="{{ url('page/why_scienceweb') }}">Подробнее <span class="ti-angle-right"></span></a>
                        </div>
                    </div>

                    <!-- Service Block -->
{{--                    <div class="service-block col-lg-4 col-md-4 col-sm-12">--}}
{{--                        <div class="inner-box">--}}
{{--                            <div class="icon-box">--}}
{{--                                <span class="icon ti-stamp"></span>--}}
{{--                            </div>--}}
{{--                            <h5><a href="service-detail.html">СТОИМОСТЬ</a></h5>--}}
{{--                            <div class="text">--}}
{{--                                Гибкие тарифы под различные потребности. Выгодные предложения для размещения нескольких журналов...--}}
{{--                            </div>--}}
{{--                            <a class="read-more" href="service-detail.html">Подробнее <span class="ti-angle-right"></span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Section -->


{{--    <!-- Experts Section -->--}}
{{--    <div class="experts-section">--}}
{{--        <div class="auto-container">--}}

{{--            <!-- Sec Title -->--}}
{{--            <div class="sec-title">--}}
{{--                <div class="clearfix">--}}
{{--                    <div class="pull-left">--}}
{{--                        <div class="title">our services</div>--}}
{{--                        <h2>We Are <span>Friendly & Profressional</span></h2>--}}
{{--                    </div>--}}
{{--                    <div class="pull-right">--}}
{{--                        <a href="service.html" class="experts">all experts <span class="arrow ti-angle-right"></span></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row clearfix">--}}

{{--                <!-- Team Block -->--}}
{{--                <div class="team-block col-lg-4 col-md-6 col-sm-6 col-12">--}}
{{--                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">--}}
{{--                        <div class="image">--}}
{{--                            <a href="#"><img src="images/resource/team-1.jpg" alt="" /></a>--}}
{{--                            <!-- Social Box -->--}}
{{--                            <ul class="social-box">--}}
{{--                                <li><a href="https://twitter.com/" class="icofont-twitter"></a></li>--}}
{{--                                <li><a href="http://facebook.com/" class="icofont-facebook"></a></li>--}}
{{--                                <li><a href="https://www.instagram.com/" class="icofont-instagram"></a></li>--}}
{{--                                <li><a href="https://www.linkedin.com/" class="icofont-linkedin"></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="lower-box mt-0">--}}
{{--                            <h4><a href="#">Edward Eric Jr</a></h4>--}}
{{--                            <div class="designation">Business & Financial Expert</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Team Block -->--}}
{{--                <div class="team-block col-lg-4 col-md-6 col-sm-6 col-12">--}}
{{--                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">--}}
{{--                        <div class="image">--}}
{{--                            <a href="#"><img src="images/resource/team-2.jpg" alt="" /></a>--}}
{{--                            <!-- Social Box -->--}}
{{--                            <ul class="social-box">--}}
{{--                                <li><a href="https://twitter.com/" class="icofont-twitter"></a></li>--}}
{{--                                <li><a href="http://facebook.com/" class="icofont-facebook"></a></li>--}}
{{--                                <li><a href="https://www.instagram.com/" class="icofont-instagram"></a></li>--}}
{{--                                <li><a href="https://www.linkedin.com/" class="icofont-linkedin"></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="lower-box mt-0">--}}
{{--                            <h4><a href="#">Tom Holland</a></h4>--}}
{{--                            <div class="designation">Logistic & Communication Expert</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Team Block -->--}}
{{--                <div class="team-block col-lg-4 col-md-6 col-sm-6 col-12">--}}
{{--                    <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">--}}
{{--                        <div class="image">--}}
{{--                            <a href="#"><img src="images/resource/team-3.jpg" alt="" /></a>--}}
{{--                            <!-- Social Box -->--}}
{{--                            <ul class="social-box">--}}
{{--                                <li><a href="https://twitter.com/" class="icofont-twitter"></a></li>--}}
{{--                                <li><a href="http://facebook.com/" class="icofont-facebook"></a></li>--}}
{{--                                <li><a href="https://www.instagram.com/" class="icofont-instagram"></a></li>--}}
{{--                                <li><a href="https://www.linkedin.com/" class="icofont-linkedin"></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="lower-box mt-0">--}}
{{--                            <h4><a href="#">Laura Erakovic</a></h4>--}}
{{--                            <div class="designation">Consumer Market Expert</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Experts Section -->--}}

{{--    <!-- Blog Section -->--}}
{{--    <div class="blog-section">--}}
{{--        <div class="auto-container">--}}
{{--            <!-- Sec Title -->--}}
{{--            <div class="sec-title centered">--}}
{{--                <div class="title">our blog</div>--}}
{{--                <h2><span>Latest </span>From Our Press</h2>--}}
{{--            </div>--}}
{{--            <div class="inner-container">--}}
{{--                <div class="clearfix row g-0">--}}
{{--                    <!-- Column -->--}}
{{--                    <div class="column col-lg-8 col-md-12 col-sm-12">--}}

{{--                        <!-- News Block -->--}}
{{--                        <div class="news-block">--}}
{{--                            <div class="inner-box">--}}
{{--                                <div class="clearfix">--}}
{{--                                    <!-- Image Column -->--}}
{{--                                    <div class="image-column col-lg-6 col-md-6 col-sm-12">--}}
{{--                                        <div class="inner-column">--}}
{{--                                            <div class="image">--}}
{{--                                                <a href="blog-detail.html"><img src="images/resource/news-1.jpg" alt="" /></a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Content Column -->--}}
{{--                                    <div class="content-column col-lg-6 col-md-6 col-sm-12">--}}
{{--                                        <div class="inner-column">--}}
{{--                                            <div class="arrow-one"></div>--}}
{{--                                            <div class="title">business</div>--}}
{{--                                            <h4><a href="blog-detail.html">Problems About <br> Social Insurance For <br> Truck Drivers</a></h4>--}}
{{--                                            <div class="post-date">Decmber 14th, 2020 by <span>Admin</span></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- News Block -->--}}
{{--                        <div class="news-block">--}}
{{--                            <div class="inner-box">--}}
{{--                                <div class="clearfix row g-0">--}}
{{--                                    <!-- Content Column -->--}}
{{--                                    <div class="content-column col-lg-6 col-md-6 col-sm-12 order-lg-1 order-2">--}}
{{--                                        <div class="inner-column">--}}
{{--                                            <div class="arrow-two"></div>--}}
{{--                                            <div class="title">bank & finance</div>--}}
{{--                                            <h4><a href="blog-detail.html">Payment Online - <br> Things That You Know To <br> Project Your Money</a></h4>--}}
{{--                                            <div class="post-date">Decmber 14th, 2020 by <span>Admin</span></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Image Column -->--}}
{{--                                    <div class="image-column col-lg-6 col-md-6 col-sm-12 order-lg-2 order-1">--}}
{{--                                        <div class="inner-column">--}}
{{--                                            <div class="image">--}}
{{--                                                <a href="blog-detail.html"><img src="images/resource/news-2.jpg" alt="" /></a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <!-- Column -->--}}
{{--                    <div class="column col-lg-4 col-md-12 col-sm-12">--}}
{{--                        <!-- News Block Two -->--}}
{{--                        <div class="news-block-two">--}}
{{--                            <div class="inner-box">--}}
{{--                                <div class="image">--}}
{{--                                    <a href="blog-detail.html"><img src="images/resource/news-3.jpg" alt="" /></a>--}}
{{--                                    <div class="arrow"></div>--}}
{{--                                </div>--}}
{{--                                <div class="lower-content">--}}
{{--                                    <div class="title">tips & tricks</div>--}}
{{--                                    <h4><a href="blog-detail.html">5 Secrets To <br> Coaching Your Employees <br> To Greatness</a></h4>--}}
{{--                                    <div class="post-date">Decmber 14th, 2020 by <span>Admin</span></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Blog Section -->--}}

{{--    <!-- Map Section -->--}}
{{--    <div class="map-section">--}}
{{--        <div class="contact-map-area">--}}
{{--            <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2136.986005919501!2d-73.9685579655238!3d40.75862446708152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258e4a1c884e5%3A0x24fe1071086b36d5!2sThe%20Atrium!5e0!3m2!1sen!2sbd!4v1585132512970!5m2!1sen!2sbd" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Map Section -->--}}


@endsection
