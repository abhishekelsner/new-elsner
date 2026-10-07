document.addEventListener("DOMContentLoaded", function () {
	const initSwiperSlider = (selector, slideSelector, options = {}) => {
		const container = document.querySelector(selector);

		if (container && typeof Swiper !== "undefined") {
			// Add Swiper and custom overflow-visible classes
			container.classList.add("swiper", "swiper-overflow-visible");

			// Create wrapper
			const wrapper = document.createElement("div");
			wrapper.classList.add("swiper-wrapper");

			// Move slides into wrapper
			const slides = container.querySelectorAll(slideSelector);
			slides.forEach((slide) => {
				slide.classList.add("swiper-slide");
				wrapper.appendChild(slide);
			});

			// Clear and build new structure
			container.innerHTML = "";
			container.appendChild(wrapper);

			// Initialize Swiper
			new Swiper(container, {
				loop: true,
				direction: "horizontal",
				spaceBetween: 30,
				autoplay: true,
				...options,
			});
		} else {
			console.warn(`Swiper not loaded or ${selector} missing.`);
		}
	};

	// Initialize sliders with fixed breakpoints
	initSwiperSlider(".client-slider", ".client-slide", {
		slidesPerView: 1, // Default for mobile-first approach
		breakpoints: {
			480: { slidesPerView: 1 },
			768: { slidesPerView: 2 },
			1024: { slidesPerView: 2 },
			1200: { slidesPerView: 3 },
		},
	});

	initSwiperSlider(".insights-blocks-wrapper", ".insights-block", {
		slidesPerView: 1, // Default for mobile-first
		breakpoints: {
			991: { slidesPerView: 1 },
			1024: { slidesPerView: 2 },
		},
	});

	initSwiperSlider(".why-weekmate-slide", ".slide-card", {
		slidesPerView: 1, // Default for mobile-first
		breakpoints: {
			480: { slidesPerView: 1 },
			768: { slidesPerView: 2 },
			1024: { slidesPerView: 3 },
			1200: { slidesPerView: 3 },
		},
	});

	initSwiperSlider(".development-services-slider", ".service-card", {
		slidesPerView: 1, // Default for mobile-first
		breakpoints: {
			480: { slidesPerView: 1 },
			768: { slidesPerView: 1 },
			991: { slidesPerView: 2 },
			1024: { slidesPerView: 2 },
		},
	});
});
// ==== Start single product Tailored  js ===
document.addEventListener("DOMContentLoaded", function () {
	const swiper = new Swiper(".product-content-box-wrapper.swiper", {
		slidesPerView: 1,
		spaceBetween: 20,
		loop: true,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		breakpoints: {
			1440: {
				slidesPerView: 3,
			},
			1280: {
				slidesPerView: 2,
			},
      1199: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 1,
			},
		},
	});

	// Pause autoplay on hover
	const sliderEl = document.querySelector(".product-content-box-wrapper.swiper");
	if (sliderEl) {
		sliderEl.addEventListener("mouseenter", function () {
			swiper.autoplay.stop();
		});
		sliderEl.addEventListener("mouseleave", function () {
			swiper.autoplay.start();
		});
	}
});
// ==== End single product Tailored  js ===

// ==== Start single product Benifit of HRMS js ===
jQuery(document).ready(function ($) {
	const backgroundColors = ["#E3F2FD", "#FCE4EC", "#FFF3E0", "#E8F5E9", "#F3E5F5"];

	const $slider = $(".single-product-weekmate-Benefits-section .expertise-slider");

	// Remove old slick instance if initialized
	if ($slider.hasClass("slick-initialized")) {
		$slider.slick("unslick");
	}

	// Function to apply background colors
	function applyBackgroundColors() {
		$slider.find(".technology-slide").each(function (index) {
			const realIndex = index % backgroundColors.length;
			const bgColor = backgroundColors[realIndex];
			$(this).css("background", ""); // clear existing
			$(this).css("background-color", bgColor); // apply new
		});
	}

	// Apply background color on init
	$slider.on("init", function () {
		applyBackgroundColors();
	});

	// Also re-apply on reInit (important for responsiveness and dynamic changes)
	$slider.on("reInit", function () {
		applyBackgroundColors();
	});

	// Re-apply on breakpoints/resizes if needed
	$slider.on("setPosition", function () {
		applyBackgroundColors();
	});

	// Initialize Slick
	$slider.slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		infinite: true,
		arrows: true,
		dots: false,
		autoplay: true,
		autoplaySpeed: 4000,
		responsive: [
			{
				breakpoint: 1199,
				settings: {
					slidesToShow: 3,
				},
			},
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
				},
			},
			{
				breakpoint: 575,
				settings: {
					slidesToShow: 1,
				},
			},
		],
	});
});
// ==== End single product Benifit of HRMS js ===

