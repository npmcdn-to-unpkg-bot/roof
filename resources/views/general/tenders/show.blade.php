@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title'){{ $tender->name }}@endsection

@section('description'){{ str_limit(strip_tags($tender->description),150) }}@endsection

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('tenders.index')}}" class="breadcrumbs__path">ТЕНДЕРЫ</a>
		<span class="breadcumbs__current">{{$tender->name}}</span>
	</div>
	<div class="container offset_bottom_60">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				<div class="title  offset_bottom_30">{{$tender->name}}</div>
				<div class="container__row offset-sm_vertical_30">
					<div class="container__col-6 container__col-sm-12">
						<div class="field field_info">
							<div class="small-title">ИНФОРМАЦИЯ О ТЕНДЕРЕ</div>
							{!!$tender->description!!}
						</div>
					</div>
					<div class="container__col-6 container__col-sm-12">
						<div class="field field_money">Бюджет: {{$tender->budget}}</div>
						@if ($tender->company||$tender->company_name)
							<div class="field field_company">Организатор: 
								@if ($tender->company) <a href="{{route('catalog.show',$tender->company)}}">{{$tender->company->name}}</a> 
								@else {{$tender->company_name}}
								@endif
							</div>
						@endif
						<div class="field field_period">Срок подачи заявок: {{$tender->end->format('d.m.Y')}}</div>
						<div class="field field_type">
							Контакты для подачи заявки:<br>
							@if ($tender->person) {{$tender->person}}<br> @endif
							@if ($tender->email) Email: {{$tender->email}}<br> @endif
							@if ($tender->phone) Телефон: {{$tender->phone}} @endif
						</div>
						<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
						<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
						<div class="ya-share2" data-services="facebook,gplus,twitter" data-counter=""></div>
					</div>
				</div>
			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.events.block')
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.area.banner',['area' => 'Тендеры запись 1'])</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection