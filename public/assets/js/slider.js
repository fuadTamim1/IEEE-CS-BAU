document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ieee-slider-all, .tes4-slider-all').forEach(function (sliderWrapper) {
        const $slider = $(sliderWrapper).find('.ieee-slider, .tes4-slider');

        if (!$slider.length) {
            return;
        }

        // Read settings from data attributes
        const slidesToShow = parseInt(sliderWrapper.dataset.slidesToShow || 1);
        const settings = {
            slidesToShow: slidesToShow,
            autoplay: sliderWrapper.dataset.autoplay === 'true',
            autoplaySpeed: parseInt(sliderWrapper.dataset.autoplaySpeed || 3000),
            arrows: sliderWrapper.dataset.arrows === 'true',
            dots: sliderWrapper.dataset.dots === 'true',
            adaptiveHeight: true,
            // Responsive breakpoints: ensure full responsiveness on smaller screens
            responsive: [
                // Large tablets / small desktops: don't exceed 2 slides
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: Math.min(slidesToShow, 2)
                    }
                },
                // Tablets and below: show 1 slide
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        };

        // Initialize Slick with the settings
        $slider.slick(settings);
    });
});
