<div class="contact-form">
    <div class="my-3 centered">
        <a class="btn btn-default" href="{{ url('/auth/service/orcid') }}"><span class="txt"><img
                    src="{{ asset('images/icons/social/orcid.png') }}" alt="orcid icon"> Register with ORCID</span></a>
    </div>
    <!-- Contact Form -->
    <form method="post" action="{{ url('register') }}" id="contact-form">
        @csrf
        <input type="hidden" name="role" id="author" value="author">

        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label for="">Имя</label>
                <input type="text" name="first_name" placeholder="Имя" value="@isset($input['first_name']){{ $input['first_name'] }}@endisset">
                @if($errors->has('first_name') !== null)
                    @foreach($errors->get('first_name') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label for="">Фамилия</label>
                <input type="text" name="last_name" placeholder="Фамилия" value="@isset($input['last_name']){{ $input['last_name'] }}@endisset" required>
                @if($errors->has('last_name') !== null)
                    @foreach($errors->get('last_name') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 form-group">
                <label for="">Отчество</label>
                <input type="text" name="middle_name" placeholder="Отчество" value="@isset($input['middle_name']){{ $input['middle_name'] }}@endisset">
                @if($errors->has('middle_name') !== null)
                    @foreach($errors->get('middle_name') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Email" value="@isset($input['email']){{ $input['email'] }}@endisset" required>
                @if($errors->has('email') !== null)
                    @foreach($errors->get('email') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label for="">Телефон</label>
                <input type="text" name="phone" placeholder="Телефон" value="@isset($input['phone']){{ $input['phone'] }}@endisset" required>
                @if($errors->has('phone') !== null)
                    @foreach($errors->get('phone') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-4 col-sm-12 form-group">
                <label for="country_code">Страна</label>
                <select name="country_code" id="country_code" required>
                    @foreach($countries as $country)
                        <option value="{{ $country->iso2 }}" @isset($input['country_code']){{ $input['country_code'] == $country->iso2 ? 'selected' : '' }}@endisset>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8 col-sm-12 form-group">
                <label for="">Область / Провинция</label>
                <input type="text" name="state" placeholder="Область / Провинция"  value="@isset($input['state']){{ $input['state'] }}@endisset">
                @if($errors->has('state') !== null)
                    @foreach($errors->get('state') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <label for="gs_profile">Сылка на профиль в Google Scholar</label>
                <input type="text" name="gs_profile" placeholder="Оставьте хдесь сылку" value="@isset($input['gs_profile']){{ $input['gs_profile'] }}@endisset" >
                @if($errors->has('gs_profile') !== null)
                    @foreach($errors->get('gs_profile') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label for="">ORCID</label>
                <input type="text" name="orcid" placeholder="Оставьте здесь ваш ORCID" value="@isset($input['orcid']){{ $input['orcid'] }}@endisset">
                @if($errors->has('orcid') !== null)
                    @foreach($errors->get('orcid') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <label for="">Пароль</label>
                <input type="password" name="password" placeholder="Пароль">
                @if($errors->has('password') !== null)
                    @foreach($errors->get('password') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label for="">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" placeholder="Подтвердите пароль">
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <input type="checkbox" name="accept" id="accept">
                <label for="accept">Принимаю условия</label>
                @if($errors->has('accept') !== null)
                    @foreach($errors->get('accept') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 text-center form-group">
                <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="txt">Отправить</span></button>
            </div>
        </div>
    </form>
</div>
