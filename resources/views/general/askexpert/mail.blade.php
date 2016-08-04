@extends('email.layout')

@section('content')
<div class="title">Вопро эксперту</div>
<div>Имя: <span class="value">{{$name}}</span></div>
<div>Телефон: <span class="value">{{$phone}}</span></div>
<div>Email: <span class="value"><a href="mailto:{{$email}}">{{$email}}</a></span></div>
<div>Вопрос: <span class="value">{{$question}}</span></div>
@endsection