<footer class="vl-footer-area4 bg-cover" style="background-image: url({{ asset('images/footer_bg.png') }});">

    <!-- footer area start -->
    <div class="footer-bottom-content">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="vl-footer-widget-white vl-footer1-logo-area mr-50 mb-50">
                        <div class="vl-footer-logo black-logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/white_logo_text.svg') }}" alt=""></a>
                        </div>
                        <div class="vl-footer-text white-heading mt-20">
                            <p class="mt-16">Empowering Innovators,
                                Shaping the Future. </p>
                        </div>
                        <div class="vl-footer-social4 text-start mt-20">
                            <a href="{{ getWidget('facebook-link') }}"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="{{ getWidget('instagram-link') }}"><i class="fa-brands fa-instagram"></i></a>
                            <a href="{{ getWidget('linkedin-link') }}"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2  col-md-6 col-6">
                    <div class="vl-footer-widget-white4 mb-50 ml-20 md:ml-30 sm:ml-0">
                        <h4>Quick Links</h4>
                        <div class="vl-footer-list">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li><a href="{{route('about')}}">About Us</a></li>
                                <li><a href="{{route('projects')}}">Projects</a></li>
                                <li><a href="{{route('events')}}">Events</a></li>
                                <li><a href="{{route('blogs')}}">Blog</a></li>
                                <li><a href="{{route('contact')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <div class="vl-footer-widget-white4 mb-50 ml-70 md:ml-0 sm:ml-0">
                        <h4>Category List</h4>
                        <div class="vl-footer-list">
                            <ul>
                                @foreach ($categories as $c)
                                    <li><a href="#" @disabled(true)>{{ $c->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-8 col-sm-6">
                    <div class="vl-footer-contact4 vl-footer-widget-white mb-50 sm:ml-0 md:ml-0">
                        <h4>Contact Information</h4>
                        <div class="single-contact-item">
                            <div class="icon">
                                <img src="assets/img/icons/footer-contact-icon1.svg" alt="">
                            </div>
                            <div class="text">
                                <a href="mail:{{getWidget('email')}}">{{getWidget('email')}}</a>
                            </div>
                        </div>

                        <div class="single-contact-item">
                            <div class="icon">
                                <img src="assets/img/icons/footer-contact-icon2.svg" alt="">
                            </div>
                            <div class="text">
                                <a href="#">
                                    {!! wordwrap(getWidget('location'), 30, '<br>') !!}</a>
                            </div>
                        </div>
                        {{-- 
                        <div class="single-contact-item">
                            <div class="icon">
                                <img src="assets/img/icons/footer-contact-icon1.svg" alt="">
                            </div>
                            <div class="text">
                                <a href="tel:123-456-7890">123-456-7890</a>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer area end -->

    <!-- copy-right area start -->
    <div class="container">
        <div class="row vl-copyright4 _dv-top align-items-center">
            <div class="col-lg-6">
                <div class="copyright-text left-side">
                    <p>ⓒCopyright 2025 IEEE CS BAU. All rights reserved</p>
                </div>
            </div>
            <div class="col-lg-6">
                {{-- <div class="copyright-text right-side text-end sm:text-start md:text-start">
                    <a href="#">Terms & Conditions</a>
                    <a href="#" class="add-before"> Privacy Policy </a>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- copy-right area end -->

</footer>
