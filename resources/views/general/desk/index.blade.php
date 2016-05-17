@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">ДОСКА ОБЪЯВЛЕНИЙ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">ОБЪЯВЛЕНИЯ</div>
				@include('general.desk.filter')
				@include('general.desk.top')
				@foreach ($offers as $offer)
					<div class="desk-item offset_vertical_20 offset-sm_vertical_20 {{ $offer->framed > Carbon\Carbon::now() ? 'desk-item_dark' : '' }}">
						<a href="{{route('desk.show',$offer)}}">
							<img src="/fit/160/140/{{$offer->image}}" alt="" class="desk-item__image">
						</a>
						<a href="{{route('desk.show',$offer)}}" class="desk-item__title">{{ $offer->title }}</a>
						<div class="desk-item__bottom">
							<div class="desk-item__info">№{{ $offer->id }}   Дата размещения: {{ $offer->created_at->format('d.m.Y') }}</div>
							<div>Специализация: {{ $offer->specialisation }}</div>
							@foreach ($offer->categories as $category)
								<a href="" class="desk-item__cat">{{ $category->name }}</a>
								@if ( $category!==$offer->categories->last() ) <span class="desk-item__sep"></span> @endif
							@endforeach
						</div>
					</div>
				@endforeach

				@include('general.pagenav',['items'=>$offers])

			</div>
			<div class="container__col-4 container__col-sm-12">
				<div class="title">КАТЕГОРИИ</div>
				<form class="menu menu_blue menu_medium menu_vertical menu_no_underline menu_rare offset_bottom_60 offset-sm_vertical_30">
					@foreach (App\Category::all() as $category)
						<label class="menu__item">
							<input class="input_checkbox" type="checkbox" name="category" value="{{$category->id}}">
							<span></span>
							{{$category->name}}
						</label>
					@endforeach
					<button class="button button_100 button_cyan button_big">ПОКАЗАТЬ</button>
				</form>
				<a href="{{route('user.offers.create')}}" class="button button_orange button_huge offset-sm_vertical_30">ДОБАВИТЬ ОБЪЯВЛЕНИЕ</a>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Объявления архив 1'])</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Объявления архив 2'])</div>
			</div>
		</div>
	</div>
	@include('general.news.block2')
@endsection