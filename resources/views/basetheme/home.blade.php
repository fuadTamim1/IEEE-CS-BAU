<x-base-layout>
    <!-- Hero Section -->
    <section class="hero4">
        <div class="hero4__backdrop" aria-hidden="true"></div>
        <div class="container text-center hero4__content-wrap">
            <div class="main-heading4 hero4__content">
                <span class="hero4__badge" data-aos="fade-down" data-aos-duration="700">
                    <img src="{{ asset('images/logo.png') }}" width="18" alt="IEEE CS icon">
                    IEEE Computer Society
                </span>

                <h1 class="text-anime-style-3 hero4__title" data-aos="fade-up" data-aos-duration="900">
                    Empowering Innovation in <span>Computing</span>
                </h1>

                <p class="hero4__lead mt-4" data-aos="fade-up" data-aos-duration="1000">
                    Engage with computer engineers, scientists, academia, and industry professionals from all areas
                    of computing and fuel global technological advancements.
                </p>

                <div class="hero4__cta mt-5" data-aos="fade-up" data-aos-duration="1200">
                    <x-theme-button href="{{ route('events') }}" icon="fa-calendar-days" text="Explore Events" />
                    <x-theme-button href="{{ route('workshops') }}" icon="fa-laptop-code" text="Browse Workshops" secondary />
                </div>

                <p class="hero4__note mt-3" data-aos="fade-up" data-aos-duration="1300">
                    Membership requests are currently paused.
                </p>
            </div>

            <div class="hero4__ascii" aria-hidden="true">
                <canvas id="heroAsciiCanvas" width="900" height="260" data-logo-src="{{ asset('images/logo.png') }}"></canvas>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section class="about4 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about4-images">
                        <div class="image1 image-anime reveal">
                            <img src="{{ asset('IEEE/Members-20250805T060423Z-1-001/Members/ieee_members_1.jpg') }}"
                                width="400" height="500" alt="Office Image">
                        </div>
                        <div class="image2 image-anime reveal">
                            <img src="{{ asset('IEEE/Members-20250805T060423Z-1-001/Members/ieee_members_2.jpg') }}"
                                width="258" height="500" alt="Office Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <x-section-heading subtitle="About IEEE CS" title="Empowering Future Innovators in Technology"
                        icon="{{ asset('images/logo.png') }}">
                        <p class="mt-4" data-aos="fade-left" data-aos-duration="800">
                            IEEE Computer Society (IEEE CS) advances computing through education, research, and
                            collaboration, offering opportunities for students and professionals to innovate.
                        </p>
                        <div class="about4-service-list mt-4" data-aos="fade-left" data-aos-duration="1000">
                            <h5>Why Choose Us?</h5>
                            <div class="row">
                                <div class="col-md-5">
                                    <ul class="list-unstyled">
                                        <li><span class="check"><i class="fa-solid fa-check"></i></span> Cutting-Edge
                                            Knowledge</li>
                                        <li><span class="check"><i class="fa-solid fa-check"></i></span> Professional
                                            Networking</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li><span class="check"><i class="fa-solid fa-check"></i></span> Hands-on
                                            Learning</li>
                                        <li><span class="check"><i class="fa-solid fa-check"></i></span> Career Growth
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <x-theme-button href="{{ route('about') }}" text="Learn More" class="mt-4" />
                    </x-section-heading>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section (Restored Original Styling) -->
    <section class="service4 sp sec-bg3">
        <div class="container">
            <x-section-heading subtitle="Our Focus Areas in Technology" title="Exploring the Frontiers of Innovation"
                icon="{{ asset('images/logo.png') }}">
                <x-theme-button href="{{ route('projects') }}" text="See Projects"
                    class="text-end md:text-start sm:text-start md:mt-20 sm:mt-20" />
            </x-section-heading>
            <div class="row mt-30">
                @foreach ([
        ['icon' => 'service4-icon1.svg', 'title' => 'Networking & Cloud Computing', 'desc' => 'Building and managing secure, scalable networks and cloud-based infrastructures to power global connectivity.', 'delay' => 200],
        ['icon' => 'service4-icon2.svg', 'title' => 'Linux & System Administration', 'desc' => 'Mastering Linux environments, server management, and automation for optimized system performance.', 'delay' => 300],
        ['icon' => 'service4-icon3.svg', 'title' => 'Python & Software Development', 'desc' => 'Leveraging Python for automation, data science, and software engineering to solve real-world challenges.', 'delay' => 400],
        ['icon' => 'service4-icon1.svg', 'title' => 'Cybersecurity & Ethical Hacking', 'desc' => 'Protecting digital assets through penetration testing, cryptography, and advanced security practices.', 'delay' => 200],
        ['icon' => 'service4-icon1.svg', 'title' => 'Web Design & Development', 'desc' => 'Make a lasting impression with a professionally designed and user-friendly website.', 'delay' => 300],
    ] as $service)
                    <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000"
                        data-aos-delay="{{ $service['delay'] }}">
                        <div class="service4-box mt-30">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icons/' . $service['icon']) }}"
                                    alt="{{ $service['title'] }} icon">
                            </div>
                            <div class="heading4 mt-20">
                                <h4><a href="#">{{ $service['title'] }}</a></h4>
                                <p class="mt-16">{{ $service['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="events-showcase sp">
        <div class="container">
            <div class="events-showcase__top">
                <div>
                    <span class="events-showcase__eyebrow">
                        <img src="{{ asset('images/logo.png') }}" alt="IEEE CS" width="22">
                        Explore Our Events
                    </span>
                    <h2 class="events-showcase__title">Discover Workshops, Meetups, Competitions, and Talks</h2>
                </div>

                <div class="events-showcase__controls" aria-label="Event slider controls">
                    <button type="button" class="events-showcase__arrow events-showcase__arrow--prev" aria-label="Previous events">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button type="button" class="events-showcase__arrow events-showcase__arrow--next" aria-label="Next events">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            @if ($events->count())
                <div class="swiper events-showcase__slider" id="eventsShowcaseSlider">
                    <div class="swiper-wrapper">
                        @foreach ($events as $e)
                            <div class="swiper-slide events-showcase__slide">
                                <x-event-card :event="$e" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="events-showcase__footer">
                    <div class="events-showcase__pagination"></div>
                    <a href="{{ route('events') }}" class="events-showcase__view-all">
                        Browse All Events
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                </div>
            @else
                <div class="events-showcase__empty">
                    <i class="fa-regular fa-calendar-xmark"></i>
                    <p>No events yet. Check back soon for upcoming activities.</p>
                </div>
            @endif
        </div>
    </section>
@push('styles')
        <style>
            .events-showcase {
                --events-bg-1: #f8f3e6;
                --events-bg-2: #f2ebcd;
                position: relative;
                overflow: hidden;
                background:
                    radial-gradient(circle at 8% 10%, rgba(255, 255, 255, 0.85) 0%, rgba(255, 255, 255, 0) 40%),
                    radial-gradient(circle at 85% 25%, rgba(209, 184, 72, 0.45) 0%, rgba(209, 184, 72, 0) 45%),
                    linear-gradient(145deg, var(--events-bg-1) 0%, var(--events-bg-2) 100%);
            }

            .events-showcase__top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 1rem;
                margin-bottom: 1.35rem;
            }

            .events-showcase__eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.4rem 0.72rem;
                border-radius: 999px;
                background: rgba(42, 33, 15, 0.08);
                color: #37351f;
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.07em;
                text-transform: uppercase;
            }

            .events-showcase__title {
                margin: 0.85rem 0 0;
                max-width: 780px;
                font-size: clamp(1.5rem, 2.8vw, 2.45rem);
                line-height: 1.15;
                color: #2a280f;
            }

            .events-showcase__controls {
                display: inline-flex;
                align-items: center;
                gap: 0.55rem;
            }

            .events-showcase__arrow {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                border: 1px solid rgba(42, 41, 15, 0.16);
                background: rgba(255, 255, 255, 0.76);
                color: #2a260f;
                display: grid;
                place-items: center;
                transition: transform 0.28s ease, background 0.28s ease, color 0.28s ease;
            }

            .events-showcase__arrow:hover {
                background: #282a0f;
                color: #fff;
                transform: translateY(-2px);
            }

            .events-showcase__slider {
                padding: 0.35rem 0.3rem 0.8rem;
            }

            .events-showcase__slide {
                height: auto;
            }

            .events-showcase__slide .ieee-event-card {
                height: 100%;
            }

            .events-showcase__footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 0.9rem;
                gap: 1rem;
            }

            .events-showcase__pagination {
                display: inline-flex;
                align-items: center;
            }

            .events-showcase__pagination .swiper-pagination-bullet {
                width: 10px;
                height: 10px;
                background: #6b7280;
                opacity: 0.35;
                transition: transform 0.3s ease, opacity 0.3s ease;
            }

            .events-showcase__pagination .swiper-pagination-bullet-active {
                transform: scale(1.2);
                opacity: 1;
                background: #ff5b37;
            }

            .events-showcase__view-all {
                display: inline-flex;
                align-items: center;
                gap: 0.45rem;
                text-decoration: none;
                font-weight: 700;
                color: #0f172a;
                border-bottom: 2px solid rgba(42, 37, 15, 0.22);
                transition: color 0.3s ease, border-color 0.3s ease;
            }

            .events-showcase__view-all:hover {
                color: #ff5b37;
                border-color: #ff5b37;
            }

            .events-showcase__empty {
                border-radius: 16px;
                border: 1px dashed rgba(42, 39, 15, 0.22);
                padding: 2.2rem 1rem;
                text-align: center;
                color: #334155;
                background: rgba(255, 255, 255, 0.55);
            }

            .events-showcase__empty i {
                font-size: 2rem;
                margin-bottom: 0.65rem;
                color: #ff5b37;
            }

            @media (max-width: 991px) {
                .events-showcase__top {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.9rem;
                }

                .events-showcase__title {
                    max-width: 100%;
                }
            }

            @media (max-width: 575px) {
                .events-showcase__footer {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .events-showcase__controls {
                    width: 100%;
                    justify-content: flex-end;
                }
            }
        </style>
    @endpush

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var sliderEl = document.getElementById('eventsShowcaseSlider');
                if (sliderEl && typeof Swiper !== 'undefined') {
                    new Swiper(sliderEl, {
                        slidesPerView: 1.1,
                        spaceBetween: 16,
                        speed: 700,
                        grabCursor: true,
                        loop: {{ $events->count() > 3 ? 'true' : 'false' }},
                        autoplay: {
                            delay: 3200,
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true
                        },
                        navigation: {
                            nextEl: '.events-showcase__arrow--next',
                            prevEl: '.events-showcase__arrow--prev'
                        },
                        pagination: {
                            el: '.events-showcase__pagination',
                            clickable: true
                        },
                        breakpoints: {
                            575: {
                                slidesPerView: 1.35,
                                spaceBetween: 18
                            },
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 20
                            },
                            992: {
                                slidesPerView: 2.45,
                                spaceBetween: 22
                            },
                            1200: {
                                slidesPerView: 3,
                                spaceBetween: 24
                            }
                        }
                    });
                }

                var heroCanvas = document.getElementById('heroAsciiCanvas');
                if (!heroCanvas) {
                    return;
                }

                var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                var ctx = heroCanvas.getContext('2d');
                var wrapper = heroCanvas.closest('.hero4');
                var particles = [];
                var mouse = {
                    x: -999,
                    y: -999,
                    active: false
                };
                var phrase = 'IEEE CS';
                var density = 4;
                var rafId = null;
                var isHeroVisible = true;
                var logoImg = new Image();
                var logoReady = false;
                var logoSource = heroCanvas.getAttribute('data-logo-src') || '';

                function resizeCanvas() {
                    var aspect = logoReady ? ((logoImg.naturalWidth || 1) / (logoImg.naturalHeight || 1)) : 1;
                    var maxCanvasWidth = Math.min((wrapper.clientWidth || 900) * 0.72, 980);
                    var maxCanvasHeight = Math.max((wrapper.clientHeight || 420) * 0.82, 220);
                    var canvasWidth = maxCanvasWidth;
                    var canvasHeight = canvasWidth / aspect;

                    if (canvasHeight > maxCanvasHeight) {
                        canvasHeight = maxCanvasHeight;
                        canvasWidth = canvasHeight * aspect;
                    }

                    heroCanvas.width = Math.max(Math.floor(canvasWidth), 220);
                    heroCanvas.height = Math.max(Math.floor(canvasHeight), 140);
                    buildParticles();
                }

                function buildParticles() {
                    particles = [];
                    var mapCanvas = document.createElement('canvas');
                    var mapCtx = mapCanvas.getContext('2d');

                    mapCanvas.width = heroCanvas.width;
                    mapCanvas.height = heroCanvas.height;
                    mapCtx.clearRect(0, 0, mapCanvas.width, mapCanvas.height);

                    if (logoReady) {
                        var maxLogoWidth = mapCanvas.width * 0.96;
                        var maxLogoHeight = mapCanvas.height * 0.96;
                        var logoAspect = (logoImg.naturalWidth || 1) / (logoImg.naturalHeight || 1);
                        var drawWidth = maxLogoWidth;
                        var drawHeight = drawWidth / logoAspect;

                        if (drawHeight > maxLogoHeight) {
                            drawHeight = maxLogoHeight;
                            drawWidth = drawHeight * logoAspect;
                        }

                        var logoX = (mapCanvas.width - drawWidth) / 2;
                        var logoY = (mapCanvas.height - drawHeight) / 2;
                        mapCtx.drawImage(logoImg, logoX, logoY, drawWidth, drawHeight);
                    } else {
                        mapCtx.fillStyle = '#ffffff';
                        var fontSize = Math.floor(Math.min(mapCanvas.width * 0.18, 130));
                        mapCtx.font = '700 ' + fontSize + 'px "Consolas", "Courier New", monospace';
                        mapCtx.textAlign = 'center';
                        mapCtx.textBaseline = 'middle';
                        mapCtx.fillText(phrase, mapCanvas.width / 2, mapCanvas.height / 2 + 6);
                    }

                    var imageData = mapCtx.getImageData(0, 0, mapCanvas.width, mapCanvas.height).data;
                    for (var y = 0; y < mapCanvas.height; y += density) {
                        for (var x = 0; x < mapCanvas.width; x += density) {
                            var idx = (y * mapCanvas.width + x) * 4 + 3;
                            if (imageData[idx] > 120) {
                                particles.push({
                                    x: x + (Math.random() - 0.5) * 26,
                                    y: y + (Math.random() - 0.5) * 26,
                                    tx: x,
                                    ty: y,
                                    vx: 0,
                                    vy: 0,
                                    c: Math.random() > 0.72 ? 'rgba(255, 210, 122, 0.95)' : 'rgba(250, 164, 26, 0.78)'
                                });
                            }
                        }
                    }
                }

                function draw() {
                    rafId = null;
                    if (!isHeroVisible) {
                        return;
                    }

                    ctx.clearRect(0, 0, heroCanvas.width, heroCanvas.height);

                    for (var i = 0; i < particles.length; i++) {
                        var p = particles[i];
                        var dx = p.tx - p.x;
                        var dy = p.ty - p.y;

                        p.vx += dx * 0.012;
                        p.vy += dy * 0.012;

                        if (mouse.active) {
                            var mx = p.x - mouse.x;
                            var my = p.y - mouse.y;
                            var d2 = mx * mx + my * my;
                            if (d2 < 6400) {
                                var repel = (6400 - d2) / 6400;
                                p.vx += (mx / 30) * repel;
                                p.vy += (my / 30) * repel;
                            }
                        }

                        p.vx *= 0.88;
                        p.vy *= 0.88;
                        p.x += p.vx;
                        p.y += p.vy;

                        ctx.fillStyle = p.c;
                        ctx.fillText('.', p.x, p.y);
                    }

                    if (!prefersReducedMotion) {
                        rafId = window.requestAnimationFrame(draw);
                    }
                }

                wrapper.addEventListener('mousemove', function (event) {
                    var rect = heroCanvas.getBoundingClientRect();
                    mouse.x = event.clientX - rect.left;
                    mouse.y = event.clientY - rect.top;
                    mouse.active = true;
                });

                wrapper.addEventListener('mouseleave', function () {
                    mouse.active = false;
                    mouse.x = -999;
                    mouse.y = -999;
                });

                function startAnimation() {
                    if (!isHeroVisible) {
                        return;
                    }

                    if (prefersReducedMotion) {
                        draw();
                        return;
                    }

                    if (rafId === null) {
                        rafId = window.requestAnimationFrame(draw);
                    }
                }

                if ('IntersectionObserver' in window) {
                    var asciiLayer = heroCanvas.parentElement;
                    var observer = new IntersectionObserver(function (entries) {
                        var entry = entries[0];
                        isHeroVisible = !!(entry && entry.isIntersecting);

                        if (asciiLayer) {
                            asciiLayer.style.display = isHeroVisible ? '' : 'none';
                        }

                        if (!isHeroVisible && rafId !== null) {
                            window.cancelAnimationFrame(rafId);
                            rafId = null;
                        }

                        if (isHeroVisible) {
                            startAnimation();
                        }
                    }, {
                        threshold: 0.05
                    });

                    observer.observe(wrapper);
                }

                ctx.font = '700 15px "Consolas", "Courier New", monospace';
                ctx.textAlign = 'center';

                if (logoSource) {
                    logoImg.onload = function () {
                        logoReady = true;
                        resizeCanvas();
                        startAnimation();
                    };

                    logoImg.onerror = function () {
                        logoReady = false;
                        resizeCanvas();
                        startAnimation();
                    };

                    logoImg.src = logoSource;
                } else {
                    resizeCanvas();
                    startAnimation();
                }

                window.addEventListener('resize', resizeCanvas);

                document.querySelectorAll('[data-team-switcher]').forEach(function(switcher) {
                    var tabs = switcher.querySelectorAll('[data-team-tab]');
                    var panels = switcher.querySelectorAll('[data-team-panel]');

                    tabs.forEach(function(tab) {
                        tab.addEventListener('click', function() {
                            var target = tab.getAttribute('data-team-tab');

                            tabs.forEach(function(otherTab) {
                                var isActive = otherTab === tab;
                                otherTab.classList.toggle('is-active', isActive);
                                otherTab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                            });

                            panels.forEach(function(panel) {
                                var isActive = panel.getAttribute('data-team-panel') === target;
                                panel.classList.toggle('is-active', isActive);
                                panel.hidden = !isActive;
                            });
                        });
                    });
                });
            });
        </script>
    @endsection

    <!--===== TEAM AREA START =====-->

    @php
        $committeeMembers = $members->filter(function ($m) {
            return strcasecmp((string) $m->title, 'Member') !== 0;
        });

        $regularMembers = $members->filter(function ($m) {
            return strcasecmp((string) $m->title, 'Member') === 0;
        });
    @endphp

    <div class="team2 sp sec-bg2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900"><img
                                src="{{ asset('images/logo.png') }}" width="25" alt="">OUR TEAM MEMBER
                        </span>
                        <h2 class="text-anime-style-3">Meet Our Team Member</h2>
                    </div>
                </div>
            </div>

            <div class="team2 sp" id="ourteam">
                <div class="team-switcher" data-team-switcher>
                    <div class="team-switcher__tabs" role="tablist" aria-label="Team categories">
                        <button type="button" class="team-switcher__tab is-active" role="tab" aria-selected="true"
                            data-team-tab="committee">Committee</button>
                        <button type="button" class="team-switcher__tab" role="tab" aria-selected="false"
                            data-team-tab="members">Members</button>
                    </div>

                    <div class="team-switcher__panel is-active" role="tabpanel" data-team-panel="committee">
                        <div class="row team-members-grid mt-20">
                            @foreach ($committeeMembers as $m)
                                <x-team-member-card name="{{ $m->name }}" role="{{ $m->title }}" :links="$m->contacts"
                                    :image="$m->image" />
                            @endforeach
                        </div>
                    </div>

                    <div class="team-switcher__panel" role="tabpanel" data-team-panel="members" hidden>
                        <div class="row team-members-grid mt-20">
                            @foreach ($regularMembers as $m)
                                <x-team-member-card name="{{ $m->name }}" role="{{ $m->title }}" :links="$m->contacts"
                                    :image="$m->image" />
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- Pagenation --}}
                {{-- 
                        <div class="space60"></div>
                        <div class="row">
                            <div class="col-12 m-auto">
                            <div class="theme-pagination text-center">
                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-angle-left"></i></a></li>
                                    <li><a class="active" href="#">01</a></li>
                                    <li><a href="#">02</a></li>
                                    <li>...</li>
                                    <li><a href="#">12</a></li>
                                    <li><a href="#"><i class="fa-solid fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                            </div>
                        </div> --}}

            </div>
        </div>
    </div>

    <!--===== TEAM AREA END =====-->
    @php
        $membersWithStory = $members->filter(function ($m) {
            return $m->hasStory();
        });
            $membersWithStory = $membersWithStory->take(2);
    @endphp
{{-- 
    <x-slider sectionClass="sp member-stories-slider" title="{{ __('Voices of Our Community') }}"
        subtitle="{{ __('Member Stories') }}" icon="{{ asset('images/logo.png') }}" :slidesToShow="2"
        :autoplay="true" :autoplaySpeed="2000" :arrows="false" :dots="false">
        @foreach ($membersWithStory as $m)
            <x-slider-item class="horizontal-slider-item">
                <div class="row align-items-center">
                    <div class="col-md-5 col-sm-12 mb-3 mb-md-0">
                        <div style="height: 300px; overflow: hidden; border-radius: 8px;">
                            <img src="{{ asset('storage/' . $m->image) }}" alt="{{ $m->name }} profile"
                                class="w-100 h-100 object-fit-cover" loading="lazy">
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="author_text p-3">
                            <img src="{{ asset('assets/img/icons/qoute4.png') }}" alt="Quote icon" class="mb-3"
                                style="max-width: 40px;">
                            <h5 class="fs-5 mb-4" style="line-height: 1.6;">
                                "{{ $m->story }}"
                            </h5>
                            <div class="info">
                                <a href="#" class="d-block mb-2 fw-bold" style="color: orange">{{ $m->name }}</a>
                                <p class="m-0 text-muted">{{ $m->title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slider-item>
        @endforeach
    </x-slider> --}}


    <!-- Blog Section -->
    <section class="blog4 sp sec-bg3">
        <div class="container">
            <x-section-heading subtitle="Blog" title="Our Latest Blog & Insight"
                icon="{{ asset('images/logo.png') }}">
                <x-theme-button href="{{ route('blogs') }}" text="View All Blogs" class="text-end md:text-start" />
            </x-section-heading>
            @if ($posts->count())
                @foreach ($posts as $post)
                    <x-blog-card :blog="$post" />
                @endforeach
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    @include('components.contactSection')

    <!-- Newsletter CTA -->
    <section class="cta4">
        <div class="container">
            <div class="row justify-center">
                <div class="col-lg-8">
                    <div class="cta4-form-area text-center">
                        <h2>Join Our Newsletter</h2>
                        <form action="#" class="d-flex gap-3 mt-4">
                            <input type="email" placeholder="Enter Your Email" class="form-control">
                            <x-theme-button type="submit" text="Subscribe" class="newletter-btn"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('styles')
    <style>

        .newletter-btn{
            background: #1d1300 !important;
        }

        .hero4 {
            --hero-bg-0: #090d12;
            --hero-bg-1: #101823;
            --hero-gold: #faa41a;
            --hero-gold-soft: #ffd27a;
            --hero-text: #f7f8fa;
            --hero-muted: #b8c0cc;
            position: relative;
            isolation: isolate;
            overflow: hidden;
            padding: 78px 0 64px;
            background:
                radial-gradient(circle at 20% 18%, rgba(250, 164, 26, 0.24) 0%, rgba(250, 164, 26, 0) 40%),
                radial-gradient(circle at 82% 12%, rgba(255, 210, 122, 0.18) 0%, rgba(255, 210, 122, 0) 42%),
                linear-gradient(130deg, var(--hero-bg-0) 0%, var(--hero-bg-1) 100%);
        }

        .hero4__backdrop {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: radial-gradient(circle at center, rgba(0, 0, 0, 0.95) 45%, transparent 100%);
        }

        .hero4__content-wrap {
            position: relative;
            z-index: 2;
        }

        .hero4__content {
            max-width: 860px;
            margin: 3rem auto auto auto;
            padding-top: 0;
            padding-right: 0;
        }

        .hero4__badge {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.42rem 0.78rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #e5e7eb;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .hero4__title {
            margin-top: 1rem;
            color: var(--hero-text);
            font-size: clamp(1.9rem, 4.4vw, 3.3rem);
            line-height: 1.07;
            text-wrap: balance;
        }

        .hero4__title span {
            color: var(--hero-gold);
        }

        .hero4__lead {
            color: var(--hero-muted);
            max-width: 760px;
            margin-left: auto;
            margin-right: auto;
            font-size: clamp(1rem, 2.1vw, 1.15rem);
            line-height: 1.65;
        }

        .hero4__cta {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .hero4__note {
            color: rgba(247, 248, 250, 0.78);
            font-size: 0.92rem;
            letter-spacing: 0.01em;
        }

        .hero4__ascii {
            position: absolute;
            top: 204px;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            pointer-events: none;
            overflow: visible;
        }

        .hero4__ascii canvas {
            position: absolute;
            left: 50%;
            top: 56%;
            transform: translate(-50%, -50%);
            width: min(72vw, 980px);
            max-width: 95%;
            height: auto;
            display: block;
            opacity: 1;
            filter: none;
        }

        .event-card:hover .hover-scale-105 {
            transform: scale(1.05);
        }

        .hover-text-warning:hover {
            color: #ffc107 !important;
        }

        .w-10 {
            width: 2.5rem;
        }

        .h-10 {
            height: 2.5rem;
        }

        .min-h-200px {
            min-height: 200px;
        }

        .min-h-md-300px {
            min-height: 300px;
        }

        @media (max-width: 768px) {
            .w-md-40 {
                width: 100%;
            }

            .min-h-md-300px {
                min-height: 200px;
            }
        }

        .disabled-opacity-50:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .home-events-slider .ieee-slider .slick-slide {
            display: block;
            box-sizing: border-box;
            /* remove external margins that break centering; use internal padding instead */
            padding: 0 8px;
        }

        .home-events-slider .ieee-slider .slick-slide > * {
            width: 100%;
        }

        .home-events-slider .ieee-slider-item__inner {
            padding: 0.7rem;
        }

        .horizontal-slider-item .row {
            margin: 0;
        }

        #ourteam .team-members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
            margin-left: 0;
            margin-right: 0;
        }

        #ourteam .team-members-grid > [class*='col-'] {
            width: auto;
            max-width: none;
            flex: none;
            padding-left: 0;
            padding-right: 0;
        }

        .team-switcher {
            margin-top: 1.2rem;
        }

        .team-switcher__tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-bottom: 1.1rem;
        }

        .team-switcher__tab {
            border: 0;
            border-radius: 999px;
            padding: 0.75rem 1.35rem;
            font-weight: 700;
            color: #475569;
            background: #e2e8f0;
            transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        .team-switcher__tab.is-active {
            color: #1f2937;
            background: #fbbf24;
            box-shadow: 0 8px 22px rgba(251, 191, 36, 0.4);
        }

        .team-switcher__panel {
            animation: fadeInTeamPanel 0.24s ease;
        }

        @keyframes fadeInTeamPanel {
            from {
                opacity: 0;
                transform: translateY(4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 575px) {
            #ourteam .team-members-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.75rem;
            }
        }

        .member-stories-slider {
            --ieee-theme-primary: #faa41a;
            --ieee-theme-ink: #0f172a;
            --ieee-theme-muted: #94a3b8;
        }

        .member-stories-slider .author_text {
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 14px;
            background: linear-gradient(145deg, #ffffff 0%, #fff9ee 100%);
        }

        .member-stories-slider .author_text .info a {
            color: var(--ieee-theme-ink);
        }

        .member-stories-slider .author_text .info p {
            color: #4b5563 !important;
        }

        .member-stories-slider .ieee-slider .slick-dots {
            bottom: -34px;
            display: flex !important;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .member-stories-slider .ieee-slider .slick-dots li {
            width: auto;
            height: auto;
            margin: 0;
        }

        .member-stories-slider .ieee-slider .slick-dots li button {
            width: 10px;
            height: 10px;
            padding: 0;
        }

        .member-stories-slider .ieee-slider .slick-dots li button:before {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 999px;
            opacity: 1;
            background: var(--ieee-theme-muted);
            transition: all 0.25s ease;
        }

        .member-stories-slider .ieee-slider .slick-dots li.slick-active button:before {
            width: 26px;
            border-radius: 999px;
            background: var(--ieee-theme-primary);
        }

        @media (max-width: 768px) {
            .hero4 {
                padding: 64px 0 52px;
            }

            .hero4__cta {
                gap: 0.55rem;
            }

            .home-events-slider .ieee-slider .slick-slide {
                padding: 0 4px;
            }

            .home-events-slider .ieee-slider-item__inner {
                padding: 0.4rem;
            }

            .member-stories-slider .ieee-slider .slick-dots {
                bottom: -28px;
            }
        }
    </style>
@endpush
</x-base-layout>
