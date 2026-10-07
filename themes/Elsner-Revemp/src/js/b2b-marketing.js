jQuery(document).ready(function($){
    $('.nav-pills li:first-child').addClass('current');

    $('.nav-pills a').on('click', function(){
        $('.nav-pills li').removeClass('current');
        $(this).parent('li').addClass('current');
    });

    $('.nav-pills a').each(function(){
        if ($(this).hasClass('active') && $(this).hasClass('show')) {
            $(this).parent('li').addClass('current');
        }
    });
    $(".b2b-client-testimonials-slider").slick({
        autoplay: !0,
        autoplaySpeed: 2e3,
        arrows: !0,
        dots: !1,
        slidesToShow: 2,
        infinite: !0,
        pauseOnHover: !0,
        swipeToSlide: !0,
        swipe: !0,
        speed: 1e3,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                  slidesToShow: 1,
                  infinite: true,
                  autoplay: true,
                  variableWidth: !1,
                },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                infinite: true,
                autoplay: true,
                variableWidth: !1,
              },
            },
            
          ],
      }),

      $(".b2b-client-logos-slider").slick({
        dots: !1,
        arrows: !1,
        infinite: !0,
        speed: 900,
        slidesToShow: 1,
        swipeToSlide: !0,
        variableWidth: !0,
        autoplay: !0,
        autoplaySpeed: 1e3,
        responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 4,
                infinite: true,
                autoplay: true,
                variableWidth: !1,
              },
            },
            {
                breakpoint: 575,
                settings: {
                  slidesToShow: 3,
                  infinite: true,
                  autoplay: true,
                  variableWidth: !1,
                },
              },
          ],
      })
});