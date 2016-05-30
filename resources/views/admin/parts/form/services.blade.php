<div class="form-group gold-border">
	<label class="control-label">{{$label}} 
		<span class="more-info"><i class="fa fa-question more-info__icon"></i>
		<span class="more-info__tooltip">{!! $info !!}</span>
		</span>
	</label>
	<div class="radio">
		<label><input type="radio" value="0" checked name="{{$name}}">Нет</label>
	</div>
	@foreach ($options as $option)
	<div class="radio">
		<label><input type="radio" value="{{ $option->id }}" name="{{$name}}">{{ $option->name }}</label>
	</div>
	@endforeach
</div>
<style>
	.more-info {
		cursor: pointer;
		display: inline-block;
		position: relative;
	}

	.more-info__icon {
		background: #ad956f;
		border-radius: 50%;
		width: 16px;
		height: 16px;
		font-size: 12px;
		line-height: 16px;
		text-align: center;
		font-weight: 400;
		color: white;
		position: relative;
		z-index: 2;
	}

	.more-info__tooltip {
		z-index: 1;
		top: 0;
		display: none;
		position: absolute;
		background: #efefef;
		font-weight: 400;
		width: 630px;
		padding: 17px;
		text-align: justify;
		color: black;
	}
	.more-info:hover .more-info__tooltip{
		display: block;
	}

	.gold-border {
		border: 5px solid #ad956f;
		padding: 20px;
	}
</style>