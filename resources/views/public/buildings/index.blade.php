@extends('public.layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">СТРОЙКИ И ВАКАНСИИ</span>
	</div>
	<div class="container buildings-map">
		<div class="buildings-map__control">
			<div class="page-tabs">
				<span class="page-tabs__nav page-tabs__nav_active">АКТИВНЫЕ СТРОЙКИ</span>
				<span class="page-tabs__separator"></span>
				<a href="#" class="page-tabs__nav">ВАКАНСИИ</a>
			</div>
			<a href="#" class="buildings-map__hide">Скрыть карту</a>
		</div>
		<div class="buildings-map__map" id="buildings-map__map"></div>
	</div>
	<div class="container offset_vertical_60">
		<div class="title">ФИЛЬТР ОБЪЕКТОВ</div>
		<form action="" class="offset_vertical_15 jus">
			<select name="" id="" class="input_select input jus__item">
				<option value="">ВЫБЕРИТЕ СТРАНУ</option>
			</select>
			<select name="" id="" class="input_select input jus__item">
				<option value="">ВЫБЕРИТЕ ГОРОД</option>
			</select>
			<select name="" id="" class="input_select input jus__item">
				<option value="">ТИП ОБЪЕКТОВ</option>
			</select>
			<select name="" id="" class="input_select input jus__item">
				<option value="">ВАКАНСИИ ПО СПЕЦИАЛЬНОСТИ</option>
			</select>
			<select name="" id="" class="input_select input jus__item">
				<option value="">СЕЗОННОСТЬ</option>
			</select>
			<button class="jus__item button button_search"></button>
		</form>
	</div>
	<div class="container">
		@foreach ($buildings as $i => $building)
			@if ($i%3==0) <div class="container__row offset_vertical_60"> @endif
				<div class="container__col-4 building">
					<img src="/imagecache/370x200/{{ $building->images->first()->name }}" alt="" class="building__image">
					<a href="{{ route('buildings.show', $building) }}" class="building__name">{{ $building->name }}</a>
					<span class="building__type">{{ $building->type }}</span>
					@if ($building->company) <a href="{{ route('catalog.show', $building->company) }}" class="building__company">{{ $building->company->name }}</a> 
					@elseif ($building->company_name) <span class="building__company">{{$building->company_name}}</span>
					@endif
					<span class="building__address">{{$building->address()}}</span>
					<span class="building__period">{{$building->calendar()}}</span>
					@if ( !$building->jobs->isEmpty() )
						<div class="building__title">Вакансии на объекте</div>
						<div class="building__job-list">
							{{ $building->jobs->implode('name',', ') }}
						</div>
					@endif
				</div>
			@if ($i+1==count($buildings)||$i%3==2) </div> @endif
		@endforeach
	</div>
	@include('public.pagenav',['items'=>$buildings])
	@include('public.news.block2')
@endsection