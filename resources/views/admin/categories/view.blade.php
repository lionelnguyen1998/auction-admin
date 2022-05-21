@extends('admin.main')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>カテゴリー詳細</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listCategories') }}">カテゴリー一覧</a></li>
              <li class="breadcrumb-item active">{{ $category['name'] }}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ $category['image'] }}"
                       alt="{{ $category['name'] }}">
                </div>
                <h3 class="text-center">{{ $category['name'] }}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>名前</b></b> <p class="float-right">{{ $category['name'] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>アイテムの合計</b> <p class="float-right">{{ $countItems }}</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#list_item" data-toggle="tab">アイテム</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="list_item">
                        <div class="col-12">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width:50px">アイテムID</th>
                                    <th>オークションID</th>
                                    <th>ブランド</th>
                                    <th>シリーズ</th>
                                    <th>名前</th>
                                    <th>始値</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key => $item)
                                        <tr>
                                            <td>{{ $item['item_id'] }}</td>
                                            <td>{{ $item['auctions']['title'] }}</td>
                                            <td>{{ $item['brands']['name'] ?? '--' }}</td>
                                            <td>{{ $item['series'] ?? '--' }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ number_format($item['starting_price']) ?? '--' }} 円</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('footer')
    <script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function () {
        var $image_element = $(this).find('img')
        $('.product-image').prop('src', $image_element.attr('src'))
        $('.product-image-thumb.active').removeClass('active')
        $(this).addClass('active')
        })
    })
@endsection

