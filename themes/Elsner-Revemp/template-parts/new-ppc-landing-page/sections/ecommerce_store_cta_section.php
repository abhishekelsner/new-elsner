<?php

/**
 * Ecommerce Store CTA Section Template
 * ACF Layout: ecommerce_store_cta_section
 */

$section_title = get_sub_field("section_title");
$section_description = get_sub_field("section_description");
$feature_boxes = get_sub_field("feature_boxes");
?>

<section class="ecommerce-store-cta">
  <div class="ecommerce-store-cta__container">
    <div class="ecommerce-store-cta-wrapper-data">
      <?php if ($section_title): ?>
        <h2 class="ecommerce-store-cta__title">
          <?php echo $section_title; ?>
        </h2>
      <?php endif; ?>

      <?php if ($section_description): ?>
        <p class="ecommerce-store-cta__description">
          <?php echo $section_description; ?>
        </p>
      <?php endif; ?>

      <div class="ecommerce-store-cta__features">
        <?php if ($feature_boxes): ?>
          <?php foreach ($feature_boxes as $feature): ?>
            <div class="ecommerce-store-cta__feature-box">
              <div class="ecommerce-store-cta__feature-icon">
                <img src="<?php echo esc_url($feature["icon"]["url"]); ?>" alt="<?php echo esc_attr($feature["title"]); ?>">
              </div>
              <h3 class="ecommerce-store-cta__feature-title">
                <?php echo esc_html($feature["title"]); ?>
              </h3>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
