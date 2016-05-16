@extends('general.desktop.layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">ОПРОСЫ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				@include('general.desktop.polls.block')

				<div class="title offset_vertical_30">АРХИВ ОПРОСОВ</div>
				@foreach ($polls as $poll)
					<div class="poll offset_vertical_30">
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

				@include('general.desktop.pagenav',['items'=>$polls])

			</div>
			<div class="container__col-4">
				@include('general.desktop.area.banner',['area' => 'Опросы архив 1'])
				<div class="offset_vertical_55">@include('general.desktop.news.block')</div>
				<div class="offset_vertical_55">@include('general.desktop.events.block')</div>
			</div>
		</div>
	</div>
	@include('general.desktop.desk.block')
@endsection