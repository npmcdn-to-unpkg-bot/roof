@extends('user.layout')

@section('breadcrumbs')
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
@endsection

@section('workspace')
	@if ($company)
	<div class="company-cart company-cart_page company-cart_white">
		<img src="/imagecache/small/{{ $company->logo }}" alt="" class="company-cart__logo">
		<div class="company-cart__name">{{ $company->name }}</div>
		<div class="company-cart__description">{{$company->entry}}</div>
		<div class="container__row">
			<div class="container__col-8">
				<div class="company-cart__address">{{$company->address}}</div>
				<div class="company-cart__post-date">
					Дата регистрации: 
					{{ $company->created_at->format('m.d.Y') }}
				</div>
			</div>
			<div class="container__col-4">
				<div>{{ $company->email }}</div>
				<div>{{ $company->phone }}</div>
			</div>
		</div>
		<div>{!! $company->about !!}</div>
	</div>
	<div class="text_right menu menu_blue menu_medium menu_vertical menu_rare">
		<a class="menu__item" href="{{ route('office.company.edit',['id'=>$company->id]) }}">Изменить информацию о компании</a>
	</div>
	@endif
@endsection