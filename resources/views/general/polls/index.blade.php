@extends(Agent::isMobile() ? 'general.mobile.layout' : 'general.desktop.layout')

@section('title')Опросы@endsection

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">ОПРОСЫ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8 container__col-sm-12">
				@include('general.polls.block')

				<div class="title offset_vertical_30 offset-sm_vertical_30">АРХИВ ОПРОСОВ</div>
				@foreach ($polls as $poll)
					<div class="poll offset_vertical_30 offset-sm_vertical_30">
						<div class="poll__question">{{ $poll->question }}</div>
						<div class="poll__created-at">{{$poll->created_at->format('d.m.Y')}}</div>
						<div class="poll__more">
							@foreach ($poll->votes as $vote)
								<div class="question__label">
									{{$vote->answer}}
									<div class="progress" style="width: 370px;">
										<div class="progress__bar" style="width: {{$vote->progress()}}%">
											{{$vote->progress()}}% ({{$vote->count()}})
										</div>
										{{$vote->progress()}}% ({{$vote->count()}})
									</div>
								</div>
							@endforeach
						</div>
					</div>
				@endforeach

				@include('general.pagenav',['items'=>$polls])

			</div>
			<div class="container__col-4 container__col-sm-12">
				@include('general.area.banner',['area' => 'Опросы архив 1'])
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.news.block')</div>
				<div class="offset_vertical_55 offset-sm_vertical_30">@include('general.events.block')</div>
			</div>
		</div>
	</div>
	@include('general.desk.block')
@endsection