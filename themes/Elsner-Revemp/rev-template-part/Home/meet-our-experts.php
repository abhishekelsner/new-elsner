<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$title = get_sub_field('title');
// $events = get_sub_field('event');
?>
<section class="meet-our-team-section section section-padding event-slider-section">
    <div class="container meet-our-team-wrapper-block-box">
        <?php if ($title) : ?>
            <div class="block-title text-center">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
        <?php endif; ?>
        <?php if ( have_rows('event_cards') ) : ?>
<div class="row">


    <?php while ( have_rows('event_cards') ) : the_row(); 
        $image       = get_sub_field('card_image');
        $expert_name       = get_sub_field('expert_name');
        $date        = get_sub_field('event_date');
        $location    = get_sub_field('event_location');
        $event_name        = get_sub_field('event_name');
        $description = get_sub_field('event_description');
        $btn_text    = get_sub_field('button_text');
        $btn_link    = get_sub_field('button_link');
    ?>
        <div class=" col-lg-4 col-md-6 col-sm-6">

        <?php if ( $btn_link ) : ?>
        <a href="<?php echo esc_url($btn_link['url']); ?>" 
        target="<?php echo esc_attr($btn_link['target']); ?>" 
        class="event-card-link">
        <?php endif; ?>
            <div class="event-card">

                <?php if ( $image ) : ?>
                    <div class="event-img">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    </div>
                <?php endif; ?>
                    
                <div class="event-content">
                    <ul class="event-meta">
                        <?php if ( $event_name ) : ?>
                            <li>
                                <img 
                                src="https://www.elsner.com/wp-content/uploads/2026/05/event_1770197679243-1.png"
                                alt=""
                                class="cta-icon"
                                loading="lazy"
                            >
                                <?php echo esc_html($event_name); ?>
                            </li>
                        <?php endif; ?>
                         <?php if ( $location ) : ?>
                            <li>
                                  <img 
                                src="https://www.elsner.com/wp-content/uploads/2026/05/image-27.svg"
                                alt=""
                                class="cta-icon"
                                loading="lazy"
                            >
                                <?php echo esc_html($location); ?>
                            </li>
                        <?php endif; ?>
                         <?php if ( $expert_name ) : ?>
                            <li>
                                <img 
                                src="https://www.elsner.com/wp-content/uploads/2026/05/expert_1770197679243-1.png"
                                alt=""
                                class="cta-icon"
                                loading="lazy"
                            >
                                <?php echo $expert_name; ?>
                            </li>
                        <?php endif; ?>
                        <?php if ( $date ) : ?>
                            <li>
                                <img 
                                src="https://www.elsner.com/wp-content/uploads/2026/05/image-26.svg"
                                alt=""
                                class="cta-icon"
                                loading="lazy"
                            >
                                <?php echo esc_html($date); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
        
                    <?php if ( $description ) : ?>
                        <p><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php if ( $btn_link ) : ?>
        </a>
        <?php endif; ?>
        </div>
    
    <?php endwhile; ?>
</div>

<?php endif; ?>

    </div>
</section>

