@extends('admin.main')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $auction[0]["title"] }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listAuctionsIsWait') }}">{{__('message.auctions_wait.list')}}</a></li>
              <li class="breadcrumb-item active">{{ $auction[0]["title"] }}</li>
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
                <h3 class="text-center">{{ $auction[0]["title"] }}</h3>
                <p class="text-muted text-center">{{ $auction[0]["category"]["name"] }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>{{__('message.detail.start_date')}}</b> <p class="float-right">{{ $auction[0]["start_date"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>{{__('message.detail.end_date')}}</b> <p class="float-right">{{ $auction[0]["end_date"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>{{__('message.detail.first_price')}}</b> 
                    @if (isset($auction[0]["items"][0]))
                      <p class="float-right">{{ number_format($auction[0]["items"][0]["starting_price"]) }} {{__('message.detail.money')}}</p>
                    @else
                      <p class="float-right"></p>
                    @endif
                  </li>
                  @php
                    $status = config('const.status');
                    $index = $auction[0]['status'];
                  @endphp
                  @if ($index == 4)
                    <li class="list-group-item">
                      <a class="btn btn-success" style="color:white" data-toggle="modal" data-target="#modal-accept">{{__('message.auctions_wait.accept')}}</a>  
                      <p class="float-right">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-deny">
                        {{__('message.auctions_wait.deny')}}
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
                  <li class="nav-item"><a class="nav-link active" href="#item" data-toggle="tab">{{__('message.detail.item_detail')}}</a></li>
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
                                    <p href="#">{{ $userSelling[0]["users"]["name"] }}</p>
                                </span>
                                <span class="description">{{ date("d-m-Y H:i", strtotime( $auction[0]['updated_at'] )) }}</span>
                            </div>
                            
                            @if (isset($item))
                              <div class="row mb-3">
                                  <div class="col-12 col-sm-12">
                                    <div class="col-12">
                                        <img @if(isset($images[0])) src="{{ $images[0] }}" @else src="" @endif class="product-image" alt="Product Image" style="width: 60%; margin-left: 22%">
                                    </div>
                                    <div class="col-12 product-image-thumbs">
                                      @if (isset($images))
                                        @foreach($images as $key => $image)
                                          <div class="product-image-thumb"><img src="{{ $image }}" alt="Product Image"></div>
                                        @endforeach
                                      @endif
                                    </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-sm-12">
                                  <h3>{{__('message.detail.item_detail')}}</h3>
                                  <p>{{__('message.detail.item_name')}}: {{ $item[0]["name"] }}</p>
                                  <p>{{__('message.detail.brand')}}: {{ $item[0]["brands"]["name"] }}</p>
                                  <p>{{__('message.detail.series')}}: {{ $item[0]["series"] ?? '--' }}</p>
                                  <p style="white-space:pre-line">{{__('message.detail.des')}}: {{ $item[0]["description"] }}</p>
                                  <hr>
                                  </div>
                              </div>
                            @else 
                              <div class="row mb-3">
                                  <p>{{__('message.auctions_wait.no_item')}}</p>
                              </div>
                            @endif
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
      <!-- /.modal deny-->
      <div class="modal fade" id="modal-deny">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="color:#F70202"><b>{{__('message.modal.deny')}}</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('auctionreject') }}" method="POST">
              <input type="hidden" name="auction_id" value="{{ $auction[0]["auction_id"] }}">
              <div class="card-body">
                <div class="modal-body">
                  <textarea class="form-control" aria-label="With textarea" name="reason" id="reason"></textarea>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('message.modal.cancel')}}</button>
                <button type="submit" class="btn btn-primary">{{__('message.modal.confirm')}}</button>
              </div>
              @csrf
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

       <!-- /.modal accept-->
       <div class="modal fade" id="modal-accept">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="color:#F70202"><b>{{__('message.modal.accept')}}</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('message.modal.cancel')}}</button>
                <a href="{{ route('acceptAuction', ['auctionId' => $auction[0]["auction_id"]]) }}" class="btn btn-primary">{{__('message.modal.confirm')}}</a>
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

