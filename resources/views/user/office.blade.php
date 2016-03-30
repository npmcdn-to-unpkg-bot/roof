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
			@if (isset($company))
			<div class="title">{{ $company->name }}</div>
			<ul>
				<li><img src="/imagecache/small/{{ $company->logo }}" alt=""></li>
				<li>{{ $company->email }}</li>
				<li>{{ $company->phone }}</li>
				<li>{{ $company->entry }}</li>
				<li><a href="/office/company/edit">Изменить</a></li>
			</ul>
			@endif
		</div>
	</div>
</div>
@endsection