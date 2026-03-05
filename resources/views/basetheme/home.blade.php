<x-base-layout>
    <!-- Hero Section -->
    <section class="hero4" style="background-image: url({{ asset('images/home_bg.png') }}); filter: brightness(0.85);">
        <div class="container text-center">
            <div class="main-heading4">
                <h1 class="text-anime-style-3">Empowerinsssg Innovation & <span style="color: #FAA41A">Technology</span>
                </h1>
                <p class="mt-4" data-aos="fade-left" data-aos-duration="800">
                    Join IEEE Computer Society to explore computing, collaborate with experts, and shape technology's
                    future.
                </p>

                <!-- Call to Action -->
                <div class="hero-cta mt-5" data-aos="fade-up" data-aos-duration="1400">
                    <div class="cta-box">
                        <h3>Ready to Start Your Tech Journey?</h3>
                        <p class="mb-4">Discover events, workshops, and opportunities to grow your skills with our
                            IEEE CS community</p>
                        <div class="d-flex gap-3 justify-center flex-wrap">
                            <x-theme-button href="#events" icon="fa-calendar-alt" text="JOIN US" />
                            {{-- <x-theme-button href="#projects" icon="fa-folder-open" text="Browse Projects" secondary /> --}}
                        </div>
                    </div>
                </div>

                <!-- Next Event -->
                {{-- <div class="next-event mt-5" data-aos="fade-up" data-aos-duration="1600">
                    <div class="event-highlight">
                        <div class="event-badge">
                            <i class="fas fa-star"></i> Next Event
                        </div>
                        <h4>Web Development Workshop</h4>
                        <div class="event-details">
                            <span><i class="fas fa-calendar"></i> July 15, 2025</span>
                            <span><i class="fas fa-clock"></i> 2:00 PM - 5:00 PM</span>
                            <span><i class="fas fa-map-marker-alt"></i> Tech Lab, Room 201</span>
                        </div>
                        <a href="#register" class="event-register-btn">Register Now <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div> --}}
            </div>

            @if (config('app.show_hero_images', false))
                <div class="hero4-images mt-5">
                    <div class="row mx-auto">
                        @foreach (['python.png', 'flutter.png', 'linux.png', 'node-tree.png'] as $img)
                            <div class="col-lg-3 col-md-6">
                                <div class="hero5-image animate4">
                                    <img src="{{ asset('images/' . $img) }}"
                                        alt="{{ Str::title(str_replace('.png', '', $img)) }} logo" width="160"
                                        loading="lazy">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
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
    <x-slider sectionClass="case4 sp sec-bg3" title="Engaging Activities to Learn, Innovate, and Connect"
        subtitle="Explore Our Latest Events" icon="{{ asset('images/logo.png') }}" :slidesToShow="3" :autoplay="true"
        :autoplaySpeed="4000" :arrows="false" :dots="false">
        <x-slot name="heading">
            <x-theme-button href="{{ route('events') }}" text="View All Events"
                class="text-end md:text-start mt-5 mb-5" />
        </x-slot>

        @foreach ($events as $event)
            <x-slider-item>
                <x-event-card :event="$event" />
            </x-slider-item>
        @endforeach
    </x-slider>


    <!--===== TEAM AREA START =====-->

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
                <div class="row">
                    @foreach ($members as $m)
                        <x-team-member-card name="{{ $m->name }}" role="{{ $m->title }}" :links="$m->contacts"
                            :image="$m->image" />
                    @endforeach
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
        $membersWithStoy = $members->filter(function ($m) {
            return $m->hasStory();
        });
    @endphp

    <x-slider sectionClass="tes4 sp" title="{{ __('Voices of Our Community') }}"
        subtitle="{{ __('Member Stories') }}" icon="{{ asset('images/logo.png') }}" :slidesToShow="1"
        :autoplay="true" :autoplaySpeed="2000" :arrows="false" :dots="true">
        @foreach ($membersWithStoy as $m)
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
                                <a href="#" class="d-block mb-2 fw-bold">{{ $m->name }}</a>
                                <p class="m-0 text-muted">{{ $m->title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slider-item>
        @endforeach
    </x-slider>


    <!-- Blog Section -->
    <section class="blog4 sp sec-bg3">
        <div class="container">
            <x-section-heading subtitle="Blog" title="Our Latest Blog & Insight"
                icon="{{ asset('images/logo.png') }}">
                <x-theme-button href="{{ route('blogs') }}" text="View All Blogs" class="text-end md:text-start" />
            </x-section-heading>
            @if ($posts->count())
                <div class="row mt-4">
                    @foreach ($posts as $index => $post)
                        <div class="{{ $index === 0 ? 'col-lg-12' : 'col-lg-4 col-md-6' }}" data-aos="fade-up"
                            data-aos-duration="{{ 800 + $index * 100 }}">
                            <div class="vl-blog-4-item {{ $index === 0 ? 'big_post' : 'add-bg' }} mt-4">
                                <div
                                    class="vl-blog-4-thumb {{ $index === 0 ? 'vl-blog-4-thumb-big' : '' }} image-anime overflow-hidden">
                                    <x-img :img="$post->image" alt="{{ $post->title }} blog image" />
                                </div>
                                <div class="vl-blog-4-content heading4 mt-3">
                                    <div class="vl-blog4-meta pb-3">
                                        <a href="#" class="date"><img
                                                src="{{ asset('assets/img/icons/date1.svg') }}" alt="Date icon">
                                            {{ $post->created_at->format('d/m/Y') }}</a>
                                        <a href="#" class="author"><img
                                                src="{{ asset('assets/img/icons/author1.svg') }}" alt="Author icon">
                                            {{ $post->author->name }}</a>
                                    </div>
                                    <h5><a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a></h5>
                                    <a href="{{ route('blogs.show', $post->slug) }}" class="learn1">Read More <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
</x-base-layout>

@section('styles')
    <style>
        .hero4 {
            padding: 60px 0;
        }

        .event-slide:not(.active) {
            opacity: 0;
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

        .tes4-slider .slick-slide {
            display: block;
            box-sizing: border-box;
            /* remove external margins that break centering; use internal padding instead */
            padding: 0 10px;
        }

        .tes4-slider .slick-slide > * {
            width: 100%;
        }

        .tes4-slider img {
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block;
        }

        .horizontal-slider-item .row {
            margin: 0;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slider = document.getElementById('eventsSlider');
            if (!slider) return;

            const slides = slider.querySelectorAll('.event-slide');
            const dots = document.querySelectorAll('.dot');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            let currentIndex = 0;
            let touchStartX = 0;
            let autoSlideInterval;

            function updateSlide(index) {
                if (index < 0 || index >= slides.length) return;
                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                    slide.setAttribute('aria-hidden', i !== index);
                });
                dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
                prevBtn.disabled = index === 0;
                nextBtn.disabled = index === slides.length - 1;
                currentIndex = index;
            }

            function changeSlide(direction) {
                updateSlide(currentIndex + direction);
            }

            window.currentSlide = (index) => {
                updateSlide(index);
            };

            function startAutoSlide() {
                autoSlideInterval = setInterval(() => changeSlide(1), 5000);
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            prevBtn?.addEventListener('click', () => {
                stopAutoSlide();
                changeSlide(-1);
                startAutoSlide();
            });

            nextBtn?.addEventListener('click', () => {
                stopAutoSlide();
                changeSlide(1);
                startAutoSlide();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopAutoSlide();
                    currentSlide(index);
                    startAutoSlide();
                });
            });

            slider.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    stopAutoSlide();
                    changeSlide(-1);
                    startAutoSlide();
                } else if (e.key === 'ArrowRight') {
                    stopAutoSlide();
                    changeSlide(1);
                    startAutoSlide();
                }
            });

            slider.addEventListener('touchstart', (e) => {
                touchStartX = e.touches[0].clientX;
                stopAutoSlide();
            }, {
                passive: true
            });

            slider.addEventListener('touchend', (e) => {
                const touchEndX = e.changedTouches[0].clientX;
                const diff = touchStartX - touchEndX;
                if (Math.abs(diff) > 50) {
                    changeSlide(diff > 0 ? 1 : -1);
                }
                startAutoSlide();
            }, {
                passive: true
            });

            if (slides.length > 0) {
                updateSlide(0);
                slider.tabIndex = 0;
                startAutoSlide();
                slider.addEventListener('mouseenter', stopAutoSlide);
                slider.addEventListener('mouseleave', startAutoSlide);
            }
        });
    </script>
@endsection
