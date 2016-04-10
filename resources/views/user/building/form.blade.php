@extends('user.layout')

@section('breadcrumbs')
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
@endsection

@section('workspace')
	<div class="title">{{ $title }}</div>
	<form action="{{ route('office.building.store') }}" method="POST" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="offset_vertical_20">
			<input type="text" name="name" value="{{ old('name')?old('name'):$building->name }}" placeholder="НАЗВАНИЕ ОБЪЕКТА" class="input input_100 {{ $errors->has('name') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('name')) <div class="error">{{ $errors->first('name') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<input type="text" name="type" value="{{ old('type')?old('type'):$building->type }}" placeholder="ТИП ОБЪЕКТА" class="input input_100 {{ $errors->has('type') ?  'input_error' : '' }} input_bold">
			@if ($errors->first('type')) <div class="error">{{ $errors->first('type') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<div class="dropzone {{ $errors->has('images') ?  'input_error' : '' }}" id="building"></div>
			@if ($errors->first('images')) <div class="error">{{ $errors->first('images') }}</div> @endif
			<script>
				document.addEventListener("DOMContentLoaded", function () {
					Dropzone.options.building = {
						maxFiles: 5,
						old: [
							@if (old('images'))
								@foreach (old('images') as $id => $image)
									{name: '{{ $image }}', id: '{{ $id }}'},
								@endforeach
							@endif
						]
					}
				});
			</script>
		</div>				
		<div class="offset_vertical_20">
			<textarea name="information" placeholder="ИНФОРМАЦИЯ" class="input input_100 {{ $errors->has('information') ?  'input_error' : '' }} input_textarea input_bold">{{ old('information')?old('information'):$building->information }}</textarea>
			@if ($errors->first('information')) <div class="error">{{ $errors->first('information') }}</div> @endif
		</div>
		<div class="offset_vertical_20">
			<select name="country" id="" class="input input_bold input_select {{ $errors->has('country') ?  'input_error' : '' }}">
				<option value="0">Украина</option>
			</select>
		</div>
		<div class="offset_vertical_20">
			<label>
				<input type="checkbox" name="published" class="input_checkbox"><span></span>
				Опубликовать в разделе "Стройки и Вакансии"
			</label>
		</div>
		<div class="offset_vertical_20">
			<button class="button button_big button_orange">СОХРАНИТЬ</button>
		</div>
	</form>
@endsection