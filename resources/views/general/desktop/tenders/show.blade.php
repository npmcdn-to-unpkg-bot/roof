@extends('general.desktop.layout')

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
						<div class="field field_company">Организатор: 
							@if ($tender->company) <a href="{{route('catalog.show',$tender->company)}}">{{$tender->company->name}}</a> 
							@else {{$tender->company_name}}
							@endif
						</div>
						<div class="field field_period">Срок подачи заявок: {{$tender->end->format('d.m.Y')}}</div>
						<div class="field field_type">
							Контакты для подачи заявки:<br>
							@if ($tender->person) {{$tender->person}}<br> @endif
							@if ($tender->email) Email: {{$tender->email}}<br> @endif
							@if ($tender->phone) Телефон: {{$tender->phone}} @endif
						</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				@include('general.desktop.events.block')
				<div class="offset_vertical_55">@include('general.desktop.area.banner',['area' => 'Тендеры запись 1'])</div>
			</div>
		</div>
	</div>
	@include('general.desktop.desk.block')
@endsection