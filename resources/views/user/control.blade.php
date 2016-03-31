<div>
	<div class="title">УПРАВЛЕНИЕ</div>
	<ul>
		@if (isset($company)) 
		<li><a href="{{ route('office.company.index') }}">Моя компания</a></li>
		<li><a href="#">Мои статьи</a></li>
		<li><a href="#">Сотрудники компании</a></li>
		<li><a href="{{ route('office.building.index') }}">Стройки</a></li>
		<li><a href="{{ route('office.job.index') }}">Вакансии</a></li>
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