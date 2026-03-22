<x-base-layout>
    <!--===== HERO AREA START =====-->

    <x-hero title="{{ __('Our Events') }}" background="{{ asset('images/home_bg.png') }}" :breadcrumbs="[
        ['label' => 'events', 'url' => route('events')],
    ]"/>

    <!--===== HERO AREA START =====-->

    <!--=== EVENTS SHOWCASE START === -->

    <section class="events-showcase sp">
        <div class="container">
            <div class="events-showcase__top">
                <div>
                    <span class="events-showcase__eyebrow">
                        <img src="{{ asset('images/logo.png') }}" alt="IEEE CS" width="22">
                        Events For You
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

    <!--=== EVENTS SHOWCASE END === -->

    <!--===== COUNTER AREA START =====-->

    <div class="inner-page-counter-sec bg-cover"
        style="background-image: url({{ asset('images/network_diagrams.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-heading text-center">
                        <span class="sub-title"><img src="{{ asset('images/logo.png') }}" width="25" alt="">
                            IEEE CS INTERESTING FACTS</span>
                    </div>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-lg col-md-4">
                    <div class="inner-counter-box mt-30">
                        <h3>50+</h3>
                        <p>Number of Events</p>
                    </div>
                </div>

                <div class="col-lg col-md-4">
                    <div class="inner-counter-box mt-30">
                        <h3>10K+</h3>
                        <p>Number of Attendees</p>
                    </div>
                </div>

                <div class="col-lg col-md-4">
                    <div class="inner-counter-box mt-30">
                        <h3>300+</h3>
                        <p>Number of Volunteers</p>
                    </div>
                </div>

                <div class="col-lg col-md-4">
                    <div class="inner-counter-box mt-30">
                        <h3>150+</h3>
                        <p>Number of Speakers</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--===== COUNTER AREA END =====-->

    <!--===== TEAM AREA START =====-->
{{-- 
    <div class="team2 sp sec-bg2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900"><img
                                src="{{ asset('images/logo.png') }}" width="25" alt="">OUR TEAM MEMBER
                        </span>
                        <h2 class="text-anime-style-3">Meet Our Uniqe Team Member</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="button text-end sm:text-start md:text-start md:mt-30 sm:mt-30" data-aos="fade-left"
                        data-aos-duration="1000">
                        <a class="theme-btn3" href="about.html">View All Team <span class="arrow1"><i
                                    class="fa-solid fa-arrow-right"></i></span><span class="arrow2"><i
                                    class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
                    <div class="team2-item mt-30">
                        <div class="team-image-area">
                            <div class="image">
                                <img src="assets/img/team/team2-image1.png" alt="">
                            </div>
                            <div class="shape round-circle">
                                <img src="assets/img/shapes/team2-items-shape.png" alt="">
                            </div>
                            <div class="social-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content-area">
                            <div class="heading2">
                                <h4><a href="#">Rodger Struck</a></h4>
                                <p class="mt-2">Social Media Specialist</p>
                            </div>
                            <div class="plue-icon">
                                <a href="#"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="300">
                    <div class="team2-item mt-30">
                        <div class="team-image-area">
                            <div class="image">
                                <img src="assets/img/team/team2-image2.png" alt="">
                            </div>
                            <div class="shape round-circle">
                                <img src="assets/img/shapes/team2-items-shape.png" alt="">
                            </div>
                            <div class="social-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content-area">
                            <div class="heading2">
                                <h4><a href="#">Alex Buckmaster</a></h4>
                                <p class="mt-2">Marketing Officer</p>
                            </div>
                            <div class="plue-icon">
                                <a href="#"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="400">
                    <div class="team2-item mt-30">
                        <div class="team-image-area">
                            <div class="image">
                                <img src="assets/img/team/team2-image3.png" alt="">
                            </div>
                            <div class="shape round-circle">
                                <img src="assets/img/shapes/team2-items-shape.png" alt="">
                            </div>
                            <div class="social-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content-area">
                            <div class="heading2">
                                <h4><a href="#">Sarah Joe</a></h4>
                                <p class="mt-2">Marketer</p>
                            </div>
                            <div class="plue-icon">
                                <a href="#"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="500">
                    <div class="team2-item mt-30">
                        <div class="team-image-area">
                            <div class="image">
                                <img src="assets/img/team/team2-image4.png" alt="">
                            </div>
                            <div class="shape round-circle">
                                <img src="assets/img/shapes/team2-items-shape.png" alt="">
                            </div>
                            <div class="social-icons">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content-area">
                            <div class="heading2">
                                <h4><a href="#">Chris Glasser</a></h4>
                                <p class="mt-2">Marketer</p>
                            </div>
                            <div class="plue-icon">
                                <a href="#"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <!--===== TEAM AREA END =====-->

    <!--===== CONTACT AREA START =====-->

    @include('components.contactSection')

    <!--===== CONTACT AREA END =====-->

    @push('styles')
        <style>
            .events-showcase {
                --events-bg-1: #f3f8e6;
                --events-bg-2: #e5f2cd;
                position: relative;
                overflow: hidden;
                background:
                    radial-gradient(circle at 8% 10%, rgba(255, 255, 255, 0.85) 0%, rgba(255, 255, 255, 0) 40%),
                    radial-gradient(circle at 85% 25%, rgba(161, 209, 72, 0.45) 0%, rgba(161, 209, 72, 0) 45%),
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
                background: rgba(15, 23, 42, 0.08);
                color: #1f2937;
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
                color: #0f172a;
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
                border: 1px solid rgba(15, 23, 42, 0.16);
                background: rgba(255, 255, 255, 0.76);
                color: #0f172a;
                display: grid;
                place-items: center;
                transition: transform 0.28s ease, background 0.28s ease, color 0.28s ease;
            }

            .events-showcase__arrow:hover {
                background: #0f172a;
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
                border-bottom: 2px solid rgba(15, 23, 42, 0.22);
                transition: color 0.3s ease, border-color 0.3s ease;
            }

            .events-showcase__view-all:hover {
                color: #ff5b37;
                border-color: #ff5b37;
            }

            .events-showcase__empty {
                border-radius: 16px;
                border: 1px dashed rgba(15, 23, 42, 0.22);
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
                if (!sliderEl || typeof Swiper === 'undefined') {
                    return;
                }

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
            });
        </script>
    @endsection
</x-base-layout>
