@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Вход@endsection

@section('content')
<div class="container breadcrumbs">
    <span class="breadcumbs__current">АВТОРИЗАЦИЯ</span>
</div>
@if(session()->has('message'))
<div class="container message">{{session()->get('message')}}</div>
@endif
<div class="container">
    <div class="container__col-left">
        <form action="{{ url('/login') }}" method="POST" class="reg-page reg-page_layout">
            {!! csrf_field() !!}
            <div class="title">ВХОД</div>      
            <div class="offset_vertical_30 offset-sm_vertical_30">
                <input type="email" class="input input_bold input_100 {{ $errors->has('email') ?  'input_error' : '' }} " placeholder="EMAIL" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))<div class="error">{{ $errors->first('email') }}</div>@endif
            </div>
            <div class="offset_vertical_30 offset-sm_vertical_30">
                <input type="password" class="input input_bold input_100 {{ $errors->has('password') ?  'input_error' : '' }} " placeholder="ПАРОЛЬ" name="password">
                @if ($errors->has('password'))<div class="error">{{ $errors->first('password') }}</div>@endif
            </div>
            <div class="offset_vertical_30 offset-sm_vertical_30">
                <label>
                    <input type="checkbox" class="input_checkbox" name="remember"><span></span> Запомнить меня
                </label>
            </div>
            <button class="button button_big button_minth reg-page__button">ВХОД</button>
            <div class="reg-page__login">Нет аккаунта? <a href="{{ url('/register') }}" class="reg-page__login">Регистрация</a></div>
            <div class="reg-page__login">Забыли пароль? <a href="{{ url('/password/reset') }}" class="reg-page__login">Восстановить</a></div>
        </form>
    </div>
    <div class="container__col-left reg-social">
        <div class="title">Или авторизуйтесь с помощью социальных сетей</div>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
        <script src="//ulogin.ru/js/ulogin.js"></script>
        <script>
            function login_from_social (token) {
                var form = document.createElement('form');
                var _token = document.createElement('input');
                var uToken = document.createElement('input');
                form.appendChild(_token);
                form.appendChild(uToken);

                form.method = 'POST';
                form.action = '{{url('/ulogin')}}';

                _token.type = 'hidden';
                _token.name = '_token';
                _token.value = '{{csrf_token()}}';

                uToken.type = 'hidden';
                uToken.name = 'uToken';
                uToken.value = token;

                form.submit();
            }
        </script>
        <div id="uLogin" data-ulogin="display=buttons;fields=first_name,last_name,email,photo_big;providers=googleplus,facebook;hidden=;redirect_uri=;callback=login_from_social">
            <div data-uloginbutton="facebook" class="social-login social-login_facebook offset_vertical_30 offset-sm_vertical_30"><i style="margin-right: 15px; width: 15px;" class="fa fa-facebook"></i> Войти через <strong>Facebook</strong></div>
            <div data-uloginbutton="googleplus" class="social-login social-login_googleplus offset_vertical_30 offset-sm_vertical_30"><i style="margin-right: 15px; width: 15px;" class="fa fa-google-plus"></i> Войти через <strong>Google+</strong></div>
        </div>
    </div>
</div>
@endsection
