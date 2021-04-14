@extends('layouts.app')


@section('content')
    <div class="reputation-section-two style-two">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Content Column -->
                <div class="content-column col-lg-7 col-md-12 col-sm-12">
                    <div class="">
                        <div class="sec-title">
                            <div class="title">ScienceWeb</div>
                            <h2><span>Поддержка научных </span>издательств основная миссия проекта</h2>
                        </div>
                        <div class="blocks-outer">

                            <!-- Reputation Block -->
                            <div class="reputation-block">
                                <div class="inner-box">
                                    <h5>Создание электронных систем научных публикаций</h5>
                                    <div class="text">Все этапы публикации научных работ полностью автоматизированы. Все происходит в реальном режиме</div>
                                </div>
                            </div>

                            <!-- Reputation Block -->
                            <div class="reputation-block">
                                <div class="inner-box">
                                    <h5>Продвижение научных работ по всему миру</h5>
                                    <div class="text">Абсолютно все публикации будут включены в поисковик Google Scholar, DOAJ и другие научные базы.</div>
                                </div>
                            </div>

                            <!-- Reputation Block -->
                            <div class="reputation-block">
                                <div class="inner-box">
                                    <h5>Предусмотрено оддержка для отдельных авторов</h5>
                                    <div class="text">Авторы также имеют возможность. Публиковать свои научные работы в ScienceWeb </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="form-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="form-boxed">
                            <h5>Вход в личный кабинет</h5>

                            <div class="consult-form">
                                <div class="card my-3" id="login_form_tabs" role="tablist">
                                    <ul class="nav nav-pills nav-fill"  role="presentation">
                                        <li class="nav-item">
                                            <a
                                                class="nav-link active"
                                                id="author-role-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#author"
                                                type="button"
                                                role="tab"
                                                aria-controls="author"
                                                aria-selected="true">
                                                Author
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                class="nav-link"
                                                id="publisher-role-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#publisher"
                                                type="button"
                                                role="tab"
                                                aria-controls="publisher"
                                                aria-selected="false">
                                                Publisher
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="author" role="tabpanel" aria-labelledby="author-role-tab">
                                        <form method="post" action="{{ url('login') }}">
                                        @csrf
                                        <!--Form Group-->
                                            <input type="hidden" name="role" value="user">
                                            <div class="form-group">
                                                <label for="email">лектронная почта</label>
                                                <input type="email" id="email" name="email" value="" placeholder="Введите ваш email" required="">
                                                @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!--Form Group-->
                                            <div class="form-group">
                                                <label for="password">Пароль</label>
                                                <input type="password" id="password" name="password" value="" placeholder="Введите ваш пароль" required="">
                                            </div>
                                            <!--Form Group-->
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="remember">Запомнить </label>
                                                    <input type="checkbox" id="remember" name="remember">
                                                </div>
                                                <div class="form-group col-6">
                                                    <a class="pull-right" href="{{ route('password.request') }}">Forgot password?</a>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="txt">Войти</span></button>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="tab-pane fade" id="publisher" role="tabpanel" aria-labelledby="publisher-role-tab">
                                        <form method="post" action="{{ url('login') }}">
                                        @csrf
                                        <!--Form Group-->
                                            <input type="hidden" name="role" value="publisher">

                                            <div class="form-group">
                                                <label for="email">лектронная почта</label>
                                                <input type="email" id="email" name="email" value="" placeholder="Введите ваш email" required="">
                                                @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!--Form Group-->
                                            <div class="form-group">
                                                <label for="password">Пароль</label>
                                                <input type="password" id="password" name="password" value="" placeholder="Введите ваш пароль" required="">
                                            </div>
                                            <!--Form Group-->
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="remember">Запомнить </label>
                                                    <input type="checkbox" id="remember" name="remember">
                                                </div>
                                                <div class="form-group col-6">
                                                    <a class="pull-right" href="{{ route('password.request') }}">Forgot password?</a>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button class="theme-btn btn-style-one" type="submit"><span class="txt">Войти</span></button>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="auto-container">
                            <div class="row pt-2 text-center">
                                <a class="theme-btn btn-style-two col-12" href="{{ url('register') }}"><span class="txt">Регистрация</span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
