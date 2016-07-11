<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label class="control-label" for="{{$name}}">{{$label}}</label>
	<div class="form-inline">
		<input class="form-control" type="number" value="{{ trim(str_replace(['грн.','руб.','$','€'],'',$value)) }}" onchange="concat_price()" id="price_{{$name}}">
		<select class="form-control" onchange="concat_price()" id="currency_{{$name}}">
			<option value=""></option>
			<option {{strpos($value,'грн.')?'selected':''}}>грн.</option>
			<option {{strpos($value,'руб.')?'selected':''}}>руб.</option>
			<option {{strpos($value,'$')?'selected':''}}>$</option>
			<option {{strpos($value,'€')?'selected':''}}>€</option>
		</select>
	</div>
	<input type="hidden" value="{{ $value }}" name="{{$name}}" id="{{$name}}">
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>
<script>
	function concat_price () {
		$('#{{$name}}').val($('#price_{{$name}}').val()+' '+$('#currency_{{$name}}').val());
	}
</script>