<form id="ask-expert" action="{{route('ask-expert.store')}}" method="POST" style="border-top:7px solid #d98e64; width: 370px;">
	{!! csrf_field() !!}
	<div class="title text_center offset_vertical_20">ВОПРОС ЭКСПЕРТУ</div>
	
	<div style="margin: auto;width: 315px;" class="offset_vertical_20 offset-sm_vertical_20 ">
		<div class="container__row">
			<div class="container__col-4 container__col-sm-4"><img src="/img/criminal_man.png"></div>
			<div class="container__col-8 container__col-sm-8 title title_small">Эксперт в сфере кровельных работ</div>
		</div>
	</div>

	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<input style="width: 315px;" name="name" value="{{old('name')}}" type="text" class="input input_bold" placeholder="ИМЯ*">
		@if ($errors->first('name')) <div class="error">{{$errors->first('name')}}</div> @endif
	</div>
	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<input style="width: 315px;" name="phone" value="{{old('phone')}}" type="text" class="input input_bold" placeholder="ТЕЛЕФОН* +380990000000*">
		@if ($errors->first('phone')) <div class="error">{{$errors->first('phone')}}</div> @endif
	</div>
	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<input style="width: 315px;" name="email" value="{{old('email')}}" type="text" class="input input_bold" placeholder="EMAIL">
	</div>
	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<textarea style="width: 315px;" name="question" value="{{old('comment')}}" class="input input_textarea input_bold" placeholder="ТЕКСТ ВОПРОСА"></textarea>
	</div>
	<button class="button button_orange button_100 button_big">ОТПРАВИТЬ</button>
</form>
<script>
	$('#ask-expert').submit(function(event){
		event.preventDefault();
		$.ajax({
			method: this.method,
			url: this.action,
			data: $(this).serialize(),
			success: function(data){
				$.fancybox(data,{padding: 0});
			}
		})
	});
</script>