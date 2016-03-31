@extends('layout')

@section('content')
<div class="container offset_vertical_60">
	<div class="container__row">
		<div class="container__col-8">
			<div class="company-cart company-cart_page company-cart_white">
				<img src="/s-img/company.jpg" alt="" class="company-cart__logo">
				<div class="company-cart__name">Компания ФУЧС, ООО</div>
				<div class="company-cart__description">Монтажные работы, кровельные работы, инжиниринг, промышленный альпинизм</div>
				<div class="company-cart__address">Украина, г. Одесса</div>
				<div class="company-cart__post-date">Дата регистрации: 01.01.2001</div>
				<div class="company-cart__right-top">
					<img src="/img/user-menu-1.png" alt="" class="company-cart__member-label">
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
				<div id="description" class="tabs__tab tabs__tab_active"></div>
				<div id="portfolio" class="tabs__tab">
					<div class="container__row offset_vertical_40">
						<div class="container__col-4 building building_small">
							<img src="/s-img/portfolio-1.jpg" alt="" class="building__image">
							<a href="" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
							<span class="building__type">Церковь</span>
							<a href="#" class="building__company">ООО "ЗАРС"</a>
							<span class="building__address">Украина, Киевская обл., г. Бровары</span>
							<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
						</div>
						<div class="container__col-4 building building_small">
							<img src="/s-img/portfolio-1.jpg" alt="" class="building__image">
							<a href="" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
							<span class="building__type">Церковь</span>
							<a href="#" class="building__company">ООО "ЗАРС"</a>
							<span class="building__address">Украина, Киевская обл., г. Бровары</span>
							<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
						</div>
						<div class="container__col-4 building building_small">
							<img src="/s-img/portfolio-1.jpg" alt="" class="building__image">
							<a href="" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
							<span class="building__type">Церковь</span>
							<a href="#" class="building__company">ООО "ЗАРС"</a>
							<span class="building__address">Украина, Киевская обл., г. Бровары</span>
							<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
						</div>
					</div>
					<div class="container__row offset_vertical_40">
						<div class="container__col-4 building building_small">
							<img src="/s-img/portfolio-1.jpg" alt="" class="building__image">
							<a href="" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
							<span class="building__type">Церковь</span>
							<a href="#" class="building__company">ООО "ЗАРС"</a>
							<span class="building__address">Украина, Киевская обл., г. Бровары</span>
							<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
						</div>
						<div class="container__col-4 building building_small">
							<img src="/s-img/portfolio-1.jpg" alt="" class="building__image">
							<a href="" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
							<span class="building__type">Церковь</span>
							<a href="#" class="building__company">ООО "ЗАРС"</a>
							<span class="building__address">Украина, Киевская обл., г. Бровары</span>
							<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
						</div>
					</div>
				</div>
				<div id="services" class="tabs__tab">
					<div class="company-service offset_vertical_30">
						<div class="company-service__title">Кровля. Монтаж и ремонт скатных крыш.</div>
						<p>Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года.</p>
					</div>
					<div class="company-service offset_vertical_30">
						<div class="company-service__title">Кровля. Монтаж и ремонт скатных крыш.</div>
						<p>Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года.</p>
					</div>
					<div class="company-service offset_vertical_30">
						<div class="company-service__title">Кровля. Монтаж и ремонт скатных крыш.</div>
						<p>Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года.</p>
					</div>
					<div class="company-service offset_vertical_30">
						<div class="company-service__title">Кровля. Монтаж и ремонт скатных крыш.</div>
						<p>Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года. Наша молодая динамично развивающаяся компания представлена на Рынке кровельных услуг Украины с 2001 года.</p>
					</div>
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
						<div class="company-sale__item">
							<img src="/s-img/akcii-1.jpg" alt="" class="company-sale__image">
							<div class="company-sale__text">
								<div class="company-sale__title">Заголовок акции</div>
								<p>Теперь у вас есть удивительная озможность стать не только зрителем, но и непосредственным Теперь у вас есть удивительная озможность стать не только зрителем, но и непосредственным участником.  но и непосредственным Теперь у вас есть </p>
							</div>
						</div>
						<div class="company-sale__item">
							<img src="/s-img/akcii-1.jpg" alt="" class="company-sale__image">
							<div class="company-sale__text">
								<div class="company-sale__title">Заголовок акции</div>
								<p>Теперь у вас есть удивительная озможность стать не только зрителем, но и непосредственным Теперь у вас есть удивительная озможность стать не только зрителем, но и непосредственным участником.  но и непосредственным Теперь у вас есть </p>
							</div>
						</div>
						<div class="company-sale__item">
							<img src="/s-img/akcii-1.jpg" alt="" class="company-sale__image">
							<div class="company-sale__text">
								<div class="company-sale__title">Заголовок акции</div>
								<p>Теперь у вас есть удивительная озможность стать не только зрителем, но и непосредственным Теперь у вас есть удивительная озможность стать не только зрителем, но и непосредственным участником.  но и непосредственным Теперь у вас есть </p>
							</div>
						</div>
						<div class="company-sale__item">
							<img src="/s-img/akcii-1.jpg" alt="" class="company-sale__image">
							<div class="company-sale__text">
								<div class="company-sale__title">Заголовок акции</div>
								<p>Теперь у вас есть удивительная озможность стать не только зрителем, но и непосредственным Теперь у вас есть удивительная озможность стать не только зрителем, но и непосредственным участником.  но и непосредственным Теперь у вас есть </p>
							</div>
						</div>
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
							<input type="radio" class="rate-form__star rate-form__star_placeholder" checked name="rate">
							<input type="radio" class="rate-form__star" value="2" name="rate">
							<input type="radio" class="rate-form__star" value="3" name="rate">
							<input type="radio" class="rate-form__star" value="4" name="rate">
							<input type="radio" class="rate-form__star" value="5" name="rate">
							<input type="radio" class="rate-form__star" value="6" name="rate">
							<input type="radio" class="rate-form__star" value="7" name="rate">
							<input type="radio" class="rate-form__star" value="8" name="rate">
							<input type="radio" class="rate-form__star" value="9" name="rate">
							<input type="radio" class="rate-form__star" value="10" name="rate">
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
			<img src="/s-img/baner-2.jpg" alt="" class="sda offset_vertical_60">
			<div class="company-blog offset_vertical_60">
				<div class="title">БЛОГ КОМПАНИИ</div>
				<div class="company-blog__item">
					<a href="" class="company-blog__title">ЗАГОЛОВОК ЗАПИСИ</a>
					<p>Теперь у вас есть удивительная возможность стать не только зрителем, но и непосредственным участником этого волшебного действия.  стать не только зрителем, но и непосредственным участником этого волшебного действия.</p>
				</div>
				<div class="company-blog__item">
					<a href="" class="company-blog__title">ЗАГОЛОВОК ЗАПИСИ</a>
					<p>Теперь у вас есть удивительная возможность стать не только зрителем, но и непосредственным участником этого волшебного действия.  стать не только зрителем, но и непосредственным участником этого волшебного действия.</p>
				</div>
				<div class="company-blog__item">
					<a href="" class="company-blog__title">ЗАГОЛОВОК ЗАПИСИ</a>
					<p>Теперь у вас есть удивительная возможность стать не только зрителем, но и непосредственным участником этого волшебного действия.  стать не только зрителем, но и непосредственным участником этого волшебного действия.</p>
				</div>
			</div>
		</div>
	</div>
</div>

@include('public.catalog.association')

@endsection