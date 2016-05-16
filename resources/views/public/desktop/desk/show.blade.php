@extends('public.layout')

@section('content')
	<div class="container breadcrumbs">
		<a href="{{ route('desk.index') }}" class="breadcrumbs__path">ДОСКА ОБЪЯВЛЕНИЙ</a>
		<span class="breadcumbs__current">{{$offer->title}}</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title">ОБЪЯВЛЕНИЯ</div>
				<form action="" class="jus offset_vertical_20">
					<input type="text" size="65" placeholder="КЛЮЧЕВЫЕ СЛОВА" class="input jus__item">
					<select name="" id="" class="input_select input jus__item">
						<option value="">ВЫБИРИТЕ СТРАНУ</option>
					</select>
					<button class="jus__item button button_search"></button>
				</form>
				<div class="container__row desk-single">
					<div class="container__col-6">
						<img src="/fit/370/200/{{$offer->image}}" alt="" class="desk-single__image">
						<div class="title-light">КОНТАКТНАЯ ИНФОРМАЦИЯ</div>
						@if($offer->name)<div class="desk-single__person">{{$offer->name}}</div>@endif
						@if($offer->phone)<div class="desk-single__phone">{{$offer->phone}}</div>@endif
						@if($offer->email)<a href="#" class="desk-single__email">{{$offer->email}}</a>@endif
					</div>
					<div class="container__col-6">
						<div class="desk-single__title">{{$offer->title}}</div>
						<div class="desk-single__text">{{$offer->information}}</div>
						<div class="desk-single__info">№{{$offer->id}}   Дата размещения: {{$offer->created_at->format('d.m.Y')}}</div>
						<div>Специализация: {{$offer->specialisation}}</div>
						@foreach($offer->categories as $category)
						<a href="" class="desk-single__cat">{{$category->name}}</a>
						@if($offer->categories->last()!==$category)<span class="desk-single__sep"></span>@endif
						@endforeach
					</div>
				</div>
				@include('public.desk.top')
			</div>
			<div class="container__col-4">
				<div class="title">КАТЕГОРИИ</div>
				<form class="menu menu_blue menu_medium menu_vertical menu_no_underline menu_rare">
					@foreach (App\Category::all() as $category)
						<label class="menu__item">
							<input class="input_checkbox" type="checkbox" name="category" value="{{$category->id}}">
							<span></span>
							{{$category->name}}
						</label>
					@endforeach
					<button class="button button_100 button_cyan button_big">ПОКАЗАТЬ</button>
				</form>
				<div class="offset_vertical_55">@include('public.area.banner',['area' =>'Объявления запись 1'])</div>
				<div class="offset_vertical_55">@include('public.area.banner',['area' => 'Объявления запись 2'])</div>
			</div>
		</div>
	</div>
	@include('public.news.block2')
@endsection