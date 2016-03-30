@extends('layout')

@section('content')
	<div class="container offset_vertical_40 page-tabs">
		<div>
			<a href="#specialisations" class="page-tabs__nav page-tabs__nav_active">СПЕЦИАЛИЗАЦИЯ</a>
			<span class="page-tabs__separator"></span>
			<a href="#propositions" class="page-tabs__nav">ТИП ПРЕДЛОЖЕНИЯ</a>
		</div>
		<div id="specialisations" class="page-tabs__tab page-tabs__tab_active container__row offset_vertical_20 taxonomy">
			@foreach ($specialisations as $i => $specialisation)
				@if ($i%5==0) <div class="container__col-4"> @endif
					<a href="#" class="taxonomy__item">{{ $specialisation->name }} 
						<span class="taxonomy__count">({{ $specialisation->companies->count() }})</span>
					</a>
				@if ($i+1==count($specialisations)||$i%5==4) </div> @endif
			@endforeach
		</div>
		<div id="propositions" class="page-tabs__tab container__row offset_vertical_20 taxonomy">
			@foreach ($propositions as $i => $proposition)
				@if ($i%5==0) <div class="container__col-4"> @endif
					<a href="#" class="taxonomy__item">{{ $proposition->name }} 
						<span class="taxonomy__count">({{ $proposition->companies->count() }})</span>
					</a>
				@if ($i+1==count($propositions)||$i%5==4) </div> @endif
			@endforeach
		</div>		
	</div>
	@include('public.catalog.association')
	<div class="page-nav container">
		<a href="#" class="page-nav__item">A</a><a href="#" class="page-nav__item">B</a><a href="#" class="page-nav__item">C</a><a href="#" class="page-nav__item">D</a><a href="#" class="page-nav__item">E</a><a href="#" class="page-nav__item">F</a><a href="#" class="page-nav__item">G</a><a href="#" class="page-nav__item">H</a><a href="#" class="page-nav__item">I</a><a href="#" class="page-nav__item">J</a><a href="#" class="page-nav__item">K</a><a href="#" class="page-nav__item">L</a><a href="#" class="page-nav__item">M</a><a href="#" class="page-nav__item">N</a><a href="#" class="page-nav__item">O</a><a href="#" class="page-nav__item">P</a><a href="#" class="page-nav__item">Q</a><a href="#" class="page-nav__item">R</a><a href="#" class="page-nav__item">S</a><a href="#" class="page-nav__item">T</a><a href="#" class="page-nav__item">U</a><a href="#" class="page-nav__item">V</a><a href="#" class="page-nav__item">W</a><a href="#" class="page-nav__item">X</a><a href="#" class="page-nav__item">Y</a><a href="#" class="page-nav__item">Z</a>
		<br>
		<a href="#" class="page-nav__item">А</a><a href="#" class="page-nav__item">Б</a><a href="#" class="page-nav__item">В</a><a href="#" class="page-nav__item">Г</a><a href="#" class="page-nav__item">Д</a><a href="#" class="page-nav__item">Е</a><a href="#" class="page-nav__item">Ё</a><a href="#" class="page-nav__item">Ж</a><a href="#" class="page-nav__item">З</a><a href="#" class="page-nav__item">И</a><a href="#" class="page-nav__item">Й</a><a href="#" class="page-nav__item">К</a><a href="#" class="page-nav__item">Л</a><a href="#" class="page-nav__item">М</a><a href="#" class="page-nav__item">Н</a><a href="#" class="page-nav__item">О</a><a href="#" class="page-nav__item">П</a><a href="#" class="page-nav__item">Р</a><a href="#" class="page-nav__item">С</a><a href="#" class="page-nav__item">Т</a><a href="#" class="page-nav__item">У</a><a href="#" class="page-nav__item">Ф</a><a href="#" class="page-nav__item">Х</a><a href="#" class="page-nav__item">Ц</a><a href="#" class="page-nav__item">Ч</a><a href="#" class="page-nav__item">Ш</a><a href="#" class="page-nav__item">Щ</a><a href="#" class="page-nav__item">Э</a><a href="#" class="page-nav__item">Ю</a><a href="#" class="page-nav__item">Я</a>
		<br>
		<a href="#" class="page-nav__item">1</a><a href="#" class="page-nav__item">2</a><a href="#" class="page-nav__item">3</a><a href="#" class="page-nav__item">4</a><a href="#" class="page-nav__item">5</a><a href="#" class="page-nav__item">6</a><a href="#" class="page-nav__item">7</a><a href="#" class="page-nav__item">8</a><a href="#" class="page-nav__item">9</a><a href="#" class="page-nav__item">0</a>
	</div>
	<div class="container text_center">
		<form action="">
			<input type="text" placeholder="КЛЮЧИВОЕ СЛОВО" size="40" class="input">
			<button class="button button_search"></button>
		</form>
	</div>
	<div class="container offset_vertical_55">
		<div class="container__row">
			<div class="container__col-8">
				@foreach ($companies as $i=>$company)
					@if ($i%2==0) <div class="container__row {{ $i!==0?'offset_vertical_55':''}}"> @endif
						<div class="container__col-6">
							<div class="company-cart company-cart_heihgt_220 company-cart_gray">
								<img src="/imagecache/small/{{$company->logo}}" alt="" class="company-cart__logo">
								<div class="company-cart__name">{{$company->name}}</div>
								<div class="company-cart__description">{{$company->entry}}</div>
								<div class="company-cart__left-bottom company-cart__left-bottom_20">
									<div class="company-cart__adress">{{$company->adress}}</div>
									<div class="company-cart__post-date">Дата регистрации: 01.01.2001</div>
								</div>
								@if ($company->association) <img src="img/user-menu-1.png" alt="" class="company-cart__member-label company-cart__right-top">
								@elseif ($company->privat) <img src="img/privat.png" alt="" class="company-cart__right-top"> @endif
								<div class="company-cart__right-bottom company-cart__rating">
									рейтинг
									<div class="company-cart__rating_value">9.8</div>
								</div>
							</div>
						</div>
					@if ($i+1==count($companies)||$i%2==1) </div> @endif
					@if ($i==5) <img src="s-img/baner-1.jpg" alt="" class="sda offset_vertical_55"> @endif
				@endforeach
				<div class="page-nav offset_vertical_55">
					<a href="#" class="page-nav__item"><</a>
					<a href="#" class="page-nav__item">1</a>
					<a href="#" class="page-nav__item">2</a>
					<a href="#" class="page-nav__item">3</a>
					<a href="#" class="page-nav__item page-nav__item_active">4</a>
					<a href="#" class="page-nav__item">5</a>
					<a href="#" class="page-nav__item">></a>
				</div>
				<div class="container__row offset_vertical_55">
					<div class="container__col-6">
						<div class="sale" style="background-image: url(s-img/sale-1.jpg);">
							<div class="sale__text">
							Скидки на дикий камень в магазине “Застройщик”
							</div>
							<a href="#" class="sale__button button button_big button_peach">ПОДРОБНЕЕ</a>
						</div>
					</div>
					<div class="container__col-6">
						<div class="sale sale_half-height" style="background-image: url(s-img/sale-2.jpg);">
							<div class="sale__text">
							Самые низкие цены на кирпичи
							</div>
							<a href="#" class="sale__button button button_medium button_peach">ПОДРОБНЕЕ</a>
						</div>
						<div class="sale sale_half-height" style="background-image: url(s-img/sale-3.jpg);">
							<div class="sale__text">
							Кирпичи оптом со скидкой
							</div>
							<a href="#" class="sale__button button button_medium button_peach">ПОДРОБНЕЕ</a>
						</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				<a href="#" class="button button_orange button_huge">ДОБАВИТЬ КОМПАНИЮ</a>
				<img src="s-img/baner-2.jpg" alt="" class="offset_vertical_55 sda">
				<div class="forum-message offset_vertical_55">
					<div class="title">ПОСЛЕДНЕЕ НА ФОРУМЕ</div>
					<div class="forum-message__item">
						<img src="img/no-name-user.jpg" alt="" class="forum-message__avatar">
						<a href="#" class="forum-message__name">good_times</a><span class="forum-message_post-date">5 мин. назад</span>
						<div class="forum-message__text">Как строить стропильную крышу?</div>
						<a href="#" class="forum-message__theme">ВОПРОСЫ</a>
					</div>
					<div class="forum-message__item">
						<img src="s-img/user-1.jpg" alt="" class="forum-message__avatar">
						<a href="#" class="forum-message__name">preZident</a><span class="forum-message_post-date">6 мин. назад</span>
						<div class="forum-message__text">Ребята, какой вариант крыши тут можно придумать?</div>
						<a href="#" class="forum-message__theme">Необычные архитектурные формы крыш</a>
					</div>
					<div class="forum-message__item">
						<img src="img/no-name-user.jpg" alt="" class="forum-message__avatar">
						<a href="#" class="forum-message__name">Smitters</a><span class="forum-message_post-date">9 мин. назад</span>
						<div class="forum-message__text">Я бы увеличил сечение конькового прогона</div>
						<a href="#" class="forum-message__theme">СОВЕТЫ</a>
					</div>
					<div class="forum-message__item">
						<img src="s-img/user-2.jpg" alt="" class="forum-message__avatar">
						<a href="#" class="forum-message__name">Barbos</a><span class="forum-message_post-date">11 мин. назад</span>
						<div class="forum-message__text">Интересует диагностика кровли</div>
						<a href="#" class="forum-message__theme">Диагностика кровли. Стоимость.</a>
					</div>
					<div class="forum-message__item">
						<img src="img/no-name-user.jpg" alt="" class="forum-message__avatar">
						<a href="#" class="forum-message__name">malfoy</a><span class="forum-message_post-date">20 мин. назад</span>
						<div class="forum-message__text">Здравствуйте! Коллеги, подскажите, пожалуйста, каким образом мне решить мою проблему. Фото крыши прилагаю. Заранее благодарен всем за ответы.</div>
						<a href="#" class="forum-message__theme">Нужна помощь</a>
					</div>
				</div>
				<div class="calendar offset_vertical_55">
					<div class="calendar__title">
						КАЛЕНАДРЬ
						<span class="calendar__month">&lt; АПРЕЛЬ 2015 &gt;</span>
					</div>
					<table class="calendar__table">
						<tbody><tr>
							<td></td><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td>
						</tr>
						<tr>
							<td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td class="calendar__date_active">10</td><td>11</td>
						</tr>
						<tr>
							<td>12</td><td>13</td><td>14</td><td class="calendar__date_active">15</td><td>16</td><td>17</td><td>18</td>
						</tr>
						<tr>
							<td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td class="calendar__date_active">24</td><td>25</td>
						</tr>
						<tr>
							<td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td></td><td></td>
						</tr>
					</tbody></table>
				</div>
				<form class="question offset_vertical_55">
					<div class="title">ПОСЛЕДНИЙ ОПРОС</div>
					<div class="question__text">Какие зарубежные новинки "кровельной" моды могут стать популярными в нашей стране в ближайшем сезоне?</div>
					<label class="question__label">
						<input type="radio" name="question" checked="" class="question__option"><span class="question__radio"></span>Сланцевые кровли
					</label>
					<label class="question__label">
						<input type="radio" name="question" class="question__option"><span class="question__radio"></span>Соломенные кровли
					</label>
					<label class="question__label">
						<input type="radio" name="question" class="question__option"><span class="question__radio"></span>Цветная керамическая черепица
					</label>
					<a href="" class="question__all">Смотреть все опросы</a>
					<button class="question__button button button_blue button_big">ГОЛОСОВАТЬ</button>
				</form>
			</div>
		</div>
	</div>
	<div class="container-fluid container-fluid_light-gray padding_vertical_60">
		<div class="container">
			<div class="title">ДОСКА ОБЪЯВЛЕНИЙ</div>
			<div class="container__row">
				<a href="" class="container__col-2 objavlenie">
					<img src="s-img/obyavlenie-1.jpg" alt="" class="objavlenie__image">
					<span class="objavlenie__text">Набор инструментов</span>
					<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
				</a>
				<a href="" class="container__col-2 objavlenie">
					<img src="s-img/obyavlenie-2.jpg" alt="" class="objavlenie__image">
					<span class="objavlenie__text">Набор инструментов</span>
					<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
				</a>
				<a href="" class="container__col-2 objavlenie">
					<img src="s-img/obyavlenie-3.jpg" alt="" class="objavlenie__image">
					<span class="objavlenie__text">Набор инструментов</span>
					<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
				</a>
				<a href="" class="container__col-2 objavlenie">
					<img src="s-img/obyavlenie-4.jpg" alt="" class="objavlenie__image">
					<span class="objavlenie__text">Набор инструментов</span>
					<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
				</a>
				<a href="" class="container__col-2 objavlenie">
					<img src="s-img/obyavlenie-5.jpg" alt="" class="objavlenie__image">
					<span class="objavlenie__text">Набор инструментов</span>
					<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
				</a>
				<a href="" class="container__col-2 objavlenie">
					<img src="s-img/obyavlenie-6.jpg" alt="" class="objavlenie__image">
					<span class="objavlenie__text">Набор инструментов</span>
					<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
				</a>
			</div>
		</div>
	</div>
@endsection