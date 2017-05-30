<!doctype html>
<html class="no-js" lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- ========== VIEWPORT META ========== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- ========== PAGE TITLE ========== -->
    <title>@yield("title",'cmp247.com | Cloud Health Records 24x7')</title>

    <meta name="description"
          content="The simplest Health Informatics System on the Cloud. For small scale clinics.
          100% Free! ZERO-Paper Policy!">
    <meta name="keywords"
          content="emr, his, health informatics, health cloud, cloud health records, clinic, patient management">
    <meta name="author" content="cmp247.com">

    <!-- ========== FAVICON & APPLE ICONS ========== -->
    <link rel="shortcut" href="{{asset('favicon.ico')}}"/>
    <link rel="apple-touch-icon" href="{{asset('FrontTheme/images/apple-touch-icon.png')}}">

    <!-- ========== MINIFIED VENDOR CSS ========== -->
    <link rel="stylesheet" href="{{asset('FrontTheme/styles/vendor.css')}}">
    <link rel="stylesheet" href="{{asset('FrontTheme/styles/main.css')}}">

    <!-- ========== MODERNIZR ========== -->
    <script src="{{asset('FrontTheme/scripts/vendor/modernizr.js')}}"></script>
</head>

<!-- ========== BODY ==========
.light-header: for light colored header
.dark-header: for dark colored header
==========  ========== -->
<body class="@if(Request::url()===url('/')) light-header @else dark-header @endif animsition">

<!-- ========== NAVIGATION ========== -->
<nav class="navbar yamm navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> <!-- end navbar-toggle -->
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('logo-white.png')}}" alt="CHR 24x7" style="width: 76px;height: 45px;"
                     class="light-logo img-responsive">
                <img src="{{asset('logo.png')}}" alt="CHR 24x7" style="width: 49px;height: 29.5px;"
                     class="dark-logo">
            </a> <!-- end navbar-brand -->
        </div> <!-- end navbar-header -->

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav pull-right">
                <li>
                    <a href="{{url('/')}}">主页 </a>
                </li>
                <li>
                    <a href="{{url('/web/features')}}">功能</a>
                </li>
                <li>
                    <a href="{{url('/web/privacyPolicy')}}">隐私条款</a>
                </li>
                {{--<li><a href="{{url('web/aboutUs')}}">关于我们</a></li>--}}
                <li><a href="{{url('web/contactUs')}}">联系我们</a></li>
                <li class="nav-btn-wrap">
                    <span class="nav-btn">
                        <a href="{{url('login')}}" class="btn se-btn-black btn-rounded">登录</a>
                    </span>
                </li>
            </ul> <!-- end navbar-nav -->

        </div> <!--end nav-collapse -->
    </div> <!-- end container -->
</nav>

@yield("content")
<!-- ========== CTA SECTION ========== -->
<section class="se-section primary-bg">
    <div class="container">
        <div class="row text-center">
            <h3>现在开始创建您的账号！</h3>
            <p>基础功能100%免费</p>
            <a href="{{route('registerClinic')}}" class="btn se-btn-black btn-rounded">注册</a>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>

<!-- ========== FOOTER ========== -->
<footer class="light-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-6">
                <img src="{{asset('FrontTheme/images/logo.png')}}" alt="cmp247.com | Cloud Health Records 24x7"
                     class="footer-logo img-responsive">
            </div>

            <div class="col-md-2 col-sm-3 col-xs-6">
                <h6 class="mtn">主页</h6>
                <ul>
                    <li><a href="{{url("/")}}">主页</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-3 col-xs-6">
                <h6 class="mtn">页面</h6>
                <ul>
                    <li>
                        <a href="{{url('/web/features')}}">功能</a>
                    </li>
{{--                    <li><a href="{{url('web/aboutUs')}}">关于我们</a></li>--}}
                </ul>
            </div>

            <div class="col-md-2 col-sm-3 col-xs-6">
                <h6 class="mtn">其他</h6>
                <ul>
                    <li><a href="{{route('registerClinic')}}">立即注册</a></li>
                    <li><a href="{{url('login')}}">登录</a></li>
                </ul>
            </div>

            <div class="col-md-4 col-sm-8 col-sm-offset-2 col-md-offset-0">
                <h6 class="mtn">联系我们</h6>
                <ul>
                    <li><a href="mailto: support@cmp247.com">support@cmp247.com</a></li>
                </ul>
            </div>
        </div> <!-- end row -->

        <div class="row footer-bottom">
            <div class="col-md-6">
                <p>Copyright &copy; cmp247.com. 2017. All Rights Reserved.</p>
            </div>

            <div class="col-md-6 text-right">
                <h6><a href="#">微信</a></h6>
                <h6><a href="#">微博</a></h6>
                <h6><a href="#">思为新创</a></h6>
                <h6><a href="#">客户端</a></h6>
            </div>
        </div> <!-- end footer-bottom -->
    </div> <!-- end container -->
</footer>


<script src="{{asset('FrontTheme/scripts/vendor.js')}}"></script>
<!-- ========== MINIFIED PLUGINS JS ========== -->
<script src="{{asset('FrontTheme/scripts/plugins.js')}}"></script>
<script src="{{asset('FrontTheme/scripts/main.js')}}"></script>
<script src="{{asset('FrontTheme/scripts/init-animation.js')}}"></script>

{{-- Google Analytics --}}
@include('analytics.googleAnalytics')

</body>

</html>