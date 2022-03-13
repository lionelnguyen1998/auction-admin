@extends('admin.main')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $auction[0]["title"] }}の詳細</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listAuctions') }}">オークション一覧</a></li>
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
                    <b>始める時間</b> <p class="float-right">{{ $auction[0]["start_date"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>終わる時間</b> <p class="float-right">{{ $auction[0]["end_date"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>始値</b> <p class="float-right">{{ $auction[0]["items"][0]["starting_price"] }}</p>
                  </li>
                  <li class="list-group-item">
                    <b>最後値段</b> <p class="float-right">{{ $maxPrice }}</p>
                  </li>
                  <li class="list-group-item">
                    @php
                        $status = config('const.status');
                        $index = $auction[0]['auction_status']['status'];
                    @endphp
                    @if ($index == 1)
                        <p class="btn btn-success" disabled>{{ $status[$index] }}</p>
                    @elseif ($index == 2)
                        <p class="btn btn-warning" disabled>{{ $status[$index] }}</p>
                    @else
                        <p class="btn btn-danger" disabled>{{ $status[$index] }}</p>
                    @endif
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
                  <li class="nav-item"><a class="nav-link active" href="#item" data-toggle="tab">アイテムの情報</a></li>
                  <li class="nav-item"><a class="nav-link" href="#bid" data-toggle="tab">値段</a></li>
                  <li class="nav-item"><a class="nav-link" href="#comment" data-toggle="tab">コメントする</a></li>
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
                                <span class="description">{{ date("d-m-Y H:i", strtotime($userSelling[0]['updated_at'])) }}</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row mb-3">
                                <div class="col-12 col-sm-12">
                                  <div class="col-12">
                                      <img @if(is_null($images)) src="{{ $images[0] }}" @else src="adafs" @endif class="product-image" alt="Product Image">
                                  </div>
                                  <div class="col-12 product-image-thumbs">
                                    @if (is_null($images))
                                      @foreach($images as $key => $image)
                                        <div class="product-image-thumb"><img src="{{ $image }}" alt="Product Image"></div>
                                      @endforeach
                                    @endif
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                <h3>アイテムの情報</h3>
                                <p>{{ $userSelling[0]["description"] }}</p>
                                <hr>
                                <h4>技術の情報</h4>
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
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="bid">
                    <!-- Post -->
                    @foreach ($bids as $key => $bid)
                    @php 
                        $avatar = $bid['users']['avatar']
                    @endphp
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ $avatar }}" alt="user image">
                        <span class="username">
                          <p>{{ $bid['users']['name'] }}</p>
                        </span>
                        <span class="description">{{ date("d-m-Y H:i", strtotime($bid['updated_at'])) }}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        {{ $bid['price'] }}
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> シェア</a>
                        <a href="#" class="link-black text-sm mr-2"><i class="far fa-thumbs-up mr-1"></i> いいね</a>
                        <a href="{{ route('deleteBid', ['bidId' => $bid['bid_id']]) }}" class="link-black text-sm"><i class="fas fa-trash mr-1"></i> 削除</a>
                      </p>
                    </div>
                    @endforeach
                    <!-- /.post -->
                  </div>
                  
                  <div class="tab-pane" id="comment">
                    <!-- Post -->
                    @foreach ($comments as $key => $comment)
                    @php 
                        $avatar = $comment['users']['avatar']
                    @endphp
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ $avatar }}" alt="user image">
                        <span class="username">
                          <p>{{ $comment['users']['name'] }}</p>
                        </span>
                        <span class="description">{{ date("d-m-Y H:i", strtotime($comment['updated_at'])) }}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        {{ $comment['content'] }}
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> シェア</a>
                        <a href="#" class="link-black text-sm mr-2"><i class="far fa-thumbs-up mr-1"></i> いいね</a>
                        <a href="{{ route('deleteComment', ['commentId' => $comment['comment_id']]) }}" class="link-black text-sm"><i class="fas fa-trash mr-1"></i> 削除</a>
                      </p>
                    </div>
                    @endforeach
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

