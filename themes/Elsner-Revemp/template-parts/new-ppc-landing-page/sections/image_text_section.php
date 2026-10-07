<?php
/**
 * Image with Text Section Template
 * ACF Layout: image_text_section
 */

$headline = get_sub_field("headline");
$description = get_sub_field("description");
$image = get_sub_field("image");
?>

<section class="new-ppc-image-text-section">
    <div class="container ">
        <div class="new-ppc-image-text-wrapper">
            <div class="new-ppc-image-text-content-wrap">
                <?php if ($headline): ?>
                    <h2 class="new-ppc-image-text-title">
                        <?php echo $headline; ?>
                    </h2>
                <?php endif; ?>
                <?php if ($description): ?>
                    <?php echo $description; ?>
                <?php endif; ?>
            </div>
            <div class="new-ppc-image-text-images">
                <?php if ($image): ?>
                    <div class="new-ppc-image-text-image">
                        <img src="<?php echo esc_url($image["url"]); ?>" 
                            alt="<?php echo esc_attr($image["alt"]); ?>" 
                            class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

