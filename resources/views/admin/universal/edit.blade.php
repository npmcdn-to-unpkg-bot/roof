@extends('admin.layout')

@section('content')
    <section class="content">
    	<h1>{{$title}}</h1>
    	<div class="box">
  			<div class="box-body">
  				@include('admin.parts.form.index')
  			</div>
  		</div>
  	</section>
@endsection