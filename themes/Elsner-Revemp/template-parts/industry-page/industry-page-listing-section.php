<?php
$title = get_field('industry_listing_title');
$subtitle = get_field('industry_listing_subtitle');
$selected_posts = get_field('industry_selected_items');
?>

<section class="industry-listing">
    <div class="industry-listing__container container">
        <div class="industry-listing__header">
            <?php if ($title): ?>
                <h2 class="industry-listing__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <?php if ($subtitle): ?>
                <div class="industry-listing__subtitle"><?php echo wp_kses_post($subtitle); ?></div>
            <?php endif; ?>
        </div>

        <?php if ($selected_posts): ?>
            <div class="industry-listing__grid">
                <div class="row">
           
                <?php foreach ($selected_posts as $post_id): 
                    $permalink = get_permalink($post_id);
                    $post_title = get_the_title($post_id);
                    $excerpt = get_the_excerpt($post_id);
                    $thumbnail = get_the_post_thumbnail_url($post_id, 'large');
                ?>
                 <div class="col-sm-12 col-md-6 col-lg-3 industry-listing-card-space">
                    <article class="industry-listing__card ">
                        <div class="industry-listing__image-wrapper">
                            <?php if ($thumbnail): ?>
                                <img src="<?php echo $thumbnail; ?>" alt="<?php echo $post_title; ?>" class="industry-listing__image">
                            <?php else: ?>
                                <div class="industry-listing__placeholder"></div>
                            <?php endif; ?>
                        </div>
                        <div class="industry-listing__content">
                            <h3 class="industry-listing__card-title"><?php echo $post_title; ?></h3>
                            <p class="industry-listing__card-excerpt">
                                <?php echo wp_trim_words($excerpt, 15); ?>
                            </p>
                            <a href="<?php echo $permalink; ?>" class="industry-listing__link">
                                Read More 
                                <span class="industry-listing__icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.5 9L7.5 6L4.5 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </article>
                 </div>
                <?php endforeach; ?>
       
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>