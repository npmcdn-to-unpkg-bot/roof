<?php
	$tags = App\Models\Tag::has('education_posts')->get();
	$max = 1;
	foreach ($tags as $tag)
		$max = max($max, $tag->education_posts()->count())
?>
<div class="text_center">
	@foreach ($tags as $tag)
		<a href="{{route('knowladge.education.index')}}?tag={{$tag->name}}" style="font-size: {{12+30*($tag->education_posts()->count()-1)/$max}}px;">{{$tag->name}}</a>
	@endforeach
</div>
