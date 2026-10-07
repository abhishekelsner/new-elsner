<?php
/* Template Name: Contact us */
get_header();
global $contact_form, $sales_email_address, $address, $usa_address, $facebook, $instagram, $linekdin, $google, $twitter, $pinterest, $youtube, $github;
?>

<section class="contact-us-section padding-80 blue-section">
    <div class="container">
        <div class="contact-heading heading-wrapper white-text">
            <h2>Get in touch <span>with us</span></h2>
            <div class="head-contact">
                <p><?php
                    if (have_rows('contact_banner_section')) :
                        while (have_rows('contact_banner_section')) : the_row();
                            echo the_sub_field('contact_banner_content');
                    ?></p>
            </div>
        </div>
        <div class="contactus-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-us-form">
                        <?php echo do_shortcode($contact_form); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form-address">
                        <div class="contact-address-block">
                            <h5>HEAD OFFICE</h5>
                            <address><?php echo $address; ?></address>
                        </div>
                        <div class="contact-address-block">
                            <h5>USA ADDRESS</h5>
                            <?php echo $usa_address; ?>
                        </div>
                        <div class="contact-address-block">
                            <h5>EMAIL ADDRESS</h5>
                            <p>
                                <a
                                    href="mailto:<?php echo $sales_email_address; ?>"><?php echo $sales_email_address; ?></a>
                                <a href="mailto:career@elsner.com">career@elsner.com</a>
                            </p>
                        </div>
                        <div class="contact-address-block">
                            <h5>CONTACT</h5>
                            <?php if (have_rows('contact_details')) : ?>
                            <?php while (have_rows('contact_details')) : the_row(); ?>
                            <p>
                                <a
                                    href="tel:<?php echo the_sub_field('phone'); ?>"><?php echo the_sub_field('phone'); ?></a>
                            </p>
                            <?php endwhile;
                            endif; ?>
                        </div>
                        <div class="contact-address-block">
                            <h5>Connect</h5>
                            <div class="social-links-menu contact-social">
                                <ul>
                                    <li>
                                        <a target="_blank" href="<?php echo $facebook; ?>"
                                            aria-label="Elsner Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo $instagram; ?>"
                                            aria-label="Elsner instagram"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo $linekdin; ?>"
                                            aria-label="Elsner linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo $twitter; ?>" aria-label="Elsner twitter"><i
                                                class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo $youtube; ?>" aria-label="Elsner youtube"><i
                                                class="fa-brands fa-youtube"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo $github; ?>" aria-label="Elsner github"><i
                                                class="fa-brands fa-github"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="map-location">
        <div class="map-img">
            <img src="<?php the_sub_field('contact_banner_image'); ?>" alt="contact map" width="1920" height="100%"
                loading="lazy">
        </div>
        <div class="container">
            <div class="map-address-block">
                <div class="heading-wrapper white-text">
                    <h2><?php echo get_field('worldwild_location', get_the_ID()); ?></h2>
                </div>
                <div class="row">
                    <?php if (have_rows('worldwild_location_repeat')) : ?>
                    <?php while (have_rows('worldwild_location_repeat')) : the_row(); ?>
                    <div class="map col-lg-3 col-md-6 col-sm-6">
                        <div class="map-address">
                            <div class="country-flags">
                                <img src="<?php the_sub_field('country_image'); ?>" defer="" alt="country image"
                                    height="40" width="68" loading="lazy">
                            </div>
                            <h6><?php the_sub_field('country_title'); ?></h6>
                            <?php if (have_rows('country_address_section')) : ?>
                            <?php while (have_rows('country_address_section')) : the_row(); ?>
                            <div class="map-address-info">
                                <address><?php the_sub_field('country_address'); ?></address>
                                <?php
                                                if (get_sub_field('country_phone')) : ?>
                                <a
                                    href="tel:<?php the_sub_field('country_phone'); ?>"><?php the_sub_field('country_phone'); ?></a>
                                <?php endif; ?>
                            </div>
                            <?php endwhile;
                                    endif; ?>
                        </div>
                    </div>
                    <?php endwhile;
                            endif; ?>

                </div>
            </div>
            <div class="contact-copyright">
                <p><?php echo str_replace('%CURRENT_YEAR%', current_time('Y'), get_field('copyright_text', 'option')); ?>
                </p>
            </div>
        </div>
    </div>
    <?php endwhile;
                    endif;
?>
</section><?php get_footer(); ?>