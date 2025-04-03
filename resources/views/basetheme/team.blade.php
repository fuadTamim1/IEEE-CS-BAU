<x-base-layout>
   <!--===== HERO AREA START =====-->

   <div class="inner-hero" style="background-image: url({{asset('images/team_bg.png')}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto text-center lightmode-bg">
                <div class="inner-main-heading">
                    <h1>Our Team Member</h1>
                    <div class="breadcrumbs-pages">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="angle"><i class="fa-solid fa-angle-right"></i></li>
                            <li>Our Team Member</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>

   <!--===== HERO AREA START =====-->

   <!--===== TEAM AREA START =====-->

   <div class="team2 sp">
    <div class="container">
        <div class="row">
            @foreach ($members as $m)
            <x-team-member-card name="{{ $m->name }}" role="{{ $m->title }}"
            :links="$m->contacts"
            />
            @endforeach
        </div>
        {{-- Pagenation --}}
{{-- 
        <div class="space60"></div>
        <div class="row">
            <div class="col-12 m-auto">
               <div class="theme-pagination text-center">
                <ul>
                    <li><a href="#"><i class="fa-solid fa-angle-left"></i></a></li>
                    <li><a class="active" href="#">01</a></li>
                    <li><a href="#">02</a></li>
                    <li>...</li>
                    <li><a href="#">12</a></li>
                    <li><a href="#"><i class="fa-solid fa-angle-right"></i></a></li>
                </ul>
               </div>
            </div>
        </div> --}}

    </div>
   </div>

   <!--===== TEAM AREA END =====-->
</x-base-layout>