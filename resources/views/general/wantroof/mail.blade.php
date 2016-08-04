@extends('email.layout')

@section('content')
<div style="color: #0a3955;text-transform: uppercase;font-weight: bold;text-align: center;">Отправление формы "Хочу кровлю"</div>
<div style="font-size: 18px;">Тема заявки: <strong>{{$theme}}</strong></div>
<div style="font-size: 18px;">Имя: <strong>{{$name}}</strong></div>
<div style="font-size: 18px;">Телефон: <strong>{{$phone}}</strong></div>
<div style="font-size: 18px;">Email: <strong><a href="mailto:{{$email}}">{{$email}}</a></strong></div>
<div style="font-size: 18px;">Комментарий: <strong>{{$comment}}</strong></div>
@endsection
