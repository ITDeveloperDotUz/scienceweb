<div class="contact-form">
    <!-- Contact Form -->
    <form method="post" action="{{ url('register') }}" id="contact-form">
        @csrf
        <input type="hidden" name="role" id="publisher" value="publisher">

        <div class="row clearfix">
            <div class="col-sm-12 form-group">
                <label for="name">Название организации</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @if($errors->has('name'))
                    @foreach($errors->get('name') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="type">Форма организации</label>
                <select name="type" id="type" required>
                    @foreach($org_types as $key => $type)
                        <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : ''}}>{{ $type }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    @foreach($errors->get('type') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                <label for="tin">ИНН</label>
                <input type="text" name="tin" id="tin" value="{{ old('tin') }}" required>
                @if($errors->has('tin'))
                    @foreach($errors->get('tin') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-4 col-sm-12 form-group">
                <label for="country_code">Страна</label>
                <select name="country_code" id="country_code" required>
                    @foreach($countries as $country)
                        <option value="{{ $country->iso2 }}" {{ old('country_code') == $country->iso2 ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-8 col-sm-12 form-group">
                <label for="state">Область / Провинция</label>
                <input type="text" id="state" name="state" placeholder="Область / Провинция"  value="{{ old('state') }}" required>
                @if($errors->has('state'))
                    @foreach($errors->get('state') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="postal_code">Почтовый индекс</label>
                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required>
                @if($errors->has('postal_code'))
                    @foreach($errors->get('postal_code') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-8 col-sm-12 form-group">
                <label for="address">Полный Адрес</label>
                <input type="text" id="address" name="address" placeholder="Полный Адрес"  value="{{ old('address') }}" required>
                @if($errors->has('address'))
                    @foreach($errors->get('address') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-4 col-sm-12 form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    @foreach($errors->get('email') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="phone">Телефон</label>
                <input type="text" id="phone" name="phone" placeholder="Пример: 998901234567" value="@isset($input['phone']){{ $input['phone'] }}@endisset" required>
                @if($errors->has('phone') !== null)
                    @foreach($errors->get('phone') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="affiliate_person">Полное имя уполномоченного лица</label>
                <input type="text" id="affiliate_person" name="affiliate_person" placeholder="Полное имя уполномоченного лица" value="{{ old('affiliate_person') }}" required>
                @if($errors->has('affiliate_person'))
                    @foreach($errors->get('affiliate_person') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-4 col-sm-12 form-group">
                <label for="bank_account">Расчетный счет</label>
                <input type="text" name="bank_account" id="bank_account" placeholder="0000 0000 0000 0000 0000" value="{{ old('bank_account') }}" required>
                @if($errors->has('bank_account'))
                    @foreach($errors->get('bank_account') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="bank_code">МФО</label>
                <input type="text" name="bank_code" id="bank_code" placeholder="00 123" value="{{ old('bank_code') }}" required>
                @if($errors->has('bank_code'))
                    @foreach($errors->get('bank_code') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 col-sm-12 form-group">
                <label for="bank_name">Наименование банка</label>
                <input type="text" id="bank_name" name="bank_name" placeholder="Наименование банка" value="@isset($input['bank_name']){{ $input['bank_name'] }}@endisset" required>
                @if($errors->has('bank_name') !== null)
                    @foreach($errors->get('bank_name') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>


            <div class="col-sm-12 form-group">
                <label for="website">Веб сайт</label>
                <input type="text" id="website" name="website" placeholder="Наименование банка" value="@isset($input['website']){{ $input['website'] }}@endisset">
                @if($errors->has('website') !== null)
                    @foreach($errors->get('website') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>

            <div class="col-md-6 col-sm-12 form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" placeholder="Пароль">
                @if($errors->has('password'))
                    @foreach($errors->get('password') as $msg)
                        <strong class="text-danger">{{ $msg }}</strong><br>
                    @endforeach
                @endif
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <label for="password_confirmation">Подтвердите пароль</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Подтвердите пароль">
            </div>
            <div class="col-md-6 col-sm-12 form-group">
                <input type="checkbox" name="accept" id="accept">
                <label for="accept">Принимаю условия</label>
                @if($errors->has('accept'))
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
