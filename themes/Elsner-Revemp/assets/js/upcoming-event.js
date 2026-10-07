/**
 * Booking widget controller.
 *
 * Toggles the four panels (schedule / confirmed / call-form / call-success),
 * handles day + time selection, updates the helper lines and fills the
 * {date} {time} {booth} {email} placeholders in the confirmation copy.
 * Supports multiple widgets on one page.
 */
( function () {
	function initBookingWidget( widget ) {
		var panels = widget.querySelectorAll( '[data-state]' );
		var booth  = widget.getAttribute( 'data-booth' ) || '';

		// Derive month + year from the month label ("September 2026") to build a full date.
		var monthEl   = widget.querySelector( '.london-event-booking-month' );
		var monthTxt  = monthEl ? monthEl.textContent.trim() : '';
		var mParts    = monthTxt.split( /\s+/ );
		var monthName = mParts.length ? mParts[0] : '';
		var year      = mParts.length > 1 ? mParts[ mParts.length - 1 ] : '';

		var state = { date: '', time: '' };

		var helperDefault = widget.querySelector( '[data-helper="default"]' );
		var helperDate    = widget.querySelector( '[data-helper="date"]' );
		var helperTime    = widget.querySelector( '[data-helper="time"]' );
		var confirmBtn    = widget.querySelector( '[data-action="confirm"]' );

		// Grab the PHP-rendered templates once so we can refill them later.
		var confirmedText = widget.querySelector( '[data-state="confirmed"] .london-event-booking-confirmed-text' );
		var confirmedTpl  = confirmedText ? confirmedText.textContent.trim() : '';
		var successText   = widget.querySelector( '[data-state="call-success"] .london-event-booking-confirmed-text' );
		var successTpl    = successText ? successText.textContent.trim() : '';

		function showState( name ) {
			panels.forEach( function ( p ) {
				p.classList.toggle( 'd-none', p.getAttribute( 'data-state' ) !== name );
			} );
		}

		function fill( tpl ) {
			return tpl
				.replace( /\{date\}/g, state.date )
				.replace( /\{time\}/g, state.time )
				.replace( /\{booth\}/g, booth );
		}

		function refreshHelpers() {
			if ( helperDefault ) {
				helperDefault.classList.toggle( 'd-none', !! state.date );
			}
			if ( helperDate ) {
				if ( state.date && ! state.time ) {
					helperDate.textContent = ( helperDate.getAttribute( 'data-template' ) || '' ).replace( /\{date\}/g, state.date );
					helperDate.classList.remove( 'd-none' );
				} else {
					helperDate.classList.add( 'd-none' );
				}
			}
			if ( helperTime ) {
				if ( state.date && state.time ) {
					helperTime.textContent = fill( helperTime.getAttribute( 'data-template' ) || '' );
					helperTime.classList.remove( 'd-none' );
				} else {
					helperTime.classList.add( 'd-none' );
				}
			}
			if ( confirmBtn ) {
				confirmBtn.disabled = ! ( state.date && state.time );
			}
		}

		// Day selection.
		widget.querySelectorAll( '.london-event-booking-day' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				if ( btn.disabled ) { return; }
				widget.querySelectorAll( '.london-event-booking-day' ).forEach( function ( b ) { b.classList.remove( 'is-active' ); } );
				btn.classList.add( 'is-active' );
				var day = btn.getAttribute( 'data-day' ) || '';
				state.date = ( monthName ? monthName + ' ' : '' ) + day + ( year ? ', ' + year : '' );
				state.time = '';
				widget.querySelectorAll( '.london-event-booking-slot' ).forEach( function ( s ) { s.classList.remove( 'is-active' ); } );
				refreshHelpers();
			} );
		} );

		// Time selection.
		widget.querySelectorAll( '.london-event-booking-slot' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				if ( btn.disabled || ! state.date ) { return; }
				widget.querySelectorAll( '.london-event-booking-slot' ).forEach( function ( s ) { s.classList.remove( 'is-active' ); } );
				btn.classList.add( 'is-active' );
				state.time = btn.getAttribute( 'data-time' ) || '';
				refreshHelpers();
			} );
		} );

		// Preferred-time chips (single select).
		widget.querySelectorAll( '.london-event-form-chip' ).forEach( function ( chip ) {
			chip.addEventListener( 'click', function () {
				widget.querySelectorAll( '.london-event-form-chip' ).forEach( function ( c ) { c.classList.remove( 'is-active' ); } );
				chip.classList.add( 'is-active' );
			} );
		} );

		// Panel navigation + submit (event delegation on data-action).
		widget.addEventListener( 'click', function ( e ) {
			var target = e.target.closest( '[data-action]' );
			if ( ! target || ! widget.contains( target ) ) { return; }
			var action = target.getAttribute( 'data-action' );

			if ( 'confirm' === action ) {
				if ( ! ( state.date && state.time ) ) { return; }
				if ( confirmedText ) { confirmedText.textContent = fill( confirmedTpl ); }
				showState( 'confirmed' );
			} else if ( 'open-call' === action ) {
				showState( 'call-form' );
			} else if ( 'back-to-schedule' === action ) {
				showState( 'schedule' );
			} else if ( 'submit-call' === action ) {
				var emailInput = widget.querySelector( '[data-state="call-form"] input[type="email"]' );
				var email      = emailInput ? emailInput.value.trim() : '';
				if ( successText ) { successText.textContent = successTpl.replace( /\{email\}/g, email || 'your inbox' ); }
				showState( 'call-success' );
			}
		} );

		refreshHelpers();
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		document.querySelectorAll( '[data-booking-widget]' ).forEach( initBookingWidget );
	} );
} )();

