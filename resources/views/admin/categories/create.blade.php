@extends('admin.main')

@section('content')
<style>
  .input-group .form-control {
    height: 44px !important;
  }
</style>
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>{{ __('message.category.add_page') }}</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listCategories') }}">{{ __('message.category.list') }}</a></li>
              <li class="breadcrumb-item active">{{ __('message.category.add_page') }}</li>
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
              <!-- form start -->
              <form action="{{ route('insertcategories') }}" method="POST">
                <div class="card-body" style="width:70%;margin-left:15%">
                  <div class="form-group">
                    <label for="image">{{ __('message.category.image') }}</label>
                    <div class="input-group">
                        <input type="file" style="margin-bottom:5px" class="form-control" id="upload" value="{{ old('thumb') }}">
                        <input type="hidden" name="thumb" id="thumb" value="{{ old('thumb') }}">
                    </div>
                    <div id="image_show" style="margin-top:10px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">{{ __('message.category.name') }} <i class="fa fa-asterisk" aria-hidden="true" style="color:red"></i></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('message.category.name_input') }}" value="{{ old('name') }}">
                    @if($errors->has('name'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name')}}</label><br/>
                    @endif
                  </div>
                  <div class="form-group">
                      <label>{{ __('message.category.type') }}</label>
                      <select class="form-control select2" style="width: 100%;" name="type">
                      @foreach (__('message.categoryType') as $key => $category)
                        <option selected="selected" value="{{ $key }}">{{ $category }}</option>
                      @endforeach
                      </select>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width:100%">
                  <button type="submit" class="btn btn-primary float-right">{{ __('message.button.send') }}</button>
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
