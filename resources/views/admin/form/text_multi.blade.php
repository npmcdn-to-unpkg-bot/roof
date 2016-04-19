<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label class="control-label">{{$label}}</label>
	<div class="sortable" id="{{$name}}">
		@foreach ($values as $value)
			<div class="form-group input-group {{$name}}">
			    <span class="input-group-addon"><i class="fa fa-sort"></i></span>
				<input type="text" class="form-control" name="{{$name}}[{{$value['id']}}]" value="{{$value['value']}}" placeholder="{{$placeholder}}">
				<input type="hidden" name="{{$name}}_id[{{$value['id']}}]" value="{{$value['id']}}">
			    <span class="input-group-btn"><a href="#" onclick="$(this).parents('.{{$name}}').remove()" class="btn btn-danger"><i class="fa fa-times"></i></a></span>
			</div>
		@endforeach
	</div>
	@if ($errors->first($name))<span class="help-block">{{ $errors->first($name) }}</span>@endif
	<div class="pull-right">
		<a href="#" class="btn btn-success" onclick="$('#{{$name}}').append({{$name}}.clone())"><i class="fa fa-plus"></i></a>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", 
	function () {
		{{$name}} = $('.{{$name}}').last().clone();
	});
</script>