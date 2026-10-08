jQuery(document).ready(function (e) {
	jQuery(".read-more-btn").on("click", function (e) {
		e.preventDefault();
		jQuery(this).siblings(".hidden-content").toggle();
		jQuery(this).hide();
	});
	jQuery(".blog-search-head .dropdown-menu a").click(function () {
		var selText = jQuery(this).text();
		jQuery(this).parents(".dropdown").find(".dropdown-toggle").html(selText);
	});

	jQuery(".blog-search-head ul li").click(function () {
		var window_widht = jQuery(window).width();
		if (!jQuery(this).hasClass("dropdown")) {
			if (window_widht > 767) {
				jQuery(".blog-search-head .dropdown").find(".dropdown-toggle").html("More Technologies");
			} else {
				jQuery(".blog-search-head .dropdown").find(".dropdown-toggle").html("All Category");
			}
		}
	});

	jQuery(".foldable-toggle").click(function () {
		var content = jQuery(this).prev(".foldable-content").find(".full-content");
		var downArrow = jQuery(this).find(".down-arrow");
		var upArrow = jQuery(this).find(".up-arrow");

		if (content.is(":visible")) {
			content.slideUp(function () {
				downArrow.show();
				upArrow.hide();
			});
		} else {
			content.slideDown(function () {
				downArrow.hide();
				upArrow.show();
			});
		}
	});

	// Initially hide the full content and show the down arrow
	jQuery(".full-content").hide();
	jQuery(".down-arrow").show();
	jQuery(".up-arrow").hide();

	e(".acknowledgement-slider").slick({
		dots: !1,
		arrows: !1,
		infinite: !0,
		speed: 900,
		slidesToShow: 1,
		swipeToSlide: !0,
		variableWidth: !0,
		autoplay: !0,
		autoplaySpeed: 1e3,
	}),
		e(".work-slider").slick({
			arrows: !1,
			dots: !0,
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: !0,
			pauseOnHover: !1,
			swipe: !0,
			speed: 1e3,
			autoplay: !0,
			adaptiveHeight: false,
			autoplaySpeed: 2e3,
		}),
		e(".solution-slider").slick({
			autoplay: !0,
			autoplaySpeed: 2e3,
			arrows: !0,
			dots: !0,
			slidesToShow: 1,
			infinite: !0,
			pauseOnHover: !1,
			swipeToSlide: !0,
			swipe: !0,
			speed: 1e3,
		}),
		e(".service-achievement-slider").slick({
			dots: false,
			arrows: false,
			infinite: false,
			speed: 900,
			slidesToShow: 4,
			swipeToSlide: !0,
			autoplay: false,
			//autoplaySpeed: 2e3,
			//centerMode: true,
			variableWidth: true,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 3,
						infinite: true,
						autoplay: true,
						variableWidth: true,
					},
				},
				{
					breakpoint: 575,
					settings: {
						slidesToShow: 1,
						infinite: true,
						autoplay: true,
						variableWidth: false,
						autoplaySpeed: 1000,
					},
				},
			],
		}),
		e(".work-party-slider").slick({
			arrows: !0,
			dots: !1,
			slidesToShow: 1,
			swipeToSlide: !0,
			variableWidth: !0,
			infinite: !0,
			swipe: !0,
			speed: 600,
			responsive: [
				{
					breakpoint: 767,
					settings: { variableWidth: !1, slidesToShow: 2, slidesToScroll: 1 },
				},
				{
					breakpoint: 575,
					settings: { slidesToShow: 1, variableWidth: !1, slidesToScroll: 1 },
				},
			],
		}),
		jQuery("form.search-form .search-btn").click(function () {
			jQuery(".searchbar").toggleClass("active-search");
		}),
		e(".client-testimonial-seciton a").click(function () {
			var i = e(this).data("name");
			e(".client-testimonial-seciton h5").html(i);
		}),
		e(".wright_review").click(function () {
			// window.open("https://g.page/r/CajOGNhGyszeEB0/review", "_blank", "width=600,height=400");
			window.open("https://g.page/r/CajOGNhGyszeEB0/review", "_blank", "width=600,height=400,noopener,noreferrer");
		});

	jQuery(".clutch-badges-slider.slick-slider").slick({
		dots: !1,
		arrows: !1,
		infinite: !0,
		speed: 900,
		slidesToShow: 5,
		swipeToSlide: !0,
		variableWidth: !1,
		autoplay: !0,
		autoplaySpeed: 1e3,
		responsive: [
			{
				breakpoint: 1500,
				settings: {
					slidesToShow: 4,
				},
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
				},
			},
			
			{
				breakpoint: 575,
				settings: {
					slidesToShow: 2,
				},
			},
			{
				breakpoint: 380,
				settings: {
					slidesToShow: 1,
				},
			},
		],
	});

	var $packageslider = jQuery(".ecommerce-package-slider");
	$packageslider.slick({
		dots: !0,
		arrows: !1,
		infinite: !0,
		speed: 900,
		slidesToShow: 3,
		swipeToSlide: !0,
		autoplay: false,
		autoplaySpeed: 2e3,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 575,
				settings: {
					initialSlide: 1,
					slidesToShow: 1,
					slidesToScroll: 1,
					adaptiveHeight: true,
				},
			},
		],
	});

	function goToSlideOnLoad() {
		var viewportWidth = jQuery(window).width();
		if (viewportWidth <= 992) {
			$packageslider.slick("slickGoTo", 1);
		}
	}

	goToSlideOnLoad();
	jQuery(window).resize(function () {
		goToSlideOnLoad();
	});

	let packageList = jQuery(".package-block");
	jQuery(document).on("click", ".package-block .see-more-link", function () {
		packageList.toggleClass("expand");
		$packageslider.slick("refresh");
	});

	// Slider Sticky function call
	blogSidebarStickyFunction();

	// ======= start breadcrumbs js code =======
	// Check if the first section inside .main-wrapper has the class .blue-section
	if (jQuery(".main-wrapper section:first").hasClass("blue-section")) {
		// Apply background and text color to the .blue-section
		jQuery(".blue-section").css({
			"background-color": "#002840",
			color: "#fff",
		});

		// Apply white color to links with the class .blue-color-breadcrumbs
		jQuery("#breadcrumbs-custom .blue-color-breadcrumbs").css("color", "#fff");
		jQuery("#breadcrumbs-custom").css("color", "#fff");
	}
	//  ==== breadcrumbs code end ====



});

