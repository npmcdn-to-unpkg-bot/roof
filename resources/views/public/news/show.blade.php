@extends('layout')

@section('content')
	<div class="container breadcrumbs">
		<a href="{{route('news.index')}}" class="breadcrumbs__path">НОВОСТИ РЫНКА</a>
		<span class="breadcumbs__current">{{$article->title}}</span>
	</div>
	<div class="container">
		<div class="container__row">
			<div class="container__col-8">
				<div class="title">{{$article->title}}</div>
				<div class="market-news">
					<div class="market-news__createdat">{{$article->created_at->format('d.m.Y')}}</div>
					<div class="offset_vertical_20">
						@if ($article->image) <img src="/imagecache/medium/{{$article->image}}" alt="" class="market-news__image"> @endif
						<div class="market-news__text">{!! $article->content !!}</div>
					</div>
				</div>
			</div>
			<div class="container__col-4">
				<div class="calendar">
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
				<div class="offset_vertical_55">
					@include('public.area.banner',[
						'area' => App\Area::where('name', 'news.show.1')->with('banner')->first()
					])
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
				<div class="offset_vertical_55">
					@include('public.area.banner',[
						'area' => App\Area::where('name', 'news.show.2')->with('banner')->first()
					])
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid container-fluid_light-gray padding_vertical_60">
			<div class="container">
				<div class="title">ДОСКА ОБЪЯВЛЕНИЙ</div>
				<div class="container__row">
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-1.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-2.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-3.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-4.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-5.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
					<a href="" class="container__col-2 objavlenie">
						<img src="/s-img/obyavlenie-6.jpg" alt="" class="objavlenie__image">
						<span class="objavlenie__text">Набор инструментов</span>
						<span class="objavlenie__label">Цена: </span><span class="objavlenie__price">1 200 грн.</span>
					</a>
				</div>
			</div>
		</div>
@endsection