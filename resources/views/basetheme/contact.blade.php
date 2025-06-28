<x-base-layout>
    <!--===== HERO AREA START =====-->


    <x-hero title="{{ __('Contact Us') }}" background="{{ asset('images/contact_us_2.png') }}" :breadcrumbs="[
        ['label' => 'Contact Us'],
    ]" />




    <!--===== HERO AREA START =====-->

    <!--===== CONTACT AREA START =====-->

    <div class="contact2 sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-page-box">
                        <div class="icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="content">
                            <h3>Email Address</h3>
                            <a href="mailto:support@seox.com">support@ieeecsbau.com</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-page-box">
                        <div class="icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="content">
                            <h3>Phone Number</h3>
                            <a href="tel:+123456-7890">+1 (123) 456-7890</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="contact-page-box">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="content">
                            <h3>Office Address</h3>
                            <a href="#">Al Balqa Applied University Engineering Technology College</a>
                            <a href="#">, Al Hizam Al Daeri St 527, Amman</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mt-60">
                    <div class="heading2">
                        <div class="contact2-form">
                            <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900"><img
                                    src="{{asset('images/logo.png')}}" width="25" alt="">CONTACT US </span>
                            <h2 class="text-anime-style-3">Let's Talk!</h2>
                            <p class="mt-16" data-aos="fade-right" data-aos-duration="900">We welcome any subject that you think it will have benefit for our society and </br> and help improving our members proo life.</p>
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
                    <div class="contact2-image mt-60 image-anime reveal ml-40 md:ml-0 sm:ml-0 md:mt-30 sm:mt-30">
                        <img class="w-full" src="{{ asset('images/contact_us.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== CONTACT AREA END =====-->

        <div class="contact-map-page">
            <iframe src="https://maps.app.goo.gl/V5Lx9KGiZb12265F7" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
</x-base-layout>
