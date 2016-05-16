<div class="form-group">
	<label class="control-label"">{{$label}}</label>
	@foreach ($options as $option => $label)
	<div class="radio">
		<label><input type="radio" value="{{ $option }}" {{$value==$option ? 'checked' : ''}} name="{{$name}}">{{ $label }}</label>
	</div>
	@endforeach
</div>