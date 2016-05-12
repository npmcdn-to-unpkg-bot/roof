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
	<div class="clearfix">
		<button type="submit" class="btn btn-success btn-lg pull-right">Сохранить</button>
	</div>
</form>