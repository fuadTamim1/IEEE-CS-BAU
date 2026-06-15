@php
    $contactFormEnabled = filter_var(get_setting('enable_contact_form', true), FILTER_VALIDATE_BOOLEAN);
@endphp

@if ($contactFormEnabled)
<div class="contact2 sp">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading2">
                    <div class="contact2-form">
                        <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900"><img
                                src="{{ asset('images/logo.png') }}" width="25" alt="">CONTACT US
                        </span>
                        <h2 class="text-anime-style-3">Let us Work Together</h2>
                        <p class="mt-16" data-aos="fade-right" data-aos-duration="900">eady to take your social
                            media presence to the next level? Let’s work together to create impactful strategies
                            drive engagement, growth, and success for your brand.</p>
                        {{-- <form action="{{ route('contact.send') }}" method="POST" data-aos="fade-right"
                            data-aos-duration="1000">
                            @csrf
                            <div class="row mt-16">
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="text" name="first_name" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="text" name="last_name" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="email" name="email" placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="tel" name="phone" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="single-input">
                                        <textarea name="message" rows="5" placeholder="How can we help you?" required></textarea>
                                    </div>
                                    <div class="button mt-30">
                                        <button class="theme-btn3" type="submit">
                                            Send <span class="arrow1"><i class="fa-solid fa-arrow-right"></i></span>
                                            <span class="arrow2"><i class="fa-solid fa-arrow-right"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form> --}}
                        @livewire("contact-form")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- quck edit --}}
@else
<div class="contact2 sp">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading2 text-center">
                    <h2 class="text-anime-style-3">Contact Form Is Temporarily Unavailable</h2>
                    <p class="mt-16">Please use our email or phone channels to reach us.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif