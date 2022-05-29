@extends('admin.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('message.user.admin')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listUser') }}">{{ __('message.user.list')}}</a></li>
              <li class="breadcrumb-item active">{{ __('message.user.info')}}</li>
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
              {{ __('message.user.phone')}}: {{ $user->phone }}
              </p>
            </div>
          </div>
          <div class="col-7">
            <div class="form-group">
              <label for="name">{{ __('message.user.name')}}</label>
              <input type="text" id="name" class="form-control" value="{{ $user->name }}" disabled />
            </div>
            @php
            $role = __('message.role');
            $index = $user->role;
            @endphp
            <div class="form-group">
              <label for="role">{{ __('message.user.role')}}</label>
              <input type="text" id="role" disabled value="{{ $role[$index] }}" class="form-control" />
            </div>
            <div class="form-group">
              <button class="btn btn-primary"><a href="{{ route('editUser', ['userId' => auth()->user()->user_id]) }}" style="color:white">{{ __('message.button.edit')}}</a></button>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
@endsection
