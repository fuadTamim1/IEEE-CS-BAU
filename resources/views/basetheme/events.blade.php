<x-base-layout>
    <!--===== HERO AREA START =====-->

    <x-hero title="{{ __('Our Events') }}" background="{{ asset('images/home_bg.png') }}" :breadcrumbs="[
        ['label' => 'events', 'url' => route('events')],
    ]"/>

    <!--===== HERO AREA START =====-->

    <!--=== SERVICE AREA START === -->

    <div class="service5 sp">
        <div class="container">
            <div class="row">
                @foreach ($events as $e)
                    <x-event-card :event=$e/>
                @endforeach
            </div>
        </div>
    </div>

    <!--=== SERVICE AREA END === -->

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
</x-base-layout>
