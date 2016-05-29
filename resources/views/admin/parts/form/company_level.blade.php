<div class="form-group">
	<label class="control-label"">{{$label}}</label>
	<div style="width: 50%;">
		При покупке статуса для Вашей компании Вы получаете ряд преимуществ согласно выбранного тарифного плана. Также Вы сможете докупить определенные функции в дальнейшем или улучшить свой тарифный план. Подробнее об условиях всех тарифных пакетов Вы можете почитать на странице <a href="'.url('uslovia').'">Условия портала</a>
	</div>
	<div class="radio">
		<label><input type="radio" value="0" checked name="{{$name}}">Нет</label>
	</div>
	@foreach ($options as $option)
	<div class="radio">
		<label><input type="radio" value="{{ $option->id }}" {{$value==$option->id ? 'checked' : ''}}  name="{{$name}}">{{ $option->name }}</label>
	</div>
	@endforeach
</div>