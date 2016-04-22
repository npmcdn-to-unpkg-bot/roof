@extends('public.layout')

@section('content')
<div class="container breadcrumbs">
    <span class="breadcumbs__current">РЕГИСТРАЦИЯ</span>
</div>
<div class="container">
    <div class="container__col-left">
        <form action="{{ url('/register') }}" method="POST" class="reg-page reg-page_layout">
            {!! csrf_field() !!}
            <div class="title">РЕГИСТРАЦИЯ</div>       
            <div class="offset_vertical_30">
                <input type="text" name="email" value="{{ old('email') }}" placeholder="EMAIL" class="input input_100 input_bold {{ $errors->has('email') ?  'input_error' : '' }}">
                @if ($errors->has('email'))<div class="error">{{ $errors->first('email') }}</div>@endif
            </div>
            <div class="offset_vertical_30">
                <input type="password" name="password" placeholder="ПАРОЛЬ" class="input input_100 input_bold {{ $errors->has('password') ?  'input_error' : '' }}">
                @if ($errors->has('password'))<div class="error">{{ $errors->first('password') }}</div>@endif
            </div>
            <div class="offset_vertical_30">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="ИМЯ" class="input input_100 input_bold {{ $errors->has('name') ?  'input_error' : '' }}">
            </div>
            <button class="button button_big button_minth reg-page__button">РЕГИСТРАЦИЯ</button>
            <div class="reg-page__login">Уже зарегистрированы? <a href="{{ url('/login') }}" class="reg-page__login">Войти</a></div>
        </form>
    </div>
    <div class="container__col-left reg-social">
        <div class="title">Или авторизуйтесь с помощью социальных сетей</div>

    </div>
</div>
@endsection
