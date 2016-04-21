@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$title}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">{{$title}}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  <form action="{{route($action)}}" method="POST" enctype="multipart/form-data">
    @if ($errors->first())
      <div class="form-group has-error">
          <span class="help-block">Проверьте правильность заполнения формы</span>
      </div>
    @endif
    {!! csrf_field() !!}
    @if ($item->id) <input type="hidden" name="id" value="{{$item->id}}"> @endif
    <div class="box">
      <div class="box-body">
        @foreach ($fields as $field)
          @include('admin.form.'.$field['type'], $field)
        @endforeach
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-success btn-lg pull-right">Сохранить</button>
      </div>
    </div>
    </form>
    </section>
    <!-- /.content -->
@endsection