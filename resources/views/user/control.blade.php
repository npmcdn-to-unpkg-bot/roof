<div>
	<div class="title">УПРАВЛЕНИЕ</div>
	<div class="menu menu_blue menu_control">
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
	<div class="title">ВАШИ ДАННЫЕ</div>
	<ul>
		<li>{{ $user->name }}</li>
		<li>{{ $user->job }}</li>
		<li>{{ $user->email }}</li>
		<li>{{ $user->phone }}</li>
	</ul>
</div>