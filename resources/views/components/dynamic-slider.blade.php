{{-- resources/views/components/dynamic-slider.blade.php --}}
<section class="{{ $sectionClass ?? '' }}">
    <div class="container">
        <x-section-heading 
            :subtitle="$subtitle ?? ''" 
            :title="$title ?? ''" 
            :icon="$icon ?? ''" 
        />

        @if ($items && count($items) > 0)
            <div class="row mt-5">
                <div class="col-lg-8 m-auto">
                    <div class="tes4-slider-all" data-aos="fade-up" data-aos-duration="900">
                        <div class="tes4-slider">
                            @foreach ($items as $item)
                                <div class="tes4-single-slider">
                                    <div class="row align-items-center">
                                        <div class="col-md-5">
                                            <img src="{{ asset('storage/' . $item['image']) }}" 
                                                 alt="{{ $item['name'] ?? '' }}" loading="lazy">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="author_text">
                                                @if (!empty($quoteIcon))
                                                    <img src="{{ asset($quoteIcon) }}" alt="Quote icon">
                                                @endif
                                                <h5>"{{ $item['text'] ?? '' }}"</h5>
                                                <div class="info">
                                                    <a href="#">{{ $item['name'] ?? '' }}</a>
                                                    @if (!empty($item['title']))
                                                        <p>{{ $item['title'] }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
