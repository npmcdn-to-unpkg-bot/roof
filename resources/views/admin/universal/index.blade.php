@extends('admin.layout')

@section('content')
    <section class="content">
    	<h1>{{$title}}</h1>
    	@include('admin.parts.table.index')
    </section>
@endsection