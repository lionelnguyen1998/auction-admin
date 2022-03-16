@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>カテゴリー一覧</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">ホーム</a></li>
              <li class="breadcrumb-item active">カテゴリー一覧</li>
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
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <a style="color:white" href="{{ route('createCategory') }}">
                    <button type="button" class="btn btn-block btn-success" style="margin-bottom:10px; width:150px">
                      追加
                    </button>
                  </a>
                  <thead>
                  <tr>
                    <th>カテゴリーID</th>
                    <th>名前</th>
                    <th>タイプ</th>
                    <th style="width:90px">&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $key => $category)
                    @php
                    $categoryParent = config('const.categories');
                    $index = $category["type"];
                    @endphp
                        <tr>
                            <td>{{ $category["category_id"] }}</td>
                            <td>{{ $category["name"] }}</td>
                            <td>{{ $categoryParent[$index] }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('viewCategory', ['categoryId' => $category["category_id"]]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('editCategory', ['categoryId' => $category["category_id"]]) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-{{$key}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @if (isset($category["category_id"]))
                          <!-- /.modal -->
                            <div class="modal fade" id="modal-{{$key}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" style="color:#F70202"><b>本当に削除しますか？</b></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"></span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('deleteCategory', ['categoryId' => $category["category_id"]]) }}" method="GET">
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
                        @endif
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
     
    </section>
    <!-- /.content -->
@endsection
