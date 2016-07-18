<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label class="control-label" for="{{$name}}">{{$label}}</label>
	<input type="password" class="form-control" name="{{$name}}" placeholder="{{$placeholder}}">
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>