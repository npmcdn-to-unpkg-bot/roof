@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Наши контакты@endsection

@section('content')

<div class="container breadcrumbs">
	<span class="breadcumbs__current">НАШИ КОНТАКТЫ</span>
</div>
<div class="container">
	<div id="contacts-page">
		Адрес:
		<div class="contact-value">Киев, Б-р Ромена Роллана 7</div>
		<br>
		Телефон:
		<div class="contact-value">+38 066 918 2362</div>
		<br>
		e-mail:
		<div class="contact-value">Svlasenko@roofers.com.ua <br>
		info@roofers.com.ua</div>

		<iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2541.4700945684513!2d30.36660735157167!3d50.43234387937212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cb837ecc39f9%3A0xc97fc4e1e6de1d76!2z0LHRg9C7LiDQoNC-0LzQtdC90LAg0KDQvtC70LvQsNC90LAsIDcsINCa0LjRl9Cy!5e0!3m2!1sru!2sua!4v1463645981148" width="571" height="433" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>
	<style>
		#contacts-page{
			font-family: "Roboto Condensed";
			color:  #000000;
			font-size: 30px;
			font-weight: 300;
			line-height: 48px;
			text-align: left;
			margin-bottom: 133px;
			position: relative;
		}
		.contact-value {
			color:  #0a3955;
		}
		@if (!Agent::isMobile())
		#map {
			position: absolute;
			top: 0;
			right: 0;
		}
		@endif
	</style>
</div>
@endsection