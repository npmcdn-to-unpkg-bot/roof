@extends('public.layout')

@section('content')
<div class="container breadcrumbs">
	<a href="{{route('knowladge.index')}}" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<span class="breadcumbs__current">ОБУЧЕНИЕ</span>
</div>

<div class="container offset_vertical_40">
	<div class="library">
		<span class="library__label">Рубрики</span>
		@foreach (App\Models\Education\Category::all() as $category)
			<a class="library__item {{Request::is('knowladge/education/category/'.$category->id)?'library__item_active':''}}" href="{{url('knowladge/education/category',$category)}}">{{$category->name}}</a>
		@endforeach
	</div>
</div>

<div class="container">
	<div class="container__row masonry">
		@foreach ($posts as $i => $post)
			<div class="container__col-4 post offset_bottom_45">
				<img src="/width/360/{{$post->image}}" class="post__image">
				<div class="post__content">
					<a href="{{route('knowladge.education.show', $post)}}" class="post__title">{{$post->title}}</a>
					<div class="post__entry">{{$post->entry}}</div>
					<div class="post__bottom clearfix">
						<div class="post__created-at">{{$post->created_at->format('d.m.Y')}}</div>
						<div class="post__libraries post__library">
							@foreach ($post->categories as $category)
								<a class="post__library" href="{{url('knowladge/education/category',$category)}}">{{$category->name}}</a>@if ($post->categories->last()!=$category), @endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@if ($i==1) <div class="container__col-4 offset_bottom_45">@include('public.area.banner',['area' => 'Обучение архив 1'])</div> @endif
		@endforeach
		@if ($posts->count() < 2) <div class="container__col-4 offset_bottom_45">@include('public.area.banner',['area' => 'Обучение архив 1'])</div> @endif
	</div>
</div>

@endsection