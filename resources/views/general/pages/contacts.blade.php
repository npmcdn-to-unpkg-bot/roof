@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Наши контакты@endsection

@section('content')

<div class="container breadcrumbs">
	<span class="breadcumbs__current">НАШИ КОНТАКТЫ</span>
</div>
<div class="container">
	<div id="contacts-page">
		Адрес:
		<div class="contact-value">{!! App\Option::firstOrNew(['name'=>'address'])->value !!}</div>
		<br>
		Телефон:
		<div class="contact-value">{!! App\Option::firstOrNew(['name'=>'phone'])->value !!}</div>
		<br>
		e-mail:
		<div class="contact-value">
		{!! App\Option::firstOrNew(['name'=>'email_1'])->value !!}
		<br>
		{!! App\Option::firstOrNew(['name'=>'email_2'])->value !!}
		</div>

		{!! App\Option::firstOrNew(['name'=>'map'])->value !!}
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