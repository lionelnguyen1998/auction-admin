@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('message.item.list') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('message.item.home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('message.item.list') }}</li>
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
                  <thead>
                  <tr>
                    <th style="width:50px">{{ __('message.item.id') }}</th>
                    <th>{{ __('message.item.category') }}</th>
                    <th>{{ __('message.item.auction') }}</th>
                    <th>{{ __('message.item.brand') }}</th>
                    <th>{{ __('message.item.series') }}</th>
                    <th>{{ __('message.item.name') }}</th>
                    <th>&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ $item['item_id'] }}</td>
                            <td>{{ $item['categories']['name'] }}</td>
                            <td>{{ $item['auctions']['title'] }}</td>
                            <td>{{ $item['brands']['name'] ?? '--' }}</td>
                            <td>{{ $item['series'] ?? '--' }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('viewItem', ['itemId' => $item['item_id']]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
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
