@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="container breadcrumbs">
        <a href="{{url('login')}}" class="breadcrumbs__path">ВХОД</a>
        <span class="breadcumbs__current">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</span>
    </div>
    <div class="container__row">
        <div class="container__col-4">
            <div class="title">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</div>
            <form method="POST" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}
                <div class="offset_vertical_30 offset-sm_vertical_30">
                    <input type="email" class="input input_100 input_bold" name="email" placeholder="ВАШ EMAIL" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="error">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="offset_vertical_30 offset-sm_vertical_30">
                    {!!captcha_img()!!}
                </div>

                <div class="offset_vertical_30 offset-sm_vertical_30">
                    <input type="text" class="input input_100 input_bold" name="captcha" placeholder="ВВЕДИТЕ ТЕКСТ С КАРТИНКИ">
                    @if ($errors->has('captcha'))
                        <span class="error">{{ $errors->first('captcha') }}</span>
                    @endif
                </div>

                <button type="submit" class="button button_big button_minth reg-page__button offset_vertical_30 offset-sm_vertical_30">
                    ПОЛУЧИТЬ ССЫЛКУ
                </button>

            </form>
        </div>
    </div>

    @if (session('status'))
        <div class="offset_vertical_30">
            {{ session('status') }}
        </div>
    @endif

                
</div>
@endsection
