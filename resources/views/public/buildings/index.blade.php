@extends('layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">СТРОЙКИ И ВАКАНСИИ</span>
	</div>
	<div class="container buildings-map">
		<div class="buildings-map__control">
			<div class="page-tabs">
				<span class="page-tabs__nav page-tabs__nav_active">АКТИВНЫЕ СТРОЙКИ</span>
				<span class="page-tabs__separator"></span>
				<a href="#" class="page-tabs__nav">ВАКАНСИИ</a>
			</div>
			<a href="#" class="buildings-map__hide">Скрыть карту</a>
		</div>
		<div class="buildings-map__map" id="buildings-map__map"></div>
	</div>
	<div class="container offset_vertical_60">
		<div class="title">ФИЛЬТР ОБЪЕКТОВ</div>
		<form action="" class="offset_vertical_15 jus">
			<select name="" id="" class="input_select input jus__item">
				<option value="">ВЫБЕРИТЕ СТРАНУ</option>
			</select>
			<select name="" id="" class="input_select input jus__item">
				<option value="">ВЫБЕРИТЕ ГОРОД</option>
			</select>
			<select name="" id="" class="input_select input jus__item">
				<option value="">ТИП ОБЪЕКТОВ</option>
			</select>
			<select name="" id="" class="input_select input jus__item">
				<option value="">ВАКАНСИИ ПО СПЕЦИАЛЬНОСТИ</option>
			</select>
			<select name="" id="" class="input_select input jus__item">
				<option value="">СЕЗОННОСТЬ</option>
			</select>
			<button class="jus__item button button_search"></button>
		</form>
	</div>
	<div class="container">
		<div class="container__row offset_vertical_60">
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
		</div>
		<div class="container__row offset_vertical_60">
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
		</div>
		<div class="container__row offset_vertical_60">
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
			<div class="container__col-4 building">
				<img src="s-img/building-1.jpg" alt="" class="building__image">
				<a href="/building/1" class="building__name">ДЕСЯТИННАЯ ЦЕРКОВЬ</a>
				<span class="building__type">Церковь</span>
				<a href="/company/1" class="building__company">ООО "ЗАРС"</a>
				<span class="building__address">Украина, Киевская обл., г. Бровары</span>
				<span class="building__period">I Кв-л 2015 г. — III Кв-л 2016 г.</span>
				<div class="building__title">Вакансии на объекте</div>
				<div class="building__job-list">
					Кровельщик, Монтажник кровельных и фасадных систем, Промышленный альпинист, Разнорабочие на кровлю, Жестянщик-кровельщик
				</div>
			</div>
		</div>
	</div>
	<div class="page-nav offset_vertical_60">
		<a href="#" class="page-nav__item"><</a>
		<a href="#" class="page-nav__item">1</a>
		<a href="#" class="page-nav__item">2</a>
		<a href="#" class="page-nav__item">3</a>
		<a href="#" class="page-nav__item page-nav__item_active">4</a>
		<a href="#" class="page-nav__item">5</a>
		<a href="#" class="page-nav__item">></a>
	</div>
	<div class="container-fluid container-fluid_light-gray padding_vertical_40">
		<div class="container">
			<div class="title">НОВОСТИ РЫНКА</div>
			<div class="container__row market-news">
				<div class="container__col-4 market-news__item">
					<img src="s-img/news-2.jpg" alt="" class="market-news__image">
					<div class="market-news__title">Положение кровельного рынка Великобритании</div>
					<div class="market-news__text">Рост кровельного рынка Великобритании оценивается примерно на 4,5 % в 2015 году, после периода низкой производительности со снижением в 2014</div>
				</div>
				<div class="container__col-4 market-news__item">
					<div class="market-news__title">Положение кровельного рынка Великобритании</div>
					<div class="market-news__text">Рост кровельного рынка Великобритании оценивается примерно на 4,5 % в 2015 году, после периода низкой производительности со снижением в 2014</div>
				</div>
				<div class="container__col-4 market-news__item">
					<img src="s-img/news-2.jpg" alt="" class="market-news__image">
					<div class="market-news__title">Положение кровельного рынка Великобритании</div>
					<div class="market-news__text">Рост кровельного рынка Великобритании оценивается примерно на 4,5 % в 2015 году, после периода низкой производительности со снижением в 2014</div>
				</div>
			</div>
		</div>
	</div>
@endsection