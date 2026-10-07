<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$b2b_banner_title = get_field('b2b_banner_title', $post_id);
$b2b_banner_subheading = get_field('b2b_banner_subheading', $post_id);
$b2b_banner_form = get_field('b2b_banner_form', $post_id);
$b2b_banner_image = get_field('b2b_banner_image', $post_id);
$shopify_banner_cta = get_field('shopify_banner_cta', $post_id);
$shopify_growth_banner_class = is_page('shopify-growth-plan') ? 'growth-banner' : '';
 ?>
<section class="services-banner maintenance-banner <?=$shopify_growth_banner_class?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-5">
                <div class="services-heading">
                    <p><?= $b2b_banner_subheading;?></p>
                    <h1><?php echo $b2b_banner_title; ?></h1>
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                    <?php if(is_page('shopify-growth-plan')):?>
                        <a href="#b2b-contact-form" class="btn btn-primary"><?=$shopify_banner_cta?></a>
                        <?php endif; ?>
                    <div class="content-bottom">
                        <?php if($b2b_banner_form):?>
                        <div class="b2b-contact-form">
                            <?=$b2b_banner_form;?>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-7">
                <div class="services-image">
                    <img src="<?php echo $b2b_banner_image;?>" alt=" b2b-services-image" width="864" height="574"
                        loading="lazy">
                </div>
            </div>

        </div>
    </div>
    <div class="banner-counter b2b-counter">
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