<?php

/**
 * Industry Page Testimonial Slider Component
 * 
 * ACF Field Required: 'industry_page_client_testimonial' (Relationship field)
 * This field should allow selection of 'client' post type
 * 
 * Dependencies: Slick Slider (loaded via CDN in this file)
 */

// Get the selected testimonials from ACF field
$selected_testimonials = get_field('industry_page_client_testimonial');
$client_title    = get_field('industry_page_client_title');
$client_subtitle = get_field('industry_page_client_subtitle');
$quote_image     = get_field('industry_page_client_testimonial_image');

// Fetch dynamic values from ACF
$cta_text = get_field('industry_page_client_testimonial_cta_text');
$cta_url  = get_field('industry_page_client_testimonial_cta_link');

// Fallback to static text if the field is empty
$display_text = $cta_text ? $cta_text : 'Discover More';
// Fallback to current permalink if the link field is empty
$display_url  = $cta_url ? $cta_url : get_permalink($post->ID);

// Only display if testimonials are selected
if ($selected_testimonials && is_array($selected_testimonials)) :
?>

    <section class="industry-page-testimonial">
        <div class="container">
            <div class="industry-page-testimonial__container">
                <!-- Header -->
                <div class="industry-page-testimonial__header">
                    <h2 class="industry-page-testimonial__title">
                        <?php echo esc_html($client_title); ?>
                    </h2>
                    <div class="industry-page-testimonial__subtitle test">
                        <?php echo wp_kses_post($client_subtitle); ?>
                    </div>
                </div>

                <!-- Main Slider Content -->
         
                    <div class="industry-page-testimonial__slider" id="testimonialMainSlider">
                        <?php
                        $slide_index = 0;
                        foreach ($selected_testimonials as $post) :
                            setup_postdata($post);

                            // Get custom fields
                            $client_name = get_the_title();
                            $client_post = get_field('client_post', $post->ID);
                            $rating = get_field('rating', $post->ID);
                            $description = get_field('description', $post->ID);
                            $testimonial_content = get_the_content(null, false, $post->ID);

                            // Default rating if not set
                            if (empty($rating)) {
                                $rating = 5;
                            }

                            // Get featured image for left section
                            $featured_image_id = get_post_thumbnail_id($post->ID);
                            $featured_image_url = wp_get_attachment_image_src($featured_image_id, 'thumbnail');
                            $featured_image_full = wp_get_attachment_image_src($featured_image_id, 'medium');
                        ?>

                            <div class="industry-page-testimonial__slide" data-slide-index="<?php echo $slide_index; ?>">
                                <div class="industry-page-testimonial__card">
                                    <!-- Left Section: Client Info, Rating & All Slider Images -->
                                    <div class="industry-page-testimonial__left">
                                        <div class="industry-page-testimonial__client-info">
                                            <h3 class="industry-page-testimonial__client-name"><?php echo esc_html($client_name); ?></h3>
                                            <?php if ($client_post) : ?>
                                                <p class="industry-page-testimonial__client-position">
                                                    <?php
                                                    $position = wp_strip_all_tags($client_post);
                                                    $words = explode(' ', $position);

                                                    if (count($words) > 3) {
                                                        $position = implode(' ', array_slice($words, 0, 3)) . '...';
                                                    }

                                                    echo esc_html($position);
                                                    ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="industry-page-testimonial__rating">
                                            <span class="industry-page-testimonial__rating-number"><?php echo esc_html($rating); ?></span>
                                            <div class="industry-page-testimonial__stars">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <?php if ($i <= $rating) : ?>
                                                        <span class="industry-page-testimonial__star industry-page-testimonial__star--filled">★</span>
                                                    <?php else : ?>
                                                        <span class="industry-page-testimonial__star">☆</span>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Center Section: Testimonial Content -->
                                    <div class="industry-page-testimonial__center">
                                        <div class="industry-page-testimonial__center-content">
                                            <div class="industry-page-testimonial__right">
                                                <?php if ($quote_image) : ?>
                                                    <div class="industry-page-testimonial__quote-image">
                                                        <img src="<?php echo esc_url($quote_image); ?>" alt="Quote">
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="industry-page-testimonial__text">
                                                <p>
                                                    <?php
                                                    $content_to_display = !empty($description) ? $description : $testimonial_content;

                                                    // Strip tags to count characters correctly
                                                    $plain_text = wp_strip_all_tags($content_to_display);

                                                    // Limit to 190 characters
                                                    $trimmed_text = mb_strimwidth($plain_text, 0, 200, '...');

                                                    echo esc_html($trimmed_text);
                                                    ?>
                                                </p>
                                            </div>

                                        </div>

                                        <!-- Move button and arrows here -->
                                        <div class="industry-page-testimonial__controls">
                                            <div class="discover-more-button">
                                                <a href="<?php echo esc_url($display_url); ?>" class="industry-page-testimonial__more-btn">
                                                    <?php echo esc_html($display_text); ?>
                                                </a>
                                            </div>
                                            
                                            <div class="industry-page-testimonial__arrows">
                                                <button class="industry-page-testimonial__arrow industry-page-testimonial__arrow--prev" id="testimonialPrev" aria-label="Previous testimonial">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M9.56982 5.92969L3.49982 11.9997L9.56982 18.0697" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M20.5 12H3.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>

                                                </button>
                                                <button class="industry-page-testimonial__arrow industry-page-testimonial__arrow--next" id="testimonialNext" aria-label="Next testimonial">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M14.4302 5.92969L20.5002 11.9997L14.4302 18.0697" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M3.5 12H20.33" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>

                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    

                                </div>
                            </div>

                        <?php
                            $slide_index++;
                        endforeach;
                        ?>
                    </div>
   

                <!-- Thumbnail Navigation Slider -->
                <div class="industry-page-testimonial__nav">
                    <div class="industry-page-testimonial__nav-slider" id="testimonialNavSlider">
                        <?php foreach ($selected_testimonials as $post) :
                            setup_postdata($post);

                            // Get custom fields
                            $client_name = get_the_title();
                            $client_post = get_field('client_post', $post->ID);

                            // Get featured image
                            $featured_image_id = get_post_thumbnail_id($post->ID);
                            $featured_image = wp_get_attachment_image_src($featured_image_id, 'thumbnail');

                            // Extract company name from client_post field or use client name
                            $company_name = $client_name;
                            if ($client_post) {
                                // Try to extract company name (text before comma if exists)
                                $parts = explode(',', $client_post);
                                if (count($parts) > 1) {
                                    $company_name = trim($parts[0]);
                                } else {
                                    $company_name = trim($client_post);
                                }
                            }
                        ?>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
    wp_reset_postdata();
endif;
?>