<?php

/**
 * Hero Section Template
 * ACF Layout: hero_section
 */

$heading_button = get_sub_field("heading_button");
$main_headline = get_sub_field("main_headline");
$description = get_sub_field("description");
$cta_button = get_sub_field("cta_button");
$social_proof_images = get_sub_field("social_proof_images");
$show_lead_form = get_sub_field("show_lead_form");
$lead_form_shortcode = get_sub_field("lead_form_shortcode");
$background_image = get_sub_field("background_image");
?>
<section class="new-ppc-landing-hero-section">
<div class="container">
  
<div class="new-ppc-landing-wrapper-content">
  <div class="new-ppc-landing-bg-image-banner">
    <img src="https://www.elsner.com/wp-content/uploads/2025/07/PPC_Page_1752831638908-1.jpg" alt="banner-img" width="100%" height="auto">
  </div>
  <div class="row new-ppc-landing-items-center">

    <!-- LEFT SIDE: Content -->
    <div class="new-ppc-landing-content-details">
      <div class="new-ppc-landing-wrap-data">
      <?php if ($background_image): ?>
          <div class="new-ppc-landing-image">
            <img src="<?php echo esc_url($background_image['url']); ?>" alt="Background Image">
          </div>
        <?php endif; ?>
        <?php if ($heading_button): ?>
          <a class="new-ppc-btn">
            <?php echo esc_html($heading_button['title']); ?>
          </a>
        <?php endif; ?>

        <?php if ($main_headline): ?>
          <h1 class="new-ppc-landing-heading">
            <?php echo $main_headline; ?>
          </h1>
        <?php endif; ?>

        <?php if ($description): ?>
          <p class="new-ppc-landing-desc">
            <?php echo $description; ?>
          </p>
        <?php endif; ?>

        <?php if ($social_proof_images): ?>
          <div class="new-ppc-landing-images">
            <div class="new-ppc-landing-images-inner">
              <?php foreach (array_slice($social_proof_images, 0, 3) as $image): ?>
                <img src="<?php echo esc_url($image["url"]); ?>" alt="<?php echo esc_attr($image["alt"]); ?>" class="h-8 w-auto">
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($cta_button): ?>
          <a class="new-ppc-button-btn">
            <?php echo esc_html($cta_button['title']); ?>
          </a>
        <?php endif; ?>

      </div>
    </div>

    <!-- RIGHT SIDE: Form -->
    <div class="new-ppc-landing-form-wrapper">
      <?php if ($show_lead_form): ?>
        <div class="new-ppc-landing-form">
          <?php if ($lead_form_shortcode): ?>
            <?php echo do_shortcode($lead_form_shortcode); ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
  </div>
  </div>
</section>

