<div class="form-group {{$errors->first($name)?'has-error':''}}">
  	<label class="control-label" for="{{$name}}">
  		{{$label}}
		@if (old()&&old($name)||!old()&&$item->{$name})
			<br><img src="/imagecache/small/{{ old()?old($name):$item->{$name} }}" alt="">
			<input type="hidden" name="{{$name}}" value="{{ old()?old($name):$item->{$name} }}">
		@endif
  	</label>
	<input type="file" name="upload">
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>