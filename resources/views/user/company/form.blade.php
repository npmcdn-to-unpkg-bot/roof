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
			<form action="/office/company" method="POST"  enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="offset_vertical_20">
					<input type="text" name="name" value="{{ old('name')?old('name'):$company->name }}" placeholder="НАЗВАНИЕ КОМПАНИИ" class="input input_100 {{ $errors->has('name') ?  'input_error' : '' }} input_bold">
					@if ($errors->first('name')) <div class="error">{{ $errors->first('name') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<input type="file" name="logo">
					@if ($errors->first('logo')) <div class="error">{{ $errors->first('logo') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<textarea name="entry" placeholder="КРАТКИЙ ТЕКСТ О КОМПАНИИ" class="input input_100  input_textarea input_bold">{{ old('entry')?old('entry'):$company->entry }}</textarea>
					@if ($errors->first('entry')) <div class="error">{{ $errors->first('entry') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<textarea name="about" placeholder="ПОЛНЫЙ ТЕКСТ О КОМПАНИИ" class="ckeditor">{{ old('about')?old('about'):$company->about }}</textarea>
					@if ($errors->first('about')) <div class="error">{{ $errors->first('about') }}</div> @endif
				</div>				
				<div class="offset_vertical_20">
					<input type="text" name="email" value="{{ old('email')?old('email'):$company->email }}"  placeholder="EMAIL" class="input input_100 {{ $errors->has('email') ?  'input_error' : '' }} input_bold">
					@if ($errors->first('email')) <div class="error">{{ $errors->first('email') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<input type="text" name="phone" value="{{ old('phone')?old('phone'):$company->phone }}" placeholder="ТЕЛЕФОН" class="input input_100 {{ $errors->has('phone') ?  'input_error' : '' }} input_bold">
					@if ($errors->first('phone')) <div class="error">{{ $errors->first('phone') }}</div> @endif
				</div>
				<div class="offset_vertical_20">
					<div class="title title_small title_black">СПЕЦИАЛИЗАЦИЯ</div>
					<div class="menu menu_blue menu_vertical menu_medium">
						@foreach ($specialisations as $specialisation)
							<label class="menu__item">
								<input 
									class="input_checkbox"
									type="checkbox"
									name="specialisations[{{ $specialisation->id }}]"
									value="{{ $specialisation->id }}"
									@if ( 
										old()&&old('specialisations.'.$specialisation->id)
										or
										!old()&&$company->specialisations->contains($specialisation->id) 
									)
									checked
									@endif
								>
								<span></span>
								{{ $specialisation->name }}
							</label>
						@endforeach
					</div>
				</div>
				<div class="offset_vertical_20">
					<div class="title title_small title_black">ТИП ПРЕДЛОЖЕНИЯ</div>
					<div class="menu menu_blue menu_vertical menu_medium">
						@foreach ($propositions as $proposition)
							<label class="menu__item">
								<input 
									class="input_checkbox"
									type="checkbox"
									name="propositions[{{ $proposition->id }}]"
									value="{{ $proposition->id }}"
									@if ( 
										old()&&old('propositions.'.$proposition->id)
										or
										!old()&&$company->propositions->contains($proposition->id) 
									)
									checked
									@endif									
								>
								<span></span>
								{{ $proposition->name }}
							</label>
						@endforeach
					</div>
				</div>				
				<div class="offset_vertical_20">
					<button class="button button_big button_orange">СОХРАНИТЬ</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection