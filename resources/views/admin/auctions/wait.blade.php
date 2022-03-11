@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>オークション評価</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin') }}">ホーム</a></li>
              <li class="breadcrumb-item active">オークション評価</li>
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
                    <th>オークションID</th>
                    <th>カテゴリー</th>
                    <th>テーマ</th>
                    <th>テーマ（英語）</th>
                    <th>始まる時間</th>
                    <th>終わる時間</th>
                    <th>スターテス</th>
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
