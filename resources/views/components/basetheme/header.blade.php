<!--=====HEADER START=======-->

<header>

    <div id="vl-header-sticky" class="vl-header-area4 header-tranperent">
        <div class="container header2-bg">
            <div class="row align-items-center px-4">
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="vl-logo">
                        <a href="{{ route('home') }}" class="header1-logo-block"><img
                                src="{{ asset('images/logo_name_description.svg') }}" alt="ieee cs logo"
                                width="160"></a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <div class="vl-main-menu">
                        <!-- content -->
                        <nav class="vl-mobile-menu-active">
                            <ul class="vl-mobile-menu-stack">
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="has-dropdown">
                                    <a href="{{ route('about') }}">About Us<span><i
                                                class="fa-regular fa-angle-down ms-2"></i></span></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('about') }}#ourteam"> Out Team</a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown">
                                    <a href="#">Explore<span><i class="fa-regular fa-angle-down ms-2"></i></span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ route('projects') }}">Projects</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('events') }}">Events</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('blogs') }}">Blogs</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('workshops') }}">Workshops - COMING SOON!</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('resources') }}">Resources</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="{{ route('leaderboard') }}">Leaderboard</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-6">
                    <div class="vl-header4-btns text-end d-none d-lg-flex gap-2">
                        <div class="buttons">
                            {{-- <div class="vl-search1">
                                <button class="search-open-btn"><i class="fa-regular fa-magnifying-glass"></i></button>
                            </div> --}}
                            @if (auth()->check())
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="theme-btn8">
                                        <span class="theme-btn8__shape"></span>
                                        <span class="theme-btn8__shape"></span>
                                        <span class="theme-btn8__shape"></span>
                                        <span class="theme-btn8__shape"></span>
                                        <span class="theme-btn8__text">Logout</span>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="theme-btn8" hidden>
                                    <span class="theme-btn8__shape"></span>
                                    <span class="theme-btn8__shape"></span>
                                    <span class="theme-btn8__shape"></span>
                                    <span class="theme-btn8__shape"></span>
                                    <span class="theme-btn8__text">Sign In</span>
                                </a>
                            @endif

                        </div>
                        <div class="buttons">
                            {{-- <div class="vl-search1">
                                <button class="search-open-btn"><i class="fa-regular fa-magnifying-glass"></i></button>
                            </div> --}}
                            <a class="theme-btn3" href="{{ route('contact') }}">Contact Us <span class="arrow1"><i
                                        class="fa-solid fa-arrow-right"></i></span><span class="arrow2"><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                    <div class="vl-header-action-item d-block d-lg-none">
                        <button type="button" class="vl-offcanvas-toggle">
                            <i class="fa-duotone fa-solid fa-bars-staggered"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--=====HEADER END =======-->

<!--===== MOBILE HEADER STARTS =======-->
<div class="vl-offcanvas vl-header-area1">
    <div class="vl-offcanvas-wrapper">
        <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-90">
            <div class="vl-offcanvas-logo">
                <a href="{{ route('home') }}" class="header1-logo-block"><img src="{{ asset('images/logo.png') }}"
                        alt=""></a>
            </div>
            <div class="vl-offcanvas-close">
                <button class="vl-offcanvas-close-toggle"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

        <div class="vl-offcanvas-menu d-lg-none mb-40">
            <nav></nav>
        </div>

        <div class="space20"></div>
        <div class="vl-footer-contact3 vl-footer-widget-black1 mb-20 sm:ml-0 md:ml-0">
            <h4>Contact Information</h4>
            <div class="single-contact-item">
                <div class="icon">
                    <img src="assets/img/icons/footer-contact-icon1.svg" alt="">
                </div>
                <div class="text">
                    <a href="mail:support@seoxagency.com">{{ getWidget('email') }}</a>
                </div>
            </div>

            <div class="single-contact-item">
                <div class="icon">
                    <img src="assets/img/icons/footer-contact-icon2.svg" alt="">
                </div>
                <div class="text">
                    <a href="#">{!! wordwrap(getWidget('location'), 30, '</br>') !!}</a>
                </div>
            </div>
            {{-- 
            <div class="single-contact-item">
                <div class="icon">
                    <img src="assets/img/icons/footer-contact-icon3.svg" alt="">
                </div>
                <div class="text">
                    <a href="tel:123-456-7890">123-456-7890</a>
                </div>
            </div> --}}

        </div>
        <div class="vl-offcanvas-social">
            <h4>Follow Us</h4>
            <div class="vl-copyright-social2 text-start">
                <a href="{{ getWidget('facebook-link') }}"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="{{ getWidget('instagram-link') }}"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ getWidget('linkedin-link') }}"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>

    </div>
</div>
<div class="vl-offcanvas-overlay"></div>
<!--===== MOBILE HEADER STARTS =======-->
