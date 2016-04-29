@extends('public.layout')

@section('content')
<div class="container offset_vertical_60">
	<div class="container__row">
		<div class="container__col-8">
			<div class="company-cart clearfix company-cart_page company-cart_white">
				<img src="/fit/160/140/{{$company->logo}}" alt="" class="company-cart__logo">
				<div class="company-cart__name">{{$company->name}}</div>
				<div class="company-cart__description">{{$company->entry}}</div>
				<div class="company-cart__address">{{$company->printAddress()}}</div>
				<div class="company-cart__post-date">Дата регистрации: {{$company->created_at->format('d.m.Y')}}</div>
				<div class="company-cart__right-top">
					@if ($company->association) <img src="/img/user-menu-1.png" alt="" class="company-cart__member-label"> @endif
					<div class="company-cart__rating">
						рейтинг <div class="company-cart__rating_value">9.8</div>
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
					@foreach ($company->buildings as $i => $building)
						@if ($i%3==0)<div class="container__row offset_vertical_40"> @endif
							<div class="container__col-4 building">
								<img src="/s-img/portfolio-1.jpg" alt="" class="building__image">
								<a href="" class="building__name">{{$building->name}}</a>
								<span class="field field_small field_type">{{$building->type}}</span>
								<span class="field field_small field_address">{{$building->printAddress()}}</span>
								<span class="field field_small field_period">{{$building->calendar()}}</span>
						@if ($i%3==2||$i==count($company->buildings)) </div> @endif
						</div>
					@endforeach
				</div>
				<div id="services" class="tabs__tab">
					{{$company->services}}
				</div>
				<div id="prices" class="tabs__tab">
					<a href="" class="file-link">
						<img src="/img/zip.png" alt="" class="file-link__image"> Название прайса может быть довольно длинным или даже очень длинным. Или же очень-очень длинным
					</a>
					<a href="" class="file-link">
						<img src="/img/pdf.png" alt="" class="file-link__image"> Название прайса может быть довольно длинным или даже очень длинным. Или же очень-очень длинным
					</a>
					<a href="" class="file-link">
						<img src="/img/doc.png" alt="" class="file-link__image"> Название прайса может быть довольно длинным или даже очень длинным. Или же очень-очень длинным
					</a>
					<a href="" class="file-link">
						<img src="/img/zip.png" alt="" class="file-link__image"> Название прайса может быть довольно длинным или даже очень длинным. Или же очень-очень длинным
					</a>
					<a href="" class="file-link">
						<img src="/img/zip.png" alt="" class="file-link__image"> Название прайса может быть довольно длинным или даже очень длинным. Или же очень-очень длинным
					</a>
					<a href="" class="file-link">
						<img src="/img/zip.png" alt="" class="file-link__image"> Название прайса может быть довольно длинным или даже очень длинным. Или же очень-очень длинным
					</a>
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
				<div class="reviews__post">
					<img src="/s-img/reviews-1.jpg" alt="" class="reviews__image">
					<div class="reviews__text">
						Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года.
					</div>
					<div class="reviews__rate">Оценка: <span class="reviews__rate-value">7 баллов</span></div>
				</div>
				<div class="reviews__post">
					<img src="/s-img/reviews-1.jpg" alt="" class="reviews__image">
					<div class="reviews__text">
						Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года.
					</div>
					<div class="reviews__rate">Оценка: <span class="reviews__rate-value">7 баллов</span></div>
					<div class="comment">
						<img src="/s-img/comment-1.jpg" alt="" class="comment__image">
						<div class="comment__text">Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. </div>
					</div>
				</div>
				<div class="reviews__post">
					<img src="/s-img/reviews-1.jpg" alt="" class="reviews__image">
					<div class="reviews__text">
						Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года.
					</div>
					<div class="reviews__rate">Оценка: <span class="reviews__rate-value">7 баллов</span></div>
				</div>
				<div class="reviews__post">
					<img src="/s-img/reviews-1.jpg" alt="" class="reviews__image">
					<div class="reviews__text">
						Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года.
					</div>
					<div class="reviews__rate">Оценка: <span class="reviews__rate-value">7 баллов</span></div>
				</div>
				<form action="" class="reviews-form">
					<textarea name="" resize="none" id="" placeholder="Оставить отзыв о компании" class="reviews-form__text"></textarea>
					<button class="button button_big button_blue reviews-form__submit">ОТПРАВИТЬ</button>
					<div class="reviews-form__rate">Оценка компании: 
						<div class="rate-form">
							<input type="radio" class="rate-form__radio" checked name="rate">
							@for ($i=1;$i<=10;$i++)
								<label for="rate-form__{{ $i }}" class="rate-form__star"></label>
								<input type="radio" id="rate-form__{{ $i }}" class="rate-form__radio" value="{{ $i }}" name="rate">
							@endfor
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="container__col-4">
			<div class="staff">
				<div class="title">СОТРУДНИКИ</div>
				<div>
					<div class="staff__item">
						<img src="/s-img/staff-1.jpg" alt="" class="staff__image">
						<div class="staff__name">Константин <br> Константинов</div>
						<div class="staff__job">Руководитель отдела продаж</div>
					</div>
				</div>
				<div>
					<div class="staff__item">
						<img src="/s-img/staff-1.jpg" alt="" class="staff__image">
						<div class="staff__name">Константин <br> Константинов</div>
						<div class="staff__job">Руководитель отдела продаж</div>
					</div>
				</div>
				<div>
					<div class="staff__item">
						<img src="/s-img/staff-1.jpg" alt="" class="staff__image">
						<div class="staff__name">Константин <br> Константинов</div>
						<div class="staff__job">Руководитель отдела продаж</div>
					</div>
				</div>
			</div>
			<div class="offset_vertical_55">
				@include('public.area.banner',['area' => 'catalog.show.1'])
			</div>
			<div class="company-blog offset_vertical_60">
				<div class="title">БЛОГ КОМПАНИИ</div>
				@foreach ($company->articles as $article)
					<div class="company-blog__item">
						<a href="" class="company-blog__title">{{$article->title}}</a>
						<p>{{$article->entry}}</p>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@include('public.catalog.association')

@endsection