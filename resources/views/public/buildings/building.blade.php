@extends('layout')

@section('content')
	<div class="container breadcrumbs">
		<a href="{{ route('buildings.index') }}" class="breadcrumbs__path">СТРОЙКИ И ВАКАНСИИ</a><span class="breadcumbs__current">{{ $building->name }}</span>
	</div>
	<div class="container building">
		<div class="title offset_vertical_20">{{ $building->name }}</div>
		<div class="container__row">
			<div class="container__col-8">
				<img src="/imagecache/765x400/{{ $building->images->first()->image }}" alt="" class="building__image">
				@if ( !$building->jobs->isEmpty() )
				<div class="building__title offset_vertical_20">ВАКАНСИИ НА ОБЪЕКТЕ</div>
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
				<div class="building__type">{{ $building->type }}</div>
				<a href="{{ route ( 'catalog.show', $building->company ) }}" class="building__company">{{ $building->company->name }}</a>
				<div class="building__address">Украина, Киевская обл., г. Бровары</div>
				<div class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</div>
				@if ($building->information)
					<div class="building__info">
						<div class="building__title">ИНФОРМАЦИЯ</div>
						{{ $building->information }}
					</div>
				@endif
				<img src="/s-img/baner-2.jpg" class="offset_vertical_60" alt="">
			</div>
		</div>
	</div>
	<div class="container-fluid container-fluid_light-gray padding_vertical_40 offset_top_60">
		<div class="container">
			<div class="title">ПОХОЖИЕ ОБЪЕКТЫ</div>
			<div class="container__row building offset_vertical_40">
				<div class="container__col-4">
					<img src="/s-img/building-1.jpg" alt="" class="building__image">
					<a href="" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
					<span class="building__type">Церковь</span>
					<a href="#" class="building__company">ООО "ЗАРС"</a>
					<span class="building__address">Украина, Киевская обл., г. Бровары</span>
					<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
					<div class="building__title">Вакансии на объекте</div>
					<div class="building__job-list">
						Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
					</div>
				</div>
				<div class="container__col-4">
					<img src="/s-img/building-1.jpg" alt="" class="building__image">
					<a href="" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
					<span class="building__type">Церковь</span>
					<a href="#" class="building__company">ООО "ЗАРС"</a>
					<span class="building__address">Украина, Киевская обл., г. Бровары</span>
					<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
					<div class="building__title">Вакансии на объекте</div>
					<div class="building__job-list">
						Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
					</div>
				</div>
				<div class="container__col-4">
					<img src="/s-img/building-1.jpg" alt="" class="building__image">
					<a href="" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
					<span class="building__type">Церковь</span>
					<a href="#" class="building__company">ООО "ЗАРС"</a>
					<span class="building__address">Украина, Киевская обл., г. Бровары</span>
					<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
					<div class="building__title">Вакансии на объекте</div>
					<div class="building__job-list">
						Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection