<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label for="{{$name}}">{{$label}}</label>
	<textarea class="form-control" name="{{$name}}" rows="6" placeholder="{{$placeholder}}" style="resize: none">{{ $value }}</textarea>
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>