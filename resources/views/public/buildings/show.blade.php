@extends('public.layout')

@section('content')
	<div class="container breadcrumbs">
		<a href="{{ route('buildings.index') }}" class="breadcrumbs__path">СТРОЙКИ И ВАКАНСИИ</a><span class="breadcumbs__current">{{ $building->name }}</span>
	</div>
	<div class="container building">
		<div class="title offset_vertical_20">{{ $building->name }}</div>
		<div class="container__row">
			<div class="container__col-8">
				<img src="/width/765/{{ $building->images->first()->name }}" alt="" class="building__image">
				<div class="building__gallery slider offset_vertical_30">
					<ul class="slides">
						@foreach ($building->images as $image)
							<li><a href="/width/765/{{ $building->images->shift()->name }}" class="building__gallery-image"><img src="/fit/170/120/{{$image->name}}" alt=""></a></li>
						@endforeach
					</ul>
				</div>
				@if ( !$building->jobs->isEmpty() )
				<div class="small-title offset_vertical_20">ВАКАНСИИ НА ОБЪЕКТЕ</div>
					@foreach ($building->jobs as $job)
						<div class="job">
							<div class="job__title">{{ $job->name }}</div>
							<div class="job__pay">ЗАРПЛАТА: {{ $job->pay }}</div>
							<div class="job__preview">
								@if ($job->information) <p>{{ $job->information }}</p> @endif
							</div>
							<div class="job__full">
								@if ($job->requirements) 
									<div class="job__label">ТРЕБОВАНИЯ:</div>
									<p>{{ $job->requirements }}</p>
								@endif
								@if ($job->duties)
									<div class="job__label">ОБЯЗАННОСТИ:</div>
									<p>{{ $job->duties }}</p> 
								@endif
								@if ($job->conditions)
									<div class="job__label">УСЛОВИЯ РАБОТЫ:</div>
									<p>{{ $job->conditions }}</p>
								@endif
								@if ($job->information)
									<div class="job__label">ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ:</div>
									<p>{{ $job->information }}</p>
								@endif
								@if ($job->phone||$job->email)
									<div class="job__label">КОНТАКТНАЯ ИНФОРМАЦИЯ:</div>
									<p>
										@if ($job->phone) Тел: {{ $job->phone }} <br> @endif
										@if ($job->email) Email: {{ $job->email }} @endif
									</p>
								@endif
							</div>
							<div class="job__toggle"></div>
						</div>
					@endforeach
				@endif
			</div>
			<div class="container__col-4">
				<div class="field field_type">{{ $building->type }}</div>
				@if ($building->company)<a href="{{ route ( 'catalog.show', $building->company ) }}" class="field field_company">{{ $building->company->name }}</a>
				@elseif ($building->company_name) <span class="field field_company">{{$building->company_name}}</span>
				@endif
				<div class="field field_address">{{$building->printAddress()}}</div>
				<div class="field field_period">{{$building->calendar()}}</div>
				@if ($building->information)
					<div class="field field_info">
						<div class="small-title">ИНФОРМАЦИЯ</div>
						{{ $building->information }}
					</div>
				@endif
				<div class="offset_vertical_55">
					@include('public.area.banner',['area' => 'Стройки запись 1'])
				</div>
			</div>
		</div>
	</div>
	@include('public.buildings.block')
@endsection