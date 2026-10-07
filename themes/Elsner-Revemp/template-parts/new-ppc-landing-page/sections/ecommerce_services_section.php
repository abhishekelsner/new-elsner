<?php

/**
 * Ecommerce Services Section Template
 * ACF Layout: ecommerce_services_section
 */

$section_title = get_sub_field("section_title");
$services = get_sub_field("services");
?>

<section class="new-ppc-ecommerce-business ecommerce-business-services">
  <div class="container">
    <?php if ($section_title): ?>
      <div class="new-ppc-ecommerce-business-heading">
        <h2 class="section-title">
          <?php echo esc_html($section_title); ?>
        </h2>
      </div>
    <?php endif; ?>
    <div class="services-grid">
      <?php if ($services): ?>
        <?php foreach ($services as $service): ?>
          <div class="service-card">
            <div class="service-icon">
              <img src="<?php echo esc_url($service["icon"]["url"]); ?>"
                  alt="<?php echo esc_attr($service["title"]); ?>"
                  style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <h3 class="service-title">
              <?php echo esc_html($service["title"]); ?>
            </h3>
            <p>
              <?php echo $service["description"]; ?>
            </p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

