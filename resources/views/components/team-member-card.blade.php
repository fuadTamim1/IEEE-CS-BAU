<div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="900"  data-aos-delay="200">
    <div class="team-page-item  mt-30">
        <div class="team-image-area">
            <div class="image">
                <img src="{{asset('images/guy.png')}}" alt="">
            </div>
            <div class="shape round-circle">
                {{-- <img src="{{asset('images/guy.png')}}" alt=""> --}}
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
                <h4><a href="#">{{$name}}</a></h4>
                <p class="mt-2">{{$role}}</p>
            </div>
            <div class="plue-icon">
                <a href="#"><i class="fa-solid fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>