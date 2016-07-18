@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('content')
<div class="container">
        <div class="container breadcrumbs">
            <a href="{{url('login')}}" class="breadcrumbs__path">ВХОД</a>
            <span class="breadcumbs__current">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</span>
        </div>
        <div class="container__row">
            <div class="container__col-4">
                <div class="title">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</div>
                <form method="POST" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="offset_vertical_30 offset-sm_vertical_30">
                        <input type="email" class="input input_100 input_bold" name="email" placeholder="ВАШ EMAIL" value="{{ $email or old('email') }}">

                        @if ($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="offset_vertical_30 offset-sm_vertical_30 ">
                        <input type="password" class="input input_100 input_bold" name="password" placeholder="НОВЫЙ ПАРОЛЬ">

                        @if ($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="offset_vertical_30 offset-sm_vertical_30 ">
                        <input type="password" class="input input_100 input_bold" name="password_confirmation" placeholder="ПОВТОРИТЕ НОВЫЙ ПАРОЛЬ">

                        @if ($errors->has('password_confirmation'))
                            <div class="error">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="button button_big button_minth reg-page__button offset_vertical_30 offset-sm_vertical_30">
                        ИЗМЕНИТЬ ПАРОЛЬ
                    </button>

                </form>
            </div>
        </div>
</div>
@endsection
