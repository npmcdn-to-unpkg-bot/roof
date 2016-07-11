<div class="form-group {{$errors->first($name)?'has-error':''}}">
  	<label class="control-label" for="{{$name}}">
  		{{$label}}
		@if ($value)
			<div class="file">
				<br>{{ $value }}
				<input type="hidden" name="{{$name}}" value="{{ $value }}">
				<button type="button" class="btn btn-danger btn-xs" onclick="$(this).parents('.file').remove()" data-toggle="tooltip" title="" data-original-title="Удалить">
					<i class="fa fa-times"></i>
				</button>
			</div>
		@endif
  	</label>
	<input type="file" name="upload">
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
	@if ($errors->first('upload'))
		<span class="help-block">{{ $errors->first('upload') }}</span>
	@endif
</div>