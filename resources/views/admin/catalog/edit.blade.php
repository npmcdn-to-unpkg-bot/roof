@extends('admin.layout')

@section('content')
	<section class="content">
		<h1>{{$company->name}}</h1>
		<div class="nav-tabs-custom">
			@include('admin.catalog.nav')
			<div class="tab-content">
		    	<h2>{{$title}}</h2>
				@include('admin.parts.form.index')
			</div>
		</div>
	</section>
@endsection