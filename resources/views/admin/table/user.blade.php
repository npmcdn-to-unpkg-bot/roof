@if($item->{$field})
	{{$item->{$field}->email}} <br>
	{{$item->{$field}->name}} <br>
	{{$item->{$field}->job}}
@endif