// ==== Start single product team thrive tab js ===
document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".category-tab");
    const contents = document.querySelectorAll(".category-content-block");

    // Initialize Swiper sliders
    document.querySelectorAll(".category-swiper").forEach(swiperEl => {
      new Swiper(swiperEl, {
        loop: true,
        pagination: {
          el: swiperEl.querySelector(".swiper-pagination"),
          clickable: true
        },
        spaceBetween: 30
      });
    });

    // Tab switching with smooth transition
    tabs.forEach(tab => {
      tab.addEventListener("click", function() {
        const targetId = this.getAttribute("data-tab");
        const targetContent = document.getElementById(targetId);

        // Remove active classes
        tabs.forEach(t => t.classList.remove("active"));
        contents.forEach(c => c.classList.remove("active"));

        // Add active class
        this.classList.add("active");
        targetContent.classList.add("active");
      });
    });

    // Fancybox initialization
    Fancybox.bind("[data-fancybox='gallery']", {});
  });
  // ==== End single product team thrive tab js ===

// ==== Start Faq js ===
  document.addEventListener("DOMContentLoaded", function() {
    const headers = document.querySelectorAll(".accordion-header");

    headers.forEach(header => {
      header.addEventListener("click", () => {
        const allHeaders = document.querySelectorAll(".accordion-header");
        const allBodies = document.querySelectorAll(".accordion-body");
        const currentBody = header.nextElementSibling;
        const isCurrentlyActive = header.classList.contains("active");

        // Close all accordion items
        allHeaders.forEach(h => h.classList.remove("active"));
        allBodies.forEach(body => {
          body.classList.remove("active");
          body.style.height = "0px";
        });

        // If the clicked item wasn't active, open it
        if (!isCurrentlyActive) {
          header.classList.add("active");
          currentBody.classList.add("active");

          // Get the natural height and animate to it
          const scrollHeight = currentBody.scrollHeight;
          currentBody.style.height = scrollHeight + "px";

          // After animation completes, set to auto for responsive behavior
          setTimeout(() => {
            if (currentBody.classList.contains("active")) {
              currentBody.style.height = "auto";
            }
          }, 300);
        }
      });
    });
  });
// ==== End Faq js ===

// ==== Single Product Deatil Slider js ===
document.addEventListener("DOMContentLoaded", function () {
	const swiper = new Swiper('.product-image-slider', {
	  loop: true,
	  autoplay: {
		delay: 6000,
		disableOnInteraction: false,
	  },
	  speed: 1200,
	  effect: 'slide',
	});
  
	// Manual click on text triggers slide
	const triggers = document.querySelectorAll('.swiper-text-trigger');
	triggers.forEach((el, i) => {
	  el.addEventListener('click', function () {
		swiper.slideToLoop(i); // Loop index fix
	  });
	});
  
	// Optional: highlight active text as slide changes
	swiper.on('slideChange', function () {
	  const realIndex = swiper.realIndex;
	  triggers.forEach(el => el.classList.remove('active'));
	  if (triggers[realIndex]) {
		triggers[realIndex].classList.add('active');
	  }
	});
	
	// Initialize Fancybox (this will group all anchors with data-fancybox='product-gallery')
	Fancybox.bind("[data-fancybox='product-gallery']", {});
  });
// ==== End Single Product Deatil Slider js ===

// ==== Single Product Feature Deatil Slider js ===
document.addEventListener("DOMContentLoaded", function() {
    if (typeof jQuery !== "undefined") {
      jQuery(function($) {
        // Click handler
        $('.dwp-solution-list li').on('click', function(e) {
          // Prevent link clicks from triggering accordion
          if ($(e.target).closest('.learn-link').length) {
            return;
          }

          $('.dwp-solution-list li').removeClass('active').each(function() {
            $(this).find('.sb-img').css('background-image', '');
          });

          const $this = $(this);
          const activeImg = $this.find('.solution-block').data('active-img');
          $this.addClass('active');
          $this.find('.sb-img').css('background-image', 'url(' + activeImg + ')');
        });

        // Set initial background for the first active item
        const $initialActive = $('.dwp-solution-list li.active');
        if ($initialActive.length) {
          const activeImg = $initialActive.find('.solution-block').data('active-img');
        }
      });
    } else {
      console.error("jQuery not loaded. Please enqueue it in WordPress.");
    }
  });
// ==== End Single Product Feature Deatil Slider js ===

// ==== Start button smoothly Redirect js ===
jQuery(document).ready(function ($) {
	$('a[href="#contact-us"]').on('click', function (e) {
	  e.preventDefault();
  
	  var $target = $('#contact-us');
  
	  if ($target.length) {
		// Dynamically get the height of the fixed header
		var headerHeight = $('header').outerHeight() || 0;
		if( headerHeight > 86 ){
			headerHeight = 86;
		}
		console.log(headerHeight);
  
		// Scroll to the target position minus the header height
		$('html, body').animate({
		  scrollTop: $target.offset().top - headerHeight
		}, 2000, 'swing');
	  }
	});
  });
  
// ==== End button smoothly Redirect js  ===

// ==== disable cf7 button form submitting js  ===
jQuery(document).ready(function ($) {
	// Disable button on submit to prevent double-clicks
	$('.wpcf7-form').on('submit', function () {
	  console.log('Submitting...');
	  $(this).find('.wpcf7-submit').attr('disabled', true).val('Submitting...');
	});
  
	// Re-enable button after submission
	$(document).on('wpcf7submit', function (e) {
	  console.log('Form submitted');
	  $(e.target).find('.wpcf7-submit').removeAttr('disabled').val('Send Message');
	});
  });  