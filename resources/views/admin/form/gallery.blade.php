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
		height: 230px;
		margin: 0;
		padding: 0;
		overflow: auto;
	}

	.dz-preview {
		margin: 10px;
		padding: 5px;
		float: left;
		width: 130px; 
		height: 190px;
		background-color: white;
	}
</style>

<script>
	document.addEventListener("DOMContentLoaded", function () {

		$('.dz-previews').sortable();
		$('.dz-previews').disableSelection();

		Dropzone.autoDiscover = false;
		{{$name}}Dropzone = new Dropzone('.dropzone', {
			previewTemplate: '<div class="dz-preview dz-file-preview">\n<div class="dz-image"><img data-dz-thumbnail /></div>\n<div class="dz-details">\n<div class="dz-filename"><span data-dz-name></span></div>\n</div>\n<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>\n<div class="dz-error-message"><span data-dz-errormessage></span></div>\n</div>',
			maxFiles: {{$quantity}},
			url: '/image',
			previewsContainer: '.dz-previews',
			clickable: '.dz-previews',
			addRemoveLinks : true,
			dictRemoveFile: 'Удалить',
			dictMaxFilesExceeded: 'Превышено максимальное количество фотографий',
			headers: { 'X-CSRF-Token': $('[name="_token"]').val()},
		});

		{{$name}}Dropzone.on( 'success', function (file, response) {
			file.serverName = response;
			$(file.previewElement).append('<input type="hidden" name="{{$name}}[]" value='+response+'>');
		});

		{{$name}}Dropzone.on('removedfile', function (file) {
			$.ajax({
			    url: '/image/'+file.serverName,
			    type: 'post',
			    data: {_method: 'delete'},
			    headers: { 'X-CSRF-Token': $('[name="_token"]').val()},
			    error: function (response) {
			    	console.log(response.responseText)
			    }
			});
		});

		{{$name}}Dropzone.files = [
			@foreach ($values as $image)
				{name: '{{ $image }}', serverName: '{{ $image }}'},
			@endforeach
		];
		$.each({{$name}}Dropzone.files, function (index, file) {
			{{$name}}Dropzone.emit("addedfile", file);
			{{$name}}Dropzone.emit("thumbnail", file, "/imagecache/120x120/"+file.serverName);
			{{$name}}Dropzone.emit("complete", file);
			{{$name}}Dropzone.emit("success", file, file.serverName);
		});
	});
</script>