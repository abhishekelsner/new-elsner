<?php

/**
 * Trusted Partner CTA Section Template
 * ACF Layout: trusted_partner_cta_section
 */

$section_title = get_sub_field("section_title");
$images = get_sub_field("images");
$section_description = get_sub_field("section_description");
?>
<section class="new-ppc-landing-trusted-partner-section">
  <div class="container">
    <?php if ($section_title): ?>
      <h2 class="new-ppc-landing-trusted-partner-title">
        <?php echo $section_title; ?>
      </h2>
    <?php endif; ?>
    <?php if ($section_description): ?>
      <div class="new-ppc-landing-trusted-partner-description">
        <?php echo $section_description; ?>
      </div>
    <?php endif; ?>
    <div class="new-ppc-landing-trusted-partner-image-block">
      <?php if (have_rows('images')): ?>
        <?php while (have_rows('images')): the_row(); ?>
          <?php $image = get_sub_field('image'); ?>
          <?php if ($image): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

