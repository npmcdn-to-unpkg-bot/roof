@extends('layout')

@section('content')
<div class="container breadcrumbs">
    <span class="breadcumbs__current">РЕГИСТРАЦИЯ</span>
</div>
<div class="container">
    <div class="container__col-left">
        <form action="{{ url('/register') }}" method="POST" class="reg-page reg-page_layout">
            {!! csrf_field() !!}
            <div class="title">РЕГИСТРАЦИЯ</div>
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="error">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif        
            <input type="text" name="email" value="{{ old('email') }}" placeholder="EMAIL" class="input {{ $errors->has('email') ?  'input_error' : '' }} input_bold reg-page__input">
            <input type="password" name="password" placeholder="ПАРОЛЬ" class="input {{ $errors->has('password') ?  'input_error' : '' }} input_bold reg-page__input">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="ИМЯ" class="input {{ $errors->has('name') ?  'input_error' : '' }} input_bold reg-page__input">
            <button class="button button_big button_minth reg-page__button">РЕГИСТРАЦИЯ</button>
            <div class="reg-page__login">Уже зарегистрированы? <a href="{{ url('/login') }}" class="reg-page__login">Войти</a></div>
        </form>
    </div>
    <div class="container__col-left reg-social">
        <div class="title">Или авторизуйтесь с помощью социальных сетей</div>

    </div>
</div>
@endsection
