<?php
/**
 * Section: Meeting + booking widget (ACF layout "meeting")
 *
 * Expects $args['booth_no'] passed from the main template
 * (pre-scanned from the Hero section) for the {booth} placeholder.
 *
 * ACF field structure required on the "person" repeater:
 *   - image                (Image)
 *   - name                 (Text)
 *   - title                (Text)
 *   - linkedin             (URL / Link)
 *   - calender_code        (Text Area / Wysiwyg) <-- NEW: per-person embed code
 *
 * The layout-level "booking_widghet_code" field is kept ONLY as a fallback
 * shown before JS runs (or if a person row has no widget code of its own).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$booth_no         = isset( $args['booth_no'] ) ? $args['booth_no'] : '';
$heading          = get_sub_field( 'heading' );
$description      = get_sub_field( 'description' );
$booking_fallback = get_sub_field( 'booking_widghet_code' );

// Only enable the per-person slider + dynamic widget swap on this specific page.
// Everywhere else, always show the static layout-level fallback widget.
$enable_dynamic_widget = is_page( 'seamless-dubai-2026' );

// Retrieve repeater or single person field
$person_raw = get_sub_field( 'person' );

if ( empty( $person_raw ) ) {
	$person_raw = get_field( 'person' );
}

$person_cards = array();

if ( ! empty( $person_raw ) && is_array( $person_raw ) ) {
	// Check if it's an indexed array (repeater field with multiple rows)
	if ( isset( $person_raw[0] ) && is_array( $person_raw[0] ) ) {
		$person_cards = $person_raw;
	} else {
		// Single person item (group or single associative array)
		$person_cards = array( $person_raw );
	}
}

// Fallback to ACF have_rows loop if get_sub_field returned empty or unindexed
if ( empty( $person_cards ) ) {
	if ( have_rows( 'person' ) ) {
		while ( have_rows( 'person' ) ) {
			the_row();
			$person_cards[] = array(
				'image'                => get_sub_field( 'image' ),
				'name'                 => get_sub_field( 'name' ),
				'title'                => get_sub_field( 'title' ),
				'linkedin'             => get_sub_field( 'linkedin' ),
				'calender_code'        => get_sub_field( 'calender_code' ),
			);
		}
	}
}

$has_multiple = ( count( $person_cards ) > 1 ) && $enable_dynamic_widget;
?>

<section class="london-event-meeting-section">

	<div class="container">
		<div class="london-event-meeting-section-wrapper">

			<?php if ( $heading || $description ) : ?>
				<div class="row">
					<div class="col-12">
						<div class="london-event-meeting-head text-center">

							<?php if ( $heading ) : ?>
								<h2 class="london-event-meeting-title">
									<?php echo esc_html( $heading ); ?>
								</h2>
							<?php endif; ?>

							<?php if ( $description ) : ?>
								<div class="london-event-meeting-desc">
									<?php echo wp_kses_post( $description ); ?>
								</div>
							<?php endif; ?>

						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="row align-items-stretch london-event-meeting-body" id="meeting-contact">

				<?php if ( ! empty( $person_cards ) ) : ?>
					<div class="col-12 col-lg-5">

						<?php if ( $has_multiple ) : ?>
							<div class="london-event-person-slider">
						<?php endif; ?>

						<?php
						foreach ( $person_cards as $index => $person ) :
							$person_image  = ! empty( $person['image'] ) ? $person['image'] : array();
							$person_name   = ! empty( $person['name'] ) ? $person['name'] : '';
							$person_title  = ! empty( $person['title'] ) ? $person['title'] : '';
							$person_widget = ! empty( $person['calender_code'] ) ? $person['calender_code'] : '';

							// Retrieve dynamic LinkedIn URL from repeater subfield
							$raw_linkedin = '';
							if ( ! empty( $person['linkedin'] ) ) {
								$raw_linkedin = $person['linkedin'];
							}

							if ( is_array( $raw_linkedin ) ) {
								$person_linkedin = ! empty( $raw_linkedin['url'] ) ? $raw_linkedin['url'] : '';
							} else {
								$person_linkedin = (string) $raw_linkedin;
							}

							if ( empty( $person_linkedin ) ) {
								$person_linkedin = 'https://www.linkedin.com/in/chughkaran/';
							}
							?>

							<div class="london-event-person-card" data-index="<?php echo esc_attr( $index ); ?>">

								<?php if ( ! empty( $person_image['url'] ) ) : ?>
									<div class="london-event-person-photo">
										<img
											src="<?php echo esc_url( $person_image['url'] ); ?>"
											alt="<?php echo esc_attr( $person_image['alt'] ?? $person_name ); ?>"
											loading="lazy"
										/>
									</div>
								<?php endif; ?>

								<?php if ( $person_name || $person_title ) : ?>
									<div class="london-event-person-meta">

										<?php if ( $person_name ) : ?>
											<h3 class="london-event-person-name">
												<a href="<?php echo esc_url( $person_linkedin ); ?>" target="_blank" rel="noopener noreferrer">
													<?php echo esc_html( $person_name ); ?>
													<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
														<g clip-path="url(#clip0_3087_3336_<?php echo esc_attr( $index ); ?>)">
															<path d="M22.7385 0H2.26145C1.0125 0 0 1.0125 0 2.26145V22.7385C0 23.9875 1.0125 25 2.26145 25H22.7385C23.9875 25 25 23.9875 25 22.7385V2.26145C25 1.0125 23.9875 0 22.7385 0ZM7.73606 21.5866C7.73606 21.9501 7.44143 22.2448 7.07795 22.2448H4.27651C3.91302 22.2448 3.61839 21.9501 3.61839 21.5866V9.84313C3.61839 9.47965 3.91302 9.18501 4.27651 9.18501H7.07795C7.44143 9.18501 7.73606 9.47965 7.73606 9.84313V21.5866ZM5.67723 8.07801C4.2074 8.07801 3.01584 6.88645 3.01584 5.41662C3.01584 3.94679 4.2074 2.75524 5.67723 2.75524C7.14706 2.75524 8.33861 3.94679 8.33861 5.41662C8.33861 6.88645 7.14712 8.07801 5.67723 8.07801ZM22.3763 21.6397C22.3763 21.9738 22.1054 22.2448 21.7712 22.2448H18.7651C18.4309 22.2448 18.1599 21.9738 18.1599 21.6397V16.1313C18.1599 15.3096 18.401 12.5304 16.0125 12.5304C14.1598 12.5304 13.784 14.4327 13.7086 15.2863V21.6397C13.7086 21.9738 13.4377 22.2448 13.1035 22.2448H10.196C9.86185 22.2448 9.5909 21.9738 9.5909 21.6397V9.79012C9.5909 9.45596 9.86185 9.18501 10.196 9.18501H13.1035C13.4376 9.18501 13.7086 9.45596 13.7086 9.79012V10.8147C14.3955 9.7837 15.4165 8.98796 17.5902 8.98796C22.4039 8.98796 22.3763 13.4851 22.3763 15.956V21.6397Z" fill="white"/>
														</g>
														<defs>
															<clipPath id="clip0_3087_3336_<?php echo esc_attr( $index ); ?>">
																<rect width="25" height="25" fill="white"/>
															</clipPath>
														</defs>
													</svg>
												</a>
											</h3>
										<?php endif; ?>

										<?php if ( $person_title ) : ?>
											<p class="london-event-person-title">
												<?php echo esc_html( $person_title ); ?>
											</p>
										<?php endif; ?>

									</div>
								<?php endif; ?>

								<?php if ( $enable_dynamic_widget ) : ?>
									<?php /* Hidden container holding this person's raw widget/embed code.
									       Never displayed directly — JS copies its contents into the
									       visible booking-widget panel when this card becomes active. */ ?>
									<div class="person-widget-code" style="display:none;">
										<?php echo $person_widget; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</div>
								<?php endif; ?>

							</div>
						<?php endforeach; ?>

						<?php if ( $has_multiple ) : ?>
							</div>
						<?php endif; ?>

					</div>
				<?php endif; ?>

				<div class="col-12 col-lg-7">
					<div class="booking-widget" id="dynamic-booking-widget">
						<?php
						$initial_widget = '';

						if ( $enable_dynamic_widget ) {
							// Dynamic mode (seamless-dubai-2026 only): render the first
							// person's widget code on initial page load (before JS/slick
							// has run), falling back to the layout-level booking code if
							// the first person has none set.
							if ( ! empty( $person_cards[0]['calender_code'] ) ) {
								$initial_widget = $person_cards[0]['calender_code'];
							} elseif ( $booking_fallback ) {
								$initial_widget = $booking_fallback;
							}
						} else {
							// Everywhere else: always use the static layout-level fallback,
							// regardless of per-person codes, and never let JS touch it.
							$initial_widget = $booking_fallback;
						}

						echo $initial_widget; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
				</div>

			</div>

		</div>
	</div>

