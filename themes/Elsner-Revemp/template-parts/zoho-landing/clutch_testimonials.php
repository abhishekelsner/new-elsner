<?php 
if( 1==1 || isset($_GET['test']) ){ ?>
    <div class="new-services-clutch-wrapper">
    <h2 class="new-services-clutch-title">What Our Clients Says on Clutch</h1>
        <div class="container">
            <div class="new-services-clutch-slider">
                <?php
                $args = array(
                    'post_type'      => 'clutch_review',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                ?>
                        <div class="new-services-clutch-review-box">
                            <div class="new-services-clutch-review-box-wrapper">               
                                <!-- Featured Image -->
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="new-services-clutch-review-image">
                                        <?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded-circle']); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="new-services-clutch-review-title">
                                    <div class="new-services-clutch-review-title-wrapper">
                                        <h3 class="new-services-reviewer-name"><?php echo get_field('the_reviewer'); ?></h3>
                                        <p class="new-services-reviewer-position"><?php echo get_field('reviewer_position'); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Details -->
                            <div class="new-services-clutch-review-content">
                                <div class="new-services-clutch-review-wrapper">
                                    <!-- <h3 class="new-services-reviewer-name"><?php echo get_field('the_reviewer'); ?></h3>
                                    <p class="new-services-reviewer-position"><?php echo get_field('reviewer_position'); ?></p> -->
                                    <p class="new-services-review-rating">
                                        <strong>Rating: <?php echo number_format((float)get_field('rating'),1); ?></strong>
                                        <span class="star-<?php echo (float)get_field('rating'); ?>"><img src="<?php echo site_url().'/wp-content/themes/Elsner-Revemp/assets/images/star-images/star-'.(float)get_field('rating'); ?>.png" /></span>
                                    </p>
                                    <div class="new-services-review-text">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                                <div class="slider-img-wrapper">
                                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2025/04/Powered-by-Clutch.svg" />
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo "<p class='text-center'>No reviews found.</p>";
                endif;
                ?>
            </div>
        </div>
</div>
<?php } ?>