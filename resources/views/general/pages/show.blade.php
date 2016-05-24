@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{$page->meta_title ? $page->meta_title : $page->name}}@endsection

@section('description'){{$page->meta_description ? $page->meta_description :  str_limit(strip_tags($page->content),150) }}@endsection

@section('content')

<div class="container breadcrumbs">
	<span class="breadcumbs__current">{{$page->name}}</span>
</div>
<div class="container">
	{!!$page->content!!}
</div>
@endsection