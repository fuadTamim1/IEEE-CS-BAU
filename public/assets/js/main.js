(function ($) {
  $(document).ready(function () {

  ////////////////////////////////////////////////////

  ////////////////////////////////////////////////////
	// 03. Search Js
	$(".search-open-btn").on("click", function () {
		$(".search__popup").addClass("search-opened");
	});
		
	$(".search-close-btn").on("click", function () {
		$(".search__popup").removeClass("search-opened");
	});


  //========== HEADER ACTIVE STRATS ============= //
 var windowOn = $(window);
 windowOn.on('scroll', function () {
   var scroll = windowOn.scrollTop();
   if (scroll < 100) {
     $("#vl-header-sticky").removeClass("header-sticky");
   } else {
     $("#vl-header-sticky").addClass("header-sticky");
   }
 });
 
//========== HEADER ACTIVE ENDS ============= //

//========== PRICING AREA ============= //
$("#ce-toggle").click(function (event) {
  $(".plan-toggle-wrap").toggleClass("active");
});

$("#ce-toggle").change(function () {
  if ($(this).is(":checked")) {
    $(".tab-content #yearly").hide();
    $(".tab-content #monthly").show();
  } else {
    $(".tab-content #yearly").show();
    $(".tab-content #monthly").hide();
  }
});

//========== MOBILE MENU STARTS ============= //
  var vlMenuWrap = $('.vl-mobile-menu-active > ul').clone();
  var vlSideMenu = $('.vl-offcanvas-menu nav');
  vlSideMenu.append(vlMenuWrap);
  if ($(vlSideMenu).find('.sub-menu, .vl-mega-menu').length != 0) {
    $(vlSideMenu).find('.sub-menu, .vl-mega-menu').parent().append('<button class="vl-menu-close"><i class="fas fa-chevron-right"></i></button>');
  }

  var sideMenuList = $('.vl-offcanvas-menu nav > ul > li button.vl-menu-close, .vl-offcanvas-menu nav > ul li.has-dropdown > a');
  $(sideMenuList).on('click', function (e) {
    console.log(e);
    e.preventDefault();
    if (!($(this).parent().hasClass('active'))) {
      $(this).parent().addClass('active');
      $(this).siblings('.sub-menu, .vl-mega-menu').slideDown();
    } else {
      $(this).siblings('.sub-menu, .vl-mega-menu').slideUp();
      $(this).parent().removeClass('active');
    }
  });


$(".vl-offcanvas-toggle").on('click',function(){
  $(".vl-offcanvas").addClass("vl-offcanvas-open");
  $(".vl-offcanvas-overlay").addClass("vl-offcanvas-overlay-open");
});

$(".vl-offcanvas-close-toggle,.vl-offcanvas-overlay").on('click', function(){
  $(".vl-offcanvas").removeClass("vl-offcanvas-open");
  $(".vl-offcanvas-overlay").removeClass("vl-offcanvas-overlay-open");
});

//========== MOBILE MENU ENDS ============= //
  

    {
      function animateElements() {
        $('.progressbar').each(function () {
          var elementPos = $(this).offset().top;
          var topOfWindow = $(window).scrollTop();
          var percent = $(this).find('.circle').attr('data-percent');
          var percentage = parseInt(percent, 10) / parseInt(100, 10);
          var animate = $(this).data('animate');
          if (elementPos < topOfWindow + $(window).height() - 10 && !animate) {
            $(this).data('animate', true);
            $(this).find('.circle').circleProgress({
              startAngle: -Math.PI / 2,
              value: percent / 100,
              size: 80,
              thickness: 5,
              emptyFill: "#E7E6F1",
              fill: {
                color: '#0778F9'
              }
            }).on('circle-animation-progress', function (event, progress, stepValue) {
              $(this).find('div').text((stepValue*100).toFixed() + "%");
            }).stop();
          }
        });
      }
    
      // Show animated elements
      animateElements();
      $(window).scroll(animateElements);
    };
     // sticky header active
     if ($("#header").length > 0) {
      $(window).on("scroll", function (event) {
        var scroll = $(window).scrollTop();
        if (scroll < 1) {
          $("#header").removeClass("sticky");
        } else {
          $("#header").addClass("sticky");
        }
      });
    }

          //Aos animation active
            AOS.init({
              offset: 0,
              duration: 400,
              easing: "ease-in-out",
              anchorPlacement: "top-bottom",
              disable: "mobile",
              once: false,
            });


            //Video poppup
            if ($(".play-btn").length > 0) {
              $(".play-btn").magnificPopup({
                type: "iframe",
              });
            };

              // page-progress
              var progressPath = document.querySelector(".progress-wrap path");
              var pathLength = progressPath.getTotalLength();
              progressPath.style.transition = progressPath.style.WebkitTransition =
                "none";
              progressPath.style.strokeDasharray = pathLength + " " + pathLength;
              progressPath.style.strokeDashoffset = pathLength;
              progressPath.getBoundingClientRect();
              progressPath.style.transition = progressPath.style.WebkitTransition =
                "stroke-dashoffset 10ms linear";
              var updateProgress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength) / height;
                progressPath.style.strokeDashoffset = progress;
              };
              updateProgress();
              $(window).scroll(updateProgress);
              var offset = 50;
              var duration = 550;
              jQuery(window).on("scroll", function () {
                if (jQuery(this).scrollTop() > offset) {
                  jQuery(".progress-wrap").addClass("active-progress");
                } else {
                  jQuery(".progress-wrap").removeClass("active-progress");
                }
              });
              jQuery(".progress-wrap").on("click", function (event) {
                event.preventDefault();
                jQuery("html, body").animate({ scrollTop: 0 }, duration);
                return false;
              });

              //product colors
              const colors = $(".accordion1 .accordion-item");
              colors.on("click", function () {
                $(".accordion1 .accordion-item").removeClass("active");
                $(this).addClass("active");
              });

              //product colors
              const colors2 = $(".accordion2 .accordion-item");
              colors2.on("click", function () {
                $(".accordion2 .accordion-item").removeClass("active");
                $(this).addClass("active");
              });

              //select colors
              const select1 = $("select1");
              select1.on("click", function () {
                $("select1").removeClass("active");
                $(this).addClass("active");
              });

              //tes1 active
              const tes1 = $(".controls li");
              tes1.on("click", function () {
                $(".controls li").removeClass("active");
                $(this).addClass("active");
              });

              $("#ce-toggle1").click(function (event) {
                $(".plan-toggle-wrap1").toggleClass("active");
              });
              
              $("#ce-toggle1").change(function () {
                if ($(this).is(":checked")) {
                  $(".tab-content #yearly1").hide();
                  $(".tab-content #monthly1").show();
                } else {
                  $(".tab-content #yearly1").show();
                  $(".tab-content #monthly1").hide();
                }
              });


    $(".work1-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      autoplay:false,
      autoplaySpeed:2000,
      loop: true,
      focusOnSelect: true,
      infinite: true,
      prevArrow: $('.work1-prev-arrow'),
      nextArrow: $('.work1-next-arrow'),
    });

    //-- testimonial 6 ---
    $(".tes6-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      autoplay:false,
      autoplaySpeed:2000,
      loop: true,
      focusOnSelect: true,
      infinite: true,
      prevArrow: $('.tes6-prev-arrow'),
      nextArrow: $('.tes6-next-arrow'),
    });

     //-- testimonial 6 ---
     $(".tes5-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      autoplay:false,
      autoplaySpeed:2000,
      loop: true,
      focusOnSelect: true,
      infinite: true,
      prevArrow: $('.tes5-prev-arrow'),
      nextArrow: $('.tes5-next-arrow'),
    });

    //-- testimonial 6 ---
    $(".tes4-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      autoplay:false,
      autoplaySpeed:2000,
      loop: true,
      focusOnSelect: true,
      infinite: true,
      prevArrow: $('.tes5-prev-arrow'),
      nextArrow: $('.tes5-next-arrow'),
    });

    //-- testimonial 9 ---
    $(".tes9-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      autoplay:false,
      autoplaySpeed:2000,
      loop: true,
      focusOnSelect: true,
      infinite: true,
      prevArrow: $('.tes9-prev-arrow'),
      nextArrow: $('.tes9-next-arrow'),
      vertical: true,
    });

    //-- testimonial 9 ---
    $(".tes8-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      autoplay:false,
      autoplaySpeed:2000,
      loop: true,
      focusOnSelect: true,
      infinite: true,
      prevArrow: $('.tes8-prev-arrow'),
      nextArrow: $('.tes8-next-arrow'),
      vertical: true,
    });


    //testimonial 2 slider
    $(".tes2-slider").slick({
      margin: "30",
      slidesToShow: 3,
      arrows: false,
      centerMode: true,
      dots: false,
      loop: true,
      centerMode: false,
      draggable: true,
      autoplay: true,
      autoplaySpeed: 4000,
      fade: false,
      fadeSpeed: 1000,
      responsive: [
        {
          breakpoint: 769,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
      ],
    });

    //Team 10 slider
    $(".team10-slider").slick({
      margin: "30",
      slidesToShow: 3,
      arrows: true,
      prevArrow: $('.team10-prev-arrow'),
      nextArrow: $('.team10-next-arrow'),
      centerMode: true,
      dots: false,
      loop: true,
      centerMode: false,
      draggable: true,
      autoplay: true,
      autoplaySpeed: 4000,
      fade: false,
      fadeSpeed: 1000,
      responsive: [
        {
          breakpoint: 769,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
      ],
    });

    //Team 8 slider
    $(".team8-slider").slick({
      margin: "30",
      slidesToShow: 4,
      arrows: true,
      prevArrow: $('.team8-prev-arrow'),
      nextArrow: $('.team8-next-arrow'),
      centerMode: true,
      dots: false,
      loop: true,
      centerMode: false,
      draggable: true,
      autoplay: true,
      autoplaySpeed: 4000,
      fade: false,
      fadeSpeed: 1000,
      responsive: [
        {
          breakpoint: 769,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
      ],
    });

    //Team 10 slider
    $(".tes10-slider").slick({
      margin: "30",
      slidesToShow: 3,
      arrows: true,
      prevArrow: $('.tes10-prev-arrow'),
      nextArrow: $('.tes10-next-arrow'),
      centerMode: true,
      dots: false,
      loop: true,
      centerMode: false,
      draggable: true,
      autoplay: true,
      autoplaySpeed: 4000,
      fade: false,
      fadeSpeed: 1000,
      responsive: [
        {
          breakpoint: 769,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
      ],
    });

    // brands slider 9
    $(".brands9-slider").slick({
      margin: "30",
      slidesToShow: 5,
      arrows: false,
      centerMode: true,
      dots: false,
      loop: true,
      centerMode: false,
      draggable: true,
      autoplay: true,
      autoplaySpeed: 2000,
      fade: false,
      fadeSpeed: 1000,
      responsive: [
        {
          breakpoint: 769,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
      ],
    });

    //testimonial 2 slider
    $(".tes7-slider").slick({
      margin: "30",
      slidesToShow: 3,
      arrows: false,
      centerMode: true,
      dots: true,
      loop: true,
      centerMode: false,
      draggable: true,
      autoplay: true,
      autoplaySpeed: 4000,
      fade: false,
      fadeSpeed: 1000,
      responsive: [
        {
          breakpoint: 769,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: false,
            centerPadding: "40px",
            slidesToShow: 1,
          },
        },
      ],
    });


    $('.istagram-feed3-slider').owlCarousel({
      loop:true,
      margin:10,
      responsiveClass:true,
      nav: false,
      responsive:{
          0:{
              items:1,
              nav:false
          },
          600:{
              items:3,
              nav:false
          },
          1000:{
              items:5.5,
              nav:false,
              loop:false
          }
      }
  });

  $('.hero7-slider').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    nav: false,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:false,
            loop:false
        }
    }
});


  //testimonial 3 slider
  $(".tes3-slider").slick({
    margin: "30",
    slidesToShow: 1,
    arrows: false,
    centerMode: true,
    dots: false,
    loop: true,
    centerMode: false,
    draggable: true,
    autoplay: true,
    autoplaySpeed: 4000,
    fade: false,
    fadeSpeed: 1000,
    dots: true,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          arrows: false,
          centerMode: false,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: false,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
    ],
  });

  //testimonial 11 slider
  $(".tes11-slider").slick({
    margin: "30",
    slidesToShow: 1,
    arrows: false,
    centerMode: true,
    dots: false,
    loop: true,
    centerMode: false,
    draggable: true,
    autoplay: true,
    autoplaySpeed: 4000,
    fade: false,
    fadeSpeed: 1000,
    dots: true,
    responsive: [
      {
        breakpoint: 769,
        settings: {
          arrows: false,
          centerMode: false,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: false,
          centerPadding: "40px",
          slidesToShow: 1,
        },
      },
    ],
  });


