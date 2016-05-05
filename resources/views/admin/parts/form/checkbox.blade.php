<label class="checkbox">
	<input type="hidden" name="{{$name}}" value="0">
	<input type="checkbox" name="{{$name}}" value="1" {{ $value ? 'checked' : '' }} class="minimal">
	{{$label}}
</label>