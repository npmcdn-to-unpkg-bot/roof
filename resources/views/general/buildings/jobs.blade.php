@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{Стройки и вакансии}}@endsection

@section('content')
	<div class="page-tabs">
		<div class="container breadcrumbs">
			<span class="breadcumbs__current">СТРОЙКИ И ВАКАНСИИ</span>
		</div>
		@include('general.buildings.map')
		@include('general.buildings.filter')
		<div id="jobs" class="container">
			@foreach ($jobs as $i => $job)
				<div class="job">
					<div class="job__title">{{$job->name}}</div>
					<div class="job__pay">ЗАРПЛАТА: {{$job->pay}}</div>
					<div class="job__preview" style="display: block;">
						 <p>{{$job->information}}</p>
					</div>
					<div class="job__full" style="display: none;">
						@if ($job->requirements)
						<div class="job__label">ТРЕБОВАНИЯ:</div>
						<p>{{$job->requirements}}</p>
						@endif
						@if($job->duties)
						<div class="job__label">ОБЯЗАННОСТИ:</div>
						<p>{{$job->duties}}</p>
						@endif
						@if ($job->conditions)
						<div class="job__label">УСЛОВИЯ РАБОТЫ:</div>
						<p>{{$job->conditions}}</p>
						@endif
						<div class="job__label">ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ:</div>
						<p>{{$job->information}}</p>
						@if($job->seasonality) <div class="job__label">СЕЗОННАЯ РАБОТА</div>@endif
						<div class="job__label">КОНТАКТНАЯ ИНФОРМАЦИЯ:</div>
						<p>Тел: {{$job->phone}}<br>
							@if ($job->email) Email: {{$job->email}} @endif
						</p>
					</div>
					<div class="job__toggle"></div>
				</div>
			@endforeach
		</div>
	</div>
	@include('general.pagenav',['items'=>$jobs])
	@include('general.news.block2')
@endsection