@extends('user.layout')

@section('breadcrumbs')
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
@endsection

@section('workspace')
	<a href="{{ route('office.offer.create') }}">Добавить объявление</a>
	@if ($offers)
		@foreach ($offers as $offer)
			<div class="desk-item offset_vertical_20">
				<img src="/imagecache/160x140/{{$offer->image}}" alt="" class="desk-item__image">
				<span class="desk-item__title">{{ $offer->title }}</span>
				<div class="desk-item__bottom">
					<div class="desk-item__info">№{{$offer->id}}   Дата размещения: {{$offer->created_at->format('d.m.Y')}}</div>
					<div>Специализация: {{$offer->specialisation}}</div>
					@foreach ($offer->deskcategories as $category)
						<a href="" class="desk-item__cat">{{ $category->name }}</a>
						@if ( $category!==$offer->deskcategories->last() ) <span class="desk-item__sep"></span> @endif
					@endforeach
					<br>
					<a href="{{ route('office.offer.edit', $offer) }}">Редактироввать</a>
				</div>
			</div>
		@endforeach
	@endif
@endsection