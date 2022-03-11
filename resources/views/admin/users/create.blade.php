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
            <h1>@if (isset($user)) ユーザー編集 @else ユーザー追加 @endif</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('listUser') }}">ユーザー一覧</a></li>
              <li class="breadcrumb-item active">@if(isset($user)) ユーザー編集 @else ユーザー追加 @endif</li>
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
                                    <label for="name"><b>名前  </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="text" class="form-control size-119" name="name" @if (isset($user)) value="{{$user["name"]}}" @else value="{{ old('name') }}" @endif placeholder="名前を入力してください"/>
                                    @if($errors->has('name'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('name')}}</label><br/>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="nick_name"><b>ニックネーム  </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="text" class="form-control size-119" name="nick_name" @if (isset($user)) value="{{$user["nick_name"]}}" @else value="{{ old('nick_name') }}" @endif placeholder="ニックネームを入力してください" />
                                    @if($errors->has('nick_name'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('nick_name')}}</label><br/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="email"><b>メールアドレス  </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="email" class="form-control size-119" name="email" @if (isset($user)) value="{{$user["email"]}}" @else value="{{ old('email') }}" @endif placeholder="メールを入力してください"/>
                                    @if($errors->has('email'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('email')}}</label><br/>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="password"><b>パスワード  </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="password" class="form-control size-119" name="password" @if (isset($user)) value="{{ substr(strip_tags($user['password']), 0, 8) }}" @endif placeholder="パスワードを入力してください"/>
                                    @if($errors->has('password'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('password')}}</label><br/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="phone"><b>電話番号 </b><i class="fa fa-asterisk" aria-hidden="true" style="color: red"></i></label>
                                    <input type="text" class="form-control size-119" name="phone" @if (isset($user)) value="{{$user["phone"]}}" @else value="{{ old('phone') }}" @endif placeholder="電話番号を入力してください"/>
                                    @if($errors->has('phone'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('phone')}}</label><br/>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="address"><b>住所  </b></label>
                                    <input type="text" class="form-control size-119" name="address" @if (isset($user)) value="{{$user["address"]}}" @else value="{{ old('address') }}" @endif placeholder="住所を入力してください"/>
                                    @if($errors->has('address'))
                                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('address')}}</label><br/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar">写真</label>
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
                          <label>役割</label>
                          <select class="form-control select2" style="width: 100%;" name="role">
                          @if (isset($user["role"]))
                            @php
                            $roleConst = config('const.role');
                            $index = $user["role"];
                            @endphp
                            <option selected="selected" hidden value="{{ $index }}">{{ $roleConst[$index] }}</option>
                            @foreach (config('const.role') as $key => $role)
                              <option value="{{ $key }}">{{ $role }}</option>
                            @endforeach
                          @else 
                            @foreach (config('const.role') as $key => $role)
                              <option selected="selected" value="{{ $key }}">{{ $role }}</option>
                            @endforeach
                          @endif
                          </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer" style="width:100%">
                    <button type="submit" class="btn btn-primary float-right">@if (isset($user)) 編集 @else 送信 @endif</button>
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
