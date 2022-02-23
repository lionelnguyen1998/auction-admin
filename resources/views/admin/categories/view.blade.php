@extends('admin.main')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chi tiết danh mục sản phẩm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $category['name'] }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
                    <b>Tên danh mục (Tiếng Nhật)</b> <p class="float-right">{{ $category['name'] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Tên danh mục (Tiếng Anh)</b> <p class="float-right">{{ $category['name_en'] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Tổng số sản phẩm</b> <p class="float-right">{{ $countItems }}</p>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#list_item" data-toggle="tab">Sản phẩm</a></li>
                  <li class="nav-item"><a class="nav-link" href="#category_values" data-toggle="tab">Danh mục thông tin</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                    <div class="active tab-pane" id="list_item">
                        <div class="col-12">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width:50px">Item ID</th>
                                    <th>Auction ID</th>
                                    <th>Selling User ID</th>
                                    <th>Buying User ID</th>
                                    <th>Brand</th>
                                    <th>Series</th>
                                    <th>Name</th>
                                    <th>Name (En)</th>
                                    <th>Starting Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key => $item)
                                        <tr>
                                            <td>{{ $item["item_id"] }}</td>
                                            <td>{{ $item["auction_id"] }}</td>
                                            <td>{{ $item["selling_user_id"] }}</td>
                                            <td>{{ $item["buying_user_id"] ?? '--' }}</td>
                                            <td>{{ $item["brands"]["name"] ?? '--' }}</td>
                                            <td>{{ $item["series"]["name"] ?? '--' }}</td>
                                            <td>{{ $item["name"] }}</td>
                                            <td>{{ $item["name_en"] ?? '--' }}</td>
                                            <td>{{ $item["starting_price"] ?? '--' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="category_values">
                    <ul class="list-group list-group-unbordered mb-6">
                        @foreach ($categoryValues as $key => $value)
                            <li class="list-group-item">
                                <p>{{ $value['category_value_id'] }}</p> <b class="float-right">{{ $value['name'] }}</b>
                            </li>
                        @endforeach
                    </ul>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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

