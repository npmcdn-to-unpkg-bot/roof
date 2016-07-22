<?php
	$tags = App\Models\Tag::has('library_posts')->get();
	$max = 1;
	foreach ($tags as $tag)
		$max = max($max, $tag->library_posts()->count());
?>
<div class="text_center">
	@foreach ($tags as $tag)
		<a href="{{route('knowladge.library.index')}}?tag={{$tag->name}}" style="font-size: {{12+30*($tag->library_posts()->count()-1)/$max}}px;">{{$tag->name}}</a>
	@endforeach
</div>
