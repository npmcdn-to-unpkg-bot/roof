@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Стройки и вакансии@endsection

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">СТРОЙКИ И ВАКАНСИИ</span>
	</div>
	@include('general.buildings.map')
	<div class="container offset_vertical_60">
		<div class="title">ФИЛЬТР ОБЪЕКТОВ</div>
		<form action="" class="offset_vertical_15 jus">
			<select style="width: 170px;" name="country" class="input_select input jus__item offset-sm_vertical_15">
				<option value="">СТРАНА</option>
				@foreach ($countries as $country)
					<option value="{{$country->id}}" {{Request::get('country')==$country->id?'selected':''}}>{{$country->name}}</option>
				@endforeach
			</select>
			<select style="width: 170px;" name="city" class="input_select input jus__item offset-sm_vertical_15">
				<option value="">ГОРОД</option>
				@foreach ($cities as $city)
					<option value="{{$city->id}}" {{Request::get('city')==$city->id?'selected':''}}>{{$city->name}}</option>
				@endforeach
			</select>
			<select style="width: 190px;" name="type" class="input_select input jus__item offset-sm_vertical_15">
				<option value="">ТИП ОБЪЕКТОВ</option>
				@foreach ($types as $type)
					<option value="{{$type}}" {{Request::get('type')==$type?'selected':''}}>{{$type}}</option>
				@endforeach
			</select>
			<button class="jus__item offset-sm_vertical_15 button button_search"></button>
		</form>
	</div>
	<div id="buildings" class="container">
		@forelse ($buildings as $i => $building)
			@if ($i%3==0) <div class="container__row offset_vertical_60"> @endif
				<div class="container__col-4 container__col-sm-12 offset-sm_vertical_60 building">
					@if ($building->images->first()) <a href="{{ route('buildings.show', $building) }}"><img src="/fit/{{Agent::isMobile()?'610/420':'370/200'}}/{{ $building->images->first()->name }}" alt="" class="building__image"></a> @endif
					<a href="{{ route('buildings.show', $building) }}" class="building__name">{{ $building->name }}</a>
					<span class="field field_type">{{ $building->type }}</span>
					@if ($building->company) <a href="{{ route('catalog.show', $building->company) }}" class="field field_company">{{ $building->company->name }}</a> 
					@elseif ($building->company_name) <span class="field field_company">{{$building->company_name}}</span>
					@endif
					<span class="field field_address">{{$building->printAddress()}}</span>
					<span class="field field_period">{{$building->calendar()}}</span>
					@if ( !$building->jobs->isEmpty() )
						<div class="small-title">Вакансии на объекте</div>
						<div class="building__job-list">
							{{ $building->jobs->implode('name',', ') }}
						</div>
					@endif
				</div>
			@if ($i+1==count($buildings)||$i%3==2) </div> @endif
		@empty
		По вашему запросу ничего не найдено.
		@endforelse
	</div>
	@include('general.pagenav',['items'=>$buildings])
	@include('general.news.block2')
@endsection