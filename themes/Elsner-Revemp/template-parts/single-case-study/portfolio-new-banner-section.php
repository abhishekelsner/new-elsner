<?php
global $contact_us_link;
$post_id                 = $args['post_id'];
// Store ACF fields in variables
$home_hero_title = get_field('home_hero_title');
$home_hero_second_title = get_field('home_hero_second_title');
$home_hero_description = get_field('home_hero_description');
$home_hero_mobile_banner_image = get_field('home_hero_mobile_banner_image');
$home_hero_second_description = get_field('home_hero_second_description');
$home_hero_description_list = get_field('home_hero_description_list');
$home_hero_banner_image = get_field('home_hero_banner_image');

?>


<section class="case-study-analysis-section">
    <div class="container">
        <div class="analysis-case-study-elsner-banner d-flex">

            <div class="case-study-analysis-banner">
                <div class="bread-crumps-analysis breadcrumb-wrapper">
                    <?php custom_breadcrumbs(); ?>
                </div>
                <div class="revol-case-main-label-text">
                    <?php if ($home_hero_title || $home_hero_second_title): ?>
                        <h1><?php echo $home_hero_title; ?><span> <?php echo $home_hero_second_title; ?></span></h1>
                    <?php endif; ?>
                </div>
                <div class="case-study-description-text">
                    <?php if ($home_hero_description || $home_hero_second_description || $home_hero_mobile_banner_image): ?>
                        <p><span><?php echo $home_hero_description; ?></span></p>
                        <div class="case-study-image-banner-mobile">
                            <?php if ($home_hero_mobile_banner_image): ?>
                                <img src="<?php echo $home_hero_mobile_banner_image['url']; ?>" alt="<?php echo esc_attr($home_hero_mobile_banner_image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                        <p><?php echo $home_hero_second_description; ?></p>
                    <?php endif; ?>
                </div>
                <?php if ($home_hero_description_list): ?>
                    <?php echo $home_hero_description_list; ?>
                <?php endif; ?>
            </div>
            <div class="case-study-analysis-banner">
                <span></span>
                <div class="case-study-image-banner">
                    <?php if ($home_hero_banner_image): ?>
                        <img src="<?php echo $home_hero_banner_image['url']; ?>" alt="<?php echo esc_attr($home_hero_mobile_banner_image['alt']); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>