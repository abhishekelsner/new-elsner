<?php
$logo_title    = get_field('jewellery_logo_title');
$logo_subtitle = get_field('jewellery_logo_subtitle');
$logos         = get_field('jewellery_logo_images');
?>

<section class="industry-jewelry-logo">
    <div class="industry-jewelry-logo__container container">
        <div class="industry-jewelry-logo__header">
            <?php if ($logo_title): ?>
                <h2 class="industry-jewelry-logo__title"><?php echo esc_html($logo_title); ?></h2>
            <?php endif; ?>
            <?php if ($logo_subtitle): ?>
                <div class="industry-jewelry-logo__subtitle"><?php echo wp_kses_post($logo_subtitle); ?></div>
            <?php endif; ?>
            </div>

        <?php if ($logos): ?>
            <div class="industry-jewelry-logo__grid">
                <?php foreach ($logos as $logo): ?>
                    <div class="industry-jewelry-logo__item">
                        <img src="<?php echo esc_url($logo['url']); ?>" 
                             alt="<?php echo esc_attr($logo['alt']); ?>" 
                             class="industry-jewelry-logo__img">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>