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
            <h1>カテゴリー価値を追加する</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">add category value</li>
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
                <h3 class="card-title">カテゴリー価値を追加する</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('storecategoryvalues') }}" method="POST">
                <input type="hidden" id="category_id" name="category_id" value="{{ $categoryId }}"/>
                <div class="card-body" style="width:70%;margin-left:15%">
                <label for="name_value">名前</label>
                @for ($i = 1; $i <= $count; $i++)
                  <div class="form-group">
                    <input type="text" class="form-control" id="name_value_{{$i}}" name="name_value_{{$i}}" placeholder="名前を入力してください" value=""/>
                  </div>
                @endfor
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
