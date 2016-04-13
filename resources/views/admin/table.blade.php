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

	<div class="box">
		<div class="box-body no-padding">
			<table class="table table-striped">
    		@foreach ($table as $col)
				<th style="width: {{$col['width']}}">{{$col['title']}}</th>
			@endforeach
		    @foreach ($items as $item)
	    		<tr>
	    		@foreach ($table as $col)
	    			<td style="width: {{$col['width']}}">
		    			@include('admin.table.' . $col['type'], [
		    				'item' => $item,
		    				'field' => $col['field'],
		    				'links' => $links
		    			])
	    			</td>
				@endforeach
				</tr>
		    @endforeach
			</table>
		</div>
		<div class="box-footer">
			<div class="pull-right">{{$items->render()}}</div>
		</div>
	</div>
    </section>
    <!-- /.content -->
@endsection