<ul class="sidebar-menu">
	<li class="header">МЕНЮ</li>
	@foreach ($menu as $item)
		<li class="treeview {{$item['active']}}">
			<a href="#"><i class="fa {{$item['icon']}}"></i><span>{{$item['name']}}</span> <i class="fa fa-angle-left pull-right"></i></a>
			<ul class="treeview-menu">
				@foreach ($item['children'] as $child)
					<li><a href="{{$child['href']}}"><i class="fa {{$child['icon']}}"></i>{{$child['name']}}</a></li>
				@endforeach
			</ul>
		</li>
	@endforeach
</ul>