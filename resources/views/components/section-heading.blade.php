@props(['subtitle', 'title', 'icon'])
<div class="heading4">
    <span class="sub-title" data-aos="zoom-in-left" data-aos-duration="900">
        <img src="{{ $icon }}" width="25" alt="IEEE CS Logo"> {{ $subtitle }}
    </span>
    <h2 class="text-anime-style-3">{{ $title }}</h2>
    {{ $slot }}
</div>