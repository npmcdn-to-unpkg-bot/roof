<div class="form-group">
	<label class="control-label"">{{$label}}</label>
	<div class="radio">
		<label><input type="radio" value="0" checked name="{{$name}}">Нет</label>
	</div>
	@foreach ($options as $option)
	<div class="radio">
		<label><input type="radio" value="{{ $option->id }}" {{$value==$option->id ? 'checked' : ''}}  name="{{$name}}">{{ $option->name }}</label>
	</div>
	@endforeach
</div>