<div class="form-group {{$errors->first($name)?'has-error':''}}">
  	<label class="control-label" for="{{$name}}">
  		{{$label}}
		@if (old()&&old($name)||!old()&&$item->{$name})
			<div class="image">
				<br><img src="/imagecache/small/{{ old()?old($name):$item->{$name} }}" alt="">
				<input type="hidden" name="{{$name}}" value="{{ old()?old($name):$item->{$name} }}">
				<button type="button" class="btn btn-danger btn-xs" data-remove=".image" data-toggle="tooltip" title="" data-original-title="Удалить">
					<i class="fa fa-times"></i>
				</button>
			</div>
		@endif
  	</label>
	<input type="file" name="upload">
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>