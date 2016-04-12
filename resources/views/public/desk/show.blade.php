@extends('layout')

@section('content')
	<div class="container breadcrumbs">
		<span class="breadcumbs__current">ДОСКА ОБЪЯВЛЕНИЙ</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title">ОБЪЯВЛЕНИЯ</div>
				<form action="" class="jus offset_vertical_20">
					<input type="text" size="65" placeholder="КЛЮЧЕВЫЕ СЛОВА" class="input jus__item">
					<select name="" id="" class="input_select input jus__item">
						<option value="">ВЫБИРИТЕ СТРАНУ</option>
					</select>
					<button class="jus__item button button_search"></button>
				</form>
				<div class="container__row desk-single">
					<div class="container__col-6">
						<img src="/s-img/desk-single.jpg" alt="" class="desk-single__image">
						<div class="title-light">КОНТАКТНАЯ ИНФОРМАЦИЯ</div>
						<div class="desk-single__person">Юрий</div>
						<div class="desk-single__phone">+38 094 893-84-49</div>
						<a href="#" class="desk-single__email">pochta@pochta.com</a>
					</div>
					<div class="container__col-6">
						<div class="desk-single__title">Демонтаж стен, алмазная резка бетона, сверление отверстий, вырезка проемов</div>
						<div class="desk-single__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro quia ratione distinctio quas ad eveniet reprehenderit tempora facilis provident! Maxime, sed, doloribus. Atque vitae natus explicabo illo similique hic repellendus accusamus voluptatibus animi facilis corporis placeat deserunt labore suscipit ullam rem, sit aliquid excepturi eligendi accusantium quibusdam perspiciatis enim. Exercitationem dolor suscipit, ut magnam eius velit qui reprehenderit aut! Amet nostrum facere perferendis culpa voluptas possimus corrupti molestias tempore, sint sit mollitia, totam minima harum ad maxime impedit. Cupiditate odio veniam harum neque delectus in blanditiis, doloribus exercitationem modi similique repellat non voluptas iste, atque dolorum, quibusdam. Error, odit veniam.</div>
						<div class="desk-single__info">№231123   Дата размещения: 21.09.2015</div>
						<div>Специализация: Кровельные материалы</div>
						<a href="" class="desk-single__cat">Услуги</a>
						<span class="desk-single__sep"></span>
						<a href="" class="desk-single__cat">Продажа материалов</a>
						<span class="desk-single__sep"></span>
						<a href="" class="desk-single__cat">Еще одна категория</a>						
					</div>
				</div>
				<div class="container__row offset_vertical_30">
					<div class="container__col-6">
						<a href="" class="desk-top">
							<img src="/s-img/desk-top-1.jpg" alt="" class="desk-top__image">
							<div class="desk-top__text">
								<div class="desk-top__title">ОНДУЛИН ОПТОМ</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel aliquid explicabo, tempora aperiam ratione odit sequi reprehenderit rerum fugiat ea ut sunt praesentium quis, excepturi corrupti corporis quidem, similique dolorem.</p>
							</div>
						</a>
					</div>
					<div class="container__col-6">
						<a href="" class="desk-top">
							<img src="/s-img/desk-top-1.jpg" alt="" class="desk-top__image">
							<div class="desk-top__text">
								<div class="desk-top__title">ОНДУЛИН ОПТОМ</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel aliquid explicabo, tempora aperiam ratione odit sequi reprehenderit rerum fugiat ea ut sunt praesentium quis, excepturi corrupti corporis quidem, similique dolorem.</p>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				<div class="title">КАТЕГОРИИ</div>
				<form class="menu menu_blue menu_medium menu_vertical menu_no_underline menu_rare">
					@foreach (App\DeskCategory::all() as $category)
						<label class="menu__item">
							<input class="input_checkbox" type="checkbox" name="category" value="{{$category->id}}">
							<span></span>
							{{$category->name}}
						</label>
					@endforeach
					<button class="button button_100 button_cyan button_big">ПОКАЗАТЬ</button>
				</form>
				<img src="/s-img/baner-3.jpg" alt="" class="sda offset_vertical_55">
				<img src="/s-img/baner-3.jpg" alt="" class="sda offset_vertical_55">
			</div>
		</div>
	</div>
	<div class="container-fluid container-fluid_light-gray padding_vertical_40">
		<div class="container">
			<div class="title">НОВОСТИ РЫНКА</div>
			<div class="container__row market-news">
				<div class="container__col-4 market-news__item">
					<img src="/s-img/news-2.jpg" alt="" class="market-news__image">
					<div class="market-news__title">Положение кровельного рынка Великобритании</div>
					<div class="market-news__text">Рост кровельного рынка Великобритании оценивается примерно на 4,5 % в 2015 году, после периода низкой производительности со снижением в 2014</div>
				</div>
				<div class="container__col-4 market-news__item">
					<div class="market-news__title">Положение кровельного рынка Великобритании</div>
					<div class="market-news__text">Рост кровельного рынка Великобритании оценивается примерно на 4,5 % в 2015 году, после периода низкой производительности со снижением в 2014</div>
				</div>
				<div class="container__col-4 market-news__item">
					<img src="/s-img/news-2.jpg" alt="" class="market-news__image">
					<div class="market-news__title">Положение кровельного рынка Великобритании</div>
					<div class="market-news__text">Рост кровельного рынка Великобритании оценивается примерно на 4,5 % в 2015 году, после периода низкой производительности со снижением в 2014</div>
				</div>
			</div>
		</div>
	</div>
@endsection