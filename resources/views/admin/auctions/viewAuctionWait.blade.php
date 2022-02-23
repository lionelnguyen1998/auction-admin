@extends('admin.main')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chi tiết Room {{ $auction[0]["auction_id"] }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Room {{ $auction[0]["auction_id"] }}</li>
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
                       src="{{ $auction[0]["category"]["image"] }}"
                       alt="{{ $auction[0]["category"]["name"] }}">
                </div>
                <h3 class="text-center">Room {{ $auction[0]["auction_id"] }}</h3>
                <p class="text-muted text-center">{{ $auction[0]["category"]["name"] }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Thời gian bắt đầu</b> <p class="float-right">{{ $auction[0]["start_date"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Thời gian kết thúc</b> <p class="float-right">{{ $auction[0]["end_date"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>Giá khởi điểm</b> <p class="float-right">{{ $auction[0]["items"][0]["starting_price"] }}</p>
                  </li>
                  @php
                    $status = config('const.status');
                    $index = $auction[0]['auction_status']['status'];
                  @endphp
                  @if ($index == 4)
                    <li class="list-group-item">
                      <p class="btn btn-success"><a style="color:white" href="{{ route('acceptAuction', ['auctionStatusId' => $auction[0]["auction_status"]["auction_status_id"]]) }}">Chấp nhận</a></p>  
                      <p class="float-right">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
                          Từ chối
                        </button>
                      </p>
                    </li>
                  @else 
                  <li class="list-group-item">
                    <p class="btn btn-secondary">{{ $status[$index] }}</p>
                  </li>
                  @endif
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
                  <li class="nav-item"><a class="nav-link active" href="#item" data-toggle="tab">Sản phẩm</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                    <div class="active tab-pane" id="item">
                     <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                @php
                                    $avatar = $userSelling[0]["users"]["avatar"]
                                @endphp
                                <img class="img-circle img-bordered-sm" src="{{ $avatar }}" alt="User Image">
                                <span class="username">
                                    <p href="#">{{ $userSelling[0]["users"]["nick_name"] }}</p>
                                </span>
                                <span class="description">{{ date("d-m-Y H:i", strtotime($userSelling[0]['updated_at'])) }}</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row mb-3">
                                <div class="col-12 col-sm-12">
                                <div class="col-12">
                                    <img src="{{ $userSelling[0]["image1"] }}" class="product-image" alt="Product Image">
                                </div>
                                <div class="col-12 product-image-thumbs">
                                    <div class="product-image-thumb active"><img src="{{ $userSelling[0]["image1"] }}" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="{{ $userSelling[0]["image2"] }}" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="{{ $userSelling[0]["image3"] }}" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="{{ $userSelling[0]["image4"] }}" alt="Product Image"></div>
                                    <div class="product-image-thumb" ><img src="{{ $userSelling[0]["image5"] }}" alt="Product Image"></div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                <h3>Thông tin sản phẩm</h3>
                                <p>{{ $userSelling[0]["description"] }}</p>
                                <hr>
                                <h4>Thông tin kỹ thuật</h4>
                                <div class="col-12 col-sm-12">
                                  <ul class="list-group list-group-unbordered mb-3 col-sm-12">
                                    @foreach ($infors as $key => $infor)
                                      <li class="list-group-item">
                                        <b>{{ $categoryValueName[$key] }}</b> <p class="float-right">{{ $infor }}</p>
                                      </li>
                                    @endforeach
                                  </ul>
                                </div>
                                </div>
                             </div>
                        </div>
                    <!-- /.post -->
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
      <!-- /.modal -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Lý do từ chối</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('auctionreject') }}" method="POST">
              <input type="hidden" name="auction_id" value="{{ $auction[0]["auction_id"] }}">
              <input type="hidden" name="auction_status_id" value="{{ $auction[0]["auction_status"]["auction_status_id"] }}">
              <div class="card-body">
                <div class="modal-body">
                  <textarea class="form-control" aria-label="With textarea" name="reason" id="reason"></textarea>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Gửi</button>
              </div>
              @csrf
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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

        $('.toastrDefaultError').click(function() {
          toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        });
    })
    </script>
@endsection

