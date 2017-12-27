@extends('../sites/master')

@section('content')
    @include('sites._include.navbar')
    @include('sites._include.banner')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12 row">
                        @if ($errors->has('id'))
                            <span class="alert alert-warning " role="alert">
                                <strong>{{ $errors->first('id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <form class='login' class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12"><label for="email" class="control-label"><strong>Tên đăng nhập (Email)</strong></label></div>

                            <div class="col-md-6">
                                <input  id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder='Ví dụ: customer_20171010_031023@medicine.com'>                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12"><label for="password" ><strong>Mật khẩu (Số điện thoại)</strong></label></div>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Ví dụ: 0987898213">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ghi nhớ
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Đăng nhập
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
  {{ Html::style('css/sites/gioithieu.css') }}
  {{ Html::style('css/sites/_include/navbar.css') }}
  {{ Html::style('css/sites/_include/footer.css') }}
  {{ Html::style('css/sites/_include/banner.css') }}
@endsection
