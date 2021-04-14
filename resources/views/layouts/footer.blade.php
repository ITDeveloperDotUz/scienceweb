@include('layouts.content_bottom')

<!-- Main Footer -->
<footer class="main-footer">
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix">

                <!-- Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-6 col-12">
                    <div class="row clearfix">

                        <!-- Footer Column -->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget logo-widget">
                                <div class="logo">
                                    <a href="index.html"><h3>ScienceWeb</h3></a>
                                </div>
                                <div class="call">
                                    Связаться с нами
                                    <a class="phone" href="tel:+1-212-226-3126">+998 97 450 16 77</a>
                                    <a class="email" href="mailto:hello@consulte.co">info@scienceweb.uz</a>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Column -->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h5>Проект ScienceWeb</h5>
                                <ul class="list-link">
                                    <li><a href="{{ url('page/about_us') }}">О ScienceWeb</a></li>
                                    <li><a href="{{ url('page/what_we_offer') }}">Что мы предлагаем</a></li>
                                    <li><a href="{{ url('page/whom_we_offer') }}">Для кого предназначено</a></li>
                                    <li><a href="{{ url('page/advantages') }}">Зачем это нужно</a></li>
                                    <li><a href="{{ url('page/why_scienceweb') }}">Почему мы</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-6 col-12">
                    <div class="row clearfix">

                        <!-- Footer Column -->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h5>Пользователям</h5>
                                <ul class="list-link">
                                    <li><a href="">FAQS</a></li>
                                    <li><a href="">Support</a></li>
                                    <li><a href="">Sitemap</a></li>
                                    <li><a href="">Community</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Footer Column -->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget newsletter-widget">
                                <h5>Подписаться</h5>
                                <div class="text">Подпишитесь чтобы первым получать наши новости</div>
                                <!-- Newsletter Form -->
                                <div class="newsletter-form">
                                    <form method="post" action="contact.html">
                                        <div class="form-group">
                                            <input type="email" name="email" value="" placeholder="E-mail" required>
                                            <button type="submit" class="theme-btn icofont-arrow-right"></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="bottom-inner">
                    <div class="row clearfix">

                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="copyright">Copyright 2021. Все права защищены  | Проект создан компанией
                                 <a href="https://i-edu.uz" target="_blank">i-Edu Group</a>
                            </div>
                                <script async="" src="https://www.google-analytics.com/analytics.js"></script>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <ul class="social-nav">
                                <li><a href="https://twitter.com/" class="icofont-twitter"></a></li>
                                <li><a href="http://facebook.com/" class="icofont-facebook"></a></li>
                                <li><a href="https://www.instagram.com/" class="icofont-instagram"></a></li>
                                <li><a href="https://rss.com/" class="icofont-rss"></a></li>
                                <li><a href="https://www.youtube.com/" class="icofont-play-alt-1"></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>

</div>
<!--End pagewrapper-->

<!-- Search Popup -->
<div class="search-popup">
    <button class="close-search style-two"><span class="icofont-brand-nexus"></span></button>
    <button class="close-search"><span class="icofont-arrow-up"></span></button>
    <form method="post" action="blog.html">
        <div class="form-group">
            <input type="search" name="search-field" value="" placeholder="Введите поисковой запрос" required="">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
</div>
<!-- End Header Search -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-circle-up"></span></div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/appear.js') }}"></script>
<script src="{{ asset('js/owl.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/parallax.min.js') }}"></script>
<script src="{{ asset('js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

@yield('scripts')
</body>
</html>
