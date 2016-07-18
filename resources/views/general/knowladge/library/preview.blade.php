<div class="post">
	<img src="/width/360/{{$post->image}}" class="post__image">
	<div class="post__content">
		<a href="{{route('knowladge.library.show', $post)}}" class="post__title">{{$post->title}}</a>
		<div class="post__entry">{{$post->entry}}</div>
		<div class="post__bottom clearfix">
			<div class="post__created-at">{{$post->created_at->format('d.m.Y')}}</div>
			<div class="post__libraries post__library">
				@foreach ($post->tags as $tag)
					<a class="post__library" href="{{route('knowladge.library.index')}}?tag={{$tag->name}}">
						{{$tag->name}}</a>@if ($post->tags->last()!=$tag), @endif
				@endforeach
			</div>
		</div>
	</div>
</div>