@extends("layouts.website.layout")

@section("title",'cmp247.com | Features')

@section("content")

    <!-- ========== PAGE TITLE ========== -->
    <header class="header page-title">
        <div class="container">
            <!-- For centering the content vertically -->
            <div class="outer">
                <div class="inner text-center">
                    <h1 class="">cmp247.com 提供什么?</h1>
                    <h5 class="">cmp247.com提供简单易用的界面来处理小规模诊所的日常任务，包括患者管理和库存管理。</h5>
                    <a href="{{route("registerClinic")}}" class="btn se-btn-black btn-rounded mt20">现在注册</a>

                </div> <!-- end inner -->
            </div> <!-- end outer -->
        </div> <!-- end container -->
    </header>

    <!-- ========== FEATURE INTRO ========== -->
    <section class="se-section">
        <div class="container">
            <div class="row">
                <div class="container-fluid col-md-12">
                    <h2 class="underline mtn">五分钟了解CMP247</h2>
                    <!-- 16:9 aspect ratio -->
                    <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/02_pjKzW0cY"
                                    allowfullscreen></iframe>
                        </div>

                        <div class="text-center">
                            <a href="{{route("registerClinic")}}" class="btn se-btn-black btn-rounded"
                               style="margin-top: 10px">
                                加入我们的服务
                            </a>
                        </div>
                    </div>
                </div> <!-- end col-md-8 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>

    <!-- ========== LIST OF FEATURES ========== -->
    <section class="se-section" id="detailedFeatures">
        <div class="container">
            <div class="row">
                <h2 class="underline mtn">详细功能</h2>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 se-feature-style-3">
                    <div class="feature-wrap">
                        <i class="icon ion-happy-outline"></i>
                        <h5>病例管理</h5>
                        <p>管理所有患者记录，包括处方和过去的病历。随时随地访问患者信息。</p>
                    </div> <!-- end feature-wrap -->
                </div> <!-- end se-feature-style-3 -->

                <div class="col-md-4 col-sm-6 col-xs-12 se-feature-style-3">
                    <div class="feature-wrap">
                        <i class="icon ion-android-list"></i>
                        <h5>药品库存</h5>
                        <p>管理所有的药物和他们的库存。低库存报警。</p>
                    </div> <!-- end feature-wrap -->
                </div> <!-- end se-feature-style-3 -->

                <div class="col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 col-xs-12 se-feature-style-3">
                    <div class="feature-wrap">
                        <i class="icon ion-android-person-add"></i>
                        <h5>排号管理</h5>
                        <p>通过发出号码来管理诊所的病人排号。随着患者的进入，出现更新排号队列。</p>
                    </div> <!-- end feature-wrap -->
                </div> <!-- end se-feature-style-3 -->
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 se-feature-style-3">
                    <div class="feature-wrap">
                        <i class="icon ion-alert-circled"></i>
                        <h5>访问级别</h5>
                        <p>有三个级别的访问。医生，护士和系统管理员。所以，不需要担心任何机密信息被暴露出来。</p>
                    </div> <!-- end feature-wrap -->
                </div> <!-- end se-feature-style-3 -->

                <div class="col-md-4 col-sm-6 col-xs-12 se-feature-style-3">
                    <div class="feature-wrap">
                        <i class="icon ion-android-checkmark-circle""></i>
                        <h5>安全性和便携性</h5>
                        <p>我们正在使用尖端技术来确保您的数据安全，同时通过允许您从任何地方安全访问数据，为访问您的信息提供了非常必要的灵活性。</p>
                    </div> <!-- end feature-wrap -->
                </div> <!-- end se-feature-style-3 -->

                <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-12 se-feature-style-3">
                    <div class="feature-wrap">
                        <i class="icon ion-android-clipboard"></i>
                        <h5>问题和打印处方</h5>
                        <p>向患者发放处方，并直接从系统打印。</p>
                    </div> <!-- end feature-wrap -->
                </div> <!-- end se-feature-style-3 -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>

@endsection