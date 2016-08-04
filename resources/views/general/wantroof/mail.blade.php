@extends('email.layout')

@section('content')
<div style="color: #0a3955;text-transform: uppercase;font-weight: bold;text-align: center;">Отправление формы "Хочу кровлю"</div>
<div>Тема заявки: <strong>{{$theme}}</strong></div>
<div>Имя: <strong>{{$name}}</strong></div>
<div>Телефон: <strong>{{$phone}}</strong></div>
<div>Email: <strong><a href="mailto:{{$email}}">{{$email}}</a></strong></div>
<div>Комментарий: <strong>{{$comment}}</strong></div>
@endsection
