<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$cta_title = get_sub_field('cta_title');
$description = get_sub_field('description');
$button = get_sub_field('button');
$button_url = get_sub_field('button_url');
$background_color = get_sub_field('background_color');
?>
<section class="cta-banner-section section section-padding" >
    <div class="container">
        <div class="cta-banner-wrapper ">
            <?php if ($cta_title) : ?>
                <h2 class="cta-title white-text"><?php echo esc_html($cta_title); ?></h2>
            <?php endif; ?>
            <div class="cta-btn-wrapper">
                <?php if ($description) : ?>
                    <p class="cta-description white-text"><?php echo esc_html($description); ?></p>
                <?php endif; ?>
                <?php if ($button && $button_url) : ?>
                    <div class="cta-button">
                        <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary">
                            <?php echo esc_html($button); ?>
                            <img 
                                src="https://www.elsner.com/wp-content/uploads/2026/05/Group-1667.png"
                                alt=""
                                class="cta-icon"
                                loading="lazy"
                            >
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

