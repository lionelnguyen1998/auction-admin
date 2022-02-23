@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Đấu giá</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Auctions</li>
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
                <h3 class="card-title">Danh sách phiên đấu giá</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:50px">Auction ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Title(En)</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>Date Time</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($auctions as $key => $auction)
                    @php
                    $status = config('const.status');
                    $index = $auction['auction_status']['status'];
                    @endphp
                        <tr>
                            <td>{{ $auction["auction_id"] }}</td>
                            <td>{{ $auction["category"]["name"] }}</td>
                            <td>{{ $auction["title"]}}</td>
                            <td>{{ $auction["title_en"] }}</td>
                            <td>{{ $auction["start_date"] }}</td>
                            <td>{{ $auction["end_date"] }}</td>
                            <td>{{ $auction["start_time"] }}</td>
                            <td>{{ $auction["end_time"] }}</td>
                            @if ($index == 1)
                            <td>
                              <p class="btn btn-success">{{ $status[$index] }}</p>
                            </td>
                            @elseif ($index == 2)
                            <td>
                              <p class="btn btn-warning">{{ $status[$index] }}</p>
                            </td>
                            @else
                            <td>
                              <p class="btn btn-danger">{{ $status[$index] }}</p>
                            </td>
                            @endif
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('viewAuction', ['auctionId' => $auction["auction_id"]]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if ($index == 3)
                                <a href="{{ route('deleteAuction', ['auctionId' => $auction["auction_id"]]) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                                @endif
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
