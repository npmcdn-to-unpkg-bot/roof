@extends('email.layout')

@section('content')
<div style="color: #0a3955;text-transform: uppercase;font-weight: bold;text-align: center;">Новый тендер на roofers.com.ua</div>
<div style="font-size: 18px;">Название:<strong>{{$tender->name}}</strong></div>
<div style="font-size: 18px;">Ссылка:<strong>{{route('tenders.show',$tender)}}</strong></div>
@endsection


