@extends('email.layout')

@section('content')
<div class="title">Отправление формы "Хочу кровлю"</div>
<div>Тема заявки: <span class="value">{{$theme}}</span></div>
<div>Имя: <span class="value">{{$name}}</span></div>
<div>Телефон: <span class="value">{{$phone}}</span></div>
<div>Email: <span class="value"><a href="mailto:{{$email}}">{{$email}}</a></span></div>
<div>Комментарий: <span class="value">{{$comment}}</span></div>
@endsection
