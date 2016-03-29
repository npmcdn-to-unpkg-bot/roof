@extends('layout')

@section('content')
<div class="container breadcrumbs">
	<span class="breadcumbs__current">РЕГИСТРАЦИЯ КОМПАНИИ</span>
</div>
<form action="/office/comp/create" method="POST"  enctype="multipart/form-data" class="container reg-comp">
	{!! csrf_field() !!}
	<div class="title">ДОБАВЛЕНИЕ КОМПАНИИ</div>
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    @endif  	
	<div class="container__col-left reg-comp__left">
		<div class="title title_small">ОБЩИЕ СВЕДЕНИЯ</div>
		<input type="text" name="name" value="{{ old('name') }}" placeholder="НАЗВАНИЕ КОМПАНИИ" class="input {{ $errors->has('name') ?  'input_error' : '' }} input_bold reg-comp__input">
		<input type="file" name="logo" class="reg-comp__input">
		<textarea name="entry" placeholder="ТЕКСТ О КОМПАНИИ" class="input  input_textarea input_bold reg-comp__input">{{ old('entry') }}</textarea>
		<input type="text" name="email" value="{{ old('email') }}"  placeholder="EMAIL" class="input {{ $errors->has('email') ?  'input_error' : '' }} input_bold reg-comp__input">
		<input type="text" name="phone" value="{{ old('phone') }}" placeholder="ТЕЛЕФОН" class="input {{ $errors->has('phone') ?  'input_error' : '' }} input_bold reg-comp__input">
	</div>
	<div class="container__col-left reg-comp__right">
		<div class="title title_small">КОНТАКТНОЕ ЛИЦО</div>
		<input type="text" name="user_name" value="{{ old('user_name')?old('user_name'):Auth::user()->name }}" placeholder="ИМЯ" class="input input_bold reg-comp__input">
		<input type="text" name="user_job" value="{{old('user_job')}}" placeholder="ДОЛЖНОСТЬ" class="input input_bold reg-comp__input">
		<input type="text" name="user_phone" value="{{old('user_phone')}}" placeholder="ТЕЛЕФОН" class="input input_bold reg-comp__input">
		<button class="button button_big button_orange reg-comp__button">РЕГИСТРАЦИЯ КОМПАНИИ</button>
	</div>
</form>
@endsection