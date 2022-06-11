@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('message.auctions.auction')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{__('message.auctions.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('message.auctions.auction')}}</li>
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
                  <thead>
                  <tr>
                    <th>{{__('message.auctions.id')}}</th>
                    <th>{{__('message.auctions.user_create')}}</th>
                    <th>{{__('message.auctions.category')}}</th>
                    <th>{{__('message.auctions.title')}}</th>
                    <th>{{__('message.auctions.start_date')}}</th>
                    <th>{{__('message.auctions.end_date')}}</th>
                    <th>{{__('message.auctions.status')}}</th>
                    <th>&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($auctions as $key => $auction)
                    @php
                    $status = __('message.status');
                    $index = $auction['status'];
                    @endphp
                      @if ($index != 4 && $index != 5)
                        <tr>
                            <td>{{ $auction['auction_id'] }}</td>
                            <td>{{ $auction['users']['name'] }}</td>
                            <td>{{ $auction['category']['name'] }}</td>
                            <td>{{ $auction['title']}}</td>
                            <td>{{ $auction['start_date'] }}</td>
                            <td>{{ $auction['end_date'] }}</td>
                            
                              @if ($index == 1)
                              <td>
                                <p class="btn btn-success">{{ $status[$index] }}</p>
                              </td>
                              @elseif ($index == 2)
                              <td>
                                <p class="btn btn-warning">{{ $status[$index] }}</p>
                              </td>
                              @elseif ($index == 3)
                              <td>
                                <p class="btn btn-danger">{{ $status[$index] }}</p>
                              </td>
                              @else
                              <td>
                                <p class="btn btn-info">{{ $status[$index] }}</p>
                              </td>
                              @endif
                           
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('viewAuction', ['auctionId' => $auction['auction_id']]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($index == 3 || $index == 6)
                                <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-{{ $key }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        <!-- /.modal -->
                        @if(isset($auction["auction_id"]))
                        <div class="modal fade" id="modal-{{ $key }}">
                          <div class="modal-dialog">
                              <div class="modal-content">
                              <div class="modal-header">
                                  <h4 class="modal-title" style="color:red">{{__('message.modal.title')}}</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true"></span>&times;</span>
                                  </button>
                              </div>
                              <form action="{{ route('deleteAuction', ['auctionId' => $auction['auction_id']]) }}" method="GET">
                                  <!-- /.card-body -->
                                  <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">{{__('message.modal.cancel')}}</button>
                                  <button type="submit" class="btn btn-danger">{{__('message.modal.confirm')}}</button>
                                  </div>
                                  @csrf
                              </form>
                              </div>
                              <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        @endif
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