// SLIDER //
var rev = $('.rev_slider');
rev.on('init', function(event, slick, currentSlide) {
  var
    cur = $(slick.$slides[slick.currentSlide]),
    next = cur.next(),
    prev = cur.prev();
  prev.addClass('slick-sprev');
  next.addClass('slick-snext');
  cur.removeClass('slick-snext').removeClass('slick-sprev');
  slick.$prev = prev;
  slick.$next = next;
}).on('beforeChange', function(event, slick, currentSlide, nextSlide) {

  var
    cur = $(slick.$slides[nextSlide]);

  slick.$prev.removeClass('slick-sprev');
  slick.$next.removeClass('slick-snext');
  next = cur.next(),
    prev = cur.prev();
  prev.prev();
  prev.next();
  prev.addClass('slick-sprev');
  next.addClass('slick-snext');
  slick.$prev = prev;
  slick.$next = next;
  cur.removeClass('slick-next').removeClass('slick-sprev');
});

rev.slick({
  speed: 1000,
  arrows: true,
  dots: false,
  focusOnSelect: true,
  prevArrow: '<button class="prev-next"><i class="fa-solid fa-angle-left"></i></button>',
  nextArrow: '<button class="next-prev"> <i class="fa-solid fa-angle-right"></i></button>',
  infinite: true,
  centerMode: true,
  slidesPerRow: 1,
  slidesToShow: 5,
  slidesToScroll: 1,
  centerPadding: '0',
  swipe: true,
  autoplaySpeed:2500,
  speed:1500,
  autoplay:false,
  customPaging: function(slider, i) {
    return '';
  },

});


  $('.cs_hover_active').hover(function () {
    $(this).addClass('active').siblings().removeClass('active');
  });
          
  });



    	/* Text Effect Animation */
	if ($('.text-anime-style-1').length) {
		let staggerAmount 	= 0.05,
			translateXValue = 0,
			delayValue 		= 0.5,
		   animatedTextElements = document.querySelectorAll('.text-anime-style-1');
		
		animatedTextElements.forEach((element) => {
			let animationSplitText = new SplitText(element, { type: "chars, words" });
				gsap.from(animationSplitText.words, {
				duration: 1,
				delay: delayValue,
				x: 20,
				autoAlpha: 0,
				stagger: staggerAmount,
				scrollTrigger: { trigger: element, start: "top 85%" },
				});
		});		
	}
	
	if ($('.text-anime-style-2').length) {				
		let	 staggerAmount 		= 0.05,
			 translateXValue	= 20,
			 delayValue 		= 0.5,
			 easeType 			= "power2.out",
			 animatedTextElements = document.querySelectorAll('.text-anime-style-2');
		
		animatedTextElements.forEach((element) => {
			let animationSplitText = new SplitText(element, { type: "chars, words" });
				gsap.from(animationSplitText.chars, {
					duration: 1,
					delay: delayValue,
					x: translateXValue,
					autoAlpha: 0,
					stagger: staggerAmount,
					ease: easeType,
					scrollTrigger: { trigger: element, start: "top 85%"},
				});
		});		
	}
	
	if ($('.text-anime-style-3').length) {		
		let	animatedTextElements = document.querySelectorAll('.text-anime-style-3');
		
		 animatedTextElements.forEach((element) => {
			//Reset if needed
			if (element.animation) {
				element.animation.progress(1).kill();
				element.split.revert();
			}

			element.split = new SplitText(element, {
				type: "lines,words,chars",
				linesClass: "split-line",
			});
			gsap.set(element, { perspective: 400 });

			gsap.set(element.split.chars, {
				opacity: 0,
				x: "50",
			});

			element.animation = gsap.to(element.split.chars, {
				scrollTrigger: { trigger: element,	start: "top 95%" },
				x: "0",
				y: "0",
				rotateX: "0",
				opacity: 1,
				duration: 1,
				ease: Back.easeOut,
				stagger: 0.02,
			});
		});		
	}


  // btn_theme
  $(function() {
    $('.btn_theme3')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme4')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme5')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme6')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme7')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme8')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme9')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme10')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme11')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });

  // btn_theme
  $(function() {
    $('.btn_theme12')
      .on('mouseenter', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
              $(this).find('span').css({top:relY, left:relX})
      })
      .on('mouseout', function(e) {
              var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
          $(this).find('span').css({top:relY, left:relX})
      });
  });



  $('select').niceSelect();

            
})(jQuery);
    

