@extends("layouts.website.layout")

@section("title",'cmp247.com | 关于我们')

@section("content")
    <!-- ========== PAGE TITLE ========== -->
    <header class="header page-title">
        <div class="container">
            <!-- For centering the content vertically -->
            <div class="outer">
                <div class="inner text-center">
                    <h1 class="">Who We Are?</h1>
                    <h5 class="">We are Consec Technologies, an Australian start-up IT company in collaboration with few
                        independent software engineers from Sri Lanka</h5>
                    <a href="{{route("registerClinic")}}" class="btn se-btn-black btn-rounded mt20">Register Now</a>

                </div> <!-- end inner -->
            </div> <!-- end outer -->
        </div> <!-- end container -->
    </header>

    <!-- ========== FEATURE INTRO ========== -->
    <section class="se-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="underline mtn">More About Us ...</h2>
                    <p>cmp247 is a service provided by <a href="http://consectechnologies.com" target="_blank"> Consec
                            Technologies</a>, an Australian start-up IT company and a few
                        independent software engineers from Sri Lanka. cmp247 was initially developed as a stand-alone
                        commercial software in order to be used in public and private hospitals in Sri Lanka. As the
                        sales progressed over time, we decided to offer the service on the cloud so that we could
                        provide our clients with updates regularly without the need to manually install them on the
                        computers. With continuous research and development from the funds we obtained from sales in the
                        first year, we were able to turn cmp247 into a globally accepted complete Health Informatics
                        System running entirely on the cloud. </p>
                    <p>As a company that greatly values equal opportunity, the partners at Consec Technologies decided
                        that cmp247 must be a service that can be equally used by those who cannot afford a Health
                        Informatics System for their hospital or private practice. In May 2015, cmp247 was finally
                        relaunched as a 100% free cloud Health Informatics System that any medical practitioner from
                        anywhere in the world can sign-up and use it to make their medical services a lot more
                        efficient. We believe cmp247 has the potential to revolutionise the medical sector in currently
                        developing countries. We invite you to try cmp247 today and be part of the largest free Health
                        Informatics System on the cloud!
                    </p>
                    <a href="{{route("registerClinic")}}" class="btn se-btn-black btn-rounded">Join our Service</a>
                </div> <!-- end col-md-8 -->

                <div class="col-md-5">
                    <div class="owl-carousel owl-carousel-single mt10">
                        <div class="text-center">
                            <img src="http://consectechnologies.com/images/consec.png" style="background-color: black"
                                 alt="Consec Technologies"/>
                        </div>
                        <div class="text-center">
                            <img src="http://consectechnologies.com/images/consec.png" style="background-color: black"
                                 alt="Consec Technologies"/>
                        </div>
                    </div><!-- end owl-carousel -->
                </div> <!-- end col-md-4 -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>

@endsection