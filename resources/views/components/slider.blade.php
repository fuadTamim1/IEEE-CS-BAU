<section class="{{ $sectionClass }}">
    <div class="container">
        @if ($title || $subtitle)
            <x-section-heading 
                :subtitle="$subtitle" 
                :title="$title" 
                :icon="$icon"
            >
                {{ $heading ?? '' }}
            </x-section-heading>
        @endif

        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="ieee-slider-all"
                    data-slides-to-show="{{ $slidesToShow }}"
                    data-autoplay="{{ $autoplay ? 'true' : 'false' }}"
                    data-autoplay-speed="{{ $autoplaySpeed }}"
                    data-arrows="{{ $arrows ? 'true' : 'false' }}"
                    data-dots="{{ $dots ? 'true' : 'false' }}"
                >
                    <div class="ieee-slider">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@once
    @push('styles')
        <style>
            .ieee-slider-all {
                width: 100%;
            }

            .ieee-slider .slick-track {
                display: flex;
            }

            .ieee-slider .slick-slide {
                height: auto;
            }

            .ieee-slider .slick-slide > div {
                height: 100%;
            }
        </style>
    @endpush
@endonce
