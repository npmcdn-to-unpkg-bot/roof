<div class="title">КАТЕГОРИИ</div>
<form id="deskCategories" class="menu menu_blue menu_medium menu_vertical menu_no_underline menu_rare offset_bottom_60 offset-sm_vertical_30">
	<input type="hidden" name="categories" value="{{Request::get('categories')}}">
	@foreach (App\Category::all() as $category)
		<label class="menu__item">
			<input class="input_checkbox" type="checkbox" value="{{$category->id}}" @if(in_array($category->id,$categories)) checked @endif>
			<span></span>
			{{$category->name}}
		</label>
	@endforeach
	<button class="button button_100 button_cyan button_big">ПОКАЗАТЬ</button>
	<script>
		document
			.getElementById('deskCategories')
			.addEventListener('change', deskCategoriesChange);
		function deskCategoriesChange(event) {
			$(this).find('[name=categories]').val(
				$(this)
					.find('input:checked')
					.map(function (){ return this.value })
					.get()
					.join(',')
			)
		}
	</script>
</form>