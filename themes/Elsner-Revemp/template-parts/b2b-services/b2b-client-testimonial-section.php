<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

?>
<section class="b2b-client-testimonial blue-section">
    <div class="container">
        <div class="row alinc">
            <div class="col-md-12 col-sm-12 col-lg-4">
                <div class="brew-content">
                    <h2><span>Clients Testimonials</span></h2>
                    <p>Hear it from our loyal customers around the globe</p>
                </div>
                <!-- <div class="b2b-slide-arrow">
                    <div class="arrow-block">
                        <span class="left"><i class="fa-solid fa-arrow-left-long"></i></span>
                        <span class="right"><i class="fa-solid fa-arrow-right-long"></i></span>
                    </div>
                </div> -->
            </div>
            <?php 
            $args = array(
                'post_type'      => 'testimonial',
                'orderby'        => 'DESC',
                'post_per_page'  =>  -1,
                'post__in' => array(40510, 40513, 40515, 40521, 24223, 40527, 40523, 40525, 40517, 40519),
            );
            $testimonials_query = new WP_Query($args); 
            ?>
            <?php if($testimonials_query->have_posts()):?>
                <div class="col-md-12 col-sm-12 col-lg-8">
                    <div class="b2b-client-testimonials-slider">
                        <?php while($testimonials_query-> have_posts()){
                            $testimonials_query -> the_post();
                            $rating = get_field('rating');
                            if (empty($rating)) {
                                $rating = 5;
                            }
                            $testimonial_content = get_the_content();
                            $testimonial_content = wp_trim_words( $testimonial_content, 20, '...' );
                            // echo '<pre>';
                            // print_r($rating);
                            // echo '</pre>';
                            ?>
                            <div>
                                <div class="user-slide">
                                    <div class="review-data-slide">
                                        <div class="description">
                                            <p><?php echo $testimonial_content; ?></p>
                                        </div>
                                        <p class="head_rate">
                                            <span class="rates">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <?php if ($i <= $rating) : ?>
                                                <i class="fa fa-star"></i>
                                                <?php else : ?>
                                                <i class="fa fa-star-o"></i>
                                                <?php endif; ?>
                                                <?php endfor; ?>
                                            </span> (<?php echo $rating; ?>)
                                        </p>
                                    </div>
                                    <div class="user-details-wrap">
                                        <div class="user-img">
                                            <?php
                                                $client_photo = get_field('client_photo');
                                                if ($client_photo) {
                                                    $thumbnail = $client_photo['sizes']['thumbnail'];
                                                    $medium = $client_photo['sizes']['medium']; // Get the medium size image URL
                                                    $large = $client_photo['sizes']['large']; // Get the large size image URL
                                                    if ($thumbnail) {
                                                        echo '<img src="' . $thumbnail . '" srcset="' . $medium . ' 600w, ' . $large . ' 1200w,' . $thumbnail . ' 300w " alt="' . $client_photo['alt'] . '">';
                                                    }
                                                }
                                                ?>
                                        </div>
                                        <div class="user-detail">
                                            <p class="name"><?php echo esc_html(get_the_title()); ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } 
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>