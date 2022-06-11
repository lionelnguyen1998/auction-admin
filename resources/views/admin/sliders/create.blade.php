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
            <h1>@if (isset($slider)) {{ __('message.slider.edit')}} @else {{ __('message.slider.add_page')}} @endif</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listSliders') }}">{{ __('message.slider.list')}}</a></li>
              <li class="breadcrumb-item active">@if(isset($slider)) {{ __('message.slider.edit')}} @else {{ __('message.slider.add_page')}} @endif</li>
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
              <form @if(isset($slider)) action="{{ route('updateSlider') }}" @else action="{{ route('insertSlider') }}" @endif method="POST">
                <div class="card-body" style="width:70%;margin-left:15%">
                  @if (isset($slider))
                    @method('PUT')
                    <input type="hidden" value="{{ $slider[0]['slider_id'] }}" name="slider_id"/>
                  @endif
                  <div class="form-group">
                    <label for="image">{{ __('message.slider.image')}}</label>
                    <div class="input-group">
                        <input type="file" style="margin-bottom:5px" class="form-control" id="upload" value="{{ old('thumb') }}">
                        <input type="hidden" name="thumb" id="thumb" @if (isset($slider)) value="{{$slider[0]['image']}}" @else value="{{ old('thumb') }}" @endif>
                    </div>
                    <div id="image_show" style="margin-top:10px">
                        @if (isset($slider[0]['image']))
                          <img src="{{ $slider[0]['image'] }}"  style="max-width:150px; max-height:150px"/>
                        @endif
                    </div>
                    @if($errors->has('thumb'))
                      <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('thumb')}}</label><br/>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ __('message.slider.type')}}</label>
                    <select class="form-control select2" style="width: 100%;" name="type">
                    @if (isset($slider[0]['type']))
                      @php
                      $sliderConst = __('message.typeSlider');
                      $index = $slider[0]['type'];
                      @endphp
                      <option selected="selected" hidden value="{{ $index }}">{{ $sliderConst[$index] }}</option>
                      @foreach ($sliderConst as $key => $type)
                          <option value="{{ $key }}">{{ $type }}</option>
                      @endforeach
                    @else 
                      @foreach (__('message.typeSlider') as $key => $type)
                          <option selected="selected" value="{{ $key }}">{{ $type }}</option>
                      @endforeach
                    @endif
                    </select>
                    @if($errors->has('type'))
                      <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('type')}}</label><br/>
                    @endif
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer" style="width:100%">
                  <button type="submit" class="btn btn-primary float-right">@if (isset($slider)) {{ __('message.button.edit')}} @else {{ __('message.button.send')}} @endif</button>
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
