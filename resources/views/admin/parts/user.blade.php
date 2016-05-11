<ul class="nav navbar-nav">
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