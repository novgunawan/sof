@extends('master')

@push('script-head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('title', 'Larahub | Detail Pertanyaan')
@section('content')

	<div class="card card-widget">
    <div class="card-header">
      <div class="user-block">
        <p class="h3">{{$ask->judul}}</p>
      </div>
      @if(Auth::user()->id == $ask->user->id)
      <div class="card-tools">
        <button type="button" class="btn btn-tool" title="Edit">
          <a href="/questions/{{$ask->id}}/edit"><i class="fas fa-edit"></i></a>
        </button>
      </div>
      @endif
    </div>
  
    <div class="card-body">
    	<p>
        {!! old('isi', $ask->isi_pertanyaan) !!}
    	</p>
      <span class="float-right text-muted">
        <div class="callout callout-info">
          <div class="row">
            <p><small>Pada {{$ask->created_at}}</small></p>
          </div>
          <div class="row">
            <p><small>Diubah {{$ask->updated_at}}</small></p>
          </div>
          <div class="row">
            <p><small>{{$ask->user->name}}</small></p>
          </div>
        </div>
      </span>
      @foreach($ask->tags as $val)
        <button class="btn btn-sm btn-success mr-1 mt-5">{{$val->tags}}</button>
      @endforeach
    </div>

    <div class="card-footer card-comments">
      <div class="post">
        <strong class="mb-3">Comment ({{$ask->askcomment->count()}})</strong>
      </div>
      @foreach($ask->askcomment as $comment)
        <div class="card-comment">
          <span class="username">
            {{ $comment->user->name }}
          <span class="text-muted float-right">{{ $comment->created_at }}</span>
          </span>
            {!! old('isi_jawaban', $comment->isi_comments ?? '') !!}
        </div>
      @endforeach
    </div>

    <div class="card-footer">
      <form action="/questionscomments" method="post">
        @csrf
        <input type="hidden" name="questions_id" value="{{$ask->id}}">
      	<input type="hidden" name="users_id" value="{{ Auth::user()->id }}">

        <div class="img-push row">
          <div class="input-group">
            <input type="text" class="disabled form-control" name="isi_comments" placeholder="Tambahkan komentar untuk pertanyaan">
            <button type="submit" class="btn btn-info ml-2" style="border-radius:50%">
              <i class="fa fa-location-arrow"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
    
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>{{$ask->answer->count()}} Jawaban</strong></h3>
    </div>

    <div class="card-body">
      @foreach($ask->answer as $ask)
        <div class="post">
          <div class="user-block">
            <img src="" alt="">
            <span class="username">
              <a href="#">{{$ask->user->name}}</a>
            </span>
            <span class="description">{{ $ask->created_at }}</span>
          </div>
          <!-- /.user-block -->
          <p>
            {!! old('isi_jawaban', $ask->isi_jawaban ?? '') !!}
          </p>
          <div id="accordion">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $ask->id }}">
                    Komentar
                  </a>
                </h4>
              </div>
              <div id="collapse{{ $ask->id }}" class="panel-collapse collapse in">
                <div class="card-body card-comments">
                  @foreach($ask->anscomment as $asc)
                  <div class="card-comment">
                    <span class="username">
                      {{ $asc->user->name }}
                    <span class="text-muted float-right">{{ $asc->created_at }}</span>
                    </span>
                      {!! old('isi_jawaban', $asc->isi_comments ?? '') !!}
                  </div>
                  @endforeach
                </div>

                <div class="card-body">
                  <form action="/answerscomments" method="post">
                    @csrf
                    <input type="hidden" name="answers_id" value="{{$ask->id}}">
                    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push row">
                      <div class="input-group">
                        <input type="text" class="disabled form-control" name="isi_comments" placeholder="Tambahkan komentar untuk jawaban">
                        <button type="submit" class="btn btn-info ml-2" style="border-radius:50%"><i class="fa fa-location-arrow"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    @endforeach

      <div class="post">
        <h4>Jawaban Anda</h4>
        <form action="/answers" method="POST">
          @csrf
          <input type="hidden" name="questions_id" id="questions_id" value="{{ $ask->id }}">
          <input type="hidden" name="users_id" id="users_id" value="{{ Auth::user()->id }}">
          <div class="form-group">
              <textarea name="isi_jawaban" class="form-control my-editor">
                  {!! old('isi_jawaban', $content ?? '') !!}
              </textarea>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Jawaban</button>
          <button type="button" class="btn btn-tool" title="Edit">
              <a href="/answer/{{$ask->id}}/edit"><i class="fas fa-edit"></i></a>
          </button>
        </form>
      </div>
    </div>
        <!-- /.card-body -->
  </div>

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