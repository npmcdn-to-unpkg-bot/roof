<div class="form-group  {{$errors->first($name)?'has-error':''}}">
	<label for="{{$name}}">{{$label}}</label>
	<select class="form-control select2" multiple name="{{$name}}[]">
		@foreach ($options as $id => $option)
			<option value="{{$id}}" {{in_array($id,$values) ? 'selected' : ''}}>{{$option}}</option>
		@endforeach
	</select>
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>