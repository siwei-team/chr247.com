@extends('layouts.app')

@section('title',"cmp247 | Register")

@section('content')

    {{--AngularJs Scripts--}}
    <script src="{{asset('plugins/angularjs/angular.min.js')}}"></script>
    <script src="{{asset('js/services.js')}}"></script>
    <script src="{{asset('js/ClinicRegistrationController.js')}}"></script>

    <div class="container-fluid" ng-app="HIS" ng-controller="ClinicRegistrationController">

        <input hidden ng-init="baseUrl='{{url("/")}}';token='{{csrf_token()}}';">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-default wow fadeInUp" data-wow-delay="1s" ng-cloak>
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            Register Clinic
                        </h4>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('registerClinic') }}"
                              ng-controller="ClinicRegistrationController">
                            {!! csrf_field() !!}

                            {{--Error Message--}}
                            @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                                    {{session('error')}}
                                </div>
                            @endif

                            @if($errors->has('terms'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <h4><i class="icon fa fa-ban"></i> Oops!</h4>
                                    {{$errors->first('terms')}}
                                </div>
                            @endif


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Clinic Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address" value="{{old('address')}}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <input type="tel" class="form-control" name="phone" value="{{old('phone')}}">

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Include countries list--}}
                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Country</label>

                                <div class="col-md-6">
                                    <select name="country" class="form-control" ng-model="countryCode"
                                            ng-change="getTimezones()"
                                            ng-init="countryCode='{{old("country")}}';getTimezones()">

                                        <option value="">None</option>
                                        @foreach(App\Lib\Support\Country::$countries as $code=>$country)
                                            <option value="{{$code}}" @if(old('country')===$code) selected @endif>
                                                {{$country}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('timezone') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Timezone</label>

                                <div class="col-md-6">
                                    <select name="timezone" class="form-control" ng-disabled="!countryCode">
                                        <option ng-repeat="timezone in timezones">[[timezone]]</option>
                                    </select>
                                    @if ($errors->has('timezone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('timezone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Currency</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="currency" value="{{old('currency')}}">

                                    @if ($errors->has('currency'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('currency') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            {{--Panel to add an admin--}}
                            <div class="box box-default">
                                <div class="box-body">

                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        <h4><i class="icon fa fa-info"></i> Important!</h4>
                                        An admin account is created when registering a clinic.
                                        Please fill in the preferred admin account username and password.
                                    </div>

                                    <div class="form-group{{ $errors->has('adminName') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Admin's Name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="adminName"
                                                   value="{{old('adminName')}}">
                                            @if ($errors->has('adminName'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('adminName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Admin Username</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="username"
                                                   value="{{old('username')}}">
                                            @if ($errors->has('username'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Password</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password"
                                                   value="{{old('password')}}">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Password Confirmation</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                   value="{{old('password_confirmation')}}">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('terms') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" name="terms"> I hereby agree on cmp247.com's
                                            <a href="#" data-toggle="modal" data-target="#privacyPolicyModal">Privacy
                                                Policy</a> and
                                            <a href="#" data-toggle="modal" data-target="#termsModal">Terms &
                                                Conditions</a>
                                        </label>
                                    </div>
                                    @if ($errors->has('terms'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('terms') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-flat">
                                        <i class="fa fa-btn fa-check"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('auth.modals.privacyPolicy')
    @include('auth.modals.terms')
@endsection
