@extends('admin.main')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $item[0]["name"] }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listItems') }}">{{ __('message.item.list') }}</a></li>
              <li class="breadcrumb-item active">{{ $item[0]["name"] }}</li>
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
                       src="{{ $item[0]["categories"]["image"] }}"
                       alt="{{ $item[0]["categories"]["name"] }}">
                </div>
                <h3 class="text-center">{{ $item[0]["name"] }}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>{{ __('message.item.category') }}</b> <p class="float-right">{{ $item[0]["categories"]["name"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>{{ __('message.item.auction') }}</b></b> <p class="float-right">{{ $item[0]["auctions"]["title"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>{{ __('message.item.first_price') }}</b> <p class="float-right">{{ number_format($item[0]["starting_price"])}} {{ __('message.item.money') }}</p>
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
                  <li class="nav-item"><a class="nav-link active" href="#item" data-toggle="tab">{{ __('message.item.info') }}</a></li>
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
                                    $avatar = $item[0]["users"]["avatar"]
                                @endphp
                                <img class="img-circle img-bordered-sm" src="{{ $avatar }}" alt="User Image">
                                <span class="username">
                                    <p href="#">{{ $item[0]["users"]["name"] }}</p>
                                </span>
                                <span class="description">{{ date("d-m-Y H:i", strtotime($item[0]['updated_at'])) }}</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row mb-3">
                                <div class="col-12 col-sm-12">
                                <div class="col-12">
                                  <img @if(isset($images[0])) src="{{ $images[0] }}" @else src="adafs" @endif class="product-image" alt="Product Image">
                                </div>
                                <div class="col-12 product-image-thumbs">
                                  @foreach($images as $key => $image)
                                    <div class="product-image-thumb"><img src="{{ $image }}" alt="Product Image"></div>
                                  @endforeach
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                <h3>{{ __('message.item.info') }}</h3>
                                <p>{{ __('message.item.name') }}: {{ $item[0]["name"] }}</p>
                                <p>{{ __('message.item.brand') }}: {{ $item[0]["brands"]["name"] }}</p>
                                <p>{{ __('message.item.series') }}: {{ $item[0]["series"] ?? '--' }}</p>
                                <p style="white-space:pre-line">{{ __('message.item.des') }}: {{ $item[0]["description"] }}</p>
                                <hr>
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
    </script>
@endsection

