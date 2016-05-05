<div class="container offset_vertical_60">
	<div class="title">ФИЛЬТР ОБЪЕКТОВ</div>
	<form action="" class="offset_vertical_15 jus">
		<select name="country" class="input_select input jus__item">
			<option value="">ВЫБЕРИТЕ СТРАНУ</option>
			@foreach ($countries as $country)
				<option value="{{$country->id}}" {{Request::get('country')==$country->id?'selected':''}}>{{$country->name}}</option>
			@endforeach
		</select>
		<select name="city" class="input_select input jus__item">
			<option value="">ВЫБЕРИТЕ ГОРОД</option>
			@foreach ($cities as $city)
				<option value="{{$city->id}}" {{Request::get('city')==$city->id?'selected':''}}>{{$city->name}}</option>
			@endforeach
		</select>
		<select name="type" class="input_select input jus__item">
			<option value="">ТИП ОБЪЕКТОВ</option>
			@foreach ($types as $type)
				<option value="{{$type}}" {{Request::get('type')==$type?'selected':''}}>{{$type}}</option>
			@endforeach
		</select>
		<select name="speciality" class="input_select input jus__item">
			<option value="">ВАКАНСИИ ПО СПЕЦИАЛЬНОСТИ</option>
			@foreach ($specialities as $speciality) @if (!empty($speciality))
				<option value="{{$speciality}}" {{Request::get('speciality')==$speciality?'selected':''}}>{{$speciality}}</option>
			@endif @endforeach
		</select>
		<select name="seasonality" class="input_select input jus__item">
			<option value="">СЕЗОННОСТЬ</option>
			<option value="1" {{Request::get('seasonality')==='1'?'selected':''}}>Сезонная работа</option>
			<option value="0" {{Request::get('seasonality')==='0'?'selected':''}}>Регулярная работа</option>
		</select>
		<button class="jus__item button button_search"></button>
	</form>
</div>