@extends('email.layout')

@section('content')
<div class="title">Ссылка для смены пароля</div>
Ваша ссылка для смены пароля: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
@endsection

