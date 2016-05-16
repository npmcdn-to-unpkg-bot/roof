@if ($poll)
	<div class="question">
		<div class="title">ПОСЛЕДНИЙ ОПРОС</div>
		<div class="question__text">{{ $poll->question }}</div>
		@if ( Auth::user()&&Auth::user()->hasPoll($poll) )
			@foreach ($poll->votes as $vote)
				<div class="question__label">
					{{$vote->answer}}
					<div class="progress" style="width: 370px; max-width: 100%;">
						<div class="progress__bar" style="width: {{$vote->progress()}}%">
							{{$vote->progress()}}% ({{$vote->count()}})
						</div>
						{{$vote->progress()}}% ({{$vote->count()}})
					</div>
				</div>
			@endforeach
			@if (!Route::is('polls*')) <a href="{{route('polls.index')}}" class="question__all">Смотреть все опросы</a> @endif
		@else
			<form action="/vote" method="POST">
			    {!! csrf_field() !!}
				@foreach ($poll->votes as $vote)
					<label class="question__label">
						<input type="radio" name="vote" value="{{$vote->id}}" class="question__option"><span class="question__radio"></span>{{$vote->answer}}
					</label>
				@endforeach
				@if (!Route::is('polls*')) <a href="{{route('polls.index')}}" class="question__all">Смотреть все опросы</a> @endif
				<button class="question__button button button_blue button_big">ГОЛОСОВАТЬ</button>
			</form>
		@endif
	</div>
@endif