<?php $area = App\Area::where('name', $area)->with('banner')->first() ?>
@if ($area&&$area->banner)
	<a href="{{$area->banner->href}}">
		<img src="/imagecache/full/{{$area->banner->image}}" style="display: block; max-width: 100%;" alt="">
	</a>
@endif