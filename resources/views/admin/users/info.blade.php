@extends('admin.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ADMIN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Info</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ $user->avatar}}"
                        alt="Avatar">
                </div>
              <h2><strong>{{ $user->name }}</strong></h2>
              <p class="lead mb-5">{{ $user->address }}<br>
                Phone: {{ $user->phone }}
              </p>
            </div>
          </div>
          <div class="col-7">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" value="{{ $user->name }}" disabled />
            </div>
            <div class="form-group">
              <label for="nick_name">Nick Name</label>
              <input type="text" id="nick_name" value="{{ $user->nick_name }}" disabled class="form-control" />
            </div>
            @php
            $role = config('const.role');
            $index = $user->role;
            @endphp
            <div class="form-group">
              <label for="role">Role</label>
              <input type="text" id="role" disabled value="{{ $role[$index] }}" class="form-control" />
            </div>
            <div class="form-group">
              <button class="btn btn-primary"><a href="admin/users/edit_account" style="color:white">Edit</a></button>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
@endsection