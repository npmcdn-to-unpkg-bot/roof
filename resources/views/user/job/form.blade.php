@extends('user.layout')

@section('breadcrumbs')
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
@endsection

@section('workspace')
	<div class="title">{{ $title }}</div>
	<form action="{{ route('office.job.store') }}" method="POST" enctype="multipart/form-data">
		{!! csrf_field() !!}
		@if ($job->id) <input type="hidden" name="id" value="{{ $job->id }}"> @endif
		<div class="offset_vertical_20">
			<input type="text" name="name" value="{{ old()?old('name'):$job->name }}" placeholder="НАЗВАНИЕ ВАКАНСИИ" class="input input_100 {{ $errors->has('name') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('name')) <div class="error">{{ $errors->first('name') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="pay" value="{{ old()?old('pay'):$job->pay }}" placeholder="ОПЛАТА (грн)" class="input input_100 {{ $errors->has('pay') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('pay')) <div class="error">{{ $errors->first('pay') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<textarea name="information" placeholder="ИНФОРМАЦИЯ" class="input input_100 {{ $errors->has('information') ?  'input_error' : '' }} input_textarea input_bold">{{ old()?old('information'):$job->information }}</textarea>
			@if ($errors->first('information')) <div class="error">{{ $errors->first('information') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<textarea name="requirements" placeholder="ТРЕБОВАНИЯ" class="input input_100 {{ $errors->has('requirements') ?  'input_error' : '' }} input_textarea input_bold">{{ old()?old('requirements'):$job->requirements }}</textarea>
			@if ($errors->first('requirements')) <div class="error">{{ $errors->first('requirements') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<textarea name="duties" placeholder="ОБЯЗАННОСТИ" class="input input_100 {{ $errors->has('duties') ?  'input_error' : '' }} input_textarea input_bold">{{ old()?old('duties'):$job->duties }}</textarea>
			@if ($errors->first('duties')) <div class="error">{{ $errors->first('duties') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<textarea name="conditions" placeholder="УСЛОВИЯ" class="input input_100 {{ $errors->has('conditions') ?  'input_error' : '' }} input_textarea input_bold">{{ old()?old('conditions'):$job->conditions }}</textarea>
			@if ($errors->first('conditions')) <div class="error">{{ $errors->first('conditions') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="phone" value="{{ old()?old('phone'):$job->phone }}" placeholder="ТЕЛЕФОН" class="input input_100 {{ $errors->has('phone') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('phone')) <div class="error">{{ $errors->first('phone') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="email" value="{{ old()?old('email'):$job->email }}" placeholder="EMAIL" class="input input_100 {{ $errors->has('email') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('email')) <div class="error">{{ $errors->first('email') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<select name="building_id" class="input input_bold input_select">
				<option value="">ОБЪЕКТ НЕ ВЫБРАН</option>
				@foreach (Auth::user()->company->buildings as $building)
					<option {{old('building_id')==$building->id||$job->building_id==$building->id ? 'selected' : ''}} value="{{ $building->id }}">{{ $building->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="offset_vertical_20">
			<button class="button button_big button_orange">СОХРАНИТЬ</button>
		</div>
	</form>
@endsection