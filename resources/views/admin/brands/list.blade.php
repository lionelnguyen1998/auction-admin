@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ブランド一覧</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">ブランド一覧</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <a style="color:white" href="{{ route('createBrand') }}">
                    <button type="button" class="btn btn-block btn-success" style="margin-bottom:10px; width:150px">
                      追加
                    </button>
                  </a>
                  <thead>
                  <tr>
                    <th>ブランドID</th>
                    <th>名前</th>
                    <th>名前（英語）</th>
                    <th style="width:70px">&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($brands as $key => $brand)
                        <tr>
                            <td>{{ $brand["brand_id"] }}</td>
                            <td>{{ $brand["name"] }}</td>
                            <td>{{ $brand["name_en"] ?? '--' }}</td>
                            <td>
                                <a href="{{ route('editBrand', ['brandId' => $brand["brand_id"]]) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      <!-- /.modal -->
      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" style="color:red">本当に削除しますか？</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"></span>&times;</span>
                  </button>
              </div>
              <form action="{{ route('deleteBrand', ['brandId' => $brand["brand_id"]]) }}" method="GET">
                  <!-- /.card-body -->
                  <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                  <button type="submit" class="btn btn-danger">確認</button>
                  </div>
                  @csrf
              </form>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>

    </section>
    <!-- /.content -->
@endsection
