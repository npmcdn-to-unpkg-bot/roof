<ul class="nav navbar-nav">
	@if (Request::is('user*')&&auth()->user()->company)
		@if (auth()->user()->company->level==0)
			<li ><a href="#" style="text-decoration: underline;"><img src="/img/coin.png" alt="" style="margin-right: 10px;"> КУПИТЬ СТАТУС</a></li>
			<li><a href="#" style="text-decoration: underline;">Условия портала</a></li>
		@elseif (auth()->user()->company->level==1)
			<li><a>Ваш текущий статус <span style="color: black; margin-left: 10px; height: 24px; width: 87px; display: inline-block; text-align: center; line-height: 24px; font-size: 16px; background-image: url(/img/silver.png);">СТАРТ</span></a></li>
		@elseif (auth()->user()->company->level==2)
			<li><a>Ваш текущий статус <span style="color: black; margin-left: 10px; height: 24px; width: 87px; display: inline-block; text-align: center; line-height: 24px; font-size: 16px; background-image: url(/img/gold.png);">БИЗНЕС</span></a></li>
		@elseif (auth()->user()->company->level==3)
			<li><a>Ваш текущий статус <span style="color: white; margin-left: 10px; height: 24px; width: 87px; display: inline-block; text-align: center; line-height: 24px; font-size: 16px; background-image: url(/img/platinum.png);">ПРЕМИУМ</span></a></li>
		@elseif (auth()->user()->company->level==4)
		@endif
	@endif
	<li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<img src="/fit/160/160/{{auth()->user()->image?auth()->user()->image:'person.png'}}" class="user-image" alt="User Image">
		<span class="hidden-xs">{{auth()->user()->name}}</span>
	</a>
		<ul class="dropdown-menu">
			<li class="user-header">
				<img src="/fit/160/160/{{auth()->user()->image?auth()->user()->image:'person.png'}}" class="img-circle" alt="User Image">
				<p>
				{{auth()->user()->name}}
				<small>Зарегистрирован {{auth()->user()->created_at->format('d.m.Y')}}</small>
				</p>
			</li>
			<li class="user-footer">
				<div class="pull-right">
				<a href="{{url('logout')}}" class="btn btn-default btn-flat">Выход</a>
				</div>
			</li>
		</ul>
	</li>
</ul>