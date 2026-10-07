<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$banner_title = get_field('banner_title', $post_id);
$services_label_images = get_field('services_label_images', $post_id);
$services_label_images2 = get_field('services_label_images2', $post_id);
$service_image_id = get_field('service_image', $post_id);
$service_image = wp_get_attachment_image_src($service_image_id, 'full');
$service_costmonth = get_field('service_costmonth', $post_id);
$service_support = get_field('service_support', $post_id);
$offer_countdown_date_picker = get_field('offer_countdown_date_picker', $post_id);
$date_obj = DateTime::createFromFormat('d/m/Y h:i a', $offer_countdown_date_picker);
if ($date_obj) {
    $date_formatted = $date_obj->format("M j, Y H:i:s");
} else {
    $date_formatted = "Parsing failed";
} ?>
<section class="services-banner maintenance-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="services-heading">
                    <h1><?php echo $banner_title; ?></h1>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>

                    <div class="content-bottom">
                        <div class="price-wrapper">
                            <span class="price"><?php echo $service_costmonth; ?></span>
                            <span class="info-text"><?php echo $service_support; ?></span>
                        </div>
                        <!-- Display the countdown timer in an element -->
                        <?php if ($offer_countdown_date_picker) : ?>
                        <div id="offerCountdown" style="display: none;"><?php echo $date_formatted; ?></div>
                        <div class="countdown-timer">
                            <p id="countdowntimer"></p>
                        </div>
                        <?php endif; ?>
                        <a href="#ecommerce-package-plan-section" class="btn btn-secondary">Claim 5% Off Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="services-image">
                    <img src="<?php echo $service_image[0]?>" alt=" services-image" width="864" height="574"
                        loading="lazy">
                </div>
                <div class="service-label">
                    <img src="<?php echo $services_label_images;?>" alt="service labels" width="" height=""
                        loading="lazy">
                    <img src="<?php echo $services_label_images2;?>" alt="service labels" width="" height=""
                        loading="lazy">
                </div>
            </div>

        </div>
    </div>
    <div class="banner-counter">
        <div class="container">
            <ul class="service-achievement-slider slick-slider">
                <?php if (have_rows('service_achievement_repeater', 'option')) :
                    while (have_rows('service_achievement_repeater' , 'option')) : the_row();
                        $service_achievement_title = get_sub_field('service_achievement_title', 'option'); ?>
                <li class="slider-item"><?php echo $service_achievement_title; ?></li>

                <?php endwhile;
                endif; ?>
            </ul>
        </div>
    </div>
</section>