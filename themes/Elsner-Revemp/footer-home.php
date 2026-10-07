<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */
global $contact_form, $sales_phone_number, $sales_email_address, $skype_id, $partners, $address, $facebook, $instagram, $linekdin, $google, $twitter, $pinterest, $youtube, $github; ?>

<footer class="footer section section-padding" id="section8">
    <div class="inner-container">
        <div class="footer-wrapper">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="heading">
                        <h3><?php echo get_field('contact_label', 'option'); ?></h3>
                        <h2 class="subhead"><?php echo get_field('contact_description', 'option'); ?></i>
                        </h2>
                    </div>
                    <div class="footer-form">
                        <?php echo do_shortcode($contact_form); ?>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="footer-right-menu">
                        <div class="row">
                            <div class="mobile-order-2 col-lg-4 col-md-12">
                                <div class="footer-menu mobile-menu">
                                    <h3><?php echo esc_html('What We Do'); ?></h3>
                                    <?php wp_nav_menu(array('menu' => 865)); ?>
                                </div>
                            </div>
                            <div class="mobile-order-1 col-lg-4 col-md-12">
                                <div class="footer-menu mobile-menu">
                                    <h3><?php echo esc_html('About Elsner'); ?></h3>
                                    <?php wp_nav_menu(array('menu' => 589, 'menu_class' => 'about-menu',)); ?>
                                </div>
                            </div>
                            <div class="mobile-order-1 col-lg-4 col-md-12">
                                <div class="footer-menu mobile-menu">
                                    <h3><?php echo esc_html('Explore'); ?></h3>
                                    <?php wp_nav_menu(array('menu' => 2200, 'menu_class' => 'explore-menu',)); ?>
                                </div>
                            </div>
                            <div class="mobile-order-3 col-lg-4 col-md-12">
                                <div class="footer-menu mobile-menu">
                                    <h3><?php echo esc_html('Connect'); ?></h3>
                                    <ul>
                                        <li><a
                                                href="tel:<?php echo $sales_phone_number; ?>"><?php echo $sales_phone_number; ?></a>
                                        </li>
                                        <li><a
                                                href="mailto:<?php echo $sales_email_address; ?>"><?php echo $sales_email_address; ?></a>
                                        </li>
                                        <li><a href="skype:<?php echo $skype_id; ?>"><?php echo $skype_id; ?></a></li>
                                    </ul>
                                    <div class="social-links-menu">
                                        <ul>
                                            <li>
                                                <a target="_blank" href="<?php echo $facebook; ?>"
                                                    aria-label="Elsner Facebook"><i
                                                        class="fa-brands fa-facebook-f"></i></a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="<?php echo $instagram; ?>"
                                                    aria-label="Elsner instagram"><i
                                                        class="fa-brands fa-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="<?php echo $linekdin; ?>"
                                                    aria-label="Elsner linkedin"><i
                                                        class="fa-brands fa-linkedin-in"></i></a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="<?php echo $twitter; ?>"
                                                    aria-label="Elsner twitter"><i
                                                        class="fa-brands fa-x-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="<?php echo $youtube; ?>"
                                                    aria-label="Elsner youtube"><i
                                                        class="fa-brands fa-youtube"></i></a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="<?php echo $github; ?>"
                                                    aria-label="Elsner github"><i
                                                        class="fa-brands fa-github"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-order-4 col-sm-6 col-lg-4 col-md-12">
                                <div class="footer-menu">
                                    <h3>Address</h3>
                                    <div class="footer-address">
                                        <address>
                                            <strong><?php echo esc_html('Headquarter-India'); ?></strong><br>
                                            <?php echo $address; ?>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-order-4 col-sm-6 col-lg-4 col-md-12">
                                <div class="footer-menu">
                                    <h3>USA Addresses</h3>
                                    <div class="footer-address">
                                        <address>
                                            <?php echo get_field('usa_address', 'option'); ?>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-certificate">
                            <?php if (have_rows('certification_repeater', 'option')):
                                while (have_rows('certification_repeater', 'option')): the_row();
                                    $certification = get_sub_field('certification', 'option');
                                    $certification_url = get_sub_field('certification_url', 'option');
                                    $certificate_url = $certification_url ? $certification_url : '#'; ?>

                                    <a>
                                        <img src="<?= $certification ?>" alt="footer certificate" height="55" width="490"
                                            loading="lazy">
                                    </a>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-block">
                <p><?php echo str_replace('%CURRENT_YEAR%', current_time('Y'), get_field('copyright_text', 'option')); ?></p>
                <a href="<?php echo site_url('terms-and-conditions'); ?>" aria-label="Terms & Conidtions">Terms & Conidtions</a>
                <a href="<?php echo site_url('privacy-policy'); ?>" aria-label="Privacy Policy">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
// Make sure Bootstrap modal function is available
    if (typeof jQuery !== "undefined" && typeof jQuery.fn.modal === "function") {
            setTimeout(function () {
                console.log("INTERVAL");
                jQuery("#elsner-popup").modal("show");
            }, 18000);
        } else {
            console.warn("Bootstrap modal is not loaded properly.");
        }
    });
    
</script>

<style type="text/css">
    .business-animation {
        text-align: center;
    }
    .business-animation img {
        margin: 0 auto;
        max-width: 230px;
    }
</style>