// SWIPER SLIDER //
document.addEventListener("DOMContentLoaded", function () {
  var swiper3 = new Swiper(".swiper-thumb2", {
    spaceBetween: 10,
    slidesPerView: 6,
    freeMode: true,
    watchSlidesProgress: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  });
  var swiper4 = new Swiper(".swiper-testimonial-2", {
    spaceBetween: 10,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    thumbs: {
      swiper: swiper3,
    },
  });
});



document.addEventListener("DOMContentLoaded", () => {
  // Safe checks for elements to avoid errors
  const categories = document.querySelectorAll(".category");

  // Check if categories exist before adding event listeners
  if (categories.length > 0) {
    categories.forEach((category) => {
      category.addEventListener("click", () => {
        categories.forEach((cat) => cat.classList.remove("active"));
        category.classList.add("active");
      });
    });
  }

});



const slider = document.getElementById('balance-slider');
const selectedValue = document.getElementById('selectedValue');

if (slider && selectedValue) {
  // Function to update the background gradient
  function updateSliderBackground() {
    const value = slider.value;
    const max = slider.max;
    const percentage = (value / max) * 100;
    slider.style.background = `linear-gradient(to right, Navy ${percentage}%, #e0e0e0 ${percentage}%)`;
  }

  // Event listener for slider input
  slider.addEventListener('input', function () {
    selectedValue.textContent = this.value;
    updateSliderBackground();
  });

  // Initialize the slider background on page load
  updateSliderBackground();
}
