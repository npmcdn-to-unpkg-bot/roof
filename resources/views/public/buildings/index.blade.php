@extends('public.layout')

@section('content')
	<div class="page-tabs">
		<div class="container breadcrumbs">
			<span class="breadcumbs__current">СТРОЙКИ И ВАКАНСИИ</span>
		</div>
		@include('public.buildings.map')
		@include('public.buildings.filter')
		<div id="buildings" class="container">
			@foreach ($buildings as $i => $building)
				@if ($i%3==0) <div class="container__row offset_vertical_60"> @endif
					<div class="container__col-4 building">
						@if ($building->images->first()) <a href="{{ route('buildings.show', $building) }}"><img src="/fit/370/200/{{ $building->images->first()->name }}" alt="" class="building__image"></a> @endif
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
			@endforeach
		</div>
	</div>
	@include('public.pagenav',['items'=>$buildings])
	@include('public.news.block2')
@endsection