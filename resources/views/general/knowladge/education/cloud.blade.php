<?php
	$tags = App\Models\Tag::has('education_posts')->get();
	$avg = $tags->avg(function($tag){
		return $tag->education_posts()->count();
	});
?>
<div class="text_center">
	@foreach ($tags as $tag)
		<a href="{{route('knowladge.education.index')}}?tag={{$tag->name}}" style="font-size: {{14*$tag->education_posts()->count()/$avg}}px;">{{$tag->name}}</a>
	@endforeach
</div>
