<div class="form-inline form-group">
	<label class="control-label">{{$label}}</label><br>
	<select name="country_id" class="form-control" id="country">
		@foreach($countries as $option)
			<option 
				value="{{$option->id}}" 
				{{$country==$option->id?'selected':''}}>
			{{$option->name}}
			</option>
		@endforeach
	</select>
	<select name="city_id" class="form-control" id="city">
		@foreach($cities as $option)
			<option 
				value="{{$option->id}}" 
				{{$city==$option->id?'selected':''}}>
			{{$option->name}}
			</option>
		@endforeach
	</select>
	<input type="text" style="width: 350px" class="form-control inputAddress" name="address" id="address" value="{{$address}}" placeholder="Улица, Дом">
	<a id="geocode" class="btn btn-success"><i class="fa fa-search"></i></a>
	<div class="pull-right">
		<input type="text" value="{{$lat}}" class="form-control" placeholder="Широта" id="lat" name="lat">
		<input type="text" value="{{$lng}}" class="form-control" placeholder="Долгота" id="lng" name="lng">
	</div>
</div>
<div class="form-group">
	<div id="map" style="height: 350px;"></div>
</div>
<script>

initAddressPicker();

function initAddressPicker(){
	var position = {lat: {{$lat}}, lng: {{$lng}} };

	var map = new google.maps.Map(document.getElementById('map'),{
		zoom: 14,
        center: position,
        scrollwheel: false,
        mapTypeId: "roadmap"
	})

	var marker = new google.maps.Marker({
	    map: map,
	    position: position,
		draggable: true,
		raiseOnDrag: true,
  	});

	marker.addListener('dragend', updateLatLngFields);

	var geocoder = new google.maps.Geocoder();

	var country = document.getElementById('country');
	var city = document.getElementById('city');
	var address = document.getElementById('address');
	var button = document.getElementById('geocode');

	$('#country').select2({language: 'ru'}).on('change', function () {
		$('#country').select2('close');
		map.setZoom(5);
		geocode(country.options[country.selectedIndex].text);
	});
	$('#city').select2({language: 'ru'}).on('change', function () {
		map.setZoom(10);
		geocode(country.options[country.selectedIndex].text+' '+city.options[city.selectedIndex].text+' '+address.value);
	});
	address.addEventListener('change', function () {
		map.setZoom(14);
		geocode(country.options[country.selectedIndex].text+' '+city.options[city.selectedIndex].text+' '+address.value);
	});
	button.addEventListener('click', function () {
		map.setZoom(14);
		geocode(country.options[country.selectedIndex].text+' '+city.options[city.selectedIndex].text+' '+address.value);
	});

	function geocode(request) {
		geocoder.geocode({'address': request}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				marker.setPosition(results[0].geometry.location);
				updateLatLngFields();
			} else {
				alert('Рекомендуется исправить адрес для успешного распознания координат.');
			}
		});
	}

	function updateLatLngFields() {
		document.getElementById('lat').value = marker.position.lat();
        document.getElementById('lng').value = marker.position.lng();
	}

	@if ($lat==0 && $lng==0)geocode(country.options[country.selectedIndex].text+' '+city.options[city.selectedIndex].text+' '+address.value);@endif

}
</script>