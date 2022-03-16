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
            <h1>カテゴリー追加</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listCategories') }}">カテゴリー一覧</a></li>
              <li class="breadcrumb-item active">カテゴリー追加</li>
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
              <form action="{{ route('insertcategories') }}" method="POST">
                <div class="card-body" style="width:70%;margin-left:15%">
                  <div class="form-group">
                    <label for="image">写真</label>
                    <div class="input-group">
                        <input type="file" style="margin-bottom:5px" class="form-control" id="upload" value="{{ old('thumb') }}">
                        <input type="hidden" name="thumb" id="thumb" value="{{ old('thumb') }}">
                    </div>
                    <div id="image_show" style="margin-top:10px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">名前 <i class="fa fa-asterisk" aria-hidden="true" style="color:red"></i></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="名前を入力してください" value="{{ old('name') }}">
                    @if($errors->has('name'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name')}}</label><br/>
                    @endif
                  </div>
                  <div class="form-group">
                      <label>タイプ</label>
                      <select class="form-control select2" style="width: 100%;" name="type">
                      @foreach (config('const.categories') as $key => $category)
                        <option selected="selected" value="{{ $key }}">{{ $category }}</option>
                      @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="count_number">カテゴリー価値の数</label>
                    <input type="text" class="form-control" id="count_number" name="count_number" placeholder="カテゴリー価値の数を入力してください" value="{{ old('count_number') }}">
                    @if($errors->has('count_number'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('count_number')}}</label><br/>
                    @endif
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width:100%">
                  <button type="submit" class="btn btn-primary float-right">送信</button>
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
