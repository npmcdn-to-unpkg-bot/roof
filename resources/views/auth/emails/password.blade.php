@extends('email.layout')

@section('content')
<div style="color: #0a3955;text-transform: uppercase;font-weight: bold;text-align: center;">Ссылка для смены пароля</div>
Ваша ссылка для смены пароля: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
@endsection

