@extends('public.layout')

@section('content')
<div class="container breadcrumbs">
	<a href="#" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<span class="breadcumbs__current">ОБУЧЕНИЕ</span>
</div>

<div class="container offset_vertical_60">
	<div class="container__row">
		<div class="container__col-6">@include('public.area.banner',['area' => 'knowladge.index.1'])</div>
		<div class="container__col-6">@include('public.area.banner',['area' => 'knowladge.index.2'])</div>
	</div>
</div>

@endsection