@extends('public.layout')

@section('content')
<div class="container breadcrumbs">
	<a href="#" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<a href="{{route('education.index')}}" class="breadcrumbs__path">ОБУЧЕНИЕ</a>
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
					<a class="post-page__library" href="{{url('education/category',$category)}}">{{$category->name}}</a>
					{{$post->categories->last()!=$category?'|':''}}
				@endforeach
			</div>
		</div>
		<div class="container__col-4">
			<div class="offset_bottom_60">@include('public.area.banner',['area' => 'education.show.1'])</div>
			<div class="offset_bottom_60">@include('public.area.banner',['area' => 'education.show.2'])</div>
		</div>
	</div>
</div>


@endsection