jQuery(window).on("scroll", function () {
	// Slider Sticky function call
	blogSidebarStickyFunction();
});

// Slider Sticky function
function blogSidebarStickyFunction() {
	if (jQuery(".sidebar-sticky").length > 0) {
		jQuery(".sidebar-sticky").each(function () {
			var sidebar_sticky_top = jQuery(".blog_content_bar .col-lg-3").offset().top - jQuery(window).scrollTop();
			var blog_footer_bottom = jQuery(".blog_footer").offset().top - jQuery(window).scrollTop();
			var sidebar_sticky_height = jQuery(this).height();
			if (blog_footer_bottom - 160 >= sidebar_sticky_height && sidebar_sticky_top <= 100) {
				jQuery(this).addClass("sticky");
				if (blog_footer_bottom - 160 <= sidebar_sticky_height) {
					jQuery(this).addClass("scroll");
				} else {
					jQuery(this).removeClass("scroll");
				}
			} else {
				if (blog_footer_bottom - 160 <= sidebar_sticky_height) {
					jQuery(this).addClass("scroll");
				} else {
					jQuery(this).removeClass("scroll");
				}
				jQuery(this).removeClass("sticky");
			}
		});
	}
}

jQuery(document).ready(function(){
	
	if(jQuery(".new-services-clutch-slider").length){
	  jQuery(".new-services-clutch-slider").slick({
		arrows: true,
		dots: false,
		slidesToShow: 4,
		swipeToSlide: true,
		infinite: true,
		swipe: true,
		speed: 600,
		responsive: [
		  {
			breakpoint: 767,
			settings: { slidesToShow: 2, slidesToScroll: 1 },
		  },
		  {
			breakpoint: 575,
			settings: { slidesToShow: 1, slidesToScroll: 1 },
		  },
		],
	  });
	}
});
document.addEventListener('DOMContentLoaded', function () {
	const triggerBtn = document.getElementById('linkedinPostsBtn');
	const popup = document.getElementById('linkedinPopup');
	const closeBtn = document.getElementById('closeLinkedinPopup');
  
	if (triggerBtn && popup) {
	  triggerBtn.addEventListener('click', function () {
		if (popup.classList.contains('show')) {
		  popup.classList.remove('show');
		  popup.style.pointerEvents = 'none';
		} else {
		  popup.classList.add('show');
		  popup.style.pointerEvents = 'auto';
  
		  // Make all links open in new tab
		  const links = popup.querySelectorAll('a');
		  links.forEach(link => {
			link.setAttribute('target', '_blank');
			link.setAttribute('rel', 'noopener noreferrer');
		  });
		}
	  });
	}
  
	if (closeBtn && popup) {
	  closeBtn.addEventListener('click', function () {
		popup.classList.remove('show');
		popup.style.pointerEvents = 'none'; // <-- Make sure this is here
	  });
	}
  });
  
  const observer = new MutationObserver(function (mutationsList, observer) {
	const juicerLinks = document.querySelectorAll(".juicer-feed a");
  
	juicerLinks.forEach(function (link) {
	  link.setAttribute("target", "_blank");
	  link.setAttribute("rel", "noopener noreferrer");
  
	  if (link.href.includes("linkedin.com")) {
		link.addEventListener("click", function (e) {
		  e.stopPropagation();
		});
	  }
	});
  });
  
  observer.observe(document.body, {
	childList: true,
	subtree: true
  });

  // Slider Js for industry page
jQuery(document).ready(function($) {
    // Initialize main slider
    var $mainSlider = $('#testimonialMainSlider');
    var $navSlider = $('#testimonialNavSlider');
    
    
    // Initialize main content slider
    $mainSlider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '#testimonialNavSlider',
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 800,
        cssEase: 'ease-in-out',
        pauseOnHover: true,
        pauseOnFocus: true
    });
    
    // Initialize navigation slider
    $navSlider.slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '#testimonialMainSlider',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '0px',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    centerMode: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    centerMode: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    centerMode: false
                }
            }
        ]
    });
    
    $('.industry-page-testimonial__arrow--prev').on('click', function() {
        $('#testimonialMainSlider').slick('slickPrev');
    });

    $('.industry-page-testimonial__arrow--next').on('click', function() {
        $('#testimonialMainSlider').slick('slickNext');
    });

    
    // Add active class to center slide
    $navSlider.on('afterChange', function(event, slick, currentSlide) {
        $('.industry-page-testimonial__nav-item').removeClass('industry-page-testimonial__nav-item--active');
        $('.industry-page-testimonial__nav-item').eq(currentSlide).addClass('industry-page-testimonial__nav-item--active');
    });
    
    // Set initial active state
    $('.industry-page-testimonial__nav-item').first().addClass('industry-page-testimonial__nav-item--active');
});