/**
 * Stats counter animation.
 *
 * Counts each `.london-event-stat-number` up from 0 to its printed value
 * once it scrolls into view. Parses the existing text ("9,500+", "4.9",
 * "250+") so no markup changes are needed — prefix, suffix, decimals and
 * thousands separators are all preserved.
 */
( function () {
	var DURATION = 1600;

	function parseNumber( raw ) {
		var match = raw.match( /-?[\d,]*\.?\d+/ );
		if ( ! match ) { return null; }

		var numStr   = match[ 0 ];
		var digits   = numStr.replace( /,/g, '' );
		var decimals = digits.indexOf( '.' ) > -1 ? digits.split( '.' )[ 1 ].length : 0;

		return {
			value:    parseFloat( digits ),
			decimals: decimals,
			prefix:   raw.slice( 0, match.index ),
			suffix:   raw.slice( match.index + numStr.length ),
		};
	}

	function formatNumber( value, decimals ) {
		return value.toLocaleString( 'en-US', {
			minimumFractionDigits: decimals,
			maximumFractionDigits: decimals,
		} );
	}

	function animateCount( el ) {
		var parsed = parseNumber( el.textContent.trim() );
		if ( ! parsed ) { return; }

		var start = null;

		function step( timestamp ) {
			if ( ! start ) { start = timestamp; }

			var progress = Math.min( ( timestamp - start ) / DURATION, 1 );
			var eased    = 1 - Math.pow( 1 - progress, 3 );

			el.textContent = parsed.prefix + formatNumber( parsed.value * eased, parsed.decimals ) + parsed.suffix;

			if ( progress < 1 ) {
				requestAnimationFrame( step );
			} else {
				el.textContent = parsed.prefix + formatNumber( parsed.value, parsed.decimals ) + parsed.suffix;
			}
		}

		requestAnimationFrame( step );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		var counters = document.querySelectorAll( '.london-event-stat-number' );
		if ( ! counters.length ) { return; }

		if ( ! ( 'IntersectionObserver' in window ) ) {
			counters.forEach( animateCount );
			return;
		}

		var observer = new IntersectionObserver( function ( entries, obs ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					animateCount( entry.target );
					obs.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.4 } );

		counters.forEach( function ( el ) { observer.observe( el ); } );
	} );
} )();
document.addEventListener('DOMContentLoaded', function () {
    const iframe = document.querySelector('iframe');
    if (!iframe) { return; }

    iframe.style.width = '100%';

    // Suppress the iframe's own native scrollbar. This is an attribute of the
    // <iframe> element itself (not its cross-origin content), so it's ours to set.
    iframe.setAttribute('scrolling', 'no');
    iframe.style.overflow = 'hidden';

    // The Calendly iframe is cross-origin, so its internal margin/whitespace
    // can't be reached with CSS or JS from this page. Instead, oversize the
    // iframe and hide the overflow on its wrapper to crop that whitespace out.
    // CROP_TOP is a rough estimate — tune it by eye against the live embed.
    var CROP_TOP = 60;

    var wrapper = iframe.parentElement;
    if (wrapper) {
        // Lock the wrapper to its current height first — if it's sized to fit
        // the iframe (height: auto), overflow: hidden alone won't clip the
        // extra CROP_TOP px, it'll just grow the wrapper and add a page scrollbar.
        var visibleHeight = wrapper.getBoundingClientRect().height;
        wrapper.style.height = visibleHeight + 'px';
        wrapper.style.overflow = 'hidden';
    }
    iframe.style.height = 'calc(100% + ' + CROP_TOP + 'px)';

    // Only pull the iframe up on desktop — below 1080px, leave it un-cropped.
    var desktopQuery = window.matchMedia('(min-width: 1180px)');
    function applyCropMargin() {
        iframe.style.marginTop = desktopQuery.matches ? '-' + CROP_TOP + 'px' : '0';
    }
    applyCropMargin();
    desktopQuery.addEventListener('change', applyCropMargin);
});
/**
 * Hero heading rotating word (single span inside clipped wrap).
 */
