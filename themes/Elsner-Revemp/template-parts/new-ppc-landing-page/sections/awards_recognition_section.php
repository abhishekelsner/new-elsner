<?php
/**
 * Awards Recognition Section Template
 * ACF Layout: awards_recognition_section
 */

$section_title = get_sub_field("section_title");
$award_badges = get_sub_field("award_badges");
?>

<section class="ppc-new-awards-recognition-section">
    <div class="awards-recognition-container">
        <?php if ($section_title): ?>
            <h2 class="awards-recognition-title">
                <?php echo esc_html($section_title); ?>
            </h2>
        <?php endif; ?>

        <div class="awards-recognition-logos">
            <?php if ($award_badges): ?>
                <?php foreach ($award_badges as $badge): ?>
                    <div class="awards-recognition-item">
                        <img src="<?php echo esc_url($badge["url"]); ?>" 
                             alt="<?php echo esc_attr($badge["alt"]); ?>">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
