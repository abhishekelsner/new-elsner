<?php
$title = get_sub_field('heading');
$testimonials = get_sub_field('testimonials');
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
            <a href="https://www.elsner.com/clientele-and-testimonials/" class="btn primary">Read more stories <span class="circle"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
<path d="M13.8049 5.90732C13.8001 5.38855 13.5911 4.89256 13.2232 4.52683L8.99293 0.286741C8.80817 0.103085 8.55825 0 8.29775 0C8.03724 0 7.78732 0.103085 7.60257 0.286741C7.51015 0.378409 7.43679 0.487469 7.38673 0.60763C7.33667 0.727791 7.3109 0.856676 7.3109 0.986848C7.3109 1.11702 7.33667 1.2459 7.38673 1.36607C7.43679 1.48623 7.51015 1.59529 7.60257 1.68696L10.8467 4.92125H0.986066C0.724545 4.92125 0.473736 5.02514 0.288812 5.21007C0.103889 5.39499 0 5.6458 0 5.90732C0 6.16884 0.103889 6.41965 0.288812 6.60457C0.473736 6.7895 0.724545 6.89339 0.986066 6.89339H10.8467L7.60257 10.1375C7.41689 10.3219 7.31206 10.5725 7.31113 10.8342C7.31021 11.0958 7.41327 11.3471 7.59764 11.5328C7.78201 11.7185 8.0326 11.8233 8.29426 11.8243C8.55593 11.8252 8.80725 11.7221 8.99293 11.5378L13.2232 7.29767C13.5935 6.92952 13.8027 6.42952 13.8049 5.90732Z" fill="white"/>
</svg></span></a>
        </div>

        <?php endif; ?>
    </div>
</section>
