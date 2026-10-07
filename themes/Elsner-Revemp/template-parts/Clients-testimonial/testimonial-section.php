<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$heading = get_field('heading', $post_id);
$heading_client = get_field('heading_1', $post_id);
$heading_testimonaial_tab = get_field('heading_2', $post_id);
$heading_clutch_tab = get_field('heading_3', $post_id);

$tab_name1 = get_field('tab_name_1', $post_id);

$tab_name = get_field('tab_name', $post_id);
$quote_image = get_field('quote_image', $post_id);

$tab_name2 = get_field('tab_name_2', $post_id);
$quote_image_2 = get_field('quote_image_2', $post_id);

$tab_name3 = get_field('tab_name_3', $post_id);
$quote_image_3 = get_field('quote_image_3', $post_id);
?>


<section class="elsner-life-events client-testimonial-seciton">
    <div class="container testimonial">
        <div class="filter-list">
            <h5 class="Redhat-font white-text"><?php echo $heading; ?></h5>
            <ul class="category-filter white-filter nav nav-tabs">
                <li>
                    <a data-toggle="tab" href="#<?php echo $tab_name1; ?>" data-name="<?php echo $heading_client; ?>"
                        class="filter-btn active"><?php echo $tab_name1; ?></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#<?php echo $tab_name; ?>" data-name="<?php echo $heading; ?>"
                        class="filter-btn"><?php echo $tab_name; ?></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#<?php echo $tab_name2; ?>"
                        data-name="<?php echo $heading_testimonaial_tab; ?>"
                        class="filter-btn"><?php echo $tab_name2; ?></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#<?php echo $tab_name3; ?>"
                        data-name="<?php echo $heading_clutch_tab; ?>" class="filter-btn"><?php echo $tab_name3; ?></a>
                </li>
                
            </ul>
            <div class="tab-content testimon_tab">

                <div class="tab-pane container fade" id="<?php echo $tab_name; ?>">
                    <div class="quote-img">
                        <img alt="tech img" loading="lazy" src="<?php echo $quote_image; ?>" width="400" height="300"
                            class="quote-img">
                    </div>
                    <div class="client-testimonial grid-container2">
                        <div class="grid-sizer"></div>
                        <?php
                        $testimonials_query = array(
                            'post_type' => 'testimonial',
                            'posts_per_page' => 6,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        );
                        $all_posts = new WP_Query($testimonials_query);
                        if ($all_posts->have_posts()) {
                            while ($all_posts->have_posts()) {
                                $all_posts->the_post();

                        ?>
                        <div class="testimonial-box grid-item">
                            <div class="video">
                                <?php echo get_field('video_url', get_the_ID()); ?>
                            </div>
                            <p><?php the_content(); ?></p>
                            <div class="author-data">
                                <?php
                                        $client_photo = get_field('client_photo', get_the_ID());
                                        if ($client_photo && is_array($client_photo)) {
                                            $thumbnail = wp_get_attachment_image($client_photo['ID'], 'thumbnail');
                                            if ($thumbnail) {
                                                echo $thumbnail;
                                            } else {
                                                echo '<img src="' . esc_url($client_photo['url']) . '" alt="Client Photo">';
                                            }
                                        }

                                        ?>
                                <div class="author-name">
                                    <h6><?php the_title(); ?></h6>
                                    <p><?php echo get_field('client_position', get_the_ID()); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                            echo '<div class="not_found">No Testimonials found.</div>';
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="view-all text-center">
                        <a href="#" class="btn-secondary btn load_testimonials">Load More</a>
                    </div>
                </div>

                <div class="tab-pane container fade" id="<?php echo $tab_name2; ?>">
                    <div class="quote-img">
                        <img alt="tech img" loading="lazy" src="<?php echo $quote_image_2; ?>" width="300" height="300"
                            class="google-quote-img">
                    </div>
                    <div class="clutch-review">
                        <?php
                        $clutch_query = array(
                            'post_type' => 'clutch_review',
                            'posts_per_page' => 10,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        );
                        $all_clutches = new WP_Query($clutch_query);
                        if ($all_clutches->have_posts()) {
                            while ($all_clutches->have_posts()) {
                                $all_clutches->the_post();
                                $rating = get_field('rating', get_the_ID());
                        ?>
                        <div class="testimonial-box">
                            <p><?php the_content(); ?></p>
                            <h6 class="Redhat-font">(<?php echo $rating; ?>.0)
                                <span class="rates">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <?php if ($i <= $rating) : ?>
                                    <i class="fa fa-star"></i>
                                    <?php else : ?>
                                    <i class="fa fa-star-o"></i>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                </span>
                            </h6>
                            <div class="clutch-user">
                                <div class="author-data">
                                    <?php add_image_size('custom_size_products', 70, 70, true);
                                            the_post_thumbnail('custom_size_products'); ?>
                                    <div class="author-name">
                                        <h6><?php echo get_field('the_reviewer', get_the_ID()); ?></h6>
                                        <p><?php echo get_field('reviewer_position', get_the_ID()); ?></p>
                                    </div>
                                </div>
                                <img alt="tech img" loading="lazy"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/clutch.svg"
                                    width="190" height="32">
                            </div>
                        </div>

                        <?php
                            }
                        } else {
                            echo '<div class="not_found">No clutch review found.</div>';
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="view-all text-center review-btn">
                        <a href="#" class="btn-secondary btn load_clutch_reviews">Load More</a>
                        <a href="https://clutch.co/profile/elsner-technologies#reviews"
                            class="btn-secondary btn explore_clutch" target="_blank">Explore on clutch</a>
                    </div>
                </div>
                <div class="tab-pane container fade" id="<?php echo $tab_name3; ?>">
                    <div class="quote-img">
                        <img alt="tech img" loading="lazy" src="<?php echo $quote_image_3; ?>" width="300" height="300"
                            class="google-quote-img">
                    </div>
                    <div class="client-testimonial">
                        <?php
                        $google_review_query = array(
                            'post_type' => 'google_reveiws',
                            'posts_per_page' => -1,
                            'orderby' => 'date',
                            'order' => 'ASC',
                        );
                        $all_clutches = new WP_Query($google_review_query);
                        if ($all_clutches->have_posts()) {
                            while ($all_clutches->have_posts()) {
                                $all_clutches->the_post();
                                $rating = get_field('rating', get_the_ID());
                        ?>

                        <div class="testimonial-box">
                            <p><?php the_content(); ?></p>
                            <div class="rating">
                                <span class="rates">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <?php if ($i <= $rating) : ?>
                                    <i class="fa fa-star"></i>
                                    <?php else : ?>
                                    <i class="fa fa-star-o"></i>
                                    <?php endif; ?>
                                    <?php endfor; ?>
                                </span>
                            </div>

                            <div class="clutch-user">
                                <div class="author-data">
                                    <img alt="tech img" loading="lazy" src="<?php echo the_post_thumbnail_url(); ?> "
                                        width="70" height="70">
                                    <div class="author-name">
                                        <h6><?php the_title(); ?></h6>
                                    </div>
                                </div>
                                <img alt="tech img" loading="lazy"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/google.svg"
                                    width="50" height="16">
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                            echo '<div class="not_found">No clutch review found.</div>';
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="view-all text-center review-btn">
                        <a href="https://www.google.com/maps?cid=16054429177291001512" class="btn-secondary btn"
                            target="_blank">SEE ALL REVIEWS</a>
                        <a class="btn-secondary btn btn-outline wright_review">WRITE A REVIEW</a>
                    </div>
                </div>
                <div class="tab-pane container active" id="<?php echo $tab_name1; ?>">
                    <div class="col-lg-12 col-md-12">
                        <div class="brands container">
                            <ul class="client-list">
                                <?php if (have_rows('client_repeater')) : ?>
                                <?php while (have_rows('client_repeater')) : the_row(); ?>
                                <li>
                                <?php $image_id = get_sub_field('clients_logo'); ?>
                                <img class="lazy" src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>" 
                                    alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                                    title = "<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                                    style="width: 100%; height: 100%;" loading="lazy">
                                    <!-- <img class="lazy" src="<?php //the_sub_field('clients_logo'); ?>"  -->
                                        <!-- style="width: 100%; height: 100%;" loading="lazy"> -->
                                </li>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>