@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Библиотека@endsection

@section('content')
<div class="container breadcrumbs">
	<a href="{{route('knowladge.index')}}" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<span class="breadcumbs__current">БИБЛИОТЕКА</span>
</div>

<div class="container offset_vertical_40 offset-sm_vertical_30">
	<div class="library">
		<span class="library__label">Рубрики</span>
		<a class="library__item" href="{{route('knowladge.library.index')}}">Все рубрики</a>
		@foreach (App\Models\Library\Category::all() as $category)
			<a class="library__item {{Request::is('knowladge/library/category/'.$category->id)?'library__item_active':''}}" href="{{url('knowladge/library/category',$category)}}">{{$category->name}}</a>
		@endforeach
	</div>
</div>

<div class="container">
	<div class="container__row masonry">
		@foreach ($posts as $i => $post)
			<div class="container__col-4 container__col-sm-12 offset-sm_vertical_30 offset_bottom_45 ">
				@include('general.knowladge.library.preview')
			</div>
			@if ($i==1) <div class="container__col-4 container__col-sm-12 offset-sm_vertical_30 offset_bottom_45">@include('general.area.banner',['area' => 'Библиотека архив 1'])</div> @endif
		@endforeach
		@if ($posts->count() < 2) <div class="container__col-4 container__col-sm-12 offset-sm_vertical_30 offset_bottom_45">@include('general.area.banner',['area' => 'Библиотека архив 1'])</div> @endif
	</div>
	@include('general.pagenav',['items'=>$posts])
</div>

@endsection