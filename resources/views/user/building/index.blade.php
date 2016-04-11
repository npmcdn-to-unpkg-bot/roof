@extends('user.layout')

@section('breadcrumbs')
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
@endsection

@section('workspace')
    <a href="{{ route('office.building.create') }}">Добавить стройку</a>
	@foreach ($buildings as $i=>$building)
		@if ($i%3==0) <div class="container__row {{ $i!==0?'offset_vertical_55':''}}"> @endif
		<div class="container__col-4 building">
			@if ($building->images()->first()) <img src="/imagecache/240x200/{{ $building->images()->first()->image }}" alt="" class="building__image"> @endif
			<a href="/building/1" class="building__name">{{ $building->name }}</a>
			<span class="building__type">{{ $building->type }}</span>
			<span class="building__address">Украина, Киевская обл., г. Бровары</span>
			<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
			<div class="building__title">Вакансии на объекте</div>
			<div class="building__job-list">
				Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
			</div>
			<a href="{{ route('office.building.edit', $building) }}">Редактировать</a>
		</div>
		@if ($i+1==count($buildings)||$i%3==2) </div> @endif
	@endforeach
@endsection