@if($related_posts->first())
<div class="container offset_bottom_60">
	<div class="title offset_vertical_30">ВОЗМОЖНО, ВАМ БУДЕТ ИНТЕРЕСНО</div>
	<div class="container__row">
		@foreach($related_posts as $post)
		<div class="container__col-4 container__col-sm-12 offset-sm_bottom_30">
			@include('general.knowledge.library.preview')
		</div>
		@endforeach
	</div>
</div>
@endif