( function () {
	var HOLD_MS       = 2200;
	var TRANSITION_MS = 550;

	function getTitleLineHeight( word ) {
		var title = word.closest( '.london-event-hero-title' );
		if ( ! title ) {
			return 0;
		}

		var computed   = window.getComputedStyle( title );
		var lineHeight = parseFloat( computed.lineHeight );

		if ( Number.isNaN( lineHeight ) ) {
			lineHeight = parseFloat( computed.fontSize ) * 1.333;
		}

		return lineHeight;
	}

	function syncWordWrap( word ) {
		var wrap = word.closest( '.rotating-word-wrap' );
		if ( ! wrap ) {
			return 0;
		}

		var lineHeight = getTitleLineHeight( word );
		if ( ! lineHeight ) {
			return 0;
		}

		wrap.style.height          = lineHeight + 'px';
		wrap.style.lineHeight      = lineHeight + 'px';
		word.style.lineHeight      = lineHeight + 'px';
		word.style.minHeight       = lineHeight + 'px';
		word.style.display         = 'inline-block';
		word.style.verticalAlign   = 'top';

		return lineHeight;
	}

	function initRotatingWord( word ) {
		var words = [];

		try {
			words = JSON.parse( word.dataset.words || '[]' );
		} catch ( error ) {
			console.error( 'Unable to parse rotating word list.', error );
			return;
		}

		if ( words.length <= 1 ) {
			syncWordWrap( word );
			return;
		}

		var index         = 0;
		var reducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

		syncWordWrap( word );

		if ( reducedMotion ) {
			return;
		}

		function tick() {
			word.classList.add( 'is-changing' );

			setTimeout( function () {
				index = ( index + 1 ) % words.length;
				word.textContent = words[ index ];

				word.style.transition = 'none';
				word.style.transform  = 'translateY(100%)';
				word.style.opacity    = '0';

				void word.offsetHeight;

				word.classList.remove( 'is-changing' );

				word.style.transition =
					'transform 0.55s cubic-bezier(0.65, 0, 0.35, 1), ' +
					'opacity 0.4s ease';
				word.style.transform = 'translateY(0)';
				word.style.opacity   = '1';

				setTimeout( tick, HOLD_MS );
			}, TRANSITION_MS );
		}

		setTimeout( tick, HOLD_MS );

		var resizeTimer;
		window.addEventListener( 'resize', function () {
			clearTimeout( resizeTimer );
			resizeTimer = setTimeout( function () {
				syncWordWrap( word );
			}, 150 );
		} );

		if ( typeof ResizeObserver !== 'undefined' ) {
			var title = word.closest( '.london-event-hero-title' );
			if ( title ) {
				new ResizeObserver( function () {
					syncWordWrap( word );
				} ).observe( title );
			}
		}
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		document.querySelectorAll( '.london-event-hero-title .rotating-word' ).forEach( initRotatingWord );
	} );
} )();

