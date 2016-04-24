@extends('public.layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">КАЛЕНДАРЬ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				@include('public.events.block',['class'=>'calendar_big'])

			</div>
			<div class="container__col-4">
				@include('public.area.banner',['area' => 'news.1'])
				<div class="offset_vertical_55">@include('public.polls.block')</div>
				<div class="offset_vertical_55">@include('public.area.banner',['area' => 'news.2'])</div>
			</div>
		</div>
	</div>
	@include('public.desk.block')
@endsection