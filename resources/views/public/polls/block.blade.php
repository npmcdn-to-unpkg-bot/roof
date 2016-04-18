<?php $poll = App\Poll::with('votes')->first() ?>
@if ($poll)
	<div class="question">
		<div class="title">ПОСЛЕДНИЙ ОПРОС</div>
		<div class="question__text">{{ $poll->question }}</div>
		@if ( Auth::user()->hasPoll($poll) )
				@foreach ($poll->votes as $vote)
					<div class="question__label">
						<div class="progress">
							<div class="progress__bar" style="width: {{$vote->progress()}}%">
								{{$vote->progress()}}%
							</div>
							{{$vote->progress()}}%
						</div>
						{{$vote->answer}}
					</div>
				@endforeach
				<a href="" class="question__all">Смотреть все опросы</a>
		@else
			<form action="/vote" method="POST">
			    {!! csrf_field() !!}
				@foreach ($poll->votes as $vote)
					<label class="question__label">
						<input type="radio" name="vote" value="{{$vote->id}}" class="question__option"><span class="question__radio"></span>{{$vote->answer}}
					</label>
				@endforeach
				<a href="" class="question__all">Смотреть все опросы</a>
				<button class="question__button button button_blue button_big">ГОЛОСОВАТЬ</button>
			</form>
		@endif
	</div>
@endif