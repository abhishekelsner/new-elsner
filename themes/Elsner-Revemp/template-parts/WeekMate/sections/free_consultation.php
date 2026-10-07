<?php
$title = get_sub_field('free_consultation_heading');
$button = get_sub_field('free_consultation_cta'); // Should be a Link type field
$image = get_sub_field('free_consultation_image');
?>

<section class="weekmate-free-consultation">
  <div class="container">
    <div class="consultation-wrapper">
      <?php if (!empty($image)): ?>
        <div class="consultation-image">
          <img src="<?php echo esc_url($image['url']); ?>"
            alt="<?php echo esc_attr($image['alt'] ?: 'Free Consultation Image'); ?>">
        </div>
      <?php endif; ?>
      <div class="right-side-content-wrapper">
        <?php if ($title): ?>
          <h3 class="consultation-title"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>
        <?php if (!empty($button) && isset($button['url'])): ?>
          <div class="weekmate-button">
            <a href="<?php echo esc_url($button['url']); ?>"
              class="btn secondary"
              target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
              <?php echo esc_html($button['title']); ?>
            </a>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>