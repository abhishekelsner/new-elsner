<?php
$title = get_sub_field('title');
$description = get_sub_field('desciption');
$cta_first = get_sub_field('cta_first');
$cta_second = get_sub_field('cta_second');
?>

<section class="weekmate-single-product-banner-wrapper services-banner">
  <div class="container">
<div class="weekmate-product-banner">
<div class="heading">
  <?php if ($title) : ?>
    <h1 class="title"> <span class="gradient-heading"> <?php echo esc_html($title); ?> </span></h1>
  <?php endif; ?>
</div>
  
    <?php if ($description) : ?>
      <p class="description"><?php echo esc_html($description); ?></p>
    <?php endif; ?>
    <div class="weekmate-banner-cta">
      <div class="weekmate-button">
        <?php if (!empty($cta_first['url']) && !empty($cta_first['title'])) : ?>
          <a href="<?php echo esc_url($cta_first['url']); ?>" class="btn" target="<?php echo esc_attr($cta_first['target'] ?: '_self'); ?>">
            <?php echo esc_html($cta_first['title']); ?>
          </a>
        <?php endif; ?>
      </div>
      <div class="weekmate-button">
        <?php if (!empty($cta_second['url']) && !empty($cta_second['title'])) : ?>
          <a href="<?php echo esc_url($cta_second['url']); ?>" class="btn btn-primary" target="<?php echo esc_attr($cta_second['target'] ?: '_self'); ?>">
            <?php echo esc_html($cta_second['title']); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
</section>
