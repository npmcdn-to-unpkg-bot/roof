@extends('layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">ДОСКА ОБЪЯВЛЕНИЙ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title">ОБЪЯВЛЕНИЯ</div>
				<form action="{{ route('desk.index') }}" class="jus offset_vertical_20">
					<input type="text" name="search" value="{{ $search ? $search : '' }}" style="width: 490px" placeholder="КЛЮЧЕВЫЕ СЛОВА" class="input jus__item">
					<select name="" style="width: 200px" class="input_select input jus__item">
						<option value="">ВЫБИРИТЕ СТРАНУ</option>
					</select>
					<button class="jus__item button button_search"></button>
				</form>
				<div class="container__row offset_vertical_30">
					<div class="container__col-6">
						<a href="" class="desk-top">
							<img src="/s-img/desk-top-1.jpg" alt="" class="desk-top__image">
							<div class="desk-top__text">
								<div class="desk-top__title">ОНДУЛИН ОПТОМ</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel aliquid explicabo, tempora aperiam ratione odit sequi reprehenderit rerum fugiat ea ut sunt praesentium quis, excepturi corrupti corporis quidem, similique dolorem.</p>
							</div>
						</a>
					</div>
					<div class="container__col-6">
						<a href="" class="desk-top">
							<img src="/s-img/desk-top-1.jpg" alt="" class="desk-top__image">
							<div class="desk-top__text">
								<div class="desk-top__title">ОНДУЛИН ОПТОМ</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel aliquid explicabo, tempora aperiam ratione odit sequi reprehenderit rerum fugiat ea ut sunt praesentium quis, excepturi corrupti corporis quidem, similique dolorem.</p>
							</div>
						</a>
					</div>
				</div>
				@foreach ($offers as $offer)
					<div class="desk-item offset_vertical_20 {{ $offer->framged ? 'desk-item_dark' : '' }}">
						<a href="{{route('desk.show',$offer)}}">
							<img src="/imagecache/160x140/{{$offer->image}}" alt="" class="desk-item__image">
						</a>
						<a href="{{route('desk.show',$offer)}}" class="desk-item__title">{{ $offer->title }}</a>
						<div class="desk-item__bottom">
							<div class="desk-item__info">№{{ $offer->id }}   Дата размещения: {{ $offer->created_at->format('d.m.Y') }}</div>
							<div>Специализация: {{ $offer->specialisation }}</div>
							@foreach ($offer->deskcategories as $category)
								<a href="" class="desk-item__cat">{{ $category->name }}</a>
								@if ( $category!==$offer->deskcategories->last() ) <span class="desk-item__sep"></span> @endif
							@endforeach
						</div>
					</div>
				@endforeach

				@include('pagenav',['items'=>$offers])

			</div>
			<div class="container__col-4">
				<div class="title">КАТЕГОРИИ</div>
				<form class="menu menu_blue menu_medium menu_vertical menu_no_underline menu_rare">
					@foreach (App\DeskCategory::all() as $category)
						<label class="menu__item">
							<input class="input_checkbox" type="checkbox" name="category" value="{{$category->id}}">
							<span></span>
							{{$category->name}}
						</label>
					@endforeach
					<button class="button button_100 button_cyan button_big">ПОКАЗАТЬ</button>
				</form>
				<div class="offset_vertical_55">
					@include('public.area.banner',['area' => 'desk.1'])
				</div>
				<div class="offset_vertical_55">
					@include('public.area.banner',['area' => 'desk.2'])
				</div>
			</div>
		</div>
	</div>
	@include('public.news.block2',['articles'=>App\Article::where('market',1)->take(3)->get()])
@endsection