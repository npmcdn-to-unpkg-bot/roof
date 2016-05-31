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

@if (Request::is('user*'))
	<div style="text-align: center;">
		@if (!auth()->user()->company||auth()->user()->company&&auth()->user()->company->level==0) 
			<div style="color: white; margin-top: 15px;">@include('general.area.banner',['area' =>'Личный кабинет 1'])</div>
		@endif
		<div style="color: white; margin-top: 15px;">@include('general.area.banner',['area' =>'Личный кабинет 2'])</div>
		<div style="color: white; margin-top: 15px;">@include('general.area.banner',['area' =>'Личный кабинет 3'])</div>
	</div>
@endif
