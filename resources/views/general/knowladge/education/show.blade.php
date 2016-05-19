@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{$post->title}}@endsection

@section('description'){{ str_limit($post->entry,150) }}@endsection

@section('content')
<div class="container breadcrumbs">
	<a href="{{route('knowladge.index')}}" class="breadcrumbs__path">БАЗА ЗНАНИЙ</a>
	<a href="{{route('knowladge.education.index')}}" class="breadcrumbs__path">ОБУЧЕНИЕ</a>
	<span class="breadcumbs__current">{{$post->title}}</span>
</div>

<div class="container offset_bottom_60">
	<div class="container__row">
		<div class="container__col-8 container__col-sm-12 post-page">
			<div class="post-page__created-at">Дата размещения: {{$post->created_at->format('d.m.Y')}}</div>
			<div class="offset_bottom_30 title">{{$post->title}}</div>
			<div class="post-page__content">
				<img class="post-page__image" src="/width/{{Agent::isMobile()?'610':'765'}}/{{$post->image}}" alt="">
				{!!$post->content!!}
				<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
				<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
				<div class="ya-share2" data-services="facebook,gplus,twitter" data-counter=""></div>
			</div>
			<div class="post-page__libraries">
				@foreach ($post->categories as $category)
					<a class="post-page__library" href="{{url('knowladge/education/category',$category)}}">{{$category->name}}</a>
					{{$post->categories->last()!=$category?'|':''}}
				@endforeach
			</div>
		</div>
		<div class="container__col-4 container__col-sm-12">
			<div class="title">РАЗДЕЛЫ</div>
			<div class="menu menu_blue menu_medium menu_vertical menu_no_underline menu_rare">
				@foreach(App\Models\Education\Category::all() as $category)
					<a href="{{url('knowladge/education/category',$category->id)}}" class="menu__item">{{$category->name}}</a>
				@endforeach
			</div>
			<div class="offset_bottom_60 offset-sm_bottom_30">@include('general.area.banner',['area' => 'Обучение запись 1'])</div>
			<div class="offset_bottom_60 offset-sm_bottom_30">@include('general.area.banner',['area' => 'Обучение запись 2'])</div>
		</div>
	</div>
</div>


@endsection