@props([
    'class' => '',
    'style' => '',
])

<div class="tes4-single-slider {{ $class }}" style="{{ $style }}">
    {{ $slot }}
</div>
