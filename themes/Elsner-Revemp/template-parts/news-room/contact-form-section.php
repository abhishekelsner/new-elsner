<?php
/**
 * Template part for displaying contact form section in News Room
 *
 */

$post_id = isset($args['post_id']) ? $args['post_id'] : get_the_ID();

// Get ACF fields
$banner_image = get_field('news_room_contact_form_image', $post_id);
$banner_title = get_field('news_room_contact_form_title', $post_id);
$banner_content = get_field('news_room_contact_form_content', $post_id);

// Default values if ACF fields are empty
$banner_title = $banner_title ?: 'Technology Moves Fast, So Do We';
$banner_content = $banner_content ?: 'Subscribe To Our Newsletter And Get Insights From The Industry\'s Most Relevant Topics.';
?>

<section class="news-room-contact">
    <div class="news-room-contact__container">
        <div class="news-room-contact__wrapper">
            
            <!-- Left Content Area -->
            <div class="news-room-contact__content">
                <h2 class="news-room-contact__title"><?php echo esc_html($banner_title); ?></h2>
                <p class="news-room-contact__text"><?php echo esc_html($banner_content); ?></p>
                
                <!-- Contact Form 7 -->
                <div class="news-room-contact__form">
                    <?php echo do_shortcode('[contact-form-7 id="56071" title="News Room"]'); ?>
                </div>
            </div>
            
            <!-- Right Image Area -->
            <div class="news-room-contact__image">
                <?php if ($banner_image): ?>
                    <img src="<?php echo esc_url($banner_image['url']); ?>" 
                         alt="<?php echo esc_attr($banner_image['alt'] ?: 'Contact illustration'); ?>">
                <?php else: ?>
                    <!-- Fallback SVG illustration if no image is uploaded -->
                    <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                        <!-- Background blob -->
                        <path d="M 150 50 Q 250 30 300 100 Q 320 180 250 220 Q 180 240 120 200 Q 80 150 150 50 Z" 
                              fill="#E8EEFF" opacity="0.6"/>
                        
                        <!-- Phone device -->
                        <rect x="150" y="80" width="100" height="180" rx="15" fill="#1E3A5F"/>
                        <rect x="160" y="95" width="80" height="140" rx="5" fill="#FFFFFF"/>
                        
                        <!-- Avatar in phone -->
                        <circle cx="200" cy="135" r="20" fill="#C5D0E6"/>
                        <ellipse cx="200" cy="155" rx="15" ry="8" fill="#C5D0E6"/>
                        <rect x="185" y="140" width="30" height="20" fill="#B4C5E4"/>
                        
                        <!-- Floating icons -->
                        <!-- Email icon -->
                        <g transform="translate(100, 120)">
                            <circle r="18" fill="#B4C5E4"/>
                            <rect x="-8" y="-5" width="16" height="10" rx="2" fill="#1E3A5F"/>
                            <path d="M -8 -5 L 0 2 L 8 -5" stroke="#B4C5E4" stroke-width="1.5" fill="none"/>
                        </g>
                        
                        <!-- Phone icon -->
                        <g transform="translate(280, 150)">
                            <circle r="18" fill="#B4C5E4"/>
                            <path d="M -5 -6 Q -7 -4 -7 0 Q -7 4 -3 7 L 3 7 Q 7 7 7 3 Q 7 -1 5 -3 L 3 -5 Q 1 -7 -2 -6 Z" 
                                  fill="#1E3A5F"/>
                        </g>
                        
                        <!-- Location pin icon -->
                        <g transform="translate(290, 90)">
                            <circle r="18" fill="#B4C5E4"/>
                            <path d="M 0 -6 Q -4 -6 -4 -2 Q -4 2 0 8 Q 4 2 4 -2 Q 4 -6 0 -6 Z M 0 -3 Q 1.5 -3 1.5 -1.5 Q 1.5 0 0 0 Q -1.5 0 -1.5 -1.5 Q -1.5 -3 0 -3 Z" 
                                  fill="#1E3A5F"/>
                        </g>
                        
                        <!-- Chat bubble icon -->
                        <g transform="translate(120, 200)">
                            <circle r="18" fill="#B4C5E4"/>
                            <rect x="-6" y="-5" width="12" height="10" rx="2" fill="#1E3A5F"/>
                            <path d="M -2 5 L 0 8 L 2 5" fill="#1E3A5F"/>
                        </g>
                        
                        <!-- Dashed connecting lines -->
                        <path d="M 118 120 Q 140 110 150 120" stroke="#1E3A5F" stroke-width="1.5" 
                              stroke-dasharray="4,4" fill="none" opacity="0.4"/>
                        <path d="M 262 150 Q 255 140 250 135" stroke="#1E3A5F" stroke-width="1.5" 
                              stroke-dasharray="4,4" fill="none" opacity="0.4"/>
                        <path d="M 272 90 Q 260 85 250 90" stroke="#1E3A5F" stroke-width="1.5" 
                              stroke-dasharray="4,4" fill="none" opacity="0.4"/>
                        <path d="M 138 200 Q 145 190 150 180" stroke="#1E3A5F" stroke-width="1.5" 
                              stroke-dasharray="4,4" fill="none" opacity="0.4"/>
                    </svg>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</section>