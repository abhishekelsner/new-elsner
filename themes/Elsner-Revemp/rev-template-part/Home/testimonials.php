<?php
$post_id = $args['post_id'];
$title = get_sub_field('title');
$testimonials = get_sub_field('testimonial');
?>
<section class="testimonials-section section section-padding blue-section">
    <div class="container">

        <?php if ($title) : ?>
            <div class="block-title text-center white">
               <h2><?php echo $title; ?></h2>
            </div>
        <?php endif; ?>

        <?php if ($testimonials) : 
            $testimonials_array = is_array($testimonials) ? $testimonials : array($testimonials);
        ?>
        <div class="testimonials-main-slider-wrapper">
            <div class="testimonials-image-wrapper">
                <div class="testimonials-image-slider">
                    <?php foreach ($testimonials_array as $testimonial) :
                        if (!is_object($testimonial) || !isset($testimonial->ID)) continue;
    
                        $testimonial_id = $testimonial->ID;
                        $client_name    = get_the_title($testimonial_id);
                        $client_photo   = get_field('client_photo', $testimonial_id);
                        $video_url      = get_field('video_url', $testimonial_id);
    
                        $photo_url = '';
                        if ($client_photo) {
                            $photo_url = is_array($client_photo) ? $client_photo['url'] : $client_photo;
                        }
                    ?>
                        <div class="testi-image-slide">
                            <div class="testimonial-left">
    
                                <?php if ($photo_url) : ?>
                                    <img src="<?php echo esc_url($photo_url); ?>"
                                        alt="<?php echo esc_attr($client_name); ?>"
                                        loading="lazy">
                                <?php endif; ?>
    
                                <?php if ($video_url) : ?>
                                    <a href="<?php echo esc_url($video_url); ?>"
                                    class="testimonial-play"
                                    data-fancybox="testimonial-video"
                                    data-type="iframe">
                                        <svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg>
                                    </a>
                                <?php else : ?>
                                    <div class="testimonial-play testimonial-play--no-video">
                                        <svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg>
                                    </div>
                                <?php endif; ?>
    
                            </div><!-- .testimonial-left -->
                        </div><!-- .testi-image-slide -->
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="testimonials-content-wrapper">
                <div class="testimonials-wrapper">
                    <?php foreach ($testimonials_array as $testimonial) : 
                        if (!is_object($testimonial) || !isset($testimonial->ID)) continue;

                        $testimonial_id      = $testimonial->ID;
                        $client_name         = get_the_title($testimonial_id);
                        $testimonial_content = get_post_field('post_content', $testimonial_id);
                        $client_position     = get_field('client_position', $testimonial_id);
                        $client_photo        = get_field('client_photo', $testimonial_id);
                        $client_logo_rating  = get_field('logo', $testimonial_id);
                        $client_post         = get_field('client_post', $testimonial_id);
                        $video_url         = get_field('video_url', $testimonial_id);
                        $rating              = get_field('rating', $testimonial_id);

                        $photo_url = '';
                        if ($client_photo) {
                            $photo_url = is_array($client_photo) ? $client_photo['url'] : $client_photo;
                        }
                    ?>
                        <div class="testimonial-item">
                            <div class="testimonial-card-new">
                                <div class="testimonial-right">
                                    <div class="testimonial-author">
                                        <?php if ($client_name) : ?>
                                            <h3><?php echo esc_html($client_name); ?></h3>
                                        <?php endif; ?>
                                        <?php if ($client_position || $client_post) : ?>
                                            <p>
                                                <?php echo esc_html($client_position); ?>
                                                <?php if ($client_post) echo ', ' . esc_html($client_post); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($testimonial_content) : ?>
                                        <div class="testimonial-content">
                                            <?php echo wp_kses_post(wpautop($testimonial_content)); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($rating) : ?>
                                        <div class="testimonial-rating">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <i class="fa fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($client_logo_rating) : ?>
                                        <div class="testimonial-logo">
                                            <img src="<?php echo esc_url($client_logo_rating); ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="testi-bottom-row">
            <div class="testi-dots-placeholder"></div>
            <a href="https://www.elsner.com/clientele-and-testimonials/" class="testi-read-more">Read more stories <span>›</span></a>
        </div>

        <?php endif; ?>
    </div>
</section>
