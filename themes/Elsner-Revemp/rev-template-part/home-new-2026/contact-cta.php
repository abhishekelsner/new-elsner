<?php
/**
 * Page Builder Layout: Contact CTA (contact_cta)
 * Fields: subheading, heading, description, background_image, phone_numbers
 *   (repeater: country, flag_icon, number, description), form_shortcode (text)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 */

$subheading     = get_sub_field( 'subheading' );
$heading        = get_sub_field( 'heading' );
$description    = get_sub_field( 'description' );
$background     = get_sub_field( 'background_image' );
$form_shortcode = get_sub_field( 'form_shortcode' );
?>
<section class="contact-section" id="contact">

	<?php if ( ! empty( $background['url'] ) ) : ?>
		<div class="bg"><img src="<?php echo esc_url( $background['url'] ); ?>" alt="" /></div>
	<?php endif; ?>

	<div class="container">

		<div class="reveal">
			<?php if ( $subheading ) : ?>
				<div class="eyebrow"><?php echo wp_kses_post( $subheading ); ?></div>
			<?php endif; ?>
			<?php if ( $heading ) : ?>
				<h2 ><?php echo wp_kses_post( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<p class="lead" ><?php echo esc_html( $description ); ?></p>
			<?php endif; ?>
		</div>

		<div class="contact-section__grid">

			<?php if ( have_rows( 'phone_numbers' ) ) : ?>
				<div class="reveal">
					<?php while ( have_rows( 'phone_numbers' ) ) : the_row();
						$country     = get_sub_field( 'country' );
						$flag_icon   = get_sub_field( 'flag_icon' );
						$number      = get_sub_field( 'number' );
						$office_desc = get_sub_field( 'description' );
						?>
						<div class="contact-section__office">
							<span class="flag">
								<?php if ( ! empty( $flag_icon['url'] ) ) : ?>
									<img src="<?php echo esc_url( $flag_icon['url'] ); ?>" alt="<?php echo esc_attr( $country ); ?>" />
								<?php endif; ?>
							</span>
							<div>
								<?php if ( $country ) : ?><h4><?php echo esc_html( $country ); ?></h4><?php endif; ?>
								<p>
									<?php if ( $office_desc ) : ?><?php echo esc_html( $office_desc ); ?><br><?php endif; ?>
									<?php if ( $number ) : ?><?php echo esc_html( $number ); ?><?php endif; ?>
								</p>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

			<div class="contact-section__form reveal" data-d="1">
				<?php if ( $form_shortcode ) : ?>
					<?php echo do_shortcode( $form_shortcode ); ?>
				<?php else : ?>
					<h3>Send us a message</h3>
					<div class="frow">
						<div class="field"><label for="contact-cta-first-name">First Name *</label><input type="text" id="contact-cta-first-name" placeholder="Your first name"></div>
						<div class="field"><label for="contact-cta-last-name">Last Name *</label><input type="text" id="contact-cta-last-name" placeholder="Your last name"></div>
					</div>
					<div class="frow">
						<div class="field"><label for="contact-cta-email">Email *</label><input type="email" id="contact-cta-email" placeholder="your.email@company.com"></div>
						<div class="field"><label for="contact-cta-phone">Phone</label><input type="tel" id="contact-cta-phone" placeholder="+1 (555) 123-4567"></div>
					</div>
					<div class="frow">
						<div class="field"><label for="contact-cta-company">Company *</label><input type="text" id="contact-cta-company" placeholder="Your company name"></div>
						<div class="field"><label for="contact-cta-country">Country *</label>
							<select id="contact-cta-country" aria-label="Country">
								<option>Select your country</option>
								<option>United States</option>
								<option>India</option>
								<option>Canada</option>
								<option>United Kingdom</option>
							</select>
						</div>
					</div>
					<div class="field" style="margin-bottom:16px;">
						<label for="contact-cta-message">Message *</label>
						<textarea id="contact-cta-message" rows="3" placeholder="Tell us more about your needs and how we can help you…"></textarea>
					</div>
					<div class="consent">
						<input type="checkbox" id="cx">
						<label for="cx" style="font-weight:400;font-family:Inter;">I agree to receive communications from Elsner and understand that I can unsubscribe at any time. *</label>
					</div>
					<a class="btn primary" href="#">Submit
						<span class="circle">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none">
								<path d="M5 12h13M13 6l6 6-6 6" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</span>
					</a>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
