@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Обучение@endsection

@section('content')
<div class="container breadcrumbs">
	<a href="{{route('knowledge.index')}}" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<span class="breadcumbs__current">ОБУЧЕНИЕ</span>
</div>

<div class="container offset_vertical_40 offset-sm_vertical_30">
	<div class="library">
		<span class="library__label">Рубрики</span>
		<a class="library__item" href="{{route('knowledge.education.index')}}">Все рубрики</a>
		@foreach (App\Models\Education\Category::orderBy('order')->get() as $category)
			<a class="library__item {{Request::is('knowledge/education/category/'.$category->id)?'library__item_active':''}}" href="{{url('knowledge/education/category',$category)}}">{{$category->name}}</a>
		@endforeach
	</div>
</div>

<div class="container">
	<div class="container__row masonry">
		@foreach ($posts as $i => $post)
			<div class="container__col-4 offset_bottom_45 container__col-sm-12 offset-sm_vertical_30">
				@include('general.knowledge.education.preview')
			</div>
			@if ($i==1) <div class="container__col-4 container__col-sm-12 offset-sm_vertical_30 offset_bottom_45">@include('general.area.banner',['area' => 'Обучение архив 1'])</div> @endif
		@endforeach
		@if ($posts->count() < 2) <div class="container__col-4 container__col-sm-12 offset-sm_vertical_30 offset_bottom_45">@include('general.area.banner',['area' => 'Обучение архив 1'])</div> @endif
	</div>
	<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.knowledge.education.cloud')</div>
	@include('general.pagenav',['items'=>$posts])
</div>

@endsection