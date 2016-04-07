@extends('layout')

@section('content')
<link rel="stylesheet" href="./temp/roofers.css">

<div class="section">
	<div class="container">

		<div class="page_title">
			Новости рынка
		</div>

		<div class="row">

			<div class="col-md-8">

				<div class="subtitle">Новости рынка</div>
				<div class="news_mod">

					<!-- LOOP -->

					<div class="post_item">
						<div class="row">
							<div class="col-md-2 img_wrap">
								
								<a href="http://roofers.com.ua/single.html">
									<img src="./temp/news_1.png" class="img-responsive">
								</a>

							</div>
							<div class="col-md-10">

								<div class="title">
									<a href="http://roofers.com.ua/single.html">Анализ украинского рынка кровельных материалов</a>
								</div>

								<div class="date">10.02.2016</div>

								<p class="short">
									Наиболее точным определением для современного рынка кровельных материалов Украины является
								</p>

								<p class="more">
									<a href="http://roofers.com.ua/news.html#">Читать подробнее</a>
								</p>

							</div>
						</div>
					</div>

					<div class="post_item">
						<div class="row">
							<div class="col-md-12">

								<div class="title">
									<a href="http://roofers.com.ua/single.html">Кровля Creaton Melodie для утонченных людей</a>
								</div>

								<div class="date">10.02.2016</div>

								<p class="short">
									Любой звук в нужном сочетании превращается в красивую мелодию. Новая модель  Creaton  Melodie в чем то полностью соответствует сочетанию приятных тонов.
								</p>

								<p class="more">
									<a href="http://roofers.com.ua/news.html#">Читать подробнее</a>
								</p>

							</div>
						</div>
					</div>

					<div class="post_item">
						<div class="row">
							<div class="col-md-2 img_wrap">
								
								<a href="http://roofers.com.ua/single.html">
									<img src="./temp/news_2.png" class="img-responsive">
								</a>

							</div>
							<div class="col-md-10">

								<div class="title">
									<a href="http://roofers.com.ua/single.html">Положение кровельного рынка Великобритании</a>
								</div>

								<div class="date">10.02.2016</div>

								<p class="short">									
									Рост кровельного рынка Великобритании оценивается примерно на 4,5 % в 2015 году, после периода низкой производительности со снижением в 2014
								</p>

								<p class="more">
									<a href="http://roofers.com.ua/news.html#">Читать подробнее</a>
								</p>

							</div>
						</div>
					</div>

					<div class="post_item">
						<div class="row">
							<div class="col-md-12">

								<div class="title">
									<a href="http://roofers.com.ua/single.html">Объем рынка металлочерепицы</a>
								</div>

								<div class="date">10.02.2016</div>

								<p class="short">
									Согласно отзывам специалистов, по рыночным объемам металлочерепица в настоящее время занимает лидирующее место среди всех кровельных материалов для скатной кровли.
								</p>

								<p class="more">
									<a href="http://roofers.com.ua/news.html#">Читать подробнее</a>
								</p>

							</div>
						</div>
					</div>

					<!-- LOOP -->
					
				</div>	
				
				<nav class="text-center">
					<ul class="pagination">
						<li>
							<a href="http://roofers.com.ua/news.html#" aria-label="Previous">
								<span aria-hidden="true">«</span>
							</a>
						</li>
						<li class="active"><a href="http://roofers.com.ua/news.html#">1</a></li>
						<li><a href="http://roofers.com.ua/news.html#">2</a></li>
						<li><a href="http://roofers.com.ua/news.html#">3</a></li>
						<li><a href="http://roofers.com.ua/news.html#">4</a></li>
						<li><a href="http://roofers.com.ua/news.html#">5</a></li>
						<li>
							<a href="http://roofers.com.ua/news.html#" aria-label="Next">
								<span aria-hidden="true">»</span>
							</a>
						</li>
					</ul>
				</nav>
				
			</div>

			<div class="col-md-4">
				<div class="calendar_mod">
					<div class="title">
						<div class="row">
							<div class="col-md-6">
								Календарь
							</div>
							<div class="col-md-6 text-right">
								<!-- <span class="btn_2 prev_month"><</span>  -->
								<span id="calendar_title">Март</span> <span id="year_title">2015</span>
								<!-- <span class="btn_2 next_month">></span> -->
							</div>
						</div>
					</div>
					<div class="calendar_grid" id="calendar_grid">
				
						<div class="item"></div>
						<div class="item">1</div>
						<div class="item">2</div>
						<div class="item">3</div>
						<div class="item">4</div>
						<div class="item">5</div>
						<div class="item">6</div>
						<div class="item">7</div>
						<div class="item">8</div>
						<div class="item">9</div>
						<div class="item">10</div>
						<div class="item">11</div>
						<div class="item">12</div>
						<div class="item">13</div>
						<div class="item">14</div>
						<div class="item">15</div>
						<div class="item">16</div>
						<div class="item">17</div>
						<div class="item">18</div>
						<div class="item">19</div>
						<div class="item">20</div>
						<div class="item">21</div>
						<div class="item">22</div>
						<div class="item">23</div>
						<a href="http://roofers.com.ua/event.html" class="item is_event">
							24
							<span class="event_title">Выставка</span>
						</a>
						<a href="http://roofers.com.ua/event.html" class="item is_event">
							25
							<span class="event_title">Выставка</span>
						</a>
						<a href="http://roofers.com.ua/event.html" class="item is_event">
							26
							<span class="event_title">Выставка</span>
						</a>	
						<a href="http://roofers.com.ua/event.html" class="item is_event">
							27
							<span class="event_title">Выставка</span>
						</a>
						<div class="item">27</div>
						<div class="item">28</div>
						<div class="item">29</div>
						<div class="item">30</div>
						<div class="item">31</div>
						<div class="item"></div>
						<div class="item"></div>						
					</div>
				</div>
				<br>
				<br>
				<a href="http://roofers.com.ua/special.html">
					<img src="./temp/banner_5.png" class="img-responsive">
				</a>
				<br>
				<br>
				<form class="last_poll" onsubmit="alert(&#39;Спасибо за ваш голос.&#39;); return false;">
				
					<div class="subtitle">Последный опрос</div>
				
					<p class="title">Какие зарубежные новинки "кровельной" моды могут стать популярными в нашей стране в ближайшем сезоне?</p>
				
					<div class="variants">
				
						<label class="poll_item radio">
							<input type="radio" name="value" value="0" checked="">
							<i></i>
							<span>Сланцевые кровли</span>
						</label>
				
						<label class="poll_item radio">
							<input type="radio" name="value" value="1">
							<i></i>
							<span>Соломенные кровли</span>
						</label>
				
						<label class="poll_item radio">
							<input type="radio" name="value" value="2">
							<i></i>
							<span>Цветная керамическая черепица</span>
						</label>
				
					</div>
				
					<p class="all"><a href="http://roofers.com.ua/polls.html">Смотреть все опросы</a></p>
				
					<button class="btn btn-lg btn-block btn-roofers-main">
						Голосовать
					</button>
					
				</form>
				<br>
				<br>
				<a href="http://roofers.com.ua/special.html">
					<img src="./temp/banner_5.png" class="img-responsive">
				</a>
				<br>
				<br>
			</div>

		</div>

	</div>
