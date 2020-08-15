@extends('master')

@push('script-head')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('title', 'Larahub | Buat Pertanyaan')

@section('content')
	<form action="/questions" method="POST">
		@csrf
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Tambahkan Pertanyaan</h3>
			</div>

	    	<div class="card-body">
	      		<div class="form-group">
	        		<label for="judul">Judul <br>
	        			<small>Ajukan dengan spesifik dan bayangkan anda sedang bertanya kepada orang lain.</small>
	        		</label>
	        		<input type="text" class="form-control" name="judul" id="judul">
	      		</div>
	      		<div class="form-group">
	        		<label>Isi Pertanyaan <br>
	        			<small>Sertakan semua informasi yang dibuthkan untuk menjawab pertanyaan Anda.</small>
	        		</label>
	        		<textarea id="isi_pertanyaan" name="isi_pertanyaan" class="form-control my-editor">
	        			{!! old('isi_pertanyaan',$content ?? '' ) !!}
	        		</textarea>
	      		</div>
	      		<div class="form-group">
	        		<label for="judul">Tags <br></label>
	        		<input type="text" class="form-control" name="tags" placeholder="tag1,tag2,tag3,dst">
	      		</div>
	    	</div>
	    	<input hidden type="text" name="user_id" value="{{ Auth::user()->id}}">
	        <div class="card-footer">
	        	<a href="/questions" class="btn btn-danger">cancel</a>
	        	<button type="submit" class="btn btn-primary">Submit</button>
	        </div>
    	</div>
	</form>

@endsection

@push('scripts')
	<script>
		console.log('ok');
	  var editor_config = {
	    path_absolute : "/",
	    selector: "textarea.my-editor",
	    plugins: [
	      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	      "searchreplace wordcount visualblocks visualchars code fullscreen",
	      "insertdatetime media nonbreaking save table contextmenu directionality",
	      "emoticons template paste textcolor colorpicker textpattern"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
	    relative_urls: false,
	    file_browser_callback : function(field_name, url, type, win) {
	      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

	      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
	      if (type == 'image') {
	        cmsURL = cmsURL + "&type=Images";
	      } else {
	        cmsURL = cmsURL + "&type=Files";
	      }

	      tinyMCE.activeEditor.windowManager.open({
	        file : cmsURL,
	        title : 'Filemanager',
	        width : x * 0.8,
	        height : y * 0.8,
	        resizable : "yes",
	        close_previous : "no"
	      });
	    }
	  };

	  tinymce.init(editor_config);
	</script>
@endpush