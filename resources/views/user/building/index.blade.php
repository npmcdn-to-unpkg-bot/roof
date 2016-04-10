@extends('user.layout')

@section('breadcrumbs')
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
@endsection

@section('workspace')
    <a href="{{ route('office.building.create') }}">Добавить стройку</a>
@endsection