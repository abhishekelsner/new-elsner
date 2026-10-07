jQuery(document).ready(function ($) {
    $('.client-logos-wrapper').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        arrows: false,
        dots: false,
        infinite: true,
        pauseOnHover: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });
    $('.expertise-wrapper-block-box').slick({
        slidesToShow: 2.5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        arrows: false,
        dots: false,
        infinite: true,
        pauseOnHover: false,
        rtl: true,  // <--- ADD THIS LINE

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    centerPadding: '80px'
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '60px'
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '30px'
                }
            }
        ]
    });
    $('.testimonials-wrapper').slick({
        slidesToShow:1,
        slidesToScroll:1,
        autoplay:false,
        autoplaySpeed:2500,
        arrows:false,
        dots:true,
        infinite:false,
         asNavFor: '.testimonials-image-slider',

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
        
    });
    $('.testimonials-wrapper').on('afterChange', function (event, slick, currentSlide) {
        $('.testimonials-image-slider').slick('slickGoTo', currentSlide, true);
    });
    $('.testimonials-image-slider')
    .on('init reInit afterChange', function(event, slick, currentSlide){

        var i = (currentSlide ? currentSlide : 0);

        // Remove old classes
        $('.slick-slide').removeClass('prev-slide next-slide');

        // Add previous slide class
        $(slick.$slides[i - 1]).addClass('prev-slide');

        // Add next slide class
        $(slick.$slides[i + 1]).addClass('next-slide');

    })
    .slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        swipe: false,
        dots: false,
        centerMode: true,
        infinite: false,
        centerPadding: '40px',
        speed: 600,
        asNavFor: '.testimonials-wrapper',

        responsive: [
            {
                breakpoint: 768,
                settings: {
                    centerMode: false,
                    slidesToShow: 1,
                    centerPadding: '0'
                }
            }
        ]
    });
});
// document.addEventListener('DOMContentLoaded', function () {
//     if (window.jQuery && jQuery.fn.slick) {
//         jQuery('.expertise-wrapper-block-box').slick({
//             slidesToShow: 2.5,
//             slidesToScroll: 1,
//             autoplay: true,
//             autoplaySpeed: 2500,
//             arrows: false,
//             dots: false,
//             infinite: true,
//             pauseOnHover: false,
//              // IMPORTANT FOR LEFT → RIGHT DISPLAY
//             centerMode: false,
//             variableWidth: false,
//             rtl: false,

//             responsive: [
//                 {
//                     breakpoint: 1024,
//                     settings: {
//                         slidesToShow: 2.5
//                     }
//                 },
//                 {
//                     breakpoint: 768,
//                     settings: {
//                         slidesToShow: 2
//                     }
//                 }
//             ]
//         });
//     }
// });