@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('message.brand.list') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('message.brand.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('message.brand.list') }}</li>
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
                  <a style="color:white" href="{{ route('createBrand') }}">
                    <button type="button" class="btn btn-block btn-success" style="margin-bottom:10px; width:150px">
                    {{ __('message.brand.add') }}
                    </button>
                  </a>
                  <thead>
                  <tr>
                    <th>{{ __('message.brand.id') }}</th>
                    <th>{{ __('message.brand.name') }}</th>
                    <th style="width:70px">&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($brands as $key => $brand)
                        <tr>
                            <td>{{ $brand["brand_id"] }}</td>
                            <td>{{ $brand["name"] }}</td>
                            <td>
                                <a href="{{ route('editBrand', ['brandId' => $brand["brand_id"]]) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-{{ $key }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- /.modal -->
                        @if (isset($brand["brand_id"]))
                        <div class="modal fade" id="modal-{{ $key }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" style="color:#F70202"><b>{{ __('message.modal.title') }}</b></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"></span>&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('deleteBrand', ['brandId' => $brand["brand_id"]]) }}" method="GET">
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
