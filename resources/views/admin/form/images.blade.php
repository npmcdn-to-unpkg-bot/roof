<div class="form-group {{$errors->first($name)?'has-error':''}}">
	<label class="control-label" for="{{$name}}">{{$label}}</label>
	<div class="dropzone" id="{{$name}}">
		<div class="dz-message"></div>
		<div class="dz-previews">
		</div>
	</div>
	@if ($errors->first($name))
		<span class="help-block">{{ $errors->first($name) }}</span>
	@endif
</div>

<style>
	.dz-previews { 
		border: 2px solid gray;
		min-height: 230px;
		margin: 0;
		padding: 0;
		overflow: auto;
		cursor: pointer;
	}

	.dz-preview {
		margin: 10px;
		padding: 5px;
		float: left;
		width: 130px; 
		height: 250px;
		background-color: white;
	}
	.dz-error-message{
		color: red;
	}
</style>

<script>
	$('.dz-previews').sortable();
	$('.dz-previews').disableSelection();

	Dropzone.autoDiscover = false;
	myDropzone = new Dropzone('.dropzone', {
		previewTemplate: '<div class="dz-preview dz-file-preview">\n<div class="dz-image"><img data-dz-thumbnail /></div>\n<div class="dz-details">\n<div class="dz-filename"><span data-dz-name></span></div>\n</div>\n<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\n<div class="dz-error-message"><span data-dz-errormessage></span></div>\n</div>',
		maxFiles: {{$quantity}},
		url: '{{url('image')}}',
		previewsContainer: '.dz-previews',
		clickable: '.dz-previews',
		addRemoveLinks : true,
		dictRemoveFile: 'Удалить',
		headers: { 'X-CSRF-Token': '{{csrf_token()}}' },
	});

	myDropzone.on( 'success', function (file, response) {
		file.serverName = response;
		$(file.previewElement).append('<input type="hidden" name="{{$name}}{{$quantity>1?'[]':''}}" value='+response+'>');
	});

	myDropzone.on('maxfilesreached', function() {
    	myDropzone.removeEventListeners();
	});

	myDropzone.on('removedfile', function (file) {
		myDropzone.setupEventListeners();
		$(".dz-hidden-input").attr("disabled",false);
		$.ajax({
		    url: '/image/'+file.serverName,
		    type: 'post',
		    data: {_method: 'delete'},
		    headers: { 'X-CSRF-Token': '{{csrf_token()}}' },
		});
	});

	myDropzone.files = [
		@foreach ($values as $image)
			{name: '{{ $image }}', serverName: '{{ $image }}', accepted: true},
		@endforeach
	];
	$.each(myDropzone.files, function (index, file) {
		myDropzone.emit("addedfile", file);
		myDropzone.emit("thumbnail", file, "/fit/120/120/"+file.serverName);
		myDropzone.emit("complete", file);
		myDropzone.emit("success", file, file.serverName);
	});
	myDropzone._updateMaxFilesReachedClass();
</script>