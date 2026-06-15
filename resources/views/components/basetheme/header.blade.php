<!--=====HEADER START=======-->

<header>
    <div id="vl-header-sticky" class="vl-header-area4 header-tranperent">
        <div class="container header2-bg">
            <div class="row align-items-center px-4">

                {{-- Logo --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="vl-logo">
                        <a href="{{ route('home') }}" class="header1-logo-block">
                            <img src="{{ asset('images/logo_name_description.svg') }}" alt="IEEE CS BAU logo" width="160">
                        </a>
                    </div>
                </div>

                {{-- Desktop Navigation (hidden on mobile) --}}
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <div class="vl-main-menu">
                        <nav class="vl-mobile-menu-active">
                            <ul class="vl-mobile-menu-stack">
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="has-dropdown">
                                    <a href="{{ route('about') }}">About Us
                                        <span><i class="fa-regular fa-angle-down ms-2"></i></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('about') }}#ourteam">Our Team</a></li>
                                    </ul>
                                </li>
                                <li class="has-dropdown">
                                    <a href="#">Explore
                                        <span><i class="fa-regular fa-angle-down ms-2"></i></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('projects') }}">Projects</a></li>
                                        <li><a href="{{ route('events') }}">Events</a></li>
                                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                                        <li><a href="{{ route('workshops') }}">Workshops</a></li>
                                        <li><a href="{{ route('resources') }}">Resources</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('leaderboard') }}">Leaderboard</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                {{-- Desktop Action Buttons (hidden on mobile) + Mobile Burger Button --}}
                <div class="col-lg-4 col-md-6 col-6">
                    {{-- Desktop buttons: only visible on lg+ --}}
                    <div class="vl-header4-btns text-end d-none d-lg-flex gap-2 align-items-center">
                        <div class="buttons">
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
                                <a href="{{ route('login') }}" class="theme-btn8-outline">
                                    <span class="theme-btn8__text">Sign In</span>
                                </a>
                            @endif
                        </div>
                        @if (get_setting('enable_registration') != 0)
                            <div class="buttons">
                                <a href="{{ route('register') }}" class="theme-btn8">
                                    <span class="theme-btn8__text">Sign Up</span>
                                </a>
                            </div>
                        @endif
                        <div class="buttons">
                            <a href="{{ route('contact') }}" class="theme-btn8-outline">
                                <span class="theme-btn8__text">
                                    <i class="fas fa-envelope me-2"></i>Get in Touch
                                </span>
                            </a>
                        </div>
                    </div>

                    {{-- Mobile burger button: only visible below lg --}}
                    <div class="vl-header-action-item d-flex d-lg-none justify-content-end">
                        <button type="button" class="vl-offcanvas-toggle" aria-label="Open navigation menu">
                            <i class="fa-duotone fa-solid fa-bars-staggered"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<!--=====HEADER END=======-->

<!--===== MOBILE OFFCANVAS MENU START =======-->
<div class="vl-offcanvas vl-header-area1" aria-hidden="true">
    <div class="vl-offcanvas-wrapper">

        {{-- Offcanvas Header: logo + close button --}}
        <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-90">
            <div class="vl-offcanvas-logo">
                <a href="{{ route('home') }}" class="header1-logo-block">
                    <img src="{{ asset('images/logo.png') }}" alt="IEEE CS BAU logo">
                </a>
            </div>
            <div class="vl-offcanvas-close">
                <button class="vl-offcanvas-close-toggle" aria-label="Close navigation menu">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation (populated via JS clone of desktop nav) --}}
        <div class="vl-offcanvas-menu mb-40">
            <nav></nav>
        </div>

        {{-- Mobile Auth Buttons --}}
        <div class="vl-offcanvas-auth mb-30">
            @if (auth()->check())
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="theme-btn8 w-100">
                        <span class="theme-btn8__shape"></span>
                        <span class="theme-btn8__shape"></span>
                        <span class="theme-btn8__shape"></span>
                        <span class="theme-btn8__shape"></span>
                        <span class="theme-btn8__text">Logout</span>
                    </button>
                </form>
            @else
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('login') }}" class="theme-btn8-outline flex-grow-1 text-center">
                        <span class="theme-btn8__text">Sign In</span>
                    </a>
                    @if (get_setting('enable_registration') != 0)
                        <a href="{{ route('register') }}" class="theme-btn8 flex-grow-1 text-center">
                            <span class="theme-btn8__text">Sign Up</span>
                        </a>
                    @endif
                </div>
            @endif
        </div>

        {{-- Contact Information --}}
        <div class="vl-footer-contact3 vl-footer-widget-black1 mb-20">
            <h4>Contact Information</h4>
            <div class="single-contact-item">
                <div class="icon">
                    <img src="assets/img/icons/footer-contact-icon1.svg" alt="">
                </div>
                <div class="text">
                    <a href="mailto:{{ getWidget('email') }}">{{ getWidget('email') }}</a>
                </div>
            </div>
            <div class="single-contact-item">
                <div class="icon">
                    <img src="assets/img/icons/footer-contact-icon2.svg" alt="">
                </div>
                <div class="text">
                    <a href="#">{!! wordwrap(getWidget('location'), 30, '<br>') !!}</a>
                </div>
            </div>
        </div>

        {{-- Social Links --}}
        <div class="vl-offcanvas-social">
            <h4>Follow Us</h4>
            <div class="vl-copyright-social2 text-start">
                <a href="{{ getWidget('facebook-link') }}" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="{{ getWidget('instagram-link') }}" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ getWidget('linkedin-link') }}" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>

    </div>
</div>
<div class="vl-offcanvas-overlay"></div>
<!--===== MOBILE OFFCANVAS MENU END =======-->
