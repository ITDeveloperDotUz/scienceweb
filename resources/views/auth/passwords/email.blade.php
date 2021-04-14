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
                                <form method="post" action="{{ route('password.email') }}">
                                @csrf
                                <!--Form Group-->
                                    <div class="form-group">
                                        <label for="email">Электронная почта</label>
                                        <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Введите ваш email" required>
                                        @if($errors->has('email') !== null)
                                            @foreach($errors->get('email') as $email)
                                                <p class="text-danger">{{ $email }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="txt">Сбросить</span></button>
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
