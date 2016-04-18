<div class="form-group {{$errors->first($name)?'has-error':''}}">
  	<label class="control-label" for="{{$name}}">
  		{{$label}}
		@if ($value)
			<div class="image">
				<br><img src="/imagecache/small/{{ $value }}" alt="">
				<input type="hidden" name="{{$name}}" value="{{ $value }}">
				<button type="button" class="btn btn-danger btn-xs" onclick="$(this).parents('.image').remove()" data-toggle="tooltip" title="" data-original-title="Удалить">
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