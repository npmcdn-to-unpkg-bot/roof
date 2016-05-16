<div class="form-group">
	<label class="control-label"">{{$label}}</label>
	@if ($expire <= Carbon\Carbon::now())
		@foreach ($periods as $period => $label)
		<div class="radio">
			<label><input type="radio" value="{{ $period }}" {{ $period==$value ? 'checked' : '' }} name="{{$name}}">{{ $label }}</label>
		</div>
		@endforeach
	@else
		<div>
			<span class="label label-large label-success">Активно до {{$expire->format('d.m.Y')}}</span>
		</div>
	@endif	
</div>