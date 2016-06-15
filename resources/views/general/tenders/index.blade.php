@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Тендеры@endsection

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">ТЕНДЕРЫ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title">АКТИВНЫЕ ТЕНДЕРЫ</div>

				@foreach ($tenders as $tender)
					<div class="tender offset_vertical_20 offset-sm_vertical_30">
						@if ($tender->image)
							<a href="{{route('tenders.show', $tender)}}"><img class="tender__image" src="/fit/85/85/{{$tender->image}}" alt=""></a>
						@endif
						<a href="{{route('tenders.show', $tender)}}" class="tender__name">{{$tender->name}}</a>
						@if ($tender->company||$tender->company_name)
							<div class="tender__company"><strong>Компания: </strong>
								@if ($tender->company) <a href="{{route('catalog.show',$tender->company)}}">{{$tender->company->name}}</a> 
								@else {{$tender->company_name}}
								@endif
							</div>
						@endif
						<div class="tender__budget"><strong>Бюджет: </strong>{{$tender->budget ? $tender->budget : 'Открыт'}}</div>
						<div class="tender__end"><strong>Крайний срок подачи заявки: </strong>{{$tender->end->format('d.m.Y')}}</div>
						<a href="{{route('tenders.show', $tender)}}" class="tender__more">Читать подробнее</a>
					</div>
				@endforeach

				@include('general.pagenav',['items'=>$tenders])

			</div>
			<div class="container__col-4 container__col-sm-12">
				<a href="{{route('user.tenders.create')}}" class="button button_orange button_huge offset_vertical_55 offset-sm_vertical_30">ДОБАВИТЬ ТЕНДЕР</a>
				@include('general.events.block')
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Тендеры архив 1'])</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.polls.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Тендеры архив 2'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection