<!-- Main Header-->
<header class="main-header">

    <!-- Header Top -->
    <div class="header-top">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <!-- Top Left -->
                <div class="top-left">
                    <!-- Info List -->
                    <ul class="info-list">
                        <li><a href="mailto:hello@consulte.co"><span class="icon icofont-envelope"></span>info@scienceweb.uz</a></li>
                        <li><a href="tel:+1212-226-3126"><span class="icon icofont-phone"></span> +998 97 450 16 77</a></li>
{{--                        <li><a href="contact.html"><span class="icon icofont-clock-time"></span> Mon - Sat: 8.00 - 17.00, Sunday Closed</a></li>--}}
                    </ul>
                </div>

                <!-- Top Right -->
                <div class="top-right pull-right">
                    <!-- Social Box -->
                    <ul class="social-box">
                        @foreach(config('app.locales') as $locale)
                            <li><a href="{{ route('set.locale', $locale) }}"><img width="20" src="{{ asset('images/icons/flags/'.$locale.'-32.png') }}" alt=""></a></li>
                        @endforeach
                        @if(auth()->check())
                            <li><a href="{{ route('profile.home') }}">{{ __('site.cabinet') }}</a></li>
                            <li><a href="">|</a></li>
                            <li>
                                <form id="logout" action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <a onclick="document.getElementById('logout').submit()">Выход</a>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('register') }}">{{ __('site.register') }}</a></li>
                            <li><a href="">|</a></li>
                            <li><a href="{{ route('login') }}">{{ __('site.login') }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Upper -->
    <div class="header-upper">
        <div class="auto-container">
            <div class="inner-container clearfix">

                <div class="pull-left logo-box">
                    <div class="logo">
                        <a href="/" class=""><h2>ScienceWeb</h2>
                        </a>
                    </div>
                </div>

                <div class="nav-outer pull-left clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md">
                        <div class="navbar-header">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse show collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="dropdown"><a href="#">О нас</a>
                                    <ul>
                                        <li><a href="{{ url('page/what_we_offer') }}">Что мы предлагаем</a></li>
                                        <li><a href="{{ url('page/whom_we_offer') }}">Для кого предназначено</a></li>
                                        <li><a href="{{ url('page/advantages') }}">Зачем это нужно</a></li>
                                        <li><a href="{{ url('page/why_scienceweb') }}">Почему мы</a></li>
{{--                                        <li><a href="{{ url('page/prices') }}">Стоимость</a></li>--}}
                                    </ul>
                                </li>
{{--                                <li class="dropdown"><a href="#">Пользователям</a>--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="project.html">Редакторам</a></li>--}}
{{--                                        <li><a href="project-details.html">Рецензентам</a></li>--}}
{{--                                        <li><a href="project-details.html">Будущим клиентам</a></li>--}}
{{--                                        <li><a href="project-details.html">Авторам</a></li>--}}
{{--                                        <li><a href="project-details.html">Издателям</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
                                <li><a href="{{ url('journals') }}">Журналы</a></li>
                                <li><a href="{{ route('event.show', 'conference') }}">Конференции</a></li>
                                <li><a href="{{ url('publishers') }}">Издатели</a></li>
{{--                                <li><a href="#">Экспертиза сайта</a></li>--}}
                                <li><a href="{{ url('contacts') }}">Контакты</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- Outer Box -->
                <div class="outer-box">
                    <!-- Search Btn -->
                    <div class="search-box-btn search-box-outer"><span class="icon icofont-search"></span></div>
                    <!-- Mobile Navigation Toggler -->
                    <div class="mobile-nav-toggler"><span class="icon ti-menu"></span></div>
                </div>

            </div>
        </div>
    </div>
    <!--End Header Upper-->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon lnr lnr-cross"></span></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="index.html"><img src="images/logo.png" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        </nav>
    </div><!-- End Mobile Menu -->

</header>
<!--End Main Header -->
