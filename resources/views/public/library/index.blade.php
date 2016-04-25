@extends('public.layout')

@section('content')
<div class="container breadcrumbs">
	<a href="#" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<span class="breadcumbs__current">БИБЛИОТЕКА</span>
</div>

<div class="container offset_vertical_40">
	<div class="library">
		<span class="library__label">Рубрики</span>
		@foreach (App\Library::all() as $library)
			<a class="library__item {{ Request::is('library/category/'.$library->id) ?'library__item_active':'' }}" href="/library/category/{{$library->id}}">{{$library->name}}</a>
		@endforeach
	</div>
</div>

<div class="container">
	<div class="container__row masonry">
		@foreach ($posts as $i => $post)
			<div class="container__col-4 post offset_bottom_45">
				<img src="/imagecache/width360/{{$post->image}}" class="post__image">
				<div class="post__content">
					<a href="{{route('library.show', $post)}}" class="post__title">{{$post->title}}</a>
					<div class="post__entry">{{$post->entry}}</div>
					<div class="post__bottom clearfix">
						<div class="post__created-at">{{$post->created_at->format('d.m.Y')}}</div>
						<div class="post__libraries post__library">
							@foreach ($post->libraries as $library)
								<a class="post__library" href="/library/category/{{$library->id}}">{{$library->name}}</a>@if ($post->libraries->last()!=$library), @endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@if ($i==2) <div class="container__col-4 offset_bottom_45">@include('public.area.banner',['area' => 'library.index.1'])</div> @endif
		@endforeach
		@if ($posts->count() < 3) <div class="container__col-4 offset_bottom_45">@include('public.area.banner',['area' => 'library.index.1'])</div> @endif
	</div>
</div>

@endsection