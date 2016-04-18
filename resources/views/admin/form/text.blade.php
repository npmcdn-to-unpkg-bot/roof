<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label class="control-label" for="{{$name}}">{{$label}}</label>
	<input type="text" class="form-control" value="{{ $value }}" name="{{$name}}" placeholder="{{$placeholder}}">
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>