<x-base-layout>
    <div class="hero4" style="background-image: url({{ asset('images/home_bg.png') }}); filter: brightness(0.85);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="main-heading4">
                        <h1 class="text-anime-style-3">Empowering Innovation & <span
                                style="color: #FAA41A">Technology</span></h1>
                        <p class="mt-16" data-aos="fade-left" data-aos-duration="800">
                            Join IEEE Computer Society to explore the world of computing, collaborate with experts, and
                            shape the future of technology.
                        </p>

                        <!-- Call to Action Section -->
                        <div class="hero-cta mt-40" data-aos="fade-up" data-aos-duration="1400">
                            <div class="cta-box">
                                <h3>Ready to Start Your Tech Journey?</h3>
                                <p class="mb-24">Discover upcoming events, workshops, and opportunities to grow your
                                    skills</p>

                                <div class="cta-buttons d-flex gap-15 justify-center flex-wrap">
                                    <div class="button">
                                        <a href="#events" class="theme-btn8">
                                            <span class="theme-btn8__text">
                                                <i class="fas fa-calendar-alt me-2"></i>View Events
                                            </span>
                                        </a>
                                    </div>
                                    <div class="button">
                                        <a href="#projects" class="theme-btn8-secondary">
                                            <span class="theme-btn8__text">
                                                <i class="fas fa-folder-open me-2"></i>Browse Projects
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Next Event Highlight -->
                        <div class="next-event my-5" data-aos="fade-up" data-aos-duration="1600">
                            <div class="event-highlight">
                                <div class="event-badge">
                                    <i class="fas fa-star"></i>
                                    <span>Next Event</span>
                                </div>
                                <h4>Web Development Workshop</h4>
                                <div class="event-details">
                                    <span class="event-date">
                                        <i class="fas fa-calendar"></i>
                                        July 15, 2025
                                    </span>
                                    <span class="event-time">
                                        <i class="fas fa-clock"></i>
                                        2:00 PM - 5:00 PM
                                    </span>
                                    <span class="event-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Tech Lab, Room 201
                                    </span>
                                </div>
                                <a href="#register" class="event-register-btn">
                                    Register Now <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                        {{-- Commented out original buttons
                    <div class="d-flex gap-15 justify-center mt-10">
                        <div class="button">
                            <a href="#" class="theme-btn8">
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__text">Join Us</span>
                            </a>
                        </div>
                        <div class="button">
                            <a href="#" class="theme-btn8-secondary">
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__text">Explore More</span>
                            </a>
                        </div>
                    </div>
                    --}}
                    </div>
                </div>
            </div>
        </div>

        @if (config('app.show_hero_images', false))
            <div class="hero4-images">
                <div class="row mx-auto">
                    <div class="col-lg-3 col-md-6">
                        <div class="hero5-image image1 animate4">
                            <img src="{{ asset('images/python.png') }}" alt="Python 3D logo" width="160">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hero5-image image2 animate2">
                            <img src="{{ asset('images/flutter.png') }}" alt="Flutter 3D logo" width="160">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hero5-image image3 animate3">
                            <img src="{{ asset('images/linux.png') }}" alt="Linux 3D logo" width="160">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 animate1">
                        <div class="hero5-image image4">
                            <img src="{{ asset('images/node-tree.png') }}" alt="Network 3D logo" width="160">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- <script>
        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number[data-count]');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000; // 2 seconds
                const step = target / (duration / 16); // 60fps
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 16);
            });
        }

        // Trigger animation when element comes into view
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Start observing when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            const statsSection = document.querySelector('.hero-stats');
            if (statsSection) {
                observer.observe(statsSection);
            }
        });
    </script> --}}

    <div class="about4 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about4-images">
                        <div class="image1 image-anime reveal">
                            <img src="{{ asset('images/office1.jpg') }}" width="258" height="500"
                                alt="Office Image">
                        </div>
                        <div class="image2 image-anime reveal">
                            <img src="{{ asset('images/office2.jpg') }}" width="258" height="500"
                                alt="Office Image">
                        </div>
                        <div class="shape">
                            <img src="{{ asset('images/office3.jpg') }}" width="258" height="500" alt="Shape">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading4 ml-40 sm:ml-0 md:ml-0">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> About IEEE
                            CS
                        </span>
                        <h2 class="text-anime-style-3">Empowering Future Innovators in Technology</h2>
                        <p class="mt-16" data-aos="fade-left" data-aos-duration="800">
                            IEEE Computer Society (IEEE CS) is a leading community dedicated to advancing computing
                            technology through education, research, and collaboration. We provide students and
                            professionals with opportunities to grow, network, and innovate in the field of computer
                            science.
                        </p>
                        <div class="about4-service-list" data-aos="fade-left" data-aos-duration="1000">
                            <h5>Why Choose Us?</h5>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="list">
                                        <ul>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span>
                                                Cutting-Edge Knowledge</li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span>
                                                Professional Networking</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="list">
                                        <ul>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Hands-on
                                                Learning</li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Career
                                                Growth</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button mt-30" data-aos="fade-left" data-aos-duration="1100">
                            <a href="{{ route('about') }}" class="theme-btn8">
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__shape"></span>
                                <span class="theme-btn8__text">Learn More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="service4 sp sec-bg3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading4">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> Our Focus
                            Areas in Technology
                        </span>
                        <h2 class="text-anime-style-3">Exploring the Frontiers of Innovation</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-end button md:mt-20 sm:mt-20 md:text-start sm:text-start">
                        <a href="{{ route('projects') }}" class="theme-btn8">
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__text">See Projects</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="service4-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icons/service4-icon1.svg') }}" alt="Networking Icon">
                        </div>
                        <div class="heading4 mt-20">
                            <h4><a href="#">Networking & Cloud Computing</a></h4>
                            <p class="mt-16">Building and managing secure, scalable networks and cloud-based
                                infrastructures to power global connectivity.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-delay="300">
                    <div class="service4-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icons/service4-icon2.svg') }}" alt="Linux Icon">
                        </div>
                        <div class="heading4 mt-20">
                            <h4><a href="#">Linux & System Administration</a></h4>
                            <p class="mt-16">Mastering Linux environments, server management, and automation for
                                optimized system performance.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-delay="400">
                    <div class="service4-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icons/service4-icon3.svg') }}" alt="Python Icon">
                        </div>
                        <div class="heading4 mt-20">
                            <h4><a href="#">Python & Software Development</a></h4>
                            <p class="mt-16">Leveraging Python for automation, data science, and software engineering
                                to solve real-world challenges.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6" data-aos="zoom-in-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="service4-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icons/service4-icon1.svg') }}" alt="Cybersecurity Icon">
                        </div>
                        <div class="heading4 mt-20">
                            <h4><a href="#">Cybersecurity & Ethical Hacking</a></h4>
                            <p class="mt-16">Protecting digital assets through penetration testing, cryptography, and
                                advanced security practices.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6" data-aos="zoom-in-up" data-aos-duration="1000" data-aos-delay="300">
                    <div class="service4-box mt-30">
                        <div class="icon">
                            <img src="{{ asset('assets/img/icons/service4-icon1.svg') }}" alt="Web Design Icon">
                        </div>
                        <div class="heading4 mt-20">
                            <h4><a href="#">Web Design & Development</a></h4>
                            <p class="mt-16">Make a lasting impression with a professionally designed and
                                user-friendly website.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="case4 sp sec-bg3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading4">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> Explore Our
                            Latest Events
                        </span>
                        <h2 class="text-anime-style-3">Engaging Activities to Learn, Innovate, and Connect</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-end button md:mt-20 sm:mt-20 md:text-start sm:text-start" data-aos="fade-left"
                        data-aos-duration="800">
                        <a href="{{ route('events') }}" class="theme-btn8">
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__text">View All Events</span>
                        </a>
                    </div>
                </div>
            </div>
            @if ($events && $events->count())
                <div class="row mt-40">
                    <div class="col-lg-10 m-auto">
                        <div class="events-slider-section" data-aos="fade-up" data-aos-duration="800">
                            <!-- Section Header -->
                            <div class="text-center mb-40">
                                <h2 class="events-section-title">Upcoming Events</h2>
                                <p class="events-section-subtitle">Don't miss out on our exciting events and workshops
                                </p>
                            </div>

                            <!-- Slider Container -->
                            <div class="events-slider-container">
                                <div class="events-slider" id="eventsSlider">
                                    @foreach ($events as $index => $event)
                                        <div class="event-slide {{ $index === 0 ? 'active' : '' }}">
                                            <div class="event-card">
                                                <div class="event-image">
                                                    <img src="{{ asset('images/event.png') }}"
                                                        alt="{{ $event->title }}">
                                                    <div class="event-overlay">
                                                        <div class="event-date">
                                                            <span
                                                                class="day">{{ $event->created_at->format('d') }}</span>
                                                            <span
                                                                class="month">{{ $event->created_at->format('M') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="event-content">
                                                    <div class="event-meta">
                                                        <span class="event-category">
                                                            <i class="fas fa-tag"></i>
                                                            Workshop
                                                        </span>
                                                        <span class="event-time">
                                                            <i class="fas fa-clock"></i>
                                                            {{ $event->created_at->format('H:i A') }}
                                                        </span>
                                                    </div>
                                                    <h3 class="event-title">
                                                        <a href="{{ route('events.show', ['event' => $event]) }}">
                                                            {{ $event->title }}
                                                        </a>
                                                    </h3>
                                                    <p class="event-description">
                                                        {{ Str::limit($event->description, 120) }}
                                                    </p>
                                                    <div class="event-footer">
                                                        <div class="event-location">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <span>Tech Lab, Room 201</span>
                                                        </div>
                                                        <a href="{{ route('events.show', ['event' => $event]) }}"
                                                            class="event-btn">
                                                            <span>Learn More</span>
                                                            <i class="fas fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Navigation Arrows -->
                                <div class="slider-nav">
                                    <button class="slider-btn prev-btn" onclick="changeSlide(-1)">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="slider-btn next-btn" onclick="changeSlide(1)">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>

                                <!-- Dots Indicator -->
                                <div class="slider-dots">
                                    @foreach ($events as $index => $event)
                                        <span class="dot {{ $index === 0 ? 'active' : '' }}"
                                            onclick="currentSlide({{ $index + 1 }})"></span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <style>
                /* Events Slider Section */
                .events-slider-section {
                    padding: 40px 0;
                }

                .events-section-title {
                    color: #FAA41A;
                    font-size: 2.5rem;
                    font-weight: bold;
                    margin-bottom: 15px;
                }

                .events-section-subtitle {
                    color: rgba(255, 255, 255, 0.8);
                    font-size: 1.1rem;
                    margin-bottom: 0;
                }

                /* Slider Container */
                .events-slider-container {
                    position: relative;
                    max-width: 100%;
                    margin: 0 auto;
                    overflow: hidden;
                    border-radius: 20px;
                    background: rgba(0, 0, 0, 0.3);
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(250, 164, 26, 0.2);
                }

                .events-slider {
                    display: flex;
                    transition: transform 0.5s ease-in-out;
                    width: 100%;
                }

                .event-slide {
                    min-width: 100%;
                    opacity: 0;
                    transition: opacity 0.5s ease-in-out;
                }

                .event-slide.active {
                    opacity: 1;
                }

                /* Event Card */
                .event-card {
                    display: flex;
                    background: rgba(255, 255, 255, 0.05);
                    border-radius: 15px;
                    overflow: hidden;
                    margin: 20px;
                    transition: all 0.3s ease;
                    border: 1px solid rgba(250, 164, 26, 0.1);
                }

                .event-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 30px rgba(250, 164, 26, 0.2);
                    border-color: rgba(250, 164, 26, 0.3);
                }

                /* Event Image */
                .event-image {
                    position: relative;
                    flex: 0 0 40%;
                    min-height: 300px;
                    overflow: hidden;
                }

                .event-image img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.3s ease;
                }

                .event-card:hover .event-image img {
                    transform: scale(1.05);
                }

                .event-overlay {
                    position: absolute;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #FAA41A, #FF8C00);
                    border-radius: 12px;
                    padding: 8px 12px;
                    text-align: center;
                    box-shadow: 0 4px 15px rgba(250, 164, 26, 0.3);
                }

                .event-date .day {
                    display: block;
                    font-size: 1.5rem;
                    font-weight: bold;
                    color: white;
                    line-height: 1;
                }

                .event-date .month {
                    display: block;
                    font-size: 0.8rem;
                    color: white;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                }

                /* Event Content */
                .event-content {
                    flex: 1;
                    padding: 30px;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }

                .event-meta {
                    display: flex;
                    gap: 20px;
                    margin-bottom: 15px;
                    flex-wrap: wrap;
                }

                .event-category,
                .event-time {
                    color: #FAA41A;
                    font-size: 0.9rem;
                    display: flex;
                    align-items: center;
                    gap: 5px;
                    font-weight: 500;
                }

                .event-title {
                    font-size: 1.8rem;
                    margin-bottom: 15px;
                    line-height: 1.3;
                }

                .event-title a {
                    color: white;
                    text-decoration: none;
                    transition: color 0.3s ease;
                }

                .event-title a:hover {
                    color: #FAA41A;
                }

                .event-description {
                    color: rgba(255, 255, 255, 0.8);
                    line-height: 1.6;
                    margin-bottom: 25px;
                    font-size: 1rem;
                }

                .event-footer {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    flex-wrap: wrap;
                    gap: 15px;
                }

                .event-location {
                    color: rgba(255, 255, 255, 0.7);
                    font-size: 0.9rem;
                    display: flex;
                    align-items: center;
                    gap: 5px;
                }

                .event-location i {
                    color: #FAA41A;
                }

                .event-btn {
                    background: linear-gradient(135deg, #FAA41A, #FF8C00);
                    color: white;
                    padding: 10px 20px;
                    border-radius: 25px;
                    text-decoration: none;
                    font-weight: 600;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    transition: all 0.3s ease;
                    font-size: 0.9rem;
                }

                .event-btn:hover {
                    background: linear-gradient(135deg, #FF8C00, #FAA41A);
                    transform: translateX(5px);
                    color: white;
                    text-decoration: none;
                }

                /* Slider Navigation */
                .slider-nav {
                    position: absolute;
                    top: 50%;
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                    padding: 0 10px;
                    pointer-events: none;
                }

                .slider-btn {
                    background: rgba(250, 164, 26, 0.9);
                    border: none;
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    color: white;
                    font-size: 1.2rem;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    pointer-events: all;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    backdrop-filter: blur(10px);
                }

                .slider-btn:hover {
                    background: #FAA41A;
                    transform: scale(1.1);
                }

                .slider-btn:disabled {
                    opacity: 0.5;
                    cursor: not-allowed;
                }

                /* Slider Dots */
                .slider-dots {
                    text-align: center;
                    padding: 20px 0;
                    display: flex;
                    justify-content: center;
                    gap: 10px;
                }

                .dot {
                    height: 12px;
                    width: 12px;
                    background-color: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    display: inline-block;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .dot.active,
                .dot:hover {
                    background-color: #FAA41A;
                    transform: scale(1.2);
                }

                /* Responsive Design */
                @media (max-width: 768px) {
                    .event-card {
                        flex-direction: column;
                        margin: 15px;
                    }

                    .event-image {
                        flex: none;
                        min-height: 200px;
                    }

                    .event-content {
                        padding: 20px;
                    }

                    .event-title {
                        font-size: 1.4rem;
                    }

                    .events-section-title {
                        font-size: 2rem;
                    }

                    .event-footer {
                        flex-direction: column;
                        align-items: flex-start;
                        gap: 15px;
                    }

                    .slider-btn {
                        width: 40px;
                        height: 40px;
                        font-size: 1rem;
                    }
                }

                @media (max-width: 480px) {
                    .event-card {
                        margin: 10px;
                    }

                    .event-content {
                        padding: 15px;
                    }

                    .events-section-title {
                        font-size: 1.8rem;
                    }
                }
            </style>

            <script>
                let currentSlideIndex = 0;
                const slides = document.querySelectorAll('.event-slide');
                const dots = document.querySelectorAll('.dot');
                const totalSlides = slides.length;

                function showSlide(index) {
                    // Hide all slides
                    slides.forEach(slide => slide.classList.remove('active'));
                    dots.forEach(dot => dot.classList.remove('active'));

                    // Show current slide
                    if (slides[index]) {
                        slides[index].classList.add('active');
                        dots[index].classList.add('active');
                    }

                    // Update navigation buttons
                    const prevBtn = document.querySelector('.prev-btn');
                    const nextBtn = document.querySelector('.next-btn');

                    if (prevBtn && nextBtn) {
                        prevBtn.disabled = index === 0;
                        nextBtn.disabled = index === totalSlides - 1;
                    }
                }

                function changeSlide(direction) {
                    currentSlideIndex += direction;

                    if (currentSlideIndex < 0) {
                        currentSlideIndex = 0;
                    } else if (currentSlideIndex >= totalSlides) {
                        currentSlideIndex = totalSlides - 1;
                    }

                    showSlide(currentSlideIndex);
                }

                function currentSlide(index) {
                    currentSlideIndex = index - 1;
                    showSlide(currentSlideIndex);
                }

                // Auto-slide functionality (optional)
                function autoSlide() {
                    currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
                    showSlide(currentSlideIndex);
                }

                // Initialize slider when DOM is loaded
                document.addEventListener('DOMContentLoaded', function() {
                    if (totalSlides > 0) {
                        showSlide(0);

                        // Optional: Enable auto-slide every 5 seconds
                        // setInterval(autoSlide, 5000);
                    }
                });

                // Keyboard navigation
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowLeft') {
                        changeSlide(-1);
                    } else if (e.key === 'ArrowRight') {
                        changeSlide(1);
                    }
                });

                // Touch/swipe support for mobile
                let startX = 0;
                let endX = 0;

                document.addEventListener('touchstart', function(e) {
                    startX = e.touches[0].clientX;
                });

                document.addEventListener('touchend', function(e) {
                    endX = e.changedTouches[0].clientX;
                    handleSwipe();
                });

                function handleSwipe() {
                    const threshold = 50;
                    const diff = startX - endX;

                    if (Math.abs(diff) > threshold) {
                        if (diff > 0) {
                            changeSlide(1); // Swipe left - next slide
                        } else {
                            changeSlide(-1); // Swipe right - previous slide
                        }
                    }
                }
            </script>
        </div>
    </div>

    <div class="tes4 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading4">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> Member
                            Stories
                        </span>
                        <h2 class="text-anime-style-3">Voices of Our Community</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
            @if ($memberStories)
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="tes4-slider-all mt-60" data-aos="fade-up" data-aos-delay="300"
                            data-aos-duration="900">
                            <div class="tes4-slider">
                                @foreach ($memberStories as $m)
                                    <div class="tes4-single-slider">
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="auhtor_thumb">
                                                    <img src="{{ asset('images/profile.png') }}"
                                                        alt="Member Profile">
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="author_text">
                                                    <div class="qoute">
                                                        <img src="{{ asset('assets/img/icons/qoute4.png') }}"
                                                            alt="Quote Icon">
                                                    </div>
                                                    <h5>"{{ $m->story }}"</h5>
                                                    <div class="info">
                                                        <a href="#">{{ $m->name }}</a>
                                                        <p>{{ $m->role }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="blog4 sp sec-bg3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading4">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> BLOG
                        </span>
                        <h2 class="text-anime-style-3">Our Latest Blog & Insight</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-end button md:mt-20 sm:mt-20 md:text-start sm:text-start">
                        <a href="{{ route('blogs') }}" class="theme-btn8">
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__shape"></span>
                            <span class="theme-btn8__text">View All Blogs</span>
                        </a>
                    </div>
                </div>
            </div>
            @if ($posts->count())
                <div class="row mt-30">
                    @foreach ($posts as $index => $post)
                        @if ($index === 0)
                            <div class="col-lg-12">
                                <div class="vl-blog-4-item big_post mt-30" data-aos="fade-up"
                                    data-aos-duration="1100">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="vl-blog-4-thumb-big image-anime overflow-hidden _relative">
                                                <img class="w-full" src="{{ asset('storage/' . $post->image) }}"
                                                    alt="{{ $post->title }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="vl-blog-4-content heading4">
                                                <div class="vl-blog4-meta pb-16">
                                                    <a href="#" class="date"><img
                                                            src="{{ asset('assets/img/icons/date1.svg') }}"
                                                            alt="Date Icon">
                                                        {{ $post->created_at->format('d/m/Y') }}</a>
                                                    <a href="#" class="author"><img
                                                            src="{{ asset('assets/img/icons/author1.svg') }}"
                                                            alt="Author Icon"> {{ $post->author->name }}</a>
                                                </div>
                                                <h3><a
                                                        href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
                                                </h3>
                                                <p class="mt-16"></p>
                                                <a href="{{ route('blogs.show', $post->slug) }}" class="learn1">Read
                                                    More
                                                    <span class="arrow1"><i
                                                            class="fa-solid fa-arrow-right"></i></span>
                                                    <span class="arrow2"><i
                                                            class="fa-solid fa-arrow-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-4 col-md-6" data-aos="fade-up"
                                data-aos-duration="{{ 800 + $index * 100 }}">
                                <div class="vl-blog-4-item add-bg mt-30">
                                    <div class="vl-blog-4-thumb">

                                        <x-img :img="$post->image" alt="{{ $post->title }}" />
                                    </div>
                                    <div class="vl-blog-4-content heading4 mt-30">
                                        <div class="vl-blog4-meta pb-16">
                                            <a href="#" class="date"><img
                                                    src="{{ asset('assets/img/icons/date1.svg') }}" alt="Date Icon">
                                                {{ $post->created_at->format('d/m/Y') }}</a>
                                            <a href="#" class="author"><img
                                                    src="{{ asset('assets/img/icons/author1.svg') }}"
                                                    alt="Author Icon"> {{ $post->author->name }}</a>
                                        </div>
                                        <h5><a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h5>
                                        <a href="{{ route('blogs.show', $post->slug) }}" class="learn1">Read More
                                            <span class="arrow1"><i class="fa-solid fa-arrow-right"></i></span>
                                            <span class="arrow2"><i class="fa-solid fa-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @include('components.contactSection')

    <div class="cta4">
        <div class="container">
            <div class="row align-items-center justify-center">
                <div class="col-lg-8">
                    <div class="cta4-form-area">
                        <div class="white-heading">
                            <h2>Join Our Newsletter</h2>
                        </div>
                        <div class="form-area">
                            <form action="#">
                                <div class="single-input">
                                    <input type="text" placeholder="Enter Your Email">
                                </div>
                                <div class="button">
                                    <button type="submit" class="theme-btn9">
                                        <span class="theme-btn9__shape"></span>
                                        <span class="theme-btn9__shape"></span>
                                        <span class="theme-btn9__shape"></span>
                                        <span class="theme-btn9__shape"></span>
                                        <span class="theme-btn9__text">Subscribe</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
