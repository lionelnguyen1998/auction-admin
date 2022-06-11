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
            <h1>@if (isset($user)) {{ __('message.user.edit')}} @else {{ __('message.user.add')}} @endif</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listUser') }}">{{ __('message.user.list')}}</a></li>
              <li class="breadcrumb-item active">@if(isset($user)) {{ __('message.user.edit')}} @else {{ __('message.user.add')}} @endif</li>
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
                <form @if(isset($user)) action="{{ route('updateUser') }}" @else action="{{ route('storeUser') }}" @endif method="POST">
                    <div class="card-body" style="width:70%;margin-left:15%">
                    @if (isset($user))
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $user["user_id"] }}" />
                    @endif
                    <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="name"><b>{{ __('message.user.name')}}  </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="text" class="form-control size-119" name="name" @if (isset($user)) value="{{$user["name"]}}" @else value="{{ old('name') }}" @endif placeholder="{{ __('message.user.name')}}"/>
                                    @if($errors->has('name'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name')}}</label><br/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="email"><b>{{ __('message.user.email')}}  </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="email" class="form-control size-119" name="email" @if (isset($user)) value="{{$user["email"]}}" @else value="{{ old('email') }}" @endif placeholder="{{ __('message.user.email')}}"/>
                                    @if($errors->has('email'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('email')}}</label><br/>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="password"><b>{{ __('message.user.pass')}}  </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="password" class="form-control size-119" name="password" placeholder="{{ __('message.user.pass')}}"/>
                                    @if($errors->has('password'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('password')}}</label><br/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="phone"><b>{{ __('message.user.phone')}} </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="text" class="form-control size-119" name="phone" @if (isset($user)) value="{{$user["phone"]}}" @else value="{{ old('phone') }}" @endif placeholder="{{ __('message.user.input_phone')}}"/>
                                    @if($errors->has('phone'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('phone')}}</label><br/>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="address"><b>{{ __('message.user.address')}}  </b></label>
                                    <input type="text" class="form-control size-119" name="address" @if (isset($user)) value="{{$user["address"]}}" @else value="{{ old('address') }}" @endif placeholder="{{ __('message.user.input_address')}}"/>
                                    @if($errors->has('address'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('address')}}</label><br/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar">{{ __('message.user.avatar')}}</label>
                            <div class="input-group">
                                <input type="file" style="margin-bottom:5px" class="form-control" id="upload" value="{{ old('thumb') }}">
                                <input type="hidden" name="thumb" id="thumb" @if (isset($user)) value="{{$user["avatar"]}}" @else value="{{ old('thumb') }}" @endif>
                            </div>
                            <div id="image_show" style="margin-top:10px">
                              @if (isset($user["avatar"]))
                              <img src="{{ $user["avatar"] }}"  style="max-width:150px; max-height:150px"/>
                              @endif
                            </div>
                        </div>
                        <div class="form-group">
                          <label>{{ __('message.user.role')}}</label>
                          <select class="form-control select2" style="width: 100%;" name="role">
                          @if (isset($user["role"]))
                            @php
                            $roleConst = __('message.role');
                            $index = $user["role"];
                            @endphp
                            <option selected="selected" hidden value="{{ $index }}">{{ $roleConst[$index] }}</option>
                            @foreach (__('message.role') as $key => $role)
                              <option value="{{ $key }}">{{ $role }}</option>
                            @endforeach
                          @else 
                            @foreach (__('message.role') as $key => $role)
                              <option selected="selected" value="{{ $key }}">{{ $role }}</option>
                            @endforeach
                          @endif
                          </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer" style="width:100%">
                    <button type="submit" class="btn btn-primary float-right">@if (isset($user)) {{ __('message.button.edit')}} @else {{ __('message.button.send')}} @endif</button>
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
