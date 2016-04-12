@extends('layout')

@section('content')
<div class="container breadcrumbs">
	@yield('breadcrumbs')
</div>
<div class="container">
	<div class="container__row">
		<div class="container__col-4">
			<div>
				<div class="title title_black">УПРАВЛЕНИЕ</div>
				<div class="menu menu_blue menu_medium menu_vertical menu_rare">
					@if (isset($company)) 
					<a class="menu__item" href="{{ route('office.company.index') }}">Компания</a>
					<a class="menu__item" href="#">Статьи</a>
					<a class="menu__item" href="#">Сотрудники компании</a>
					<a class="menu__item" href="{{ route('office.building.index') }}">Стройки</a>
					<a class="menu__item" href="{{ route('office.job.index') }}">Вакансии</a>
					@endif
					<a href="{{ route('office.offer.index') }}" class="menu__item">Объявления</a>
					<a class="menu__item" href="/logout">Выход</a>
				</div>
			</div>
			<div class="offset_vertical_60">
				<div class="title title_black">ВАШИ ДАННЫЕ</div>
				<div class="user-data">
					@if($user->name)<div class="user-data__item">Имя: <span class="user-data_value">{{ $user->name }}</span></div>@endif
					@if($user->job)<div class="user-data__item">Должность: <span class="user-data_value">{{ $user->job }}</span></div>@endif
					@if($user->email)<div class="user-data__item">Email: <span class="user-data_value">{{ $user->email }}</span></div>@endif
					@if($user->phone)<div class="user-data__item">Телефон: <span class="user-data_value">{{ $user->phone }}</span></div>@endif
				</div>
				<div class="menu menu_blue menu_medium menu_vertical menu_rare">
					<a class="menu__item" href="#">Изменить личные данные</a>
				</div>
			</div>
		</div>
		<div class="container__col-8">
		    @yield('workspace')
		</div>
	</div>
</div>
@endsection