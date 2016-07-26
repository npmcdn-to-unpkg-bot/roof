@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Стройки и вакансии@endsection

@section('content')
	<div class="page-tabs">
		<div class="container breadcrumbs">
			<span class="breadcumbs__current">СТРОЙКИ И ВАКАНСИИ</span>
		</div>
		@include('general.buildings.map')
		<div class="container offset_vertical_60">
			<div class="title">ВАКАНСИИ ПО СПЕЦИАЛИЗАЦИИ</div>
			<form action="" class="offset_vertical_15 jus">
				<select style="width: 280px;" name="speciality" class="input_select input jus__item offset-sm_vertical_15">
					<option value="">ВАКАНСИИ ПО СПЕЦИАЛЬНОСТИ</option>
					@foreach ($specialities as $speciality) @if (!empty($speciality))
						<option value="{{$speciality}}" {{Request::get('speciality')==$speciality?'selected':''}}>{{$speciality}}</option>
					@endif @endforeach
				</select>
				<select style="width: 170px;" name="seasonality" class="input_select input jus__item offset-sm_vertical_15">
					<option value="">СЕЗОННОСТЬ</option>
					<option value="1" {{Request::get('seasonality')==='1'?'selected':''}}>Сезонная работа</option>
					<option value="0" {{Request::get('seasonality')==='0'?'selected':''}}>Регулярная работа</option>
				</select>
				<button class="jus__item offset-sm_vertical_15 button button_search"></button>
			</form>
		</div>
		<div id="jobs" class="container">
			@forelse ($jobs as $i => $job)
				<div class="job">
					<div class="container__row">
						<a href="{{route('jobs.show',$job)}}" class="container__col-6 job__title">
							{{$job->name}}
						</a>
						<div class="container__col-6 text_right">
							{{$job->created_at->format('d.m.Y')}}
						</div>
					</div>
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
			@empty
			По вашему запросу ничегоне найдено.
			@endforelse
		</div>
	</div>
	@include('general.pagenav',['items'=>$jobs])
	@include('general.news.block2')
@endsection