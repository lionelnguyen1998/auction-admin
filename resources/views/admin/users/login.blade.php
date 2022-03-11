@include('admin.header')
<style>
    .profile-user-img {
        border: none !important;
    }
</style>
<body class="hold-transition login-page">
        <div class="login-box">
        <div class="login-logo">
            <b>ログイン</b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                       src="/template/images/logo.jpg"
                       alt="">
                </div>
                <p class="login-box-msg"></p>
                @include('admin.alert')
                <form action="{{ route('storeAdmin') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="メールを入力してください" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('email'))
                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('email')}}</label><br/>
                    @endif
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <label class="control-label" for="inputError" style="color: red; padding-left: 5px;">{{ $errors->first('password')}}</label><br/>
                    @endif
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    レメンバ
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- /.login-box -->

@include('admin.footer')
