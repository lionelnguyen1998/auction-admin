
@extends('admin.main')

@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ユーザー詳細</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listUser') }}">ユーザー一覧</a></li>
              <li class="breadcrumb-item active">ユーザー詳細</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control" id="name" value="{{ $user[0]['name'] }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="email">メール</label>
                    <input type="email" class="form-control" id="email" value="{{ $user[0]['email'] }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="address">住所</label>
                    <input type="text" class="form-control" id="address" value="{{ $user[0]['address'] }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="phone">電話</label>
                    <input type="text" class="form-control" id="phone" value="{{ $user[0]['phone'] }}" disabled>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="cancel" class="btn btn-danger btn-cancel">キャンセル</button></button>
                </div>
              </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        $(document).ready(function() {
            $('.btn-cancel').click(function(e) {
                console.log('abc')
            })
        })
    </script>
@endsection
