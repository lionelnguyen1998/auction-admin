@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:50px">User ID</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Nick Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
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
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('viewUser', ['userId' => $user->user_id]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('deleteUser', ['userId' => $user->user_id]) }}" class="btn btn-danger btn-sm">
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
    </section>
    <!-- /.content -->
@endsection
