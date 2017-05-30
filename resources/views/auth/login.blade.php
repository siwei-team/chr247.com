@extends("layouts.website.layout")

@section("title",'cmp247.com | Sign In')

@section("content")

    <!-- ========== PAGE TITLE ========== -->
    <header class="header page-title">
        <div class="container">
            <!-- For centering the content vertically -->
            <div class="outer">
                <div class="inner text-center">
                    <h1 class="">请登录您的账号</h1>
                </div> <!-- end inner -->
            </div> <!-- end outer -->
        </div> <!-- end container -->
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2 form-wrap">
                <div class="text-center logo-wrap">
                    <a href="{{url("/")}}"><img src="{{asset('logo.png')}}" alt="CHR24x7" width="125"></a>
                </div> <!-- end text-center -->

                <form action="{{url('login')}}" method="post">

                    {!! csrf_field() !!}

                    {{--Success Message--}}
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                            <h4><i class="icon fa fa-check"></i> 登录成功!</h4>
                            {{session('success')}}
                        </div>
                    @endif

                    {{-- General error message --}}
                    @if ($errors->has('general'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                            <h4><i class="icon fa fa-ban"></i> 警告!</h4>
                            {{ $errors->first('general') }}
                        </div>
                    @endif

                    <div class="form-group col-md-12 has-feedback {{ $errors->has('username') ? 'has-error' : '' }}">
                        <label for="username">用户名</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                               value="{{ old('username') }}">
                        @if ($errors->has('username'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif
                    </div> <!-- end form-group -->
                    <div class="form-group col-md-12 has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">密码</label>
                        <input type="password" class="form-control" name="password" placeholder="Password"
                               value="{{old('password')}}">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div> <!-- end form-group -->

                    <div class="text-center col-md-12 mt10 mb20">
                        <button type="submit" class="btn se-btn btn-rounded">登录</button>
                    </div> <!-- end text-center -->
                </form> <!-- end form -->

                <div class="col-sm-6">
                    <p class="text-muted"><a href="{{ url('/password/reset') }}">忘记密码?</a></p>
                </div>

                <div class="col-sm-6 text-right">
                    <p class="text-muted mbn">
                        还没有账号? <a href="{{route('registerClinic')}}">点此注册!</a>
                    </p>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->

@endsection