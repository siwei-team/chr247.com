@extends("layouts.website.layout")

@section("title",'cmp247.com | Contact Us')

@section("content")
    <!-- ========== PAGE TITLE ========== -->
    <header class="header page-title">
        <div class="container">
            <!-- For centering the content vertically -->
            <div class="outer">
                <div class="inner text-center">
                    <h1 class="">联系我们</h1>
                    <h5 class="">我们会尽快回复你</h5>
                    <a href="{{route("registerClinic")}}" class="btn se-btn-black btn-rounded mt20">现在注册</a>

                </div> <!-- end inner -->
            </div> <!-- end outer -->
        </div> <!-- end container -->
    </header>

    <!-- ========== CONTACT US FORM ========== -->
    <section class="se-section">
        <div class="container">
            <div class="row">
                <form class="col-md-9 col-sm-6" action="{{route('contactUs')}}" method="post" id="form">
                    {{csrf_field()}}
                    <h2 class="underline mtn">联系我们</h2>
                    <p>
                        我们重视您的意见和建议，进一步改进！
                        <strong>请向我们发送有关您的联系方式的消息，我们会联系你您</strong>
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                            <i class="icon fa fa-ban"></i> 请正确输入信息.
                        </div>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                            </button>
                            <i class="icon fa fa-check"></i> {{session('success')}}
                        </div>
                    @endif

                    <div class="form-group col-md-6 col-xs-12">
                        <label for="name">名字</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name ..."
                               value="{{old('name')}}" required>
                    </div> <!-- end form-group -->
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="contact">联系电话</label>
                        <input type="tel" class="form-control" id="contact" name="contact"
                               placeholder="With country code ..." value="{{old('contact')}}"
                               required="">
                    </div> <!-- end form-group -->
                    <div class="form-group col-md-12 col-xs-12">
                        <label for="email">邮箱</label>
                        <input type="email" class="form-control" name="email" id="email"
                               placeholder="Your Email Address" value="{{old('email')}}"
                               required="">
                    </div> <!-- end form-group -->
                    <div class="form-group col-md-12 col-xs-12">
                        <label for="message">信息</label>
                        <textarea name="message" id="message" rows="5"
                                  placeholder="Enter your message here..">{{old('message')}}</textarea>
                    </div> <!-- end form-group -->

                    <div class="text-center col-md-12 mt10 mb20 col-xs-12">
                        <button type="submit" class="btn se-btn btn-rounded">提交</button>
                    </div> <!-- end text-center -->
                </form>

                <div class="col-md-3 col-sm-6 contact-info">
                    <h6 class="underline mtn">地址</h6>
                    <p>
                        太原市, <br>
                        小店区平阳景苑,<br>
                        4-3-3001,<br>
                        中国
                    </p>
                    <h6 class="underline mtn">电话</h6>
                    <p> +86 18404968725</p>
                    <h6 class="underline mtn">邮箱</h6>
                    <p>
                        support@cmp247.com
                    </p>
                </div> <!-- end contact-info -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>

@endsection