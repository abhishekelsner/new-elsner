<?php
/**
 * Template part for displaying clients section in News Room
 *
 * @package YourTheme
 */

$post_id = isset($args['post_id']) ? $args['post_id'] : get_the_ID();

// Get ACF fields
$section_title = get_field('news_room_our_clients_title', $post_id);
$client_logos = get_field('news_room_our_clients_images', $post_id); // Gallery field

// Default title if ACF field is empty
$section_title = $section_title ?: 'Our Clients';
?>

<section class="news-room-clients">
    <div class="news-room-clients__container">
        
        <!-- Section Title -->
        <h2 class="news-room-clients__title"><?php echo esc_html($section_title); ?></h2>
        
        <!-- Client Logos Grid -->
        <?php if ($client_logos): ?>
            <div class="news-room-clients__grid">
                <?php foreach ($client_logos as $logo): ?>
                    <?php 
                    // Handle both repeater (with sub-field) and gallery format
                    $logo_data = is_array($logo) && isset($logo['client_logo']) ? $logo['client_logo'] : $logo;
                    
                    if ($logo_data): 
                        $logo_url = is_array($logo_data) ? $logo_data['url'] : $logo_data;
                        $logo_alt = is_array($logo_data) && isset($logo_data['alt']) ? $logo_data['alt'] : 'Client logo';
                    ?>
                        <div class="news-room-clients__item">
                            <div class="news-room-clients__logo-wrapper">
                                <img src="<?php echo esc_url($logo_url); ?>" 
                                     alt="<?php echo esc_attr($logo_alt); ?>"
                                     loading="lazy">
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
    </div>
</section>