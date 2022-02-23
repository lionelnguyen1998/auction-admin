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
              <li class="breadcrumb-item active">Duyệt đấu giá</li>
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
                <h3 class="card-title">Danh sách phiên đấu giá chưa duyệt</h3>
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
                    $index = $auction->status;
                    @endphp
                        <tr>
                            <td>{{ $auction->auction_id }}</td>
                            <td>{{ $auction->category_id }}</td>
                            <td>{{ $auction->title }}</td>
                            <td>{{ $auction->title_en }}</td>
                            <td>{{ $auction->start_date }}</td>
                            <td>{{ $auction->end_date }}</td>
                            <td>{{ $auction->start_time }}</td>
                            <td>{{ $auction->end_time }}</td>
                            <td>
                              <p class="btn btn-info">{{ $status[$index] }}</p>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('viewAuctionIsWait', ['auctionId' => $auction->auction_id]) }}">
                                    <i class="fas fa-eye"></i>
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
