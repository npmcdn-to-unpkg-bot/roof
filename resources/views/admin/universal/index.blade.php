@extends('admin.layout')

@section('content')
    <section class="content">
    	<h1>{{$title}} @if (isset($add)) <a href="{{$add}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Добавить</a> @endif </h1>
    	@include('admin.parts.table.index')
    </section>
@endsection