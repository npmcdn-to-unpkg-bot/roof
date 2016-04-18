<div class="form-group">
	<label class="control-label">{{$label}}</label>
		@foreach ($taxonomy as $word)
			<label class="checkbox">
				<input type="checkbox" name="{{$name}}[]" value="{{$word->id}}" {{in_array($word->id,$values) ? 'checked' : ''}} class="minimal">
				{{$word->name}}
			</label>
		@endforeach
</div>