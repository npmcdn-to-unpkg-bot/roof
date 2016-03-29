@extends('layout')

@section('content')
<div class="container breadcrumbs">
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
</div>
<div class="container">
	<div class="container__row">
		<div class="container__col-4">
			<div>
				<div class="title">УПРАВЛЕНИЕ</div>
				<ul>
					@if (isset($comp)) 
					<li><a href="#">Создать запись в блог компании</a></li>
					<li><a href="#">Добавить сотрудника компании</a></li>
					<li><a href="#">Добавить объект в портфолио компании</a></li>
					@else
					<li><a href="/office/comp/create">Создать компанию</a></li>
					@endif
					<li><a href="/logout">Выход</a></li>
				</ul>
			</div>
			<div class="offset_vertical_60">
				<div class="title">ВАШИ ДАННЫЕ</div>
				<ul>
					<li>{{ $user->name }}</li>
					<li>{{ $user->job }}</li>
					<li>{{ $user->email }}</li>
					<li>{{ $user->phone }}</li>
				</ul>
			</div>
		</div>
		<div class="container__col-8">
			@if (isset($comp))
			<div class="title">{{ $comp->name }}</div>
			<ul>
				<li><img src="{{ url($comp->logo) }}" alt=""></li>
				<li>{{ $comp->email }}</li>
				<li>{{ $comp->phone }}</li>
				<li>{{ $comp->entry }}</li>
			</ul>
			@endif
		</div>
	</div>
</div>
@endsection