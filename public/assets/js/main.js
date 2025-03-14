(function($){
	"use strict";

	// Mean Menu
	$('.mean-menu').meanmenu({
		meanScreenWidth: "991"
	});

	// Header Sticky
	$(window).on('scroll',function() {
		if ($(this).scrollTop() > 120){
			$('.navbar-area').addClass("is-sticky");
		}
		else{
			$('.navbar-area').removeClass("is-sticky");
		}
	});

	// Others Option For Responsive JS
	$(".others-option-for-responsive .dot-menu").on("click", function(){
		$(".others-option-for-responsive .container .container").toggleClass("active");
	});

	// Search Menu JS
	// $(".others-option .search-icon i").on("click", function(){
	// 	$(".search-overlay").toggleClass("search-overlay-active");
	// });
	$(".search-overlay-close").on("click", function(){
		$(".search-overlay").removeClass("search-overlay-active");
	});

	// Home Slides
	$('.home-slides').owlCarousel({
		items: 1,
		margin:0,
		nav: true,
		loop: true,
		dots: false,
		autoplay: true,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		],
		responsive: {
			0: {
				autoHeight: true
			},
			576: {
				autoHeight: false
			},
			768: {
				autoHeight: false
			},
			992: {
				autoHeight: false
			},
			1200: {
				autoHeight: false
			}
		}
	});

	// Banner Slides
	$('.banner-slides').owlCarousel({
		items: 1,
		nav: false,
		loop: true,
		dots: true,
		autoplay: true,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		]
	});

	// Categories Slides
	$('.categories-slides').owlCarousel({
		nav: true,
		margin: 10,
		loop: false,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='fa fa-angle-left'></i>",
			"<i class='fa fa-angle-right'></i>",
		],
		responsive: {
			0: {
				items: 2
			},
			576: {
				items: 3
			},
			768: {
				items: 4
			},
			992: {
				items: 6
			},
			1200: {
				items: 6
			}
		}
	});

	// Products Slides
	$('.products-slides').owlCarousel({
		nav: true,
		margin: 10,
		loop: true,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		],
		responsive: {
			0: {
				items: 2
			},
			576: {
				items: 2
			},
			768: {
				items: 2
			},
			992: {
				items: 4
			},
			1200: {
				items: 4
			}
		}
	});

	// Offers-products-Slides
	$('.offers-products-slides').owlCarousel({
		nav: false,
		margin: 10,
		loop: false,
		dots: true,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		],
		responsive: {
			0: {
				items: 2
			},
			576: {
				items: 2
			},
			1200: {
				items: 2
			}
		}
	});

	// banner Slides
	$('.banner-slides').owlCarousel({
		nav: true,
		margin: 0,
		loop: true,
		dots: false,
		autoplay: true,
		autoplaySpeed:1000,
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 1
			},
			1200: {
				items: 1
			}
		}
	});
		// testimonials Slides
		$('.testimonials-slides').owlCarousel({
			nav: false,
			margin: 40,
			loop: false,
			dots: true,
            // centerMode: true,
            // center: true,
			autoplay: true,
			autoplayHoverPause: true,
			navText: [
				"<i class='bx bx-chevron-left'></i>",
				"<i class='bx bx-chevron-right'></i>",
			],
			responsive: {
				0: {
					items: 1
				},
				576: {
					items: 1
				},
				1200: {
					items: 2
				}
			}
		});
	// Odometer JS
	$('.odometer').appear(function(e) {
		var odo = $(".odometer");
		odo.each(function() {
			var countNumber = $(this).attr("data-count");
			$(this).html(countNumber);
		});
	});

	// Popup Image
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery:{
			enabled:true
		}
	});

	// Popup Video
	$('.popup-video').magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	// Feedback Slides
	$('.feedback-slides').owlCarousel({
		items: 1,
		nav: false,
		loop: true,
		dots: true,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		]
	});

	// Input Plus & Minus Number JS
	$('.input-counter').each(function() {
		var spinner = jQuery(this),
		input = spinner.find('input[type="text"]'),
		btnUp = spinner.find('.plus-btn'),
		btnDown = spinner.find('.minus-btn'),
		min = input.attr('min'),
		max = input.attr('max');
		btnUp.on('click', function() {
			var oldValue = parseFloat(input.val());
			if (oldValue >= max) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue + 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
		btnDown.on('click', function() {
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
	});

	// Country Select
	$("#country_selector, #country_selector2").countrySelect({
		preferredCountries: ['ca', 'gb', 'us']
	});

	// Countdown
	$(document).ready(function(){
		loopcounter('counter-class');
	});

	// Price Range Slider JS
	$(".js-range-of-price").ionRangeSlider({
		type: "double",
		drag_interval: true,
		min_interval: null,
		max_interval: null
	});

	// Products Details Image Slides
	$('.products-details-thumbs-image-slides').slick({
		dots: true,
		speed: 500,
		fade: false,
		slide: 'li',
		slidesToShow: 1,
		autoplay: true,
		autoplaySpeed: 4000,
		prevArrow: false,
		nextArrow: false,
		responsive: [{
			breakpoint: 800,
			settings: {
				arrows: false,
				centerMode: false,
				centerPadding: '30px',
				variableWidth: false,
				slidesToShow: 1,
				dots: true
			},
			breakpoint: 1200,
			settings: {
				arrows: false,
				centerMode: false,
				centerPadding: '30px',
				variableWidth: false,
				slidesToShow: 1,
				dots: true
			}
		}],
		customPaging: function (slider, i) {
			return '<button class="tab">' + $('.slick-thumbs li:nth-child(' + (i + 1) + ')').html() + '</button>';
		}
	});

	// Subscribe form
	$(".newsletter-forme").validator().on("submit", function (event) {
		if (event.isDefaultPrevented()) {
			// handle the invalid form...
			formErrorSub();
			submitMSGSub(false, "Please enter your email correctly.");
		} else {
			// everything looks good!
            $(".newsletter-forme").submit();
            formSuccessSub();
			event.preventDefault();

		}
	});
	function callbackFunction (resp) {
		if (resp.result === "success") {
			formSuccessSub();
		}
		else {
			formErrorSub();
		}
	}
	function formSuccessSub(){
		$(".newsletter-forme")[0].reset();
		submitMSGSub(true, "Thank you for subscribing!");
		setTimeout(function() {
			$("#validator-newsletter").addClass('hide');
		}, 4000)
	}
	function formErrorSub(){
		$(".newsletter-forme").addClass("animated shake");
		setTimeout(function() {
			$(".newsletter-forme").removeClass("animated shake");
		}, 1000)
	}
	function submitMSGSub(valid, msg){
		if(valid){
			var msgClasses = "validation-success";
		} else {
			var msgClasses = "validation-danger";
		}
		$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
	}
	// AJAX MailChimp
	// $(".newsletter-forme").ajaxChimp({
	// 	url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
	// 	callback: callbackFunction
	// });

	// Go to Top
	$(function(){
		// Scroll Event
		$(window).on('scroll', function(){
			var scrolled = $(window).scrollTop();
			if (scrolled > 600) $('.go-top').addClass('active');
			if (scrolled < 600) $('.go-top').removeClass('active');
		});
		// Click Event
		$('.go-top').on('click', function() {
			$("html, body").animate({ scrollTop: "0" },  500);
		});
	});

    $(document).ready(function() {
        "use strict";
        // Phone
        $(".phone").intlTelInput({
            preferredCountries: ["eg"],
            separateDialCode: true,
            hiddenInput: "full",
        });
    });

}(jQuery));
