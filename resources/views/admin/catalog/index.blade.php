@extends('admin.layout')

@section('content')
	<section class="content">
		<h1>{{$company->name}}</h1>
    	<div class="nav-tabs-custom">
			@include('admin.catalog.nav')
			<div class="tab-content">
		    	<h3>{{$title}} @if (isset($add)) <a href="{{$add}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Добавить</a> @endif</h3>
				@include('admin.parts.table.index')
			</div>
    	</div>
	</section>
@endsection