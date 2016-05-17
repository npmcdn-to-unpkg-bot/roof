<form action="{{ route('desk.index') }}" class="jus offset_vertical_20">
	<input type="text" name="search" value="{{Request::get('search')}}" style="width: 490px" placeholder="КЛЮЧЕВЫЕ СЛОВА" class="input offset-sm_vertical_15 jus__item">
	<select name="created_at" style="width: 200px" class="input_select input offset-sm_vertical_15 jus__item">
		<option value="">ЗА ВСЕ ВРЕМЯ</option>
		<option value="2" {{Request::get('created_at')==2?'selected':''}}>ЗА ДВЕ НЕДЕЛИ</option>
		<option value="4" {{Request::get('created_at')==4?'selected':''}}>ЗА МЕСЯЦ</option>
	</select>
	<button class="offset-sm_vertical_15 jus__item button button_search"></button>
</form>