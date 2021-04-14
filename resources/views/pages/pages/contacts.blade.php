@extends('layouts.app')




@section('content')
    <!-- Map Section -->
    <div class="map-section">
        <div class="contact-map-area">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11987.5630686617!2d69.24300970964323!3d41.31123985602578!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8b057e077235%3A0xfbc9d27281266e15!2z0KLQsNGI0LrQtdC90YLRgdC60LjQuSDQk9C-0YHRg9C00LDRgNGB0YLQstC10L3QvdGL0Lkg0K3QutC-0L3QvtC80LjRh9C10YHQutC40Lkg0KPQvdC40LLQtdGA0YHQuNGC0LXRgiwgNDkgTyd6YmVraXN0b24gc2hvaCBrbydjaGFzaSwg0KLQsNGI0LrQtdC90YIgMTAwMDAzLCDQo9C30LHQtdC60LjRgdGC0LDQvQ!5e0!3m2!1sru!2s!4v1611545206514!5m2!1sru!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            {{--            <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2136.986005919501!2d-73.9685579655238!3d40.75862446708152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258e4a1c884e5%3A0x24fe1071086b36d5!2sThe%20Atrium!5e0!3m2!1sen!2sbd!4v1585132512970!5m2!1sen!2sbd" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>--}}
        </div>
    </div>
    <!-- End Map Section -->

    <!-- Contact Page Section -->
    <div class="contact-page-section">
        <div class="auto-container">
            <!-- Contact Info Boxed -->
            <div class="contact-info-boxed">
                <div class="row clearfix">

                    <!-- Column -->
                    <div class="column col-lg-6 col-md-6 col-sm-12">
                        <h2>Ташкент, <span>Шайхантахурский район</span></h2>
                        <div class="text">улица И.Каримов, дом 49, <br> Ориентир: Напротив Tashkent city</div>
                        <div class="email">Email: <a href="mailto:infor@consulte.co">info@scienceweb.uz</a></div>
                    </div>

                    <!-- Column -->
                    <div class="column col-lg-6 col-md-6 col-sm-12">
                        <div class="call">Call directly:<br><a href="#">+998 97 450 16 77</a></div>
                        <ul class="location-list">
                            <li><span>Brand Offices:</span>Allentown PA | Allanta, GA | Chicago, IL | Dallas, TX, <br> Edison, NJ | Houston, TX</li>
                            <li><span>График работы:</span>Пн - Сб: 8.00 - 17.00, Воскресение выходной</li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Form Boxed -->
            <div class="form-boxed">
                <div class="sec-title centered">
                    <div class="title">Свяжитесь с нами</div>
                    <h2>По всем вопросам <span>интересующих вас</span></h2>
                </div>

                <div class="boxed-inner">
                    <!-- Contact Form -->
                    <div class="contact-form">
                        <!-- Contact Form -->
                        <form method="post" action="mail.php" id="contact-form">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="name" placeholder="Ф.И.О." required>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="E-mail" required>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="subject" placeholder="Тема сообщении" required>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea name="message" placeholder="Сообщение"></textarea>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 text-center form-group">
                                    <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="txt">Отправить</span></button>
                                </div>

                            </div>
                        </form>
                        <p class="form-messege"></p>

                    </div>
                    <!--End Contact Form -->
                </div>

            </div>

        </div>
    </div>
    <!-- End Blog Detail Section -->

@endsection
