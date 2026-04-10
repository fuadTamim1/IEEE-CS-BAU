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
                            <a href="{{ getWidget('youtube-link') }}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                            <a href="{{ getWidget('instagram-link') }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                            <a href="{{ getWidget('linkedin-link') }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
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
                                <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                                <li><a href="{{route('contact')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-3 col-md-4 col-6">
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
                </div> --}}

                <div class="col-lg-3 col-md-8 col-sm-6">
                    <div class="vl-footer-contact4 vl-footer-widget-white mb-50 sm:ml-0 md:ml-0">
                        <h4>Contact Information</h4>
                        <div class="single-contact-item">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icons/footer-contact-icon1.svg') }}" alt="">
                            </div>
                            <div class="text">
                                <a href="mail:{{getWidget('email')}}" target="_blank">{{getWidget('email')}}</a>
                            </div>
                        </div>


                        <div class="single-contact-item">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icons/footer-contact-icon2.svg') }}" alt="">
                            </div>
                            <div class="text">
                                <a href="{{(getWidget('google_map_locaction')) }}" target="_blank" rel="noopener noreferrer">
                                    {!! wordwrap(getWidget('location'), 30, '<br>') !!}</a>
                            </div>
                        </div>
                        {{-- 
                        <div class="single-contact-item">
                            <div class="icon">
                                <img src="/assets/img/icons/footer-contact-icon1.svg" alt="">
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

    <div class="ieee-admin-links" aria-label="IEEE Administrative Links">
        <div class="container">
            <h5 class="ieee-admin-links__title">IEEE Administrative Links</h5>
            <ul class="ieee-admin-links__list">
                <li>
                    <a href="https://www.ieee.org/" target="_blank" rel="noopener noreferrer">IEEE Home</a>
                </li>
                <li>
                    <a href="https://www.ieee.org/security-privacy.html" target="_blank" rel="noopener noreferrer">IEEE Privacy Policy</a>
                </li>
                <li>
                    <a href="https://www.ieee.org/about/help/site-terms-conditions.html" target="_blank" rel="noopener noreferrer">Terms and Conditions</a>
                </li>
                <li>
                    <a href="https://www.ieee.org/about/corporate/governance/p9-26.html" target="_blank" rel="noopener noreferrer">Nondiscrimination Policy</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- copy-right area start -->
    <div class="container">
        <div class="row vl-copyright4 _dv-top align-items-center">
            <div class="col-lg-6">
                <div class="copyright-text left-side">
                    <p>ⓒCopyright 2025 IEEE CS BAU. All rights reserved</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="copyright-text right-side text-end sm:text-start md:text-start">
                    {{-- <a href="#">Terms & Conditions</a>
                    <a href="#" class="add-before"> Privacy Policy </a> --}}
                    <p>Made with <i class="fa-solid fa-heart"></i> by <a href="https://github.com/fuadTamim1">Fuad Al-Tamimi</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- copy-right area end -->

    <style>
        .ieee-admin-links {
            border-top: 1px solid rgba(255, 255, 255, 0.16);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            padding: 18px 0;
            margin-bottom: 8px;
            background: linear-gradient(90deg, rgba(0, 98, 155, 0.18) 0%, rgba(0, 41, 84, 0.18) 100%);
        }

        .ieee-admin-links__title {
            margin: 0 0 10px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .ieee-admin-links__list {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 10px 18px;
        }

        .ieee-admin-links__list a {
            color: #ffffff;
            font-size: 14px;
            line-height: 1.6;
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: color 0.2s ease, border-color 0.2s ease;
        }

        .ieee-admin-links__list a:hover,
        .ieee-admin-links__list a:focus-visible {
            color: #9ad8ff;
            border-bottom-color: #9ad8ff;
        }

        @media (max-width: 767.98px) {
            .ieee-admin-links {
                padding: 14px 0;
            }

            .ieee-admin-links__title {
                font-size: 14px;
            }

            .ieee-admin-links__list {
                gap: 8px 12px;
            }

            .ieee-admin-links__list a {
                font-size: 13px;
            }
        }
    </style>

</footer>
