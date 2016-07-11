@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Стройки и вакансии@endsection

@section('content')
	<div class="page-tabs">
		<div class="container breadcrumbs">
			<a href="{{route('jobs.index')}}" class="breadcrumbs__path">СТРОЙКИ И ВАКАНСИИ</a>
			<span class="breadcumbs__current">{{$job->name}}</span>
		</div>
		<div id="jobs" class="container">
			<div class="job">
				<div class="container__row">
					<div class="container__col-6 job__title">
						{{$job->name}}
					</div>
					<div class="container__col-6 text_right">
						{{$job->created_at->format('d.m.Y')}}
					</div>
				</div>
				<div class="job__pay">ЗАРПЛАТА: {{$job->pay}}</div>
				<div class="job__preview" style="display: block;">
					<p>{{$job->information}}</p>
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
			</div>
		</div>
	</div>
	@include('general.news.block2')
@endsection