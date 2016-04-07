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
			<div class="company-cart company-cart_page company-cart_white">
				<img src="imagecache/small/{{ $company->logo }}" alt="" class="company-cart__logo">
				<div class="company-cart__name">{{ $company->name }}</div>
				<div class="company-cart__description">{{$company->entry}}</div>
				<div class="container__row">
					<div class="container__col-6">
						<div class="company-cart__address">{{$company->address}}</div>
						<div class="company-cart__post-date">
							Дата регистрации: 
							{{ $company->register->format('m.d.Y') }}
						</div>
					</div>
					<div class="container__col-6">
						<div>{{ $company->email }}</div>
						<div>{{ $company->phone }}</div>
					</div>
				</div>				
			</div>			
		</div>
	</div>
</div>
@endsection