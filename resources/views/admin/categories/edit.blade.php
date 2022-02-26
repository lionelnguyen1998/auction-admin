@extends('admin.main')

@section('content')
<style>
  .input-group .form-control {
    height: 44px !important;
  }
</style>
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>カテゴリー編集</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">edit category</li>
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
                <h3 class="card-title">カテゴリー編集</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('updatecategory') }}" method="POST">
                <input type="hidden" name="category_id" value="{{ $category['category_id'] }}">
                <div class="card-body" style="width:70%;margin-left:15%">
                  <div class="form-group">
                      <label for="image">写真</label>
                      <div class="input-group">
                          <input type="file" style="margin-bottom:5px" class="form-control" id="upload" value="{{ old('thumb') ?? $category['image'] }}">
                          <input type="hidden" name="thumb" id="thumb" value="{{ old('thumb') ?? $category['image'] }}">
                      </div>
                      <div id="image_show" style="margin-top:10px">

                      </div>
                  </div>
                  <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="名前を入力してください" value="{{ old('name') ?? $category['name'] }}">
                    @if($errors->has('name'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name')}}</label><br/>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="name_en">名前（英語）</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="英語で名前を入力してください" value="{{ old('name_en') ?? $category['name_en'] }}">
                    @if($errors->has('name_en'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name_en')}}</label><br/>
                    @endif
                  </div>
                  <h5>Danh mục kỹ thuật (lưu vào bảng category_values)</h5>
                  <div class="form-group">
                    <label for="name_values"></label>
                    <input type="text" class="form-control" id="name_values" name="name_values" placeholder="Nhập giá trị">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width:100%">
                  <button type="submit" class="btn btn-primary float-right">編集</button>
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
