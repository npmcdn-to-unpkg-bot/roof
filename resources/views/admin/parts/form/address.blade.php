<div class="form-inline form-group">
	<label class="control-label">{{$label}}</label><br>
	<select name="country_id" style="width: 150px" class="form-control" id="country">
		<option value="{{$country->id}}" selected>{{$country->name}}</option>
	</select>
	<select name="city_id" style="width: 250px" class="form-control" id="city">
		<option value="{{$city->id}}" selected>{{$city->name}}</option>
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

	var country = document.getElementById('country');
	var city = document.getElementById('city');
	var address = document.getElementById('address');
	var button = document.getElementById('geocode');

	$('#country').select2({
		minimumInputLength: 1,
		placeholder: 'Страна',
		ajax: {
			url: "/autocomplete/country",
			delay: 250,
			cache: true
		},
        language: 'ru'
	}).on('change', function () { 
	    $('#country').select2('close'); 
	    map.setZoom(5); 
	    geocode(country.options[country.selectedIndex].text); 
  	});

	$('#city').select2({
		minimumInputLength: 1,
		placeholder: 'Город',
		ajax: {
			url: "/autocomplete/city",
			delay: 250,
			data: function (params) { 
				return {
					term: params.term,
					country: country.value
				};
			},
			cache: true
		},
		language: 'ru'
	}).on('change', function () {
		map.setZoom(10);
		geocode();
	});

  	var position;
	position = {lat: {{$lat ? $lat : 0}}, lng: {{$lng ? $lng : 0}} };

	var map = new google.maps.Map(document.getElementById('map'),{
		zoom: 14,
        center: position,
        scrollwheel: false,
        mapTypeId: "roadmap",
		disableDefaultUI: false,
	})

	var marker = new google.maps.Marker({
	    map: map,
	    position: position,
		draggable: true,
		raiseOnDrag: true,
  	});

	marker.addListener('dragend', updateLatLngFields);

	var geocoder = new google.maps.Geocoder();

	address.addEventListener('change', function () {
		map.setZoom(14);
		geocode();
	});
	button.addEventListener('click', function () {
		map.setZoom(14);
		geocode();
	});

	function geocode(request) {
		request = request ||
			country.options[country.selectedIndex].text+' '+city.options[city.selectedIndex].text+' '+address.value;
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


}
</script>