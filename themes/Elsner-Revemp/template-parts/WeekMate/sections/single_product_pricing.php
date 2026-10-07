<?php
$heading            = get_sub_field('heading');
$pricing_title      = get_sub_field('pricing_title');
$pricing_sub_title  = get_sub_field('pricing_sub_title');
$pricing            = get_sub_field('pricing');
$pricing_list       = get_sub_field('pricing_list'); // Repeater
$pricing_text       = get_sub_field('pricing_text');
$pricing_cta        = get_sub_field('pricing_cta'); // Link field
?>

<div class="weekmate-single-product-pricing-section custom-py-50">
  <div class="narrow-container">
    <?php if (!empty($heading)) : ?>
      <div class="heading">
        <h2 class="h2"><span class="gradient-heading"><?php echo esc_html($heading); ?></span> </h2>
      </div>
    <?php endif; ?>

    <div class="pricing-box">
      <div class="pricing-box-inner">
        <?php if (!empty($pricing_title)) : ?>
          <h3 class="pricing-title"><?php echo esc_html($pricing_title); ?></h3>
        <?php endif; ?>

        <?php if (!empty($pricing_sub_title)) : ?>
          <p class="pricing-sub-title"><?php echo esc_html($pricing_sub_title); ?></p>
        <?php endif; ?>

        <?php if (!empty($pricing)) : ?>
          <?php echo ' ';//esc_html($pricing); ?>
        <?php endif; ?>

        <?php if (have_rows('pricing_list')) : ?>
          <ul class="pricing-features">
            <?php while (have_rows('pricing_list')) : the_row();
              $list_item = get_sub_field('pricing_tags'); ?>
              <li><?php echo esc_html($list_item); ?></li>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>

        <?php if (!empty($pricing_text)) : ?>
          <p class="pricing-note"><?php echo esc_html($pricing_text); ?></p>
        <?php endif; ?>
      </div>
      <div class="pricing-button weekmate-button">
        <?php if (!empty($pricing_cta)) :
            $cta_url = $pricing_cta['url'];
            $cta_title = $pricing_cta['title'];
            $cta_target = $pricing_cta['target'] ?: '_self';
          ?>
            <a href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>" class="btn btn-white">
              <?php echo esc_html($cta_title); ?>
            </a>
          <?php endif; ?>
        </div>
    </div>
  </div>
</div>
