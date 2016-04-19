<div class="form-group  {{$errors->first($name)?'has-error':''}}">
	<label for="{{$name}}">{{$label}}</label>
	<select class="form-control select2" name="{{$name}}">
		<option value="0">НЕТ</option>
		@foreach ($options as $id => $option)
			<option value="{{$id}}" {{$value==$id?'selected':''}}>{{$option}}</option>
		@endforeach
	</select>
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>