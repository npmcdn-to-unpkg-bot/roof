@extends('layout')

@section('content')
<div class="container breadcrumbs">
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
</div>
<div class="container">
	<div class="container__row">
		<div class="container__col-4">
			@include('user.control')
		</div>
		<div class="container__col-8">
		    <div class="title">{{ $title }}</div>
			<form action="/office/company/store" method="POST"  enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="offset_vertical_20">
					<input type="text" name="name" value="{{ old('name')?old('name'):$company->name }}" placeholder="НАЗВАНИЕ ОБЪЕКТА" class="input input_100 {{ $errors->has('name') ?  'input_error' : '' }} input_bold">
					@if ($errors->first('name')) <div class="error">{{ $errors->first('name') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<input type="text" name="type" value="{{ old('type')?old('type'):$company->type }}" placeholder="ТИП ОБЪЕКТА" class="input input_100 {{ $errors->has('type') ?  'input_error' : '' }} input_bold">
					@if ($errors->first('type')) <div class="error">{{ $errors->first('type') }}</div> @endif
				</div>				
				<div class="offset_vertical_20">
					<textarea name="information" placeholder="ИНФОРМАЦИЯ" class="input input_100  input_textarea input_bold">{{ old('information')?old('information'):$company->information }}</textarea>
					@if ($errors->first('information')) <div class="error">{{ $errors->first('information') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<select name="country" id="" class="input input_100 input_select {{ $errors->has('email') ?  'input_error' : '' }}">
					</select>
					<input type="text" name="email" value="{{ old('email')?old('email'):$company->email }}"  placeholder="EMAIL" class="input input_100  input_bold">
					@if ($errors->first('email')) <div class="error">{{ $errors->first('email') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<input type="text" name="phone" value="{{ old('phone')?old('phone'):$company->phone }}" placeholder="ТЕЛЕФОН" class="input input_100 {{ $errors->has('phone') ?  'input_error' : '' }} input_bold">
					@if ($errors->first('phone')) <div class="error">{{ $errors->first('phone') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<button class="button button_big button_orange">СОХРАНИТЬ</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection