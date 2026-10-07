 <?php  
$image       = get_sub_field('image'); // field_68a5a57059a53
$title       = get_sub_field('title'); // field_cta_title
$description = get_sub_field('description'); // field_68a5a57959a54
$button      = get_sub_field('button'); // field_cta_btn
?>

<section class="cta-section our-portfolio-cta-section">
    <div class="container">
            <div class="cta-block">
                <div class="cta-block-wrapper">
                    <div class="cta-block-image">
                    <?php if( $image ): ?>
                        <div class="cta-image">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                    <?php endif; ?>
                    </div>
                    <div class="cta-block-content">
                    <div class="cta-block-content-wrapper">
                        <?php if( $title ): ?>
                            <h3 class="cta-title"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if( $description ): ?>
                            <p class="cta-description"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="cta-block-btn">
                        <?php if( $button ): ?>
                            <a class="cta-btn btn btn-secondary" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
                                <?php echo esc_html($button['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
            </div>
    </div>
</section>