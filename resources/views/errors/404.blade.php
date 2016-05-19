@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title') 404 @endsection

@section('content')
<div class="container">
	<div class="title"><span style="font-size: 130px;">404</span> ошибка<br>
Страница не найдена <br>
Давайте поищем вместе</div>
</div>
@endsection