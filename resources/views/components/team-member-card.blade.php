<div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
    <div class="team-page-item  mt-30">

        <div class="team-image-area">
            <div class="image">
                <img src="{{ isset($image) ? asset('storage/' . $image) : asset('images/pixel_male.jpg') }}"
                    style="width:88%" alt="">
            </div>
            <div class="shape round-circle">
                {{-- <img src="{{asset('images/guy.png')}}" alt=""> --}}
            </div>
            @if (!empty($contacts))
                <div class="social-icons">
                    <ul>
                        @foreach ($contacts as $contact)
                            <li>
                                <a href="{{ $contact['value'] ?? '#' }}" target="_blank">
                                    @switch(strtolower($contact['key']))
                                        @case('facebook')
                                            <i class="fa-brands fa-facebook-f fa-lg"></i>
                                        @break

                                        @case('twitter')
                                            <i class="fa-brands fa-twitter fa-lg"></i>
                                        @break

                                        @case('instagram')
                                            <i class="fa-brands fa-instagram fa-lg"></i>
                                        @break

                                        @case('linkedin')
                                            <i class="fa-brands fa-linkedin-in fa-lg"></i>
                                        @break

                                        @case('youtube')
                                            <i class="fa-brands fa-youtube fa-lg"></i>
                                        @break

                                        @default
                                            <i class="fas fa-link fa-lg"></i>
                                            {{ ucfirst($platform) }}
                                    @endswitch
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="team-content-area">
            <div class="heading2">
                <h4><a href="#">{{ $name }}</a></h4>
                <p class="mt-2">{{ $role }}</p>
            </div>
            <div class="plue-icon">
                <a href="#"><i class="fa-solid fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
