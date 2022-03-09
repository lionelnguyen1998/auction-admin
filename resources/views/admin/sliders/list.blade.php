@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>スライダー一覧</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
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
                <h3 class="card-title">スライダー一覧</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <a style="color:white"   href="{{ route('createSlider') }}">
                    <button type="button" class="btn btn-block btn-success" style="margin-bottom:10px; width:150px">
                      追加
                    </button>
                  </a>
                  <thead>
                  <tr>
                    <th>スライダーID</th>
                    <th>テーマ</th>
                    <th>写真</th>
                    <th>&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($sliders as $key => $slider)
                    @php
                    $sliderConst = config('const.typeSlider');
                    $index = $slider["type"];
                    @endphp
                        <tr>
                            <td>{{ $slider["slider_id"] }}</td>
                            <td>{{ $sliderConst[$index] }}</td>
                            <td>
                                <div id="image_show" style="margin-top:10px">
                                    <img src="{{ $slider["image"] }}"  style="max-width:150px; max-height:150px"/>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('editSlider', ['sliderId' => $slider["slider_id"]]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-trash"></i>
                                </a>
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
    
     <!-- /.modal -->
     @if (isset($slider["slider_id"]))
      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" style="color:#F70202"><b>本当に削除しますか？</b></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"></span>&times;</span>
                  </button>
              </div>
              <form action="{{ route('deleteSlider', ['sliderId' => $slider["slider_id"]]) }}" method="GET">
                  <!-- /.card-body -->
                  <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                  <button type="submit" class="btn btn-danger">確認</button>
                  </div>
                  @csrf
              </form>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
    @endif
    <!-- /.content -->
@endsection
