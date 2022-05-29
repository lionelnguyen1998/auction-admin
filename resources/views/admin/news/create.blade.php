@extends('admin.main')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>@if (isset($new)) {{ __('message.news.edit') }} @else {{ __('message.news.add_page') }} @endif</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listNews') }}">{{ __('message.news.list') }}</a></li>
              <li class="breadcrumb-item active">@if(isset($new)) {{ __('message.news.edit') }} @else {{ __('message.news.add_page') }} @endif</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <!-- form start -->
              <form @if(isset($new)) action="{{ route('updateNew', ['newId' => $new["new_id"]]) }}" @else action="{{ route('insertNew') }}" @endif method="POST">
                <div class="card-body" style="width:70%;margin-left:15%">
                  @if (isset($new))
                    @method('PUT')
                    <input type="hidden" value="{{ $new['user_id'] }}" name="user_id"/>
                  @endif
                  <div class="form-group">
                    <label for="title">{{ __('message.news.title') }} <i class="fa fa-asterisk" aria-hidden="true" style="color:red"></i></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('message.news.title_input') }}" @if (isset($new)) value="{{$new["title"]}}" @else value="{{ old('title') }}" @endif>
                    @if($errors->has('title'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('title')}}</label><br/>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="content">{{ __('message.news.content') }} <i class="fa fa-asterisk" aria-hidden="true" style="color:red"></i></label>
                    @if (isset($new))
                      <textarea id="summernote" name="content" value="{{ old('content') }}">
                        {{ $new["content"] }}
                      </textarea>
                    @else 
                      <textarea id="summernote" name="content" value="{{ old('content') }}">
                        
                      </textarea>
                    @endif
                    @if($errors->has('content'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('content')}}</label><br/>
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width:100%">
                  <button type="submit" class="btn btn-primary float-right">@if (isset($new)) {{ __('message.button.edit') }} @else {{ __('message.button.send') }} @endif</button>
                </div>
                @csrf
              </form>
            </div>
          </div>
          <!-- right column -->
        </div>
        <!-- /.row -->
      </div>
    </section>
@endsection
@section('footer')
<!-- Summernote -->
<script src="/template/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
@endsection
