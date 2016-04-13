<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label for="{{$name}}">{{$label}}</label>
	<textarea class="form-control" name="{{$name}}" rows="3" placeholder="{{$placeholder}}" style="resize: none">{{ old()?old($name):$item->{$name} }}</textarea>
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>