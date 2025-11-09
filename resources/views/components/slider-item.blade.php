@props([
    'class' => '',
    'style' => '',
])

<div class="tes4-single-slider overflow-hidden {{ $class }}" style="min-height: 200px; {{ $style }}">
    <div class="w-full h-full p-4 overflow-auto">
        {{ $slot }}
    </div>
</div>
