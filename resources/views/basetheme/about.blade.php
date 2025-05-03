<x-base-layout>


    <!--===== HERO AREA START =====-->

    <div class="inner-hero" style="background-image: url({{asset('images/home_bg.png')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="inner-main-heading lightmode-bg">
                        <h1>About Us</h1>
                        <div class="breadcrumbs-pages">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li class="angle"><i class="fa-solid fa-angle-right"></i></li>
                                <li>About Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== HERO AREA START =====-->

    <!--===== ABOUT AREA START =====-->

    <div class="about2 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about2-images">
                        <div class="image1 image-anime reveal">
                            <img src="{{ asset('images/work.jpg') }}" width="500px" alt="">
                        </div>
                        <div class="image2 image-anime reveal">
                            <img src="{{ asset('images/work2.jpg') }}" width="500px" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading2 ml-30 md:ml-0 sm:ml-0 md:mt-30 sm:mt-30">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900"><img
                                src="{{ asset('images/logo.png') }}" width="25" alt=""> ABOUT US </span>
                        <h2 class="text-anime-style-3">Empowering Innovators, Shaping the Future</h2>
                        <p class="mt-16" data-aos="fade-left" data-aos-duration="700">IEEE Computer Society at Balqa
                            Applied University Faulity Of Technology & Enginering is a dynamic community dedicated to
                            fostering innovation, collaboration,
                            and excellence in computing. We bring together students, professionals, and tech enthusiasts
                            to explore the latest advancements in software development, cybersecurity, AI, and
                            networking. Through hands-on workshops, expert talks, and real-world projects, we empower
                            our members to develop skills, build connections, and lead the future of technology.</p>
                        <p class="mt-16" data-aos="fade-left" data-aos-duration="700">Why Choose Us?
                            Access to exclusive tech workshops and training sessions
                            Opportunities to collaborate on real-world projects
                            Networking with industry professionals and IEEE global chapters
                            A supportive environment to grow, innovate, and excel</p>
                        <div class="button mt-30" data-aos="fade-left" data-aos-duration="1000">
                            <a class="theme-btn3" href="{{route('contact')}}">Contact Us <span class="arrow1"><i
                                        class="fa-solid fa-arrow-right"></i></span><span class="arrow2"><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== ABOUT AREA END =====-->

    <!--===== COUNTER AREA START =====-->

    <div class="inner-page-counter-sec bg-cover" style="background-image: url({{asset('images/network_diagrams.png')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-heading text-center">
                        <span class="sub-title"><img src="{{ asset('images/logo.png') }}" width="25" alt="">
                            IEEE CS INTERESTING
                            FACTS</span>
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

    <!--===== CHOOSE AREA START =====-->

    <div class="about-page-choose sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt=""> WHY JOIN IEEE CS?
                        </span>
                        <h2 class="text-anime-style-3">Empowering Innovators, Shaping the Future</h2>
                        <p class="mt-16">
                            Join a global network of passionate technologists, researchers, and students dedicated to
                            advancing computing and innovation.
                            IEEE Computer Society provides access to resources, mentorship, and real-world opportunities
                            to help you grow, learn, and lead in the tech industry.
                        </p>

                        <div class="about-choose-box mt-24">
                            <h3>Our Mission</h3>
                            <p class="mt-12">
                                "To foster a community of technology enthusiasts, empowering them with knowledge,
                                skills, and opportunities to drive innovation in computing and engineering."
                            </p>
                        </div>

                        <div class="about-choose-box mt-24">
                            <h3>Our Vision</h3>
                            <p class="mt-12">
                                "To be a leading force in shaping the future of technology by inspiring students and
                                professionals to excel in computing, research, and innovation."
                            </p>
                        </div>

                        <div class="button mt-30">
                            <a class="theme-btn3" href="{{ route('contact') }}">
                                Join Us <span class="arrow1"><i class="fa-solid fa-arrow-right"></i></span>
                                <span class="arrow2"><i class="fa-solid fa-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-choose-images ml-50 md:ml-0 sm:ml-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="image mt-30 image-anime reveal">
                                    <img class="w-full" src="{{ asset('images/about1.png') }}"
                                        alt="">
                                </div>
                                <div class="image mt-30 image-anime reveal">
                                    <img class="w-full" src="{{ asset('images/about2.png') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="image image-anime reveal md:mt-30 sm:mt-30">
                                    <img class="w-full" src="{{ asset('images/about3.png') }}"
                                        alt="">
                                </div>
                                <div class="image image-anime reveal md:mt-30 sm:mt-30">
                                    <img class="w-full" src="{{ asset('images/about4.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== CHOOSE AREA END =====-->

    <!--===== OUR FOCUS AREA START =====-->

    <div class="service1 sp sp sec-bg2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading2">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt=""> WHAT WE DO
                        </span>
                        <h2 class="text-anime-style-3">Advancing Technology, Empowering Innovators</h2>
                        <p class="mt-16">
                            IEEE Computer Society is dedicated to fostering knowledge, collaboration, and innovation in
                            computing and technology.
                            Through educational programs, research, and hands-on experiences, we help students and
                            professionals excel in various fields of computer science and engineering.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="overflow-hidden">
                        <div class="service1-image image-anime reveal md:mt-30 sm:mt-30">
                            <img src="{{ asset('images/about5.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
                    <div class="about-service-box mt-30">
                        <div class="num">
                            <p>1</p>
                        </div>
                        <div class="heading2">
                            <h5><a href="#">Networking</a></h5>
                            <p class="mt-16">Exploring the fundamentals and advancements in computer networking and
                                communication.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="300">
                    <div class="about-service-box mt-30">
                        <div class="num">
                            <p>2</p>
                        </div>
                        <div class="heading2">
                            <h5><a href="#">Linux & Open Source</a></h5>
                            <p class="mt-16">Advocating for open-source technologies and Linux-based system
                                administration.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="400">
                    <div class="about-service-box mt-30">
                        <div class="num">
                            <p>3</p>
                        </div>
                        <div class="heading2">
                            <h5><a href="#">Python Development</a></h5>
                            <p class="mt-16">Focusing on Python programming, from automation to artificial
                                intelligence.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="500">
                    <div class="about-service-box mt-30">
                        <div class="num">
                            <p>4</p>
                        </div>
                        <div class="heading2">
                            <h5><a href="#">Cybersecurity</a></h5>
                            <p class="mt-16">Enhancing knowledge in ethical hacking, digital forensics, and
                                cybersecurity defense.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="600">
                    <div class="about-service-box mt-30">
                        <div class="num">
                            <p>5</p>
                        </div>
                        <div class="heading2">
                            <h5><a href="#">Artificial Intelligence</a></h5>
                            <p class="mt-16">Exploring AI, machine learning, and data science applications in
                                real-world problems.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== OUR FOCUS AREA END =====-->

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
    </div>

    <!--===== TEAM AREA END =====-->

    <!--===== CONTACT AREA START =====-->
    @include('components.contactSection')

    <!--===== CONTACT AREA END =====-->


</x-base-layout>
