<form action="{{ $delete }}" method="POST">
	{!! csrf_field() !!}
	<a href="{{ $edit }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Редактировать"><span class="glyphicon glyphicon-pencil"></span></a>
	<button name="_method" value="DELETE" class="btn btn-sm btn-danger" onclick="confirm('Подтвердите удаление')" data-toggle="tooltip" data-original-title="Удалить"><span class="glyphicon glyphicon-remove"></span> </button>
</form>