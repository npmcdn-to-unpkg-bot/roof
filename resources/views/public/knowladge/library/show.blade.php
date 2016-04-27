@extends('public.layout')

@section('content')
<div class="container breadcrumbs">
	<a href="{{route('knowladge.index')}}" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<a href="{{route('knowladge.library.index')}}" class="breadcrumbs__path">БИБЛИОТЕКА</a>
	<span class="breadcumbs__current">{{$post->title}}</span>
</div>

<div class="container">
	<div class="container__row">
		<div class="container__col-8 post-page">
			<div class="post-page__created-at">Дата размещение: {{$post->created_at->format('d.m.Y')}}</div>
			<div class="offset_bottom_30 title">{{$post->title}}</div>
			<div class="post-page__content">
				<img class="post-page__image" src="/imagecache/full/{{$post->image}}" alt="">
				{!!$post->content!!}
			</div>
			<div class="post-page__libraries">
				@foreach ($post->categories as $category)
					<a class="post-page__library" href="{{url('knowladge/library/category',$category->id)}}">{{$category->name}}</a>
					{{$post->categories->last()!=$category?'|':''}}
				@endforeach
			</div>
		</div>
		<div class="container__col-4">
			<div class="title">РАЗДЕЛЫ</div>
			<div class="menu menu_blue menu_medium menu_vertical menu_no_underline menu_rare">
				@foreach(App\Models\Library\Category::all() as $category)
					<a href="{{url('knowladge/library/category',$category->id)}}" class="menu__item">{{$category->name}}</a>
				@endforeach
			</div>
			<div class="offset_bottom_60">@include('public.area.banner',['area' => 'knowladge.library.show.1'])</div>
			<div class="offset_bottom_60">@include('public.area.banner',['area' => 'knowladge.library.show.2'])</div>
		</div>
	</div>
</div>


@endsection