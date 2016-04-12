@extends('user.layout')

@section('breadcrumbs')
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
@endsection

@section('workspace')
	<div class="title">{{ $title }}</div>
	<form action="{{ route('office.offer.store') }}" method="POST" enctype="multipart/form-data">
		{!! csrf_field() !!}
		@if ($offer->id) <input type="hidden" name="id" value="{{ $offer->id }}"> @endif
		<div class="offset_vertical_20">
			<input type="text" name="title" value="{{ old()?old('title'):$offer->title }}" placeholder="ЗАГОЛОВОК ОБЪЯВЛЕНИЯ" class="input input_100 {{ $errors->has('title') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('title')) <div class="error">{{ $errors->first('title') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="price" value="{{ old()?old('price'):$offer->price }}" placeholder="ЦЕНА" class="input input_100 {{ $errors->has('price') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('price')) <div class="error">{{ $errors->first('price') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			@if (!old()&&$offer->image||old()&&old('image'))
				<div class="removable">
					<a href="#" class="removable__remove">Удалить</a><br>
					<img src="/imagecache/small/{{ old()?old('image'):$offer->image }}" alt="">
					<input type="hidden" name="image" value="{{ old()?old('image'):$offer->image }}">
				</div>
			@endif
			<input type="file" name="upload">
			@if ($errors->first('image')) <div class="error">{{ $errors->first('image') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<textarea name="information" placeholder="ИНФОРМАЦИЯ" class="input input_100 {{ $errors->has('information') ?  'input_error' : '' }} input_textarea input_bold">{{ old()?old('information'):$offer->information }}</textarea>
			@if ($errors->first('information')) <div class="error">{{ $errors->first('information') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="specialisation" value="{{ old()?old('specialisation'):$offer->specialisation }}" placeholder="СПЕЦИАЛИЗАЦИЯ" class="input input_100 {{ $errors->has('specialisation') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('specialisation')) <div class="error">{{ $errors->first('specialisation') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<div class="title title_small title_black">КАТЕГОРИИ</div>
			<div class="menu menu_blue menu_vertical menu_medium">
				@foreach (App\DeskCategory::all() as $category)
					<label class="menu__item">
						<input 
							class="input_checkbox"
							type="checkbox"
							name="deskcategories[{{ $category->id }}]"
							value="{{ $category->id }}"
							@if ( 
								old()&&old('deskcategories.'.$category->id)
								or
								!old()&&$offer->deskcategories->contains($category->id) 
							)
							checked
							@endif
						>
						<span></span>
						{{ $category->name }}
					</label>
				@endforeach
			</div>
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="name" value="{{ old()?old('name'):$offer->name }}" placeholder="ИМЯ КОНТАКТНОГО ЛИЦА" class="input input_100 {{ $errors->has('name') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('name')) <div class="error">{{ $errors->first('name') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="email" value="{{ old()?old('email'):$offer->email }}" placeholder="EMAIL" class="input input_100 {{ $errors->has('email') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('email')) <div class="error">{{ $errors->first('email') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="phone" value="{{ old()?old('phone'):$offer->phone }}" placeholder="ТЕЛЕФОН" class="input input_100 {{ $errors->has('phone') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('phone')) <div class="error">{{ $errors->first('phone') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<button class="button button_big button_orange">СОХРАНИТЬ</button>
		</div>
	</form>
@endsection