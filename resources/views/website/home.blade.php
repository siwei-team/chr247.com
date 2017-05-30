@extends("layouts.website.layout")

@section("content")
    <!-- ========== HEADER ========== -->
    <header class="header main-header header-style-2" id="header-animated">
        <div class="primary-trans-bg">
            <div class="container">
                <!-- For centering the content vertically -->
                <div class="outer">
                    <div class="inner text-center">
                        <h1 class="white-color">医疗信息云平台</h1>
                        <h5 class="">安全 | 简单 | 实用</h5>
                        <a href="{{route('registerClinic')}}" class="btn se-btn-white btn-rounded">
                            立即免费使用
                        </a>
                    </div> <!-- end inner -->
                </div> <!-- end outer -->
            </div> <!-- end container -->
        </div> <!-- end primary-trans-bg -->
    </header>

    <!-- ========== FEATURE INTRO ========== -->
    <section class="se-section">
        <div class="container">
            <div class="row">
                <div class="container-fluid col-md-12">
                    <h2 class="underline mtn">5分钟了解cmp247 ...</h2>
                    <!-- 16:9 aspect ratio -->
                    <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            {{--<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/02_pjKzW0cY"--}}
                                    {{--allowfullscreen></iframe>--}}
                        </div>

                        <div class="text-center">
                            <a href="{{route("registerClinic")}}" class="btn se-btn-black btn-rounded"
                               style="margin-top: 10px">
                                使用我们的服务
                            </a>
                        </div>
                    </div>
                </div> <!-- end col-md-8 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>


    <!-- ========== FEATURES ========== -->
    <section class="se-section features-section">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3 col-sm-3 col-xs-12 se-feature">
                    <i class="icon ion-earth"></i>
                    <h5>100％免费！</h5>
                    <p>
                        享受所有医生每天需要免费的所有标准功能！
                    </p>
                    <ul>
                        <li>
                            <p><i class="icon ion-android-done" style="font-size: 16px"></i>  没有试用期</p>
                        </li>
                        <li>
                            <p><i class="icon ion-android-done" style="font-size: 16px"></i> 没有隐藏的费用</p>
                        </li>
                        <li>
                            <p><i class="icon ion-android-done" style="font-size: 16px"></i> 没有合同</p>
                        </li>
                    </ul>
                </div> <!-- end se-feature -->

                <div class="col-md-3 col-sm-3 col-xs-12 se-feature">
                    <i class="icon ion-android-checkmark-circle"></i>
                    <h5>安全</h5>
                    <p>
                        所有记录都受SSL端到端加密保护，因此只能由您和您授予访问权限的用户访问。
                    </p>
                </div> <!-- end se-feature -->

                <div class="col-md-3 col-sm-3 col-xs-12 se-feature">
                    <i class="icon ion-settings"></i>
                    <h5>设置简单</h5>
                    <p>用户不需要安装，更新或维护。我们会为你做所有这一切。一旦您的帐户获得批准，您可以立即开始使用系统。 </p>
                </div> <!-- end se-feature -->

                <div class="col-md-3 col-sm-3 col-xs-12 se-feature">
                    <i class="icon ion-cloud"></i>
                    <h5>访问方便</h5>
                    <p>
                        整个系统都运行在云技术上，所以您可以随时随地安全地访问您的记录。所有您需要的是电脑，平板电脑或智能手机和互联网连接。
                    </p>
                </div> <!-- end se-feature -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>

    <!-- ========== STEPS ========== -->
    <section class="se-section se-steps">
        <div class="container">
            <div class="row text-center">
                <h3 class="underline mtn">使用流程</h3>
            </div> <!-- end row -->

            <div class="row">
                <div class="col-md-4 col-sm-4 one-step">
                    <h4>注册</h4>
                    <p>让我们了解有关您的诊所或私人执业的一些信息，我们将在24小时内与您联系以验证您的帐户。 </p>
                </div>

                <div class="col-md-4 col-sm-4 one-step">
                    <h4>添加用户</h4>
                    <p>一旦您的帐户设置完成，您可以登录并添加医生和护士，以授予他们对系统的访问权限。 </p>
                </div>

                <div class="col-md-4 col-sm-4 one-step">
                    <h4>免费享受CMP247</h4>
                    <p>所有的用户都可以登录到云端，每天使用系统！</p>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>

    <!-- ========== FEATURES ========== -->
    <section class="se-section features-section parallax-bg" data-parallax="scroll"
             data-image-src="{{asset('FrontTheme/images/bg-img-3.jpg')}}"
             data-speed="0.4">
        <div class="black-gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 se-feature-style-2 mb60">
                        <div class="left">
                            <i class="icon ion-ios-monitor-outline"></i>
                        </div>
                        <div class="right">
                            <h5>在任何设备上工作</h5>
                            <p>该系统适用于任何具有网络浏览器和互联网连接的设备。</p>
                        </div>
                    </div> <!-- end se-feature -->

                    <div class="col-md-6 col-sm-6 se-feature-style-2 mb60">
                        <div class="left">
                            <i class="icon ion-ios-infinite-outline"></i>
                        </div>
                        <div class="right">
                            <h5>永久更新</h5>
                            <p>一旦发布，所有用户的所有更新都可用。</p>
                        </div>
                    </div> <!-- end se-feature -->

                    <div class="col-md-6 col-sm-6 se-feature-style-2 mb60">
                        <div class="left">
                            <i class="icon ion-ios-bolt-outline"></i>
                        </div>
                        <div class="right">
                            <h5>闪电快</h5>
                            <p>该系统在工业级云服务器上运行时总是闪电般快速。</p>
                        </div>
                    </div> <!-- end se-feature -->

                    <div class="col-md-6 col-sm-6 se-feature-style-2 mb60">
                        <div class="left">
                            <i class="icon ion-ios-paper-outline"></i>
                        </div>
                        <div class="right">
                            <h5>完善的文档</h5>
                            <p>该文档是整个系统的完整指南，对初学者和高级用户有用。
                            </p>
                        </div>
                    </div> <!-- end se-feature -->

                    <div class="col-md-6 col-sm-6 se-feature-style-2">
                        <div class="left">
                            <i class="icon ion-ios-checkmark-empty"></i>
                        </div>
                        <div class="right">
                            <h5>轻量化</h5>
                            <p>该系统经过优化，可在低带宽条件下运行。
                            </p>
                        </div>
                    </div> <!-- end se-feature -->

                    <div class="col-md-6 col-sm-6 se-feature-style-2">
                        <div class="left">
                            <i class="icon ion-ios-world-outline"></i>
                        </div>
                        <div class="right">
                            <h5>多语言支持</h5>
                            <p>Hello ~ 你好 ~ Привіт
                            </p>
                        </div>
                    </div> <!-- end se-feature -->

                </div> <!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end black-gradient -->
    </section> <!-- end features-section -->
@endsection