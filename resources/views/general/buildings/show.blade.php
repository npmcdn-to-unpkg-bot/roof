@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{$building->meta_title ? $building->meta_title : $building->name}}@endsection

@section('description'){{ $building->meta_description ? $building->meta_description : str_limit($building->information,150) }}@endsection

@section('content')
	<div class="container breadcrumbs">
		<a href="{{ route('buildings.index') }}" class="breadcrumbs__path">СТРОЙКИ И ВАКАНСИИ</a><span class="breadcumbs__current">{{ $building->name }}</span>
	</div>
	<div class="container building">
		<div class="title offset_vertical_20">{{ $building->name }}</div>
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<img src="/width/{{Agent::isMobile()?'610':'765'}}/{{ $building->images->first()->name }}" alt="" class="building__image offset-sm_vertical_30">
				<div class="building__gallery slider offset_vertical_30">
					<ul class="slides">
						@foreach ($building->images as $image)
							<li><a href="/width/{{Agent::isMobile()?'610':'765'}}/{{ $image->name }}" class="building__gallery-image"><img src="/fit/170/120/{{$image->name}}" alt=""></a></li>
						@endforeach
					</ul>
				</div>
				@if ( !$building->jobs->isEmpty() )
				<div class="small-title offset_vertical_20 offset-sm_vertical_30">ВАКАНСИИ НА ОБЪЕКТЕ</div>
					@foreach ($building->jobs as $job)
						<div class="job offset-sm_vertical_30">
							<div class="job__title">{{ $job->name }}</div>
							<div class="job__pay">ЗАРПЛАТА: {{ $job->pay }}</div>
							<div class="job__preview">
								@if ($job->information) <p>{{ $job->information }}</p> @endif
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
							</div>
							<div class="job__toggle"></div>
						</div>
					@endforeach
				@endif
			</div>
			<div class="container__col-4 container__col-sm-12">
				<div class="field field_type">{{ $building->type }}</div>
				@if ($building->company)<a href="{{ route ( 'catalog.show', $building->company ) }}" class="field field_company">{{ $building->company->name }}</a>
				@elseif ($building->company_name) <span class="field field_company">{{$building->company_name}}</span>
				@endif
				<div class="field field_address">{{$building->printAddress()}}</div>
				<div class="field field_period">{{$building->calendar()}}</div>
				<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
				<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
				<div class="ya-share2" data-services="facebook,gplus,twitter" data-counter=""></div>
				@if ($building->information)
					<div class="field field_info">
						<div class="small-title">ИНФОРМАЦИЯ</div>
						{{ $building->information }}
					</div>
				@endif
				<div class="offset_vertical_55 offset-sm_vertical_30">
					@include('general.area.banner',['area' => 'Стройки запись 1'])
				</div>
			</div>
		</div>
	</div>
	@include('general.buildings.block')
@endsection