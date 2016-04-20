<ul class="nav navbar-nav">
	<li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<img src="/bower/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
		<span class="hidden-xs">{{Auth::user()->name}}</span>
	</a>
		<ul class="dropdown-menu">
			<li class="user-header">
				<img src="/bower/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				<p>
				{{Auth::user()->name}}
				<small>Зарегистрирован {{Auth::user()->created_at->format('d.m.Y')}}</small>
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