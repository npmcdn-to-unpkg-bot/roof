<div class="box">
	<div class="box-body no-padding">
		<table class="table table-striped">
		@foreach ($table->shift() as $th)
			<th style="width: {{$th['width']}}">{{$th['title']}}</th>
		@endforeach
	    @foreach ($table as $tr)
    		<tr>
	    		@foreach ($tr as $td)
	    			<td>@include('admin.parts.table.' . $td['type'], $td)</td>
				@endforeach
			</tr>
	    @endforeach
		</table>
	</div>
	<div class="box-footer">
		<div class="pull-right">{{$pagination}}</div>
	</div>
</div>
<style>
.table>tbody>tr>td {
	vertical-align: middle;
}
</style>