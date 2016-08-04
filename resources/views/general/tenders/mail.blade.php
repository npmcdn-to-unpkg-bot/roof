@extends('email.layout')

@section('content')
<div class="title">Новый тендер на roofers.com.ua</div>
<div>Название:<span class="value">{{$tender->name}}</span></div>
<div>Ссылка:<span class="value">{{route('tenders.show',$tender)}}</span></div>
@endsection


