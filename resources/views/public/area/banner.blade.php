@if ($area&&$area->banner)
	<a href="{{$area->banner->href}}">
		<img src="/imagecache/full/{{$area->banner->image}}" style="display: block;" alt="">
	</a>
@endif