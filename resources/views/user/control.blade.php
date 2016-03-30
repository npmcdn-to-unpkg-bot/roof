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