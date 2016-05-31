<?php $banner = App\Area::firstOrNew(['name' => $area])->banner ?>
@if ($banner)
	<a href="{{$banner->href}}" target="{{ $banner->target }}" style="display: block;">
		<img src="/full/{{$banner->image}}" style="max-width: 100%;" alt="">
	</a>
@endif
@if ( auth()->user()&&auth()->user()->hasRole('admin') ) <span class="area">{{$area}}</span> @endif