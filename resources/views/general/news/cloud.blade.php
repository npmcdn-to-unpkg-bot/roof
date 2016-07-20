<?php
	$tags = App\Models\Tag::has('articles')->get();
	$avg = $tags->avg(function($tag){
		return $tag->articles()->count();
	});
?>
<div class="text_center">
	@foreach ($tags as $tag)
		<a href="{{route('news.index')}}?tag={{$tag->name}}" style="font-size: {{14*$tag->articles()->count()/$avg}}px;">{{$tag->name}}</a>
	@endforeach
</div>
