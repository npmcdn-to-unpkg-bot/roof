<form action="{{$action}}" method="POST" enctype="multipart/form-data">
	@if ($errors->first())
		<div class="form-group has-error">
			<span class="help-block">Проверьте правильность заполнения формы</span>
		</div>
	@endif
	{!! csrf_field() !!}
	@if (isset($item)&&$item->id) <input type="hidden" name="id" value="{{$item->id}}"> @endif
	@foreach ($fields as $field)
		@include('admin.parts.form.'.$field['type'], $field)
	@endforeach
	<div class="clearfix text-right">
		<button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
		@if(isset($promote)&&$promote)
		<button type="submit" class="btn btn-success btn-lg" name="promote" value="true">Сохранить и рекламировать</button>
		@endif
	</div>
</form>