<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label class="control-label" for="{{$name}}">{{$label}}</label>
	<div class="input-group date {{$errors->first($name)?'has-error':''}}">
	  <div class="input-group-addon">
	    <i class="fa fa-calendar"></i>
	  </div>
	  <input type="text" value="{{ $value }}" name="{{$name}}" class="form-control pull-right"  id="date_{{$name}}">
	</div>
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>
<script>
	$('#date_{{$name}}').datetimepicker({
	    locale: 'ru',
        format: '{{$format}}'
    });
</script>
