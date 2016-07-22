<?php
	$tags = App\Models\Tag::has('articles')->get();
	$max = 1;
	foreach ($tags as $tag)
		$max = max($max, $tag->articles()->count())
?>
<div class="text_center">
	@foreach ($tags as $tag)
		<a href="{{route('news.index')}}?tag={{$tag->name}}" style="font-size: {{12+30*($tag->articles()->count()-1)/$max}}px;">{{$tag->name}}</a>
	@endforeach
</div>
