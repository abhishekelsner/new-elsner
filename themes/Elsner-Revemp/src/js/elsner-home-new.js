/**
 * NOTE — testimonials data:
 * The testimonial slider below reads `window.elsnerTestimonials`, an array
 * of { name, role, quote, rating } objects. Since this build has no
 * enqueue file, localize it yourself wherever you enqueue this script, e.g.:
 *
 *   wp_enqueue_script( 'elsner-home', get_stylesheet_directory_uri() . '/assets/js/home.js', array( 'jquery' ), '1.0.0', true );
 *
 *   if ( have_rows( 'page_builder' ) ) {
 *       while ( have_rows( 'page_builder' ) ) {
 *           the_row();
 *           if ( get_row_layout() === 'testimonials' && have_rows( 'testimonials' ) ) {
 *               $slides = array();
 *               while ( have_rows( 'testimonials' ) ) {
 *                   the_row();
 *                   $slides[] = array(
 *                       'name'   => get_sub_field( 'client_name' ),
 *                       'role'   => get_sub_field( 'client_title' ),
 *                       'quote'  => get_sub_field( 'quote' ),
 *                       'rating' => (int) get_sub_field( 'rating' ),
 *                   );
 *               }
 *               wp_localize_script( 'elsner-home', 'elsnerTestimonials', $slides );
 *           }
 *       }
 *   }
 *
 * Without this, the slider simply won't auto-rotate — the first testimonial
 * still renders fine since testimonials.php outputs it server-side.
 */
