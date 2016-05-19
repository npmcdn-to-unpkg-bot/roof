@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')База знаний@endsection

@section('content')
<div class="container breadcrumbs">
	<span class="breadcumbs__current">БАЗА ЗНАНИЙ</span>
</div>

<div class="container offset_vertical_60">
	<div class="container__row">
		<div class="container__col-6 container__col-sm-12">@include('general.area.banner',['area' => 'База знаний 1'])</div>
		<div class="container__col-6 container__col-sm-12">@include('general.area.banner',['area' => 'База знаний 2'])</div>
	</div>
</div>

@endsection