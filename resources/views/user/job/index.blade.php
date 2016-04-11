@extends('user.layout')

@section('breadcrumbs')
	<span class="breadcumbs__current">ЛИЧНЫЙ КАБИНЕТ</span>
@endsection

@section('workspace')
	<a href="{{ route('office.job.create') }}">Добавить вакансию</a>
	@if ($jobs)
		@foreach ($jobs as $job)
			<div class="job">
				<div class="job__title">{{ $job->name }}</div>
				<div class="job__pay">ЗАРПЛАТА: {{ $job->pay }}</div>
				<div class="job__preview">
					@if ($job->information) <p>{{ $job->information }}</p> @endif
					<a href="{{ route('office.job.edit',$job) }}">Редактироввать</a>
				</div>
				<div class="job__full">
					@if ($job->requirements) 
						<div class="job__label">ТРЕБОВАНИЯ:</div>
						<p>{{ $job->requirements }}</p>
					@endif
					@if ($job->duties)
						<div class="job__label">ОБЯЗАННОСТИ:</div>
						<p>{{ $job->duties }}</p> 
					@endif
					@if ($job->conditions)
						<div class="job__label">УСЛОВИЯ РАБОТЫ:</div>
						<p>{{ $job->conditions }}</p>
					@endif
					@if ($job->information)
						<div class="job__label">ДОПОЛНИТЕЛЬНАЯ ИНФОРМАЦИЯ:</div>
						<p>{{ $job->information }}</p>
					@endif
					@if ($job->phone||$job->email)
						<div class="job__label">КОНТАКТНАЯ ИНФОРМАЦИЯ:</div>
						<p>
							@if ($job->phone) Тел: {{ $job->phone }} <br> @endif
							@if ($job->email) Email: {{ $job->email }} @endif
						</p>
					@endif
					<a href="{{ route('office.job.edit',$job) }}">Редактироввать</a>
				</div>
				<div class="job__toggle"></div>
			</div>
		@endforeach
	@endif
@endsection