(function () {
  var mq = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* header on scroll */
  var hdr = document.getElementById('hdr');
  if (hdr) {
    var onScroll = function () { hdr.classList.toggle('scrolled', window.scrollY > 40); };
    onScroll(); window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* hero word stagger (only fires if hero heading markup uses <span class="w"> per word) */
  document.querySelectorAll('#heroH1 .w').forEach(function (w, i) { w.style.animationDelay = (0.15 + i * 0.07) + 's'; });

  /* reveal on scroll */
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: 0.14, rootMargin: '0px 0px -8% 0px' });
  if (!('IntersectionObserver' in window)) {
    document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('in'); });
  } else {
    document.querySelectorAll('.reveal').forEach(function (el) { mq ? el.classList.add('in') : io.observe(el); });
  }

  /* count-up stats — targets .stats-section__number (data-to / data-suffix / data-comma set in stats-bar.php) */
  function countUp(el) {
    var to = +el.dataset.to, suf = el.dataset.suffix || '', comma = el.dataset.comma, dur = 1600, t0 = null;
    function fmt(n) { n = Math.round(n); return comma ? n.toLocaleString('en-US') : n; }
    function step(ts) {
      if (!t0) t0 = ts; var p = Math.min((ts - t0) / dur, 1); var e = 1 - Math.pow(1 - p, 3);
      el.textContent = fmt(to * e) + suf; if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }
  var sObs = new IntersectionObserver(function (en) {
    en.forEach(function (e) {
      if (e.isIntersecting) {
        e.target.querySelectorAll('.stats-section__number').forEach(function (n) {
          mq ? (n.textContent = (+n.dataset.to).toLocaleString('en-US') + (n.dataset.suffix || '')) : countUp(n);
        });
        sObs.unobserve(e.target);
      }
    });
  }, { threshold: 0.4 });
  var st = document.getElementById('stats'); if (st) sObs.observe(st);

  /* core capabilities: subtle depth scale on stacked cards — targets .capability-card (capabilities-section.php) */
  var caps = Array.prototype.slice.call(document.querySelectorAll('.capability-card'));
  if (!mq && caps.length) {
    var capScroll = function () {
      caps.forEach(function (card, i) {
        var r = card.getBoundingClientRect();
        var pin = 100;
        if (r.top <= pin + 2) {
          var behind = 0;
          for (var j = i + 1; j < caps.length; j++) { if (caps[j].getBoundingClientRect().top <= pin + 40) behind++; }
          var s = Math.max(1 - behind * 0.02, 0.92);
          card.style.transform = 'scale(' + s + ')';
        } else { card.style.transform = ''; }
      });
    };
    window.addEventListener('scroll', capScroll, { passive: true }); capScroll();
  }

  /* faq accordion — only one open at a time */
  var faqs = document.querySelectorAll('.faq');

  faqs.forEach(function (f) {
    var q = f.querySelector('.q'), a = f.querySelector('.a'), pm = f.querySelector('.pm');
    if (!q || !a) return;

    if (f.classList.contains('open')) a.style.maxHeight = a.scrollHeight + 'px';

    q.addEventListener('click', function () {
      var isOpen = f.classList.contains('open');

      // close every other faq first
      faqs.forEach(function (other) {
        if (other === f) return;
        var otherA = other.querySelector('.a'), otherPm = other.querySelector('.pm');
        other.classList.remove('open');
        if (otherA) otherA.style.maxHeight = 0;
        if (otherPm) otherPm.textContent = '+';
      });

      // then toggle the clicked one
      if (isOpen) {
        f.classList.remove('open');
        a.style.maxHeight = 0;
        if (pm) pm.textContent = '+';
      } else {
        f.classList.add('open');
        a.style.maxHeight = a.scrollHeight + 'px';
        if (pm) pm.textContent = '−';
      }
    });
  });

  /* testimonials carousel — data comes from ACF via wp_localize_script()
     as `elsnerTestimonials` (see elsner_homepage_assets() in
     functions-page-builder.php). Falls back to whatever is already
     server-rendered in #testiSlide if the variable isn't present. */
  var slides = (typeof elsnerTestimonials !== 'undefined' && elsnerTestimonials.length) ? elsnerTestimonials : null;

  if (slides) {
    var dots = document.querySelectorAll('#dots b'), slideEl = document.getElementById('testiSlide'), cur = 0, timer;

    function show(i) {
      cur = i; slideEl.style.opacity = 0;
      setTimeout(function () {
        var s = slides[i];
        var stars = '★★★★★'.slice(0, Math.max(1, Math.min(5, s.rating || 5)));
        slideEl.innerHTML =
          '<div class="testimonials-section__name">' + s.name + '</div>' +
          '<div class="testimonials-section__role">' + s.role + '</div>' +
          '<p class="testimonials-section__quote">' + s.quote + '</p>' +
          '<div class="testimonials-section__stars">' + stars + '</div>';
        slideEl.style.opacity = 1;
      }, mq ? 0 : 260);
      dots.forEach(function (d, di) { d.classList.toggle('on', di === i); });
    }

    function auto() { timer = setInterval(function () { show((cur + 1) % slides.length); }, 5000); }
    dots.forEach(function (d, di) { d.addEventListener('click', function () { clearInterval(timer); show(di); auto(); }); });
    if (!mq && slides.length > 1) auto();
  }

  /* mobile menu toggle */
  var burger = document.getElementById('burger'), menu = document.querySelector('.menu');
  burger && burger.addEventListener('click', function () {
    var open = menu.style.display === 'flex';
    menu.style.display = open ? '' : 'flex';
    if (!open) {
      menu.style.position = 'absolute'; menu.style.top = '100%'; menu.style.left = 0; menu.style.right = 0;
      menu.style.flexDirection = 'column'; menu.style.background = '#fff'; menu.style.padding = '16px 24px'; menu.style.gap = '10px'; menu.style.color = '#16273f';
    }
  });

  /* clients logo slider (Slick) */
  if (window.jQuery && jQuery.fn.slick) {
    console.log("Hello World")
    jQuery('.clients-slider').slick({
      infinite: true,
      slidesToShow: 6,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2500,
      arrows: false,
      dots: false,
      responsive: [
        { breakpoint: 1200, settings: { slidesToShow: 5, slidesToScroll: 1 } },
        { breakpoint: 1024, settings: { slidesToShow: 4, slidesToScroll: 1 } },
        { breakpoint: 768, settings: { slidesToShow: 3, slidesToScroll: 1 } },
        { breakpoint: 576, settings: { slidesToShow: 2, slidesToScroll: 1 } }
      ]
    });
  }
})();

