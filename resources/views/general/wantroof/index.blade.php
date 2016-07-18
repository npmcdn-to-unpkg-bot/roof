<form id="want-roof" action="{{route('want-roof.store')}}" method="POST" style="border-top:7px solid #6fc0d1; width: 370px;">
	{!! csrf_field() !!}
	<div class="title text_center offset_vertical_30">ЗАЯВКА НА УСЛУГИ</div>
	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<input style="width: 315px;" name="name" value="{{old('name')}}" type="text" class="input input_bold" placeholder="ИМЯ*">
		@if ($errors->first('name')) <div class="error">{{$errors->first('name')}}</div> @endif
	</div>
	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<input style="width: 315px;" name="phone" value="{{old('phone')}}" type="text" class="input input_bold" placeholder="ТЕЛЕФОН*">
		@if ($errors->first('phone')) <div class="error">{{$errors->first('phone')}}</div> @endif
	</div>
	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<input style="width: 315px;" name="email" value="{{old('email')}}" type="text" class="input input_bold" placeholder="EMAIL">
	</div>
	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<input style="width: 315px;" name="theme" value="{{old('theme')}}" type="text" class="input input_bold" placeholder="ТЕМА ЗАЯВКИ">
	</div>
	<div class="offset_vertical_20 offset-sm_vertical_20 text_center">
		<textarea style="width: 315px;" name="comment" value="{{old('comment')}}" class="input input_textarea input_bold" placeholder="КОММЕНТАРИЙ"></textarea>
	</div>
	<button class="button button_blue button_100 button_big">ОТПРАВИТЬ</button>
</form>
<script>
	$('#want-roof').submit(function(event){
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