<div class="form-group  {{$errors->first($name)?'has-error':''}}">
	<label for="{{$name}}">{{$label}}</label>
	<select class="form-control" multiple name="{{$name}}[]" id="{{$name}}Select">
		@foreach ($options as $id => $option)
			<option value="{{$id}}" {{in_array($id,$values) ? 'selected' : ''}}>{{$option}}</option>
		@endforeach
	</select>
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>
<script>
	$('#{{$name}}Select').select2({
		language: 'ru',
		@if(isset($settings)) {{$settings}} @endif
	});
</script>