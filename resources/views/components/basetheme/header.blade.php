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
                                        <li><a href="{{ route('about') }}#ourteam"> Our Team</a></li>
                                    </ul>
                                </li>
                                {{-- <li class="has-dropdown">
                                    <a href="#">Explore<span><i
                                                class="fa-regular fa-angle-down ms-2"></i></span></a>
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
                                </li> --}}
                                <li class="has-dropdown" style="position: relative;" id="exploreMenuItem">
                                    <a href="#">Explore<span><i
                                                class="fa-regular fa-angle-down ms-2"></i></span></a>

                                    <!-- Mega Menu Widget -->
                                    <div class="mega-menu-widget" id="exploreMegaMenu">
                                        <div class="mega-menu-content">
                                            <div class="row">
                                                <!-- Column 1: Development & Projects -->
                                                <div class="col-lg-4">
                                                    <div class="mega-section">
                                                        <h5 class="mega-section-title">
                                                            <i class="fas fa-code"></i>
                                                            Development & Projects
                                                        </h5>
                                                        <ul class="mega-links">
                                                            <li>
                                                                <a href="{{ route('projects') }}">
                                                                    <div class="mega-link-content">
                                                                        <i class="fas fa-folder-open"></i>
                                                                        <div class="mega-link-text">
                                                                            <span
                                                                                class="mega-link-title">Projects</span>
                                                                            <small class="mega-link-desc">Explore our
                                                                                latest work and innovations</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <div class="mega-link-content">
                                                                        <i class="fas fa-code-branch"></i>
                                                                        <div class="mega-link-text">
                                                                            <span class="mega-link-title">Open
                                                                                Source</span>
                                                                            <small
                                                                                class="mega-link-desc">Community-driven
                                                                                development</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('workshops') }}">
                                                                    <div class="mega-link-content">
                                                                        <i class="fas fa-tools"></i>
                                                                        <div class="mega-link-text">
                                                                            <span
                                                                                class="mega-link-title">Workshops</span>
                                                                            <small class="mega-link-desc">Hands-on
                                                                                learning sessions</small>
                                                                            <span class="coming-soon-badge">Coming
                                                                                Soon</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Column 2: Community & Learning -->
                                                <div class="col-lg-4">
                                                    <div class="mega-section">
                                                        <h5 class="mega-section-title">
                                                            <i class="fas fa-users"></i>
                                                            Community & Learning
                                                        </h5>
                                                        <ul class="mega-links">
                                                            <li>
                                                                <a href="{{ route('events') }}">
                                                                    <div class="mega-link-content">
                                                                        <i class="fas fa-calendar-check"></i>
                                                                        <div class="mega-link-text">
                                                                            <span class="mega-link-title">Events</span>
                                                                            <small class="mega-link-desc">Join our tech
                                                                                meetups and activities</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('blogs') }}">
                                                                    <div class="mega-link-content">
                                                                        <i class="fas fa-blog"></i>
                                                                        <div class="mega-link-text">
                                                                            <span class="mega-link-title">Blogs</span>
                                                                            <small class="mega-link-desc">Tech insights
                                                                                and tutorials</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('resources') }}">
                                                                    <div class="mega-link-content">
                                                                        <i class="fas fa-book"></i>
                                                                        <div class="mega-link-text">
                                                                            <span
                                                                                class="mega-link-title">Resources</span>
                                                                            <small class="mega-link-desc">Learning
                                                                                materials and guides</small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Column 3: Pixel Character -->
                                                {{-- <div class="col-md-4">
                                                    <div class="mega-section pixel-section">
                                                        <div class="pixel-character-showcase">
                                                            <div class="pixel-avatar">
                                                                <div class="pixel-body">
                                                                    <div class="pixel-head">
                                                                        <div class="pixel-eyes">
                                                                            <span class="pixel-eye left"></span>
                                                                            <span class="pixel-eye right"></span>
                                                                        </div>
                                                                        <div class="pixel-mouth"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pixel-info">
                                                                <h6 class="pixel-title">Meet Pixel!</h6>
                                                                <p class="pixel-subtitle">IEEE CS Community Mascot</p>
                                                                <button class="pixel-btn" onclick="pixelGreeting()">
                                                                    <i class="fas fa-hand-paper"></i>
                                                                    Say Hello!
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Move CSS and JS outside the <li> element and activate the JavaScript -->
                                <style>
                                    /* Mega Menu Widget Styles */
                                    .mega-menu-widget {
                                        position: absolute;
                                        top: 100%;
                                        left: 0;
                                        background: #ffffff;
                                        border-radius: 12px;
                                        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
                                        border: 1px solid rgba(0, 0, 0, 0.1);
                                        min-width: 720px;
                                        opacity: 0;
                                        visibility: hidden;
                                        transform: translateY(-15px);
                                        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                                        z-index: 9999;
                                        margin-top: 8px;
                                    }

                                    .mega-menu-widget.show {
                                        opacity: 1;
                                        visibility: visible;
                                        transform: translateY(0);
                                    }

                                    .mega-menu-content {
                                        padding: 30px;
                                    }

                                    .mega-section {
                                        padding: 20px 15px;
                                        border-radius: 8px;
                                        transition: all 0.3s ease;
                                        height: 100%;
                                        position: relative;
                                    }

                                    .mega-section:not(.pixel-section):hover {
                                        background: rgba(0, 123, 255, 0.05);
                                        transform: translateY(-3px);
                                    }

                                    .mega-section-title {
                                        color: #2c3e50;
                                        font-size: 16px;
                                        font-weight: 600;
                                        margin-bottom: 20px;
                                        display: flex;
                                        align-items: center;
                                        position: relative;
                                        padding-bottom: 8px;
                                    }

                                    .mega-section-title::after {
                                        content: '';
                                        position: absolute;
                                        bottom: 0;
                                        left: 0;
                                        width: 40px;
                                        height: 2px;
                                        background: linear-gradient(90deg, #007bff, #0056b3);
                                        border-radius: 1px;
                                        transition: width 0.3s ease;
                                    }

                                    .mega-section:hover .mega-section-title::after {
                                        width: 80px;
                                    }

                                    .mega-section-title i {
                                        margin-right: 10px;
                                        color: #007bff;
                                        width: 18px;
                                        font-size: 16px;
                                    }

                                    .mega-links {
                                        list-style: none;
                                        padding: 0;
                                        margin: 0;
                                    }

                                    .mega-links li {
                                        margin-bottom: 6px;
                                    }

                                    .mega-links a {
                                        display: block;
                                        padding: 12px 15px;
                                        color: #333;
                                        text-decoration: none;
                                        border-radius: 8px;
                                        transition: all 0.3s ease;
                                        position: relative;
                                        overflow: hidden;
                                    }

                                    .mega-links a::before {
                                        content: '';
                                        position: absolute;
                                        left: 0;
                                        top: 0;
                                        width: 4px;
                                        height: 100%;
                                        background: linear-gradient(180deg, #007bff, #0056b3);
                                        transform: scaleY(0);
                                        transform-origin: bottom;
                                        transition: transform 0.3s ease;
                                    }

                                    .mega-links a:hover::before {
                                        transform: scaleY(1);
                                    }

                                    .mega-links a:hover {
                                        background: rgba(0, 123, 255, 0.08);
                                        color: #007bff;
                                        padding-left: 25px;
                                    }

                                    .mega-link-content {
                                        display: flex;
                                        align-items: center;
                                        gap: 12px;
                                    }

                                    .mega-link-content i {
                                        color: #666;
                                        width: 18px;
                                        font-size: 16px;
                                        margin-top: 2px;
                                        transition: color 0.3s ease;
                                    }

                                    .mega-links a:hover .mega-link-content i {
                                        color: #007bff;
                                    }

                                    .mega-link-text {
                                        flex: 1;
                                    }

                                    .mega-link-title {
                                        font-weight: 500;
                                        font-size: 14px;
                                        display: block;
                                        margin-bottom: 2px;
                                    }

                                    .mega-link-desc {
                                        color: #666;
                                        font-size: 12px;
                                        line-height: 1.4;
                                        opacity: 0.8;
                                    }

                                    .coming-soon-badge {
                                        background: linear-gradient(45deg, #ffc107, #ffb300);
                                        color: #333;
                                        padding: 2px 8px;
                                        border-radius: 12px;
                                        font-size: 10px;
                                        font-weight: 600;
                                        margin-left: 8px;
                                        display: inline-block;
                                        animation: pulse 2s infinite;
                                    }

                                    /* Pixel Character Section */
                                    .pixel-section {
                                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                        color: white;
                                        text-align: center;
                                        position: relative;
                                        overflow: hidden;
                                    }

                                    .pixel-section::before {
                                        content: '';
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        right: 0;
                                        bottom: 0;
                                        background-image:
                                            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
                                            radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
                                        background-size: 30px 30px, 20px 20px;
                                        animation: pixelFloat 15s linear infinite;
                                    }

                                    .pixel-character-showcase {
                                        position: relative;
                                        z-index: 1;
                                        padding: 15px;
                                    }

                                    .pixel-avatar {
                                        width: 90px;
                                        height: 90px;
                                        margin: 0 auto 15px;
                                        position: relative;
                                    }

                                    .pixel-body {
                                        width: 100%;
                                        height: 100%;
                                        position: relative;
                                    }

                                    .pixel-head {
                                        width: 70px;
                                        height: 70px;
                                        background: #4ecdc4;
                                        border-radius: 50%;
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
                                        animation: pixelBob 3s ease-in-out infinite;
                                    }

                                    .pixel-eyes {
                                        position: absolute;
                                        top: 22px;
                                        left: 50%;
                                        transform: translateX(-50%);
                                        display: flex;
                                        gap: 12px;
                                    }

                                    .pixel-eye {
                                        width: 6px;
                                        height: 6px;
                                        background: #2c3e50;
                                        border-radius: 50%;
                                        animation: pixelBlink 4s infinite;
                                    }

                                    .pixel-eye.left {
                                        animation-delay: 0.1s;
                                    }

                                    .pixel-mouth {
                                        position: absolute;
                                        bottom: 18px;
                                        left: 50%;
                                        transform: translateX(-50%);
                                        width: 16px;
                                        height: 8px;
                                        border: 2px solid #2c3e50;
                                        border-top: none;
                                        border-radius: 0 0 16px 16px;
                                        animation: pixelSmile 5s ease-in-out infinite;
                                    }

                                    .pixel-info {
                                        text-align: center;
                                    }

                                    .pixel-title {
                                        font-size: 16px;
                                        font-weight: 600;
                                        margin-bottom: 5px;
                                        color: white;
                                    }

                                    .pixel-subtitle {
                                        font-size: 12px;
                                        opacity: 0.9;
                                        margin-bottom: 15px;
                                        color: rgba(255, 255, 255, 0.9);
                                    }

                                    .pixel-btn {
                                        background: rgba(255, 255, 255, 0.2);
                                        border: 1px solid rgba(255, 255, 255, 0.3);
                                        color: white;
                                        padding: 8px 16px;
                                        border-radius: 20px;
                                        font-size: 12px;
                                        font-weight: 500;
                                        cursor: pointer;
                                        transition: all 0.3s ease;
                                        backdrop-filter: blur(10px);
                                        display: inline-flex;
                                        align-items: center;
                                        gap: 6px;
                                    }

                                    .pixel-btn:hover {
                                        background: rgba(255, 255, 255, 0.3);
                                        transform: translateY(-2px);
                                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                                    }

                                    .pixel-btn i {
                                        font-size: 11px;
                                    }

                                    /* Animations */
                                    @keyframes pixelFloat {
                                        0% {
                                            transform: translateX(0) translateY(0);
                                        }

                                        100% {
                                            transform: translateX(-30px) translateY(-30px);
                                        }
                                    }

                                    @keyframes pixelBob {

                                        0%,
                                        100% {
                                            transform: translate(-50%, -50%) translateY(0);
                                        }

                                        50% {
                                            transform: translate(-50%, -50%) translateY(-8px);
                                        }
                                    }

                                    @keyframes pixelBlink {

                                        0%,
                                        90%,
                                        100% {
                                            transform: scaleY(1);
                                        }

                                        95% {
                                            transform: scaleY(0.1);
                                        }
                                    }

                                    @keyframes pixelSmile {

                                        0%,
                                        80%,
                                        100% {
                                            transform: translateX(-50%) scaleX(1);
                                        }

                                        85%,
                                        95% {
                                            transform: translateX(-50%) scaleX(1.3);
                                        }
                                    }

                                    @keyframes pulse {
                                        0% {
                                            opacity: 1;
                                            transform: scale(1);
                                        }

                                        50% {
                                            opacity: 0.8;
                                            transform: scale(1.05);
                                        }

                                        100% {
                                            opacity: 1;
                                            transform: scale(1);
                                        }
                                    }

                                    /* Responsive */
                                    @media (max-width: 992px) {
                                        .mega-menu-widget {
                                            min-width: 600px;
                                        }

                                        .mega-menu-content {
                                            padding: 20px;
                                        }
                                    }

                                    @media (max-width: 1068px) {
                                        .mega-menu-widget {
                                            min-width: 100%;
                                            position: static;
                                            transform: none;
                                            opacity: 1;
                                            visibility: visible;
                                            box-shadow: none;
                                            border-radius: 0;
                                            margin-top: 0;
                                        }
                                    }
                                </style>

                                <script>
                                    // Mega Menu Widget JavaScript
                                    class MegaMenuWidget {
                                        constructor(triggerId, menuId) {
                                            this.trigger = document.querySelector(triggerId);
                                            this.menu = document.querySelector(menuId);
                                            this.hideTimeout = null;

                                            if (this.trigger && this.menu) {
                                                this.init();
                                            } else {
                                                console.log('MegaMenu: Trigger or menu not found', triggerId, menuId);
                                            }
                                        }

                                        init() {
                                            // Show menu on hover
                                            this.trigger.addEventListener('mouseenter', () => {
                                                this.show();
                                            });

                                            this.trigger.addEventListener('mouseleave', () => {
                                                this.hideWithDelay();
                                            });

                                            // Keep menu open when hovering over it
                                            this.menu.addEventListener('mouseenter', () => {
                                                this.clearHideTimeout();
                                            });

                                            this.menu.addEventListener('mouseleave', () => {
                                                this.hide();
                                            });
                                        }

                                        show() {
                                            this.clearHideTimeout();
                                            this.menu.classList.add('show');
                                        }

                                        hide() {
                                            this.menu.classList.remove('show');
                                        }

                                        hideWithDelay() {
                                            this.hideTimeout = setTimeout(() => {
                                                this.hide();
                                            }, 300);
                                        }

                                        clearHideTimeout() {
                                            if (this.hideTimeout) {
                                                clearTimeout(this.hideTimeout);
                                                this.hideTimeout = null;
                                            }
                                        }
                                    }

                                    // Pixel character interaction
                                    function pixelGreeting() {
                                        const pixelHead = document.querySelector('.pixel-head');
                                        const pixelBtn = document.querySelector('.pixel-btn');

                                        if (pixelHead && pixelBtn) {
                                            // Add greeting animation
                                            pixelHead.style.animation = 'pixelBob 0.5s ease-in-out 3';
                                            pixelBtn.innerHTML = '<i class="fas fa-heart"></i> Hi there!';

                                            // Reset after 2 seconds
                                            setTimeout(() => {
                                                pixelBtn.innerHTML = '<i class="fas fa-hand-paper"></i> Say Hello!';
                                                pixelHead.style.animation = 'pixelBob 3s ease-in-out infinite';
                                            }, 2000);
                                        }
                                    }

                                    // Initialize when DOM is loaded - FIXED: Uncommented and activated
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Initialize the mega menu
                                        new MegaMenuWidget('#exploreMenuItem', '#exploreMegaMenu');
                                    });
                                </script>

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
                            @if (get_setting('enable_login') != 0)

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
                            {{-- <div class="vl-search1">
                                <button class="search-open-btn"><i class="fa-regular fa-magnifying-glass"></i></button>
                            </div> --}}

                            <div class="button">
                                <a href="{{ route('contact') }}" class="theme-btn8-outline">
                                    <span class="theme-btn8__text">
                                        <i class="fas fa-envelope me-2"></i>Get in Touch
                                    </span>
                                </a>
                            </div>
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
