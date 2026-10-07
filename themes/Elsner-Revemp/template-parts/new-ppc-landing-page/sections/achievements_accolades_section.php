<?php

/**
 * Achievements Section Template
 * ACF Layout: achievements_accolades_section
 */

$section_title = get_sub_field("section_title");
$metrics = get_sub_field("metrics");
?>

<section class="ppc-new-achievement-section py-20">
    <div class="new-ppc-landing-achievement-bg-image-banner">
        <img src="https://www.elsner.com/wp-content/uploads/2025/07/Group_32_1752843206518_1752844322468-2.jpg" alt="banner-img" width="100%" height="auto">
    </div>
    <div class="container mx-auto px-4 text-center">
        <?php if ($section_title): ?>
            <h2 class="ppc-new-achievement-title">
                <?php echo esc_html($section_title); ?>
            </h2>
        <?php endif; ?>

        <div class="achievement-items flex flex-wrap justify-center text-center">
            <?php if ($metrics): ?>
                <?php foreach ($metrics as $index => $metric): ?>
                    <div class="achievement-item">
                        <div class="achievement-number"><?php echo esc_html($metric["number"]); ?></div>
                        <div class="achievement-text"><?php echo esc_html($metric["description"]); ?></div>
                    </div>
                    <?php if ($index !== array_key_last($metrics)): ?>
                        <div class="achievement-divider"></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
