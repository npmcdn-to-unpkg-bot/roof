<?php
	$tags = App\Models\Tag::has('library_posts')->get();
	$avg = $tags->avg(function($tag){
		return $tag->library_posts()->count();
	});
?>
<div class="text_center">
	@foreach ($tags as $tag)
		<a href="{{route('knowladge.library.index')}}?tag={{$tag->name}}" style="font-size: {{14*$tag->library_posts()->count()/$avg}}px;">{{$tag->name}}</a>
	@endforeach
</div>
