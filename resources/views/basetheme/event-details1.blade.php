<x-base-layout>

    <!--===== HERO AREA START =====-->

    <x-hero title="{{ $event->title }}" background="{{ asset('images/home_bg.png') }}" :breadcrumbs="[['label' => 'events', 'url' => route('events')], ['label' => $event->slug]]" />

    <!--===== HERO AREA START =====-->

    <!--===== BLOG DETAILS AREA START =====-->

    <div class="blog-details-area sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <article>
                        <div class="details-content">
                            <div class="image d-flex">
                                <img class="mx-auto" src="{{ asset('images/event.png') }}" style="width: 60%"
                                    alt="">
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-area mt-50">
                        {{-- <div class="_sidebar-widget _search">
                            <h3>Search</h3>
                            <form action="#" class="_relative">
                                <input type="search" placeholder="Search...">
                                <button><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <div class="_sidebar-widget _list mt-40">
                            <h3>Categories</h3>
                            <div class="sidebar-list">
                                <ul>
                                    <li><a href="service-details1.html" class="active">SEO Marketing <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                    <li><a href="service-details2.html">Social Media Strategy <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                    <li><a href="service-details3.html">Content Marketing <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                    <li><a href="service-details4.html">Pay-Per-Click Advertising <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                    <li><a href="service-details5.html">Travel Guide Expertise <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                    <li><a href="service-details6.html">HR Staffing Agency <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                    <li><a href="service-details7.html">Insurance Policy <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                    <li><a href="service-details8.html">Real Estate <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                    <li><a href="service-details9.html">Startup Agency <span><i
                                                    class="fa-solid fa-angle-right"></i></span></a></li>
                                </ul>
                            </div>
                        </div> --}}

                        {{-- <div class="_sidebar-widget _buttons mt-40">
                            <h3>You Still Have A Question</h3>
                            <p class="mt-16">If you cannot find answer to your question our FAQ, you can always contact
                                us. Web will answer you shortly!</p>
                            <div class="buttons mt-16">
                                <a href="mailto:Infoseoxagency@gmail.com" class="sidebar-btn1"><img
                                        src="assets/img/icons/sidebar-email.png" alt="">
                                    Infoseoxagency@gmail.com</a>
                                <a href="tel:123-456-7890" class="sidebar-btn2"><img
                                        src="assets/img/icons/sidebar-phone.png" alt=""> 123-456-7890</a>
                            </div>
                        </div> --}}

                        <div class="_sidebar-widget _contact mt-40">
                            <h3>Get A Free Quote</h3>
                            <div class="_contact-form mt-10">
                                <form action="#">
                                    <input type="text" placeholder="Your Name">
                                    <input type="email" placeholder="Email Address">
                                    <input type="number" placeholder="Phone Number">
                                    <textarea rows="5" placeholder="Your Message"></textarea>

                                    <button class="theme-btn3 mt-20" type="submit">Send <span class="arrow1"><i
                                                class="fa-solid fa-arrow-right"></i></span><span class="arrow2"><i
                                                class="fa-solid fa-arrow-right"></i></span></button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-details-content ml-30 md:ml-0 sm:ml-0 mt-50">
                        <article>
                            <div class="details-content"
                                style="line-height: 37px;display: flex;flex-direction: column;gap: 25px;">
                                <div class="heading2 mt-24">
                                    <h3>{{ $event->title }}</h3>
                                    <p class=" mt-16">{{ $event->description }}</p>
                                </div>

                                {!! $event->content !!}

                            </div>
                        </article>

                        <div class="details-border"></div>

                        <div class="row">
                            <h2 class="mb-5">Sponser</h2>
                            <div class="col-lg-4 col-md-6">
                                <div class="service-details-box1 text-center">
                                    <div class="icon">
                                        <img src="https://imgs.search.brave.com/NysYgIXU-ivLF6pENutcD3NsKHSPAUDeQjCbgKczQkE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/a2licmlzcGRyLm9y/Zy9kYXRhLzc1NS9s/b2dvLWtvcGktZ29v/ZC1kYXktMC5qcGc"
                                            alt="">
                                    </div>
                                    <div class="heading2 mt-16">
                                        <h4><a href="#">Goodday </a></h4>
                                        <p class="mt-10">Coffe & nescafe </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="service-details-box1 text-center sm:mt-30">
                                    <div class="icon">
                                        <img src="https://imgs.search.brave.com/d8pOr4qP8R_attAC5OJzhzwdi7KTeuzIE0ft7F67oGI/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9hbC1o/dWRheWRhaC5jb20v/d3AtY29udGVudC91/cGxvYWRzLzIwMjMv/MDUvS0lUQ08ucG5n"
                                            alt="">
                                    </div>
                                    <div class="heading2 mt-16">
                                        <h4><a href="#">Kitco </a></h4>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="details-border"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== BLOG DETAILS AREA END =====-->

    <!--===== CTA AREA STARTS =======-->
    {{-- <div class="cta-section-area others-cta sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="cta-header-area text-center sp4 white-heading">
                        <h2>Competitor Analysis</h2>
                        <p class="mt-16">Find the keywords your competitors rank for and analyze their <br
                                class="d-lg-block d-none"> data insights to uncover their SEO strategy in one click</p>
                        <div class="space40"></div>
                        <div class="form-area">
                            <form>
                                <div class="input-area">
                                    <span><i class="fa-solid fa-link"></i></span>
                                    <input type="text" placeholder="https:// yoursite.com">
                                </div>

                                <div class="input-area">
                                    <span><i class="fa-regular fa-envelope"></i></span>
                                    <input type="text" placeholder="youremail@domain.com">
                                </div>
                                <div class="btn-area">
                                    <button class="theme-btn3" type="submit">Contact Us <span class="arrow1"><i
                                                class="fa-solid fa-arrow-right"></i></span><span class="arrow2"><i
                                                class="fa-solid fa-arrow-right"></i></span></button>
                                </div>
                            </form>
                        </div>
                        <ul>
                            <li>Try:</li>
                            <li><a href="#">Marketing</a></li>
                            <li><a href="#">Laptop</a></li>
                            <li><a href="#">iPhone</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--===== CTA AREA ENDS =======-->

    <!-- schedule-area-start -->
    <section class="schedule-area sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto text-center">
                    <div class="heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/calendar-icon.png') }}" width="25" alt=""> EVENT
                            SCHEDULE
                        </span>
                        <h2 class="text-anime-style-3">Conference Agenda & Timeline</h2>
                    </div>
                </div>
            </div>
            <div class="space60"></div>
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="schedule-timeline">
                        <div class="schedule-scroll p-4">
                            <div class="schedule-head">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-4 col-4">
                                        <div class="schedule-heading">
                                            <h4 class="schedule-heading-title">Time Slot</h4>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-8">
                                        <div class="schedule-categories">
                                            <div class="row">
                                                <div class="col-lg-4 col-4">
                                                    <div class="schedule-heading-item schedule-category-one">
                                                        <span>Session</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-5">
                                                    <div class="schedule-heading-item schedule-category-two">
                                                        <span>Description</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-3">
                                                    <div class="schedule-heading-item schedule-category-three">
                                                        <span>Speaker</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Item 1 -->
                            <div class="schedule-item">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-4 col-4">
                                        <div class="schedule-time">
                                            <span class="time-range">04:00 - 05:00</span>
                                            <span class="time-zone">GMT+3</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-8">
                                        <div class="schedule-details">
                                            <div class="row">
                                                <div class="col-lg-4 col-4">
                                                    <div class="schedule-detail-item schedule-session">
                                                        <span>Registration</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-5">
                                                    <div class="schedule-detail-item schedule-description">
                                                        <p>Welcome address, conference opening, and registration
                                                            process.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-3">
                                                    <div class="schedule-detail-item schedule-speaker">
                                                        <span>-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Item 2 -->
                            <div class="schedule-item">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-4 col-4">
                                        <div class="schedule-time">
                                            <span class="time-range">05:00 - 06:00</span>
                                            <span class="time-zone">GMT+3</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-8">
                                        <div class="schedule-details">
                                            <div class="row">
                                                <div class="col-lg-4 col-4">
                                                    <div class="schedule-detail-item schedule-session">
                                                        <span>Beginning of Competition</span>
                                                        <span>Tasks 1 & 2 Reveal</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-5">
                                                    <div class="schedule-detail-item schedule-description">
                                                        <p>Introduction to the competition with the reveal of Tasks 1
                                                            and 2 for participants.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-3">
                                                    <div class="schedule-detail-item schedule-speaker">
                                                        <span>-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Item 3 -->
                            <div class="schedule-item">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-4 col-4">
                                        <div class="schedule-time">
                                            <span class="time-range">06:00 - 07:00</span>
                                            <span class="time-zone">GMT+3</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-8">
                                        <div class="schedule-details">
                                            <div class="row">
                                                <div class="col-lg-4 col-4">
                                                    <div class="schedule-detail-item schedule-session">
                                                        <span>Tasks 3 & 4 Reveal</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-5">
                                                    <div class="schedule-detail-item schedule-description">
                                                        <p>Reveal of Tasks 3 and 4 for participants to continue the
                                                            competition.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-3">
                                                    <div class="schedule-detail-item schedule-speaker">
                                                        <span>-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Item 4 -->
                            <div class="schedule-item">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-4 col-4">
                                        <div class="schedule-time">
                                            <span class="time-range">07:00 - 07:20</span>
                                            <span class="time-zone">GMT+3</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-8">
                                        <div class="schedule-details">
                                            <div class="row">
                                                <div class="col-lg-4 col-4">
                                                    <div class="schedule-detail-item schedule-session">
                                                        <span>Lunch Break</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-5">
                                                    <div class="schedule-detail-item schedule-description">
                                                        <p>Networking lunch with fellow attendees.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-3">
                                                    <div class="schedule-detail-item schedule-speaker">
                                                        <span>-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Item 5 -->
                            <div class="schedule-item">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-4 col-4">
                                        <div class="schedule-time">
                                            <span class="time-range">07:20 - 08:00</span>
                                            <span class="time-zone">GMT+3</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-8">
                                        <div class="schedule-details">
                                            <div class="row">
                                                <div class="col-lg-4 col-4">
                                                    <div class="schedule-detail-item schedule-session">
                                                        <span>Tasks 5 & 6 Reveal</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-5">
                                                    <div class="schedule-detail-item schedule-description">
                                                        <p>Reveal of the final Tasks 5 and 6 for the competition.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-3">
                                                    <div class="schedule-detail-item schedule-speaker">
                                                        <span>-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Item 6 -->
                            <div class="schedule-item">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-4 col-4">
                                        <div class="schedule-time">
                                            <span class="time-range">08:00 - 09:00</span>
                                            <span class="time-zone">GMT+3</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-8">
                                        <div class="schedule-details">
                                            <div class="row">
                                                <div class="col-lg-4 col-4">
                                                    <div class="schedule-detail-item schedule-session">
                                                        <span>Last Hour Countdown</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-5">
                                                    <div class="schedule-detail-item schedule-description">
                                                        <p>Final hour for participants to complete all tasks before the
                                                            competition ends.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-3">
                                                    <div class="schedule-detail-item schedule-speaker">
                                                        <span>-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Item 7 -->
                            <div class="schedule-item">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 col-lg-4 col-4">
                                        <div class="schedule-time">
                                            <span class="time-range">09:00 - 09:30</span>
                                            <span class="time-zone">GMT+3</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-8 col-8">
                                        <div class="schedule-details">
                                            <div class="row">
                                                <div class="col-lg-4 col-4">
                                                    <div class="schedule-detail-item schedule-session">
                                                        <span>Crowning the Winners</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-5">
                                                    <div class="schedule-detail-item schedule-description">
                                                        <p>Announcement and crowning of the competition winners,
                                                            followed by closing remarks.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-3">
                                                    <div class="schedule-detail-item schedule-speaker">
                                                        <span>-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- analysis-area-end -->

    <!--===== SERVICE SECTION AREA START =====-->

    <div class="service sp sec-bg1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto text-center">
                    <div class="heading2">
                        <h2>More Events</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-30">
                @foreach ($otherEvents as $event)
                    <x-event-card :event="$event" />
                @endforeach
            </div>
        </div>
    </div>

    <!--===== SERVICE SECTION AREA END =====-->

    {{-- <!--===== CONTACT AREA START =====-->

    <div class="contact2 sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading2">
                        <div class="contact2-form">
                            <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900"><img
                                    src="{{ asset('images/logo.png') }}" width="25" alt="">CONTACT US
                            </span>
                            <h2 class="text-anime-style-3">Lets Work Together</h2>
                            <p class="mt-16" data-aos="fade-right" data-aos-duration="900">eady to take your social
                                media presence to the next level? Let’s work together to create impactful strategies
                                drive engagement, growth, and success for your brand.</p>
                            <form action="#" data-aos="fade-right" data-aos-duration="1000">
                                <div class="row mt-16">
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="text" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="text" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="email" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input">
                                            <input type="number" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-input">
                                            <select class="wide">
                                                <option value="1">Service Type</option>
                                                <option value="2">Option 1</option>
                                                <option value="3">Option 2</option>
                                                <option value="4">Option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-input">
                                            <textarea rows="5" placeholder="How can we help you?"></textarea>
                                        </div>
                                        <div class="button mt-30">
                                            <button class="theme-btn3" type="submit">Send <span class="arrow1"><i
                                                        class="fa-solid fa-arrow-right"></i></span><span
                                                    class="arrow2"><i
                                                        class="fa-solid fa-arrow-right"></i></span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact2-image image-anime reveal ml-40 md:ml-0 sm:ml-0 md:mt-30 sm:mt-30">
                        <img class="w-full" src="assets/img/others/contact2-image.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!--===== CONTACT AREA END =====-->
</x-base-layout>
