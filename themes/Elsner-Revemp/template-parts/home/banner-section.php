<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$banner_image   = get_field('banner_image', $post_id);
$banner_text    = get_field('banner_text', $post_id);
$banner_content = get_field('banner_content', $post_id);
$banner_background = get_field('banner_background', $post_id);
?>
<section class="banner-section section blue-section" id="section0"
    style="background: url(<?php echo $banner_background; ?>)">
    <!--<div class="landing-logo">
        <div class="move">
            <img class="lazy" id="image" src="<?php echo esc_url($banner_image); ?>" alt="splash"
                style="width: 100%; height:100%;" />
        </div>
    </div>-->
    <!-- start code for Easter Event  -->

    <!-- End code for Easter Event  -->

    <div class="banner-wrapper">
        <div class="container">
            <div class="row alinc">
                <div class="col-lg-6 col-sm-12">
                    <div class="banner-content white-text">
                        <h1><?php echo $banner_text; ?></h1>
                        <p><?php echo esc_html($banner_content); ?></p>
                        <div class="banner-btn">
                            <a href="<?php echo esc_url(get_field('get_quote_link')); ?>"
                                class="btn btn-primary"><?php echo esc_html('GET QUOTE'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="banner-logos">
                        <ul>
                            <?php
                            if (have_rows('banner_logos')) :
                                while (have_rows('banner_logos')) : the_row();
                                    $file_url = get_sub_field('images');
                                    $file_extension = pathinfo($file_url, PATHINFO_EXTENSION);
                                    if ($file_extension === 'lottie') { ?>
                            <li>
                                <div class="img-bannerright">
                                    <dotlottie-player src="<?php echo $file_url; ?>" background="transparent" speed="1"
                                        loop autoplay></dotlottie-player>
                                </div>
                            </li>
                            <?php
                                    } else { ?>

                            <li>
                                <div class="img-bannerright">
                                    <img class="lazy" src="<?php echo $file_url; ?>" alt="banner icon" height="55"
                                        width="70" loading="lazy">
                                </div>
                            </li>
                            <?php
                                    }
                                endwhile;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="ratings white-text">
            <div class="container">
                <div class="slider slick-slider rating-slider">
                    <?php if (have_rows('rating')) : ?>
                    <?php while (have_rows('rating')) : the_row(); ?>
                    <?php
                            $rating = get_sub_field('star_rating', $post_id);
                            $plaform = get_sub_field('platform', $post_id);
                            $full_stars = floor($rating);
                            $half_star = ($rating - $full_stars) >= 0.5;
                            ?>
                    <div class="slides">
                        <p class="rate_head">
                            <span class="rates">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <?php if ($i <= $full_stars) : ?>
                                <i class="fas fa-star"></i>
                                <?php elseif ($i == $full_stars + 1 && $half_star) : ?>
                                <i class="fas fa-star-half-alt"></i>
                                <?php else : ?>
                                <i class="far fa-star"></i>
                                <?php endif; ?>
                                <?php endfor; ?>
                            </span>
                            (<?php echo $rating; ?>) <?php echo $plaform; ?>
                        </p>
                        <p class="desc"><?php the_sub_field('description'); ?></p>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>