<div class="col-lg-3 col-md-6">
    <div class="service-page-box mt-30">
        <div class="image">
            <x-img :img="$event->image ?? null" />
        </div>
        <div class="content-area">
            {{-- <div class="num">01</div> --}}
            <a href="{{ url('events/' . $event->slug) }}" class="arrow"><i class="fa-regular fa-arrow-right"></i></a>
            {{-- <h4><a href="{{ url('events/' . $event->slug) }}">{{ Str::limit($event->title, 20, '...') }}</a></h4> --}}
        </div>
    </div>
</div>
{{-- assets/img/service/service5-image1.png --}}
