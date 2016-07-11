<form action="/search" class="search-block__form">
    <input type="hidden" name="filter" value="0" />
	<input type="text" name='q' placeholder="ВВЕДИТЕ СЛОВО ДЛЯ ПОИСКА" class="search-block__input" value="{{Request::get('q')}}">
</form>