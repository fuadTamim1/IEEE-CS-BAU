<div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
    <div class="team-page-item  mt-30">

        <div class="team-image-area">
            <div class="image">
                <img src="{{ asset('images/guy.png') }}" alt="">
            </div>
            <div class="shape round-circle">
                {{-- <img src="{{asset('images/guy.png')}}" alt=""> --}}
            </div>
            <div class="social-icons">
                <ul>
                    @if ($contacts["instagram"] != null)
                        <li><a href="{{ $contacts["instagram"] }}"><i class="fa-brands fa-instagram"></i></a></li>
                    @endif
                    @if ($contacts["facebook"] != null)
                        <li><a href="{{ $contacts["facebook"] }}"><i class="fa-brands fa-facebook"></i></a></li>
                    @endif
                    @if ($contacts["linkedin"] != null)
                        <li><a href="{{ $contacts["linkedin"] }}"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    @endif
                </ul>
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
