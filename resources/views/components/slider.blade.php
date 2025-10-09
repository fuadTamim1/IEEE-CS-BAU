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
                <div class="tes4-slider-all"
                    data-slides-to-show="{{ $slidesToShow }}"
                    data-autoplay="{{ $autoplay ? 'true' : 'false' }}"
                    data-autoplay-speed="{{ $autoplaySpeed }}"
                    data-arrows="{{ $arrows ? 'true' : 'false' }}"
                    data-dots="{{ $dots ? 'true' : 'false' }}"
                >
                    <div class="tes4-slider">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