</section>

<?php if ( $enable_dynamic_widget ) : ?>
<script>
	(function () {

		function setActiveWidgetByPersonIndex( personIndex ) {
			var card = document.querySelector(
				'.london-event-person-card[data-index="' + personIndex + '"]'
			);
			if ( ! card ) {
				return;
			}

			var codeHolder = card.querySelector( '.person-widget-code' );
			var container  = document.getElementById( 'dynamic-booking-widget' );

			if ( codeHolder && container ) {
				container.innerHTML = codeHolder.innerHTML;

				// Re-run any <script> tags inside the newly injected widget code,
				// since innerHTML assignment does not execute embedded scripts.
				var scripts = container.querySelectorAll( 'script' );
				scripts.forEach( function ( oldScript ) {
					var newScript = document.createElement( 'script' );
					Array.from( oldScript.attributes ).forEach( function ( attr ) {
						newScript.setAttribute( attr.name, attr.value );
					} );
					newScript.textContent = oldScript.textContent;
					oldScript.parentNode.replaceChild( newScript, oldScript );
				} );
			}
		}

		function initPersonSlider() {
			if ( typeof jQuery !== 'undefined' ) {
				var $ = jQuery;
				var $slider = $( '.london-event-person-slider' );

				if ( $slider.length && typeof $.fn.slick !== 'undefined' ) {
					if ( ! $slider.hasClass( 'slick-initialized' ) ) {
						$slider.slick( {
							slidesToShow: 1,
							slidesToScroll: 1,
							infinite: true,
							dots: false,
							arrows: true,
							prevArrow: '<button type="button" class="slick-prev" aria-label="Previous"></button>',
							nextArrow: '<button type="button" class="slick-next" aria-label="Next"></button>'
						} );
					}

					// Sync the booking widget whenever the active slide changes.
					// currentSlide from Slick can point to a CLONE when infinite:true,
					// so read the real person index from that exact DOM slide's
					// data-index rather than assuming currentSlide lines up with
					// our original person_cards array.
					$slider.off( 'afterChange.bookingSync' ).on( 'afterChange.bookingSync', function ( event, slick, currentSlide ) {
						var $activeSlide = $slider.find( '.slick-slide[data-slick-index="' + currentSlide + '"]' );
						var $realCard = $activeSlide.find( '.london-event-person-card' );
						var personIndex = $realCard.attr( 'data-index' );

						if ( typeof personIndex !== 'undefined' ) {
							setActiveWidgetByPersonIndex( personIndex );
						}
					} );
				}
			}
		}

		if ( document.readyState === 'loading' ) {
			document.addEventListener( 'DOMContentLoaded', initPersonSlider );
		} else {
			initPersonSlider();
		}

		if ( typeof window !== 'undefined' ) {
			window.addEventListener( 'load', initPersonSlider );
			setTimeout( initPersonSlider, 500 );
			setTimeout( initPersonSlider, 1500 );
		}
	})();
</script>
<?php endif; ?>