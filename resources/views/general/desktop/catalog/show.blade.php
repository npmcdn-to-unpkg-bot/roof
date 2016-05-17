@extends('general.desktop.layout')

@section('content')
<div class="container offset_vertical_60">
	<div class="container__row">
		<div class="container__col-8">
			<div class="company-cart clearfix company-cart_page company-cart_white">
				<img src="/resize/160/140/{{$company->logo}}" alt="" class="company-cart__logo">
				<div class="company-cart__name">{{$company->name}}</div>
				<div class="company-cart__description">{{$company->entry}}</div>
				<div class="container__row">
					<div class="container__col-8">
						<div class="company-cart__address">{{$company->printAddress()}}</div>
						<div class="company-cart__post-date">Дата регистрации: {{$company->created_at->format('d.m.Y')}}</div>
					</div>
					<div class="container__col-4">{{$company->phone}}</div>
				</div>
				<div class="company-cart__right-top">
					@if ($company->association) <img src="/img/user-menu-1.png" alt="" class="company-cart__member-label"> @endif
					<div class="company-cart__rating">
						рейтинг <div class="company-cart__rating_value">{{$company->rating}}</div>
					</div>			
				</div>
			</div>
			<div class="tabs">
				<div class="jus offset_vertical_20">
					<a href="#description" class="jus__item tabs__nav tabs__nav_active">О КОМПАНИИ</a>
					<a href="#portfolio" class="jus__item tabs__nav">ПОРТФОЛИО</a>
					<a href="#services" class="jus__item tabs__nav">УСЛУГИ</a>
					<a href="#prices" class="jus__item tabs__nav">ПРАЙСЫ</a>
					<a href="#sales" class="jus__item tabs__nav">АКЦИИ</a>
				</div>
				<div id="description" class="tabs__tab tabs__tab_active">
					{!!$company->about!!}
				</div>
				<div id="portfolio" class="tabs__tab">
					@foreach ($company->examples as $i => $example)
						@if ($i%3==0)<div class="container__row offset_vertical_40"> @endif
							<a href="/example/{{$example->id}}" class="container__col-4 building fancybox">
								<img src="/fit/240/145/{{$example->image}}" alt="" class="building__image">
								<div class="building__name">{{$example->title}}</div>
							</a>
						@if ($i%3==2||$i+1==count($company->examples)) </div> @endif
					@endforeach
				</div>
				<div id="services" class="tabs__tab">
					{!!$company->services!!}
				</div>
				<div id="prices" class="tabs__tab">
					@foreach($company->prices as $price)
					<a href="/price/{{$price->name}}" class="file-link">
						<img src="/img/{{$price->type}}.png" alt="" class="file-link__image">
						{{$price->title}}
					</a>
					@endforeach
				</div>
				<div id="sales" class="tabs__tab">
					<div class="company-sale">
						@foreach ($company->sales as $sale)
							<div class="company-sale__item">
								<img src="/fit/120/85/{{$sale->image}}" alt="" class="company-sale__image">
								<div class="company-sale__text">
									<a href="{{route('sales.show',$sale)}}" class="company-sale__title">{{$sale->title}}</a>
									<p>{{$sale->entry}}</p>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="reviews">
				<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
				<div class="title">ОТЗЫВЫ</div>
				@foreach ($company->comments as $review)
					<div class="reviews__post">
						<img src="/fit/85/85/{{$review->user->image?$review->user->image:'person.png'}}" alt="" class="reviews__image">
						<div class="reviews__text">{{$review->text}}</div>
						<div class="reviews__rate">Оценка: <span class="reviews__rate-value">{!!$review->printRating()!!}</span></div>
					</div>
					<!-- <div class="comment">
						<img src="/s-img/comment-1.jpg" alt="" class="comment__image">
						<div class="comment__text">Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. </div>
					</div> -->
				@endforeach
				<form action="{{route('comment.store')}}" class="reviews-form" method="POST">
					{!! csrf_field() !!}
					<input type="hidden" name="company_id" value="{{$company->id}}">
					<textarea name="text" resize="none" placeholder="Оставить отзыв о компании" class="reviews-form__text">{{old('text')}}</textarea>
					@if ($errors->first('text'))<div class="error">{{ $errors->first('text') }}</div>@endif
					<button class="button button_big button_blue reviews-form__submit">ОТПРАВИТЬ</button>
					<div class="reviews-form__rate">Оценка компании: 
						<div class="rate-form">
							<input type="radio" class="rate-form__radio" {{old('rating')!=0?'':'checked'}} name="rating" value="0">
							@for ($i=1;$i<=10;$i++)
								<label for="rate-form__{{ $i }}" class="rate-form__star"></label>
								<input {{old('rating')==$i?'checked':''}} type="radio" id="rate-form__{{ $i }}" class="rate-form__radio" value="{{ $i }}" name="rating">
							@endfor
						</div>
					</div>
					@if ($errors->first('rating'))<div class="error">{{ $errors->first('rating') }}</div>@endif
				</form>
			</div>
		</div>
		<div class="container__col-4">
			@if ($company->members->first())
				<div class="staff offset_bottom_60">
					<div class="title">СОТРУДНИКИ</div>
					@foreach ($company->members as $member)
						<div>
							<div class="staff__item">
								<img src="/fit/120/120/{{$member->image?$member->image:'person.png'}}" alt="" class="staff__image">
								<div class="staff__name">{{$member->name}}</div>
								<div class="staff__job">{{$member->job}}</div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
			<div class="offset_bottom_60">
				@include('general.desktop.area.banner',['area' => 'Каталог запись 1'])
			</div>
			@if ($company->posts->first())
				<div class="company-blog offset_bottom_60">
					<div class="title">БЛОГ КОМПАНИИ</div>
					@foreach ($company->posts as $post)
						<div class="company-blog__item">
							<a href="" class="company-blog__title">{{$post->title}}</a>
							<p>{{$post->entry}}</p>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>

@include('general.desktop.catalog.association')

@endsection