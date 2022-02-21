@extends('admin.main')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>chỉnh sửa thương hiệu</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">edit brand</li>
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
              <div class="card-header">
                <h3 class="card-title">Chỉnh sửa thương hiệu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('updatebrand') }}" method="POST">
                <input type="hidden" name="brand_id" value="{{ $brand[0]['brand_id'] }}"/>
                <div class="card-body" style="width:70%;margin-left:15%">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{ old('name') ?? $brand[0]['name'] }}">
                    @if($errors->has('name'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name')}}</label><br/>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="name_en">Name (En)</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nhập tên Tiếng Anh" value="{{ old('name_en') ?? $brand[0]['name_en'] }}">
                    @if($errors->has('name'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name_en')}}</label><br/>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="brand_info">Thông tin thương hiệu</label>
                    <textarea id="summernote" name="brand_info">
                        {{ $brand[0]['brand_info'] }}
                    </textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width:100%">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
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
