@extends('admin.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách thương hiệu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
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
                <h3 class="card-title">Danh sách thương hiệu</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <button type="button" class="btn btn-block btn-success" style="margin-bottom:10px; width:150px">
                    <a style="color:white" href="create">Thêm thương hiệu</a>
                  </button>
                  <thead>
                  <tr>
                    <th style="width:50px">Brand ID</th>
                    <th>Name</th>
                    <th>Name (En)</th>
                    <th style="width:70px">&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($brands as $key => $brand)
                        <tr>
                            <td>{{ $brand["brand_id"] }}</td>
                            <td>{{ $brand["name"] }}</td>
                            <td>{{ $brand["name_en"] ?? '--' }}</td>
                            <td>
                                <a href="{{ route('editBrand', ['brandId' => $brand["brand_id"]]) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('deleteBrand', ['brandId' => $brand["brand_id"]]) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
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
