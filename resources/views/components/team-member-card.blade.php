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
            <div class="social-icons">
                @if (!empty($contacts))
                    <ul>
                        @foreach ($contacts as $platform => $url)
                            <a href="{{ $url }}" target="_blank">
                                @switch(strtolower($platform))
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
                        @endforeach
                        {{--                     
                        @if (isset($contacts['Instagram']))
                        <li><a href="{{ $contacts['Instagram'] }}"><i class="fa-brands fa-instagram"></i></a>
                        </li>
                        @endif --}}
                        {{-- @if (isset($contacts['facebook']))
                        <li><a href="{{ $contacts["facebook"] }}"><i class="fa-brands fa-facebook"></i></a></li>
                        @endif
                        @if (isset($contacts['linkedin']))
                        <li><a href="{{ $contacts["linkedin"] }}"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        @endif --}}
                    </ul>
                @endif
            </div>
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
