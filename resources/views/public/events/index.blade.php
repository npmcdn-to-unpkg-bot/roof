@extends('public.layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">КАЛЕНДАРЬ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<div class="calendar {{$class}}">
					<div class="calendar__title">
						<span class="calendar__month">< {{trans('month.'.$current->month)}} {{$current->year}} ></span>
					</div>
					<table class="calendar__table">
						@for ( $i=$start;$i<=$end;$i->addDay() )
							@if ($i->dayOfWeek == 1) <tr> @endif
								@if ($i->month == $current->month) 
									<td class="{{$events->get($i->day)->first() ? 'calendar__date_active' : ''}}">
										<span class="calendar__day">{{$i->day}}</span>
										@if ($event=$events->get($i->day)->shift())
											<a href="{{route('events.show',$event)}}" class="calendar__first">{{$event->name}}</a>
										@endif
										@if ($events->get($i->day)->first())
											<span class="calendar__carret"></span>
											<div class="calendar__events">
												@foreach ($events->get($i->day) as $event)
													<a href="{{route('events.show',$event)}}" class="calendar__event">{{$event->name}}</a>
												@endforeach
											</div>
										@endif
									</td>
								@else 
									<td></td>
								@endif
							@if ($i->dayOfWeek == 0) </tr> @endif
						@endfor
					</table>
				</div>
			</div>
			<div class="container__col-4">
				@include('public.area.banner',['area' => 'news.1'])
				<div class="offset_vertical_55">@include('public.polls.block')</div>
				<div class="offset_vertical_55">@include('public.area.banner',['area' => 'news.2'])</div>
			</div>
		</div>
	</div>
	@include('public.desk.block')
@endsection