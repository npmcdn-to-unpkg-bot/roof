@extends('public.layout')

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('tenders.index')}}" class="breadcrumbs__path">ТЕНДЕРЫ</a>
		<span class="breadcumbs__current">{{$tender->name}}</span>
	</div>
	<div class="container offset_bottom_60">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title  offset_bottom_30">{{$tender->name}}</div>
				<div class="container__row">
					<div class="container__col-6">
						<div class="field field_info">
							<div class="small-title">ИНФОРМАЦИЯ О ТЕНДЕРЕ</div>
							{!!$tender->description!!}
						</div>
					</div>
					<div class="container__col-6">
						<div class="field field_money">Бюджет: {{$tender->budget}}</div>
						<div class="field field_company">Организатор: <a href="{{route('catalog.show',$tender->company)}}">{{$tender->company->name}}</a></div>
						<div class="field field_period">Срок подачи заявок: {{$tender->end->format('d.m.Y')}}</div>
						<div class="field field_type">
							Контакты для подачи заявки:<br>
							@if ($tender->company->user) {{$tender->company->user->name}}<br> @endif
							@if ($tender->company->email) Email: {{$tender->company->email}}<br> @endif
							@if ($tender->company->phone) Телефон: {{$tender->company->phone}} @endif
						</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				@include('public.events.block')
				<div class="offset_vertical_55">@include('public.area.banner',['area' => 'tenders.show.1'])</div>
			</div>
		</div>
	</div>
	@include('public.desk.block')
@endsection