jQuery(document).ready(function ($) {

    $('.testimonials-wrapper').slick({
        slidesToShow:1,
        slidesToScroll:1,
        autoplay:true,
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

document.addEventListener('DOMContentLoaded', function () {
      console.log("hello world");

    // Convert a YouTube/Vimeo "watch" URL into an embeddable, autoplay URL
    function toEmbedUrl(url) {
        if (!url) return url;

        // YouTube: watch?v=ID or youtu.be/ID
        var yt = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/);
        if (yt && yt[1]) {
            return 'https://www.youtube.com/embed/' + yt[1] + '?autoplay=1&rel=0';
        }

        // Vimeo: vimeo.com/ID
        var vm = url.match(/vimeo\.com\/(\d+)/);
        if (vm && vm[1]) {
            return 'https://player.vimeo.com/video/' + vm[1] + '?autoplay=1';
        }

        // Already an embed URL or self-hosted mp4 — leave as-is
        return url;
    }

   document.querySelectorAll('.testimonial-play[data-fancybox="testimonial-video"]').forEach(function (link) {
        link.addEventListener('click', function () {

            // Reset every OTHER testimonial link back to its clean original href first
            document.querySelectorAll('.testimonial-play[data-fancybox="testimonial-video"]').forEach(function (otherLink) {
                if (otherLink !== link) {
                    var otherOriginal = otherLink.getAttribute('data-original-href');
                    if (otherOriginal) {
                        otherLink.setAttribute('href', otherOriginal);
                    }
                }
            });

            // Now rewrite only the clicked link's href to the autoplay embed URL
            var original = link.getAttribute('data-original-href') || link.getAttribute('href');
            link.setAttribute('data-original-href', original);
            link.setAttribute('href', toEmbedUrl(original));
        });
    });
 
    if (typeof Fancybox !== 'undefined') {
 
        // Clear any prior bindings/instances in case this script ever runs more than once
        Fancybox.unbind('[data-fancybox="testimonial-video"]');
        Fancybox.close(true);
 
        Fancybox.bind('[data-fancybox="testimonial-video"]', {
            type: 'iframe',
            preload: false, // stop Fancybox from preloading neighboring gallery iframes
            iframe: {
                css: {
                    width: '800px',
                    height: '450px'
                }
            },
            on: {
                // Fires once when the popup first opens — safety net for any stray
                // youtube/vimeo iframe elsewhere on the page that isn't inside this popup
                ready: function (fancybox) {
                    document.querySelectorAll('iframe[src*="youtube.com/embed"], iframe[src*="player.vimeo.com"]').forEach(function (ifr) {
                        if (!fancybox.container.contains(ifr)) {
                            ifr.src = ifr.src;
                        }
                    });
                },
 
                // Fires every time you navigate between slides INSIDE the open popup
                // (arrow click / swipe) — stops the slide you're leaving from still playing
                'Carousel.change': function (fancybox, carousel, to, from) {
                    var prevSlide = carousel.slides[from];
                    if (prevSlide && prevSlide.$el) {
                        var prevIframe = prevSlide.$el.querySelector('iframe');
                        if (prevIframe) {
                            var src = prevIframe.src;
                            prevIframe.src = '';
                            prevIframe.src = src;
                        }
                    }
                },
 
                closing: function (fancybox) {
                      if (!fancybox || !fancybox.container) return;

                      var iframe = fancybox.container.querySelector('.fancybox__iframe');
                      if (iframe) {
                          var src = iframe.src;
                          iframe.src = '';
                          iframe.src = src;
                      }

                      // Revert the clicked link's href back to the original watch URL
                      // so it doesn't sit permanently as an autoplay embed URL
                      document.querySelectorAll('.testimonial-play[data-fancybox="testimonial-video"]').forEach(function (link) {
                          var original = link.getAttribute('data-original-href');
                          if (original) {
                              link.setAttribute('href', original);
                          }
                      });

                      // Resume the slider's autoplay now that the video is closed
                      if (window.jQuery && jQuery('.testimonials-wrapper').hasClass('slick-initialized')) {
                          jQuery('.testimonials-wrapper').slick('slickPlay');
                      }
                  }
            }
        });
    }
 
});
 