</div>


<div class="section section-odd">
	<div class="container">

		<div class="board_mod">
		
			<div class="subtitle">Доска обьявлений</div>
		
			<div class="row">
		
				<!-- LOOP -->
		
				<div class="col-md-2">
		
					<div class="post_item">
					
						<a href="http://roofers.com.ua/board_single.html">
							<img src="./temp/board_1.png" class="img-responsive">
						</a>
		
						<p class="title">
							<a href="http://roofers.com.ua/board_single.html">Набор инструментов</a>
						</p>    
		
						<p class="price">Цена: <strong>1 200 грн.</strong></p>
		
					</div>
		
				</div>
		
				<div class="col-md-2">
		
					<div class="post_item">
					
						<a href="http://roofers.com.ua/board_single.html">
							<img src="./temp/board_2.png" class="img-responsive">
						</a>
		
						<p class="title">
							<a href="http://roofers.com.ua/board_single.html">Магнитная лента</a>
						</p>    
		
						<p class="price">Цена: <strong>45 грн.</strong></p>
		
					</div>
		
				</div>
		
				<div class="col-md-2">
		
					<div class="post_item">
					
						<a href="http://roofers.com.ua/board_single.html">
							<img src="./temp/board_3.png" class="img-responsive">
						</a>
		
						<p class="title">
							<a href="http://roofers.com.ua/board_single.html">Металлочерепица со скидкой!</a>
						</p>    
		
					</div>
		
				</div>
		
				<div class="col-md-2">
		
					<div class="post_item">
					
						<a href="http://roofers.com.ua/board_single.html">
							<img src="./temp/board_4.png" class="img-responsive">
						</a>
		
						<p class="title">
							<a href="http://roofers.com.ua/board_single.html">Бригада кровельщиков в Одессе</a>
						</p>    
		
					</div>
		
				</div>
		
				<div class="col-md-2">
		
					<div class="post_item">
					
						<a href="http://roofers.com.ua/board_single.html">
							<img src="./temp/board_5.png" class="img-responsive">
						</a>
		
						<p class="title">
							<a href="http://roofers.com.ua/board_single.html">Инструмент</a>
						</p>    
		
						<p class="price">Цена: <strong>456 грн.</strong></p>
		
					</div>
		
				</div>
		
				<div class="col-md-2">
		
					<div class="post_item">
					
						<a href="http://roofers.com.ua/board_single.html">
							<img src="./temp/board_6.png" class="img-responsive">
						</a>
		
						<p class="title">
							<a href="http://roofers.com.ua/board_single.html">Металочерепица</a>
						</p>    
		
						<p class="price">Цена: <strong>3 456 грн.</strong></p>
		
					</div>
		
				</div>
		
				<!-- LOOP -->
		
			</div>
		
		</div>

	</div>
</div>

@endsection