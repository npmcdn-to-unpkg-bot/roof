@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Авторские колонки@endsection

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">АВТОРСКИЕ КОЛОНКИ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">АВТОРСКИЕ КОЛОНКИ</div>

				@foreach ($authors as $author)
				<div class="author offset_vertical_30  offset-sm_vertical_30">
					<a href="{{route('authors.show', $author)}}" class="author_link">
						@if ($author->image) <img src="/fit/180/180/{{$author->image}}" alt="" class="author__image">@endif
						<div class="author__name">{{$author->name}}</div>
						<div class="author__description">{{$author->description}}</div>
					</a>
				</div>
				@endforeach

				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.news.cloud')</div>

				@include('general.pagenav',['items'=>$authors])

			</div>
			<div class="container__col-4 container__col-sm-12">
				<a href="{{route('news.index')}}" class="button button_minth button_huge offset_vertical_55 offset-sm_vertical_30">НОВОСТИ И СТАТЬИ</a>
				@include('general.area.banner',['area' => 'Новости архив 1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.polls.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Новости архив 2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection