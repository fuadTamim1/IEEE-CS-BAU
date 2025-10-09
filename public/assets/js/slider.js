document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tes4-slider-all').forEach(function (sliderWrapper) {
        const $slider = $(sliderWrapper).find('.tes4-slider');

        // Read settings from data attributes
        const settings = {
            slidesToShow: parseInt(sliderWrapper.dataset.slidesToShow || 1),
            autoplay: sliderWrapper.dataset.autoplay === 'true',
            autoplaySpeed: parseInt(sliderWrapper.dataset.autoplaySpeed || 3000),
            arrows: sliderWrapper.dataset.arrows === 'true',
            dots: sliderWrapper.dataset.dots === 'true',
            adaptiveHeight: true
        };

        // Initialize Slick with the settings
        $slider.slick(settings);
    });
});
