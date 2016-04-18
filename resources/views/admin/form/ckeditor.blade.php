<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label for="{{$name}}">{{$label}}</label>
	<textarea class="form-control ckeditor" name="{{$name}}" style="resize: none">{{ $value }}</textarea>
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>