/**
 * Brand logos slider (Slick).
 *
 * Self-sufficient: if the theme hasn't actually enqueued Slick on this
 * template, we load it from a CDN so the slider still works, and log a
 * clear console message either way so a missing-dependency case is
 * obvious instead of silently rendering a plain stacked list.
 */
( function () {
	var SLICK_JS  = 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js';
	var SLICK_CSS = 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css';

	function loadCSS( href ) {
		if ( document.querySelector( 'link[href="' + href + '"]' ) ) { return; }
		var link = document.createElement( 'link' );
		link.rel  = 'stylesheet';
		link.href = href;
		document.head.appendChild( link );
	}

	function loadScript( src, onLoad, onError ) {
		var existing = document.querySelector( 'script[src="' + src + '"]' );
		if ( existing ) {
			existing.addEventListener( 'load', onLoad );
			existing.addEventListener( 'error', onError );
			return;
		}
		var script = document.createElement( 'script' );
		script.src = src;
		script.onload  = onLoad;
		script.onerror = onError;
		document.head.appendChild( script );
	}

	function initSliders( $ ) {
		var $sliders = $( '.london-event-brands-slider' );
		if ( ! $sliders.length ) { return; }

		$sliders.each( function () {
			var $slider = $( this );
			var count   = $slider.children().length;

			// Slick refuses to slide once slidesToShow >= the real slide count,
			// so clamp every tier to what's actually there.
			var show    = Math.min( 6, count );
			var showMd  = Math.min( 4, count );
			var showSm  = Math.min( 2, count );
			var canLoop = count > show;

			$slider.slick( {
				slidesToShow:   show,
				slidesToScroll: 1,
				infinite:       canLoop,
				autoplay:       canLoop,
				autoplaySpeed:  0,
				speed:          4000,
				cssEase:        'linear',
				pauseOnHover:   true,
				arrows:         false,
				dots:           false,
				responsive: [
					{ breakpoint: 992, settings: { slidesToShow: showMd } },
					{ breakpoint: 576, settings: { slidesToShow: showSm } },
				],
			} );
		} );
	}

	function boot() {
		var $ = window.jQuery;

		if ( ! $ ) {
			console.error( '[london-event] jQuery is not loaded on this page — the brand logos slider needs jQuery + Slick.' );
			return;
		}

		if ( $.fn && $.fn.slick ) {
			initSliders( $ );
			return;
		}

		console.warn( '[london-event] Slick carousel was not found on this page (expected it to already be enqueued) — loading it from a CDN as a fallback.' );
		loadCSS( SLICK_CSS );
		loadScript( SLICK_JS, function () {
			initSliders( $ );
		}, function () {
			console.error( '[london-event] Failed to load Slick from the CDN — the brand logos will render as a static list.' );
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', boot );
	} else {
		boot();
	}
} )();

// Scroll to Meeting Section on click of book button


document.addEventListener('DOMContentLoaded', function () {
    const headerOffset = 88;
    const ctaButtons = document.querySelectorAll(
        'a.london-event-cta-btn[href="#meeting-contact"], a.header-6-cta[href="#meeting-contact"]'
    );

    ctaButtons.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const target = document.querySelector('#meeting-contact');
            if (target) {
                const elementPosition = target.getBoundingClientRect().top + window.pageYOffset;
                const offsetPosition = elementPosition - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});