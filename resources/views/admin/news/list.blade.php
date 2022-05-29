@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('message.news.list') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('message.news.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('message.news.list') }}</li>
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <a style="color:white"   href="{{ route('createNew') }}">
                    <button type="button" class="btn btn-block btn-success" style="margin-bottom:10px; width:150px">
                    {{ __('message.news.add') }}
                    </button>
                  </a>
                  <thead>
                  <tr>
                    <th>{{ __('message.news.id') }}</th>
                    <th>{{ __('message.news.user_create') }}</th>
                    <th>{{ __('message.news.title') }}</th>
                    <th>{{ __('message.news.content') }}</th>
                    <th>{{ __('message.news.time') }}</th>
                    <th>&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($news as $key => $new)
                        <tr>
                            <td>{{ $new["new_id"] }}</td>
                            <td>{{ $new["users"]["name"] }}</td>
                            <td>{{ $new["title"] }}</td>
                            <td>{{ substr(strip_tags($new['content']), 0, 40) . '...' }}</td>
                            <td>{{ date("d-m-Y H:i", strtotime($new["updated_at"]))}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('editNew', ['newId' => $new["new_id"]]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-{{ $key }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- /.modal -->
                        @if (isset($new["new_id"]))
                          <div class="modal fade" id="modal-{{ $key }}">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title" style="color:#F70202"><b>{{ __('message.modal.title') }}</b></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true"></span>&times;</span>
                                      </button>
                                  </div>
                                  <form action="{{ route('deleteNew', ['newId' => $new["new_id"]]) }}" method="GET">
                                      <!-- /.card-body -->
                                      <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('message.modal.cancel') }}</button>
                                      <button type="submit" class="btn btn-danger">{{ __('message.modal.confirm') }}</button>
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
                  </tbody>
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
