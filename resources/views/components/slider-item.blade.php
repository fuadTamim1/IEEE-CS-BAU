@props([
    'class' => '',
    'style' => '',
])

<div class="ieee-slider-item {{ $class }}" style="{{ $style }}">
    <div class="ieee-slider-item__inner">
        {{ $slot }}
    </div>
</div>

@once
    @push('styles')
        <style>
            .ieee-slider-item {
                height: 100%;
                padding: 0 14px;
            }

            .ieee-slider-item__inner {
                height: 100%;
                min-height: 200px;
                overflow: visible;
                padding: 1rem;
            }

            @media (max-width: 768px) {
                .ieee-slider-item {
                    padding: 0;
                }

                .ieee-slider-item__inner {
                    padding: 0.5rem;
                }
            }
        </style>
    @endpush
@endonce
