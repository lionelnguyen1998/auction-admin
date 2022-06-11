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
            <h1>{{ __('message.category.edit') }}</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listCategories') }}">{{ __('message.category.list') }}</a></li>
              <li class="breadcrumb-item active">{{ __('message.category.edit') }}</li>
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
              <form action="{{ route('updatecategory') }}" method="POST">
                <input type="hidden" name="category_id" value="{{ $category['category_id'] }}">
                <div class="card-body" style="width:70%;margin-left:15%">
                  <div class="form-group">
                      <label for="image">{{ __('message.category.image') }}</label>
                      <div class="input-group">
                          <input type="file" style="margin-bottom:5px" class="form-control" id="upload" value="{{ old('thumb') ?? $category['image'] }}">
                          <input type="hidden" name="thumb" id="thumb" value="{{ old('thumb') ?? $category['image'] }}">
                      </div>
                      <div id="image_show" style="margin-top:10px">
                      @if (isset($category['image']))
                      <img src="{{ $category['image'] }}"  style="max-width:150px; max-height:150px"/>
                      @endif
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="name">{{ __('message.category.name') }} <i class="fa fa-asterisk" aria-hidden="true" style="color:red"></i></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('message.category.name_input') }}" value="{{ old('name') ?? $category['name'] }}">
                    @if($errors->has('name'))
                    <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name')}}</label><br/>
                    @endif
                  </div>

                  <div class="form-group">
                    @php
                    $categoryParent = __('message.categoryType');
                    $index = $category["type"];
                    @endphp
                      <label>{{ __('message.category.type') }}</label>
                      <select class="form-control select2" style="width: 100%;" name="type">
                      <option selected="selected" hidden value="{{ $index }}">{{ $categoryParent[$index] }}</option>
                      @foreach ($categoryParent as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                      @endforeach
                      </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width:100%">
                  <button type="submit" class="btn btn-primary float-right">{{ __('message.button.edit') }}</button>
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
