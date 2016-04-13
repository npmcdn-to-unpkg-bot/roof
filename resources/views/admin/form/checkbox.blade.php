<label>
	<input type="hidden" name="{{$name}}" value="0">
	<input type="checkbox" name="{{$name}}" value="1" @if (old()&&old($name)==1||!old()&&$item->{$name}==1) checked @endif class="minimal">
	{{$label}}
</label>