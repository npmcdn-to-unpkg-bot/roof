<div>
	<div class="title title_black">УПРАВЛЕНИЕ</div>
	<div class="menu menu_blue menu_medium menu_vertical menu_rare">
		@if (isset($company)) 
		<a class="menu__item" href="{{ route('office.company.index') }}">Моя компания</a>
		<a class="menu__item" href="#">Мои статьи</a>
		<a class="menu__item" href="#">Сотрудники компании</a>
		<a class="menu__item" href="{{ route('office.building.index') }}">Стройки</a>
		<a class="menu__item" href="{{ route('office.job.index') }}">Вакансии</a>
		@else
		<a class="menu__item" href="/office/company/create">Создать компанию</a>
		@endif
		<a class="menu__item" href="/logout">Выход</a>
	</div>
</div>
<div class="offset_vertical_60">
	<div class="title title_black">ВАШИ ДАННЫЕ</div>
	<div class="user-data">
		<div class="user-data__item">Имя: <span class="user-data_value">{{ $user->name }}</span></div>
		<div class="user-data__item">Должность: <span class="user-data_value">{{ $user->job }}</span></div>
		<div class="user-data__item">Email: <span class="user-data_value">{{ $user->email }}</span></div>
		<div class="user-data__item">Телефон: <span class="user-data_value">{{ $user->phone }}</span></div>
	</div>
	<a href="#">Изменить личные данные</a>
</div>