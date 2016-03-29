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
					@if (isset($company)) 
					<li><a href="#">Создать запись в блог компании</a></li>
					<li><a href="#">Добавить сотрудника компании</a></li>
					<li><a href="#">Добавить объект в портфолио компании</a></li>
					@else
					<li><a href="/office/company/create">Создать компанию</a></li>
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
			@if (isset($company))
			<div class="title">{{ $company->name }}</div>
			<ul>
				<li><img src="/imagecache/small/{{ $company->logo }}" alt=""></li>
				<li>{{ $company->email }}</li>
				<li>{{ $company->phone }}</li>
				<li>{{ $company->entry }}</li>
			</ul>
			@endif
		</div>
	</div>
</div>
@endsection