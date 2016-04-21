<div class="calendar">
	<div class="calendar__title">
		КАЛЕНАДРЬ
		<span class="calendar__month">< {{trans('month.'.$current->month)}} {{$current->year}} ></span>
	</div>
	<table class="calendar__table">
		@for ( $i=$start;$i<=$end;$i->addDay() )
			@if ($i->dayOfWeek == 1) <tr> @endif
				@if ($i->month == $current->month) 
					<td>
						{{$i->day}}
					</td>
				@else 
					<td></td>
				@endif
			@if ($i->dayOfWeek == 0) </tr> @endif
		@endfor
	</table>
		<?php // print_r($events) ?>
</div>
