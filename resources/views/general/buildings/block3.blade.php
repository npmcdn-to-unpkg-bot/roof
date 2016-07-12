<div class="offset-sm_vertical_60">
	<a href="{{route('buildings.index')}}" class="title">Строительство</a>
	@foreach (App\Models\Building\Building::take(5)->get() as $building)
		<a href="{{route('buildings.show',$building)}}" class="buildings-block__title">{{$building->name}}</a>
		<div class="buildings-block__calendar">Календарный план: {{$building->calendar()}}</div>
	@endforeach
</div>
<div class="offset-sm_vertical_60">
	<a href="{{route('jobs.index')}}" class="title">Вакансии</a>
	@foreach (App\Models\Building\Job::orderBy('created_at','desc')->take(7)->get() as $job)
		<a href="{{route('jobs.show',$job)}}" class="buildings-block__title">{{$job->name}}</a>
	@endforeach
</div>