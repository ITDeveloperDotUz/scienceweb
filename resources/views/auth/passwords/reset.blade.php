@extends('layouts.app')

@section('content')
    <div class="reputation-section-two style-three">
        <div class="auto-container">
            <div class="row clearfix justify-content-center">
                <!-- Form Column -->
                <div class="form-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="form-boxed">
                            <h5>Сбросить пароль</h5>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="consult-form">
                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                <!--Form Group-->
                                    <div class="form-group">
                                        <label for="email">Электронная почта</label>
                                        <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Введите ваш email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Новый пароль</label>
                                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Введите новый пароль" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">Пароль еще раз</label>
                                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="txt">Сохранить</span></button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
