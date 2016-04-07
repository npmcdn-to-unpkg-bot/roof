@extends('layout')

@section('content')
<div class="container breadcrumbs">
    <span class="breadcumbs__current">АВТОРИЗАЦИЯ</span>
</div>
<div class="container">
    <div class="container__col-left">
        <form action="{{ url('/login') }}" method="POST" class="reg-page reg-page_layout">
            {!! csrf_field() !!}
            <div class="title">ВХОД</div>      
            <div class="offset_vertical_30">
                <input type="email" class="input input_bold input_100 {{ $errors->has('email') ?  'input_error' : '' }} " placeholder="EMAIL" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))<div class="error">{{ $errors->first('email') }}</div>@endif
            </div>
            <div class="offset_vertical_30">
                <input type="password" class="input input_bold input_100 {{ $errors->has('password') ?  'input_error' : '' }} " placeholder="ПАРОЛЬ" name="password">
                @if ($errors->has('password'))<div class="error">{{ $errors->first('password') }}</div>@endif
            </div>
            <div class="offset_vertical_30">
                <label>
                    <input type="checkbox" class="input_checkbox" name="remember"><span></span> Запомнить меня
                </label>
            </div>
            <button class="button button_big button_minth reg-page__button">ВХОД</button>
            <div class="reg-page__login">Нет аккаунта? <a href="{{ url('/register') }}" class="reg-page__login">Регистрация</a></div>
        </form>
    </div>
    <div class="container__col-left reg-social">
        <div class="title">Или авторизуйтесь с помощью социальных сетей</div>

    </div>
</div>
@endsection
