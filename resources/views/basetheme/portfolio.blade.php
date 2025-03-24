<x-base-layout>
    <!--===== HERO AREA START =====-->

    <div class="inner-hero" style="background-image: url({{ asset('images/project_bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="inner-main-heading lightmode-bg">
                        <h1>Our Portfolio</h1>
                        <div class="breadcrumbs-pages">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li class="angle"><i class="fa-solid fa-angle-right"></i></li>
                                <li>Our Portfolio </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== HERO AREA START =====-->

    <!--===== BLOG AREA START=======-->

    <div class="blog1 sp bg1 _relative">
        <div class="container">
            <livewire:portofilo-cards>
        </div>
    </div>
    <!--===== PORTFOLIO AREA END=======-->
</x-base-layout>
