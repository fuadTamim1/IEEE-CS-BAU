<x-base-layout>
    <div class="hero4" style="background-image: url({{ asset('images/home_bg.png') }}); filter: brightness(0.85);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="main-heading4">
                        <h1 class="text-anime-style-3">Empowering Innovation & <span style="color: #FAA41A">Technology</span></h1>
                        <p class="mt-16" data-aos="fade-left" data-aos-duration="800">
                            Join IEEE Computer Society to explore the world of computing, collaborate with experts, and shape the future of technology.
                        </p>
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
                    </div>
                </div>
            </div>
        </div>
        @if(config('app.show_hero_images', false))
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

    <div class="about4 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about4-images">
                        <div class="image1 image-anime reveal">
                            <img src="{{ asset('images/office1.jpg') }}" width="258" height="500" alt="Office Image">
                        </div>
                        <div class="image2 image-anime reveal">
                            <img src="{{ asset('images/office2.jpg') }}" width="258" height="500" alt="Office Image">
                        </div>
                        <div class="shape">
                            <img src="{{ asset('images/office3.jpg') }}" width="258" height="500" alt="Shape">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading4 ml-40 sm:ml-0 md:ml-0">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> About IEEE CS
                        </span>
                        <h2 class="text-anime-style-3">Empowering Future Innovators in Technology</h2>
                        <p class="mt-16" data-aos="fade-left" data-aos-duration="800">
                            IEEE Computer Society (IEEE CS) is a leading community dedicated to advancing computing technology through education, research, and collaboration. We provide students and professionals with opportunities to grow, network, and innovate in the field of computer science.
                        </p>
                        <div class="about4-service-list" data-aos="fade-left" data-aos-duration="1000">
                            <h5>Why Choose Us?</h5>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="list">
                                        <ul>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Cutting-Edge Knowledge</li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Professional Networking</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="list">
                                        <ul>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Hands-on Learning</li>
                                            <li><span class="check"><i class="fa-solid fa-check"></i></span> Career Growth</li>
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
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> Our Focus Areas in Technology
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
                            <p class="mt-16">Building and managing secure, scalable networks and cloud-based infrastructures to power global connectivity.</p>
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
                            <p class="mt-16">Mastering Linux environments, server management, and automation for optimized system performance.</p>
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
                            <p class="mt-16">Leveraging Python for automation, data science, and software engineering to solve real-world challenges.</p>
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
                            <p class="mt-16">Protecting digital assets through penetration testing, cryptography, and advanced security practices.</p>
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
                            <p class="mt-16">Make a lasting impression with a professionally designed and user-friendly website.</p>
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
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> Explore Our Latest Events
                        </span>
                        <h2 class="text-anime-style-3">Engaging Activities to Learn, Innovate, and Connect</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-end button md:mt-20 sm:mt-20 md:text-start sm:text-start" data-aos="fade-left" data-aos-duration="800">
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
                    <div class="col-lg-7 m-auto">
                        <div class="case4-slider-all" data-aos="fade发力up" data-aos-duration="800">
                            <div class="testimonial2-slider-area">
                                <div class="rev_slider">
                                    @foreach ($events as $event)
                                        <div class="rev_slide">
                                            <div class="test">
                                                <img src="{{ asset('images/event.png') }}" alt="Event Image">
                                            </div>
                                            <div class="text">
                                                <a href="{{ route('events.show', ['event' => $event]) }}" class="theme-btn8">
                                                    Learn More
                                                </a>
                                                <div class="heading4 mt-20">
                                                    <h4><a href="{{ route('events.show', ['event' => $event]) }}">{{ $event->title }}</a></h4>
                                                    <p class="mt-10">{{ $event->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rev_slide">
                                            <div class="test">
                                                <img src="{{ asset('images/event.png') }}" alt="Event Image">
                                            </div>
                                            <div class="text">
                                                <a href="{{ route('events.show', ['event' => $event]) }}" class="theme-btn8">
                                                    Learn More
                                                </a>
                                                <div class="heading4 mt-20">
                                                    <h4><a href="{{ route('events.show', ['event' => $event]) }}">{{ $event->title }}</a></h4>
                                                    <p class="mt-10">{{ $event->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="tes4 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading4">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
                            <img src="{{ asset('images/logo.png') }}" width="25" alt="IEEE CS Logo"> Member Stories
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
                        <div class="tes4-slider-all mt-60" data-aos="fade-up" data-aos-delay="300" data-aos-duration="900">
                            <div class="tes4-slider">
                                @foreach ($memberStories as $m)
                                    <div class="tes4-single-slider">
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="auhtor_thumb">
                                                    <img src="{{ asset('images/profile.png') }}" alt="Member Profile">
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="author_text">
                                                    <div class="qoute">
                                                        <img src="{{ asset('assets/img/icons/qoute4.png') }}" alt="Quote Icon">
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
                                <div class="vl-blog-4-item big_post mt-30" data-aos="fade-up" data-aos-duration="1100">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="vl-blog-4-thumb-big image-anime overflow-hidden _relative">
                                                <img class="w-full" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="vl-blog-4-content heading4">
                                                <div class="vl-blog4-meta pb-16">
                                                    <a href="#" class="date"><img src="{{ asset('img/icons/date1.svg') }}" alt="Date Icon"> {{ $post->created_at->format('d/m/Y') }}</a>
                                                    <a href="#" class="author"><img src="{{ asset('img/icons/author1.svg') }}" alt="Author Icon"> {{ $post->author->name }}</a>
                                                </div>
                                                <h3><a href="blog-details.html">{{ $post->title }}</a></h3>
                                                <p class="mt-16"></p>
                                                <a href="blog-details.html" class="learn1">Read More
                                                    <span class="arrow1"><i class="fa-solid fa-arrow-right"></i></span>
                                                    <span class="arrow2"><i class="fa-solid fa-arrow-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="{{ 800 + $index * 100 }}">
                                <div class="vl-blog-4-item add-bg mt-30">
                                    <div class="vl-blog-4-thumb">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                                    </div>
                                    <div class="vl-blog-4-content heading4 mt-30">
                                        <div class="vl-blog4-meta pb-16">
                                            <a href="#" class="date"><img src="{{ asset('img/icons/date1.svg') }}" alt="Date Icon"> {{ $post->created_at->format('d/m/Y') }}</a>
                                            <a href="#" class="author"><img src="{{ asset('img/icons/author1.svg') }}" alt="Author Icon"> {{ $post->author->name }}</a>
                                        </div>
                                        <h5><a href="blog-details.html">{{ $post->title }}</a></h5>
                                        <a href="blog-details.html" class="learn1">Read More
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