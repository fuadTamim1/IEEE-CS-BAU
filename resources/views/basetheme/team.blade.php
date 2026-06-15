<x-base-layout>
    <!--===== HERO AREA START =====-->

    <div class="inner-hero" style="background-image: url({{ asset('images/team_bg.png') }});">
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
                    {{-- Keep member cards shared with the about page so both sections stay in sync. --}}
                    <x-team-member-card name="{{ $m->name }}" role="{{ $m->title }}" :contacts="$m->contacts" />
                @endforeach
            </div>
            {{-- Pagination markup can be restored here if the team listing becomes paginated later. --}}

        </div>
    </div>

    <!--===== TEAM AREA END =====-->
</x-base-layout>
