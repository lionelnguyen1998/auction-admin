@extends('admin.main')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Chỉnh sửa danh mục sản phẩm</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Chỉnh sửa danh mục sản phẩm</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Chỉnh sửa danh mục sản phẩm</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('updatecategory') }}" method="POST">
                <input type="hidden" name="category_id" value="{{ $category['category_id'] }}">
                <div class="card-body" style="width:70%;margin-left:15%">
                  <div class="form-group">
                    <label for="image">Icon</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image') ?? $category['image'] }}" >
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{ old('name') ?? $category['name'] }}">
                    @if($errors->has('name'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name')}}</label><br/>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="name_en">Name (En)</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nhập tên Tiếng Anh" value="{{ old('name_en') ?? $category['name_en'] }}">
                    @if($errors->has('name_en'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name_en')}}</label><br/>
                    @endif
                  </div>
                  <h5>Danh mục kỹ thuật (lưu vào bảng category_values)</h5>
                  <div class="form-group">
                    <label for="name_values"></label>
                    <input type="text" class="form-control" id="name_values" name="name_values" placeholder="Nhập giá trị">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width:100%">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
                @csrf
              </form>
            </div>
          </div>
          <!-- right column -->
        </div>
        <!-- /.row -->
      </div>
    </section>
@endsection
