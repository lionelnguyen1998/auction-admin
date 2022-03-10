@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ユーザー一覧</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">user list</li>
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
                <h3 class="card-title">ユーザー一覧</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <a style="color:white"   href="{{ route('createUser') }}">
                    <button type="button" class="btn btn-block btn-success" style="margin-bottom:10px; width:150px">
                      追加
                    </button>
                  </a>
                  <thead>
                  <tr>
                    <th style="width:50px">ユーザーID</th>
                    <th>役割</th>
                    <th>名前</th>
                    <th>ニックネーム</th>
                    <th>メール</th>
                    <th>住所</th>
                    <th>電話</th>
                    <th>&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $key => $user)
                    @php
                    $role = config('const.role');
                    $index = $user['role'];
                    @endphp
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $role[$index] }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nick_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address ?? '--' }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                              <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-{{ $key }}">
                                  <i class="fas fa-trash"></i>
                              </a>
                              @if ($user->user_create == auth()->user()->user_id)
                                <a class="btn btn-info btn-sm" href="{{ route('editUser', ['userId' => $user->user_id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                              @endif
                            </td>
                        </tr>
                        <!-- /.modal -->
                        <div class="modal fade" id="modal-{{ $key }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" style="color:#F70202"><b>本当に削除しますか？</b></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"></span>&times;</span>
                                    </button>
                                </div>
                    
                                <form action="{{ route('deleteUser', ['userId' => $user->user_id]) }}" method="GET">
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
