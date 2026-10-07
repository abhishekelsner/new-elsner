<?php
$product_feture_heding = get_sub_field('product_feture_heding');
?>
<section class="weekmate-single-product-digital-workplace-section custom-py-50">
  <div class="container">
    <div class="heading">
      <h2><span class="gradient-heading"><?php echo $product_feture_heding; ?></span></h2>
    </div>
    <?php if (have_rows('product_content_box')) : ?>
      <div class="dwp-solution-list">
        <ul>
          <?php $index = 0; ?>
          <?php while (have_rows('product_content_box')) : the_row();
            $title = get_sub_field('title');
            $desc = get_sub_field('description');
            $link = get_sub_field('link');
            $image = get_sub_field('image');
            $active_img = get_sub_field('background_image');
            $is_active = ($index === 0) ? 'active' : '';
          ?>
            <?php
            $is_active = ($index === 0);
            ?>
            <li class="<?php echo $is_active ? 'active' : ''; ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
              <div class="solution-block">
                <span class="roate-txt"><?php echo esc_html($title); ?></span>
                <div class="solution-wrapper sb-img">
                  <div class="sb-content">
                    <h3 tabindex="0"><?php echo esc_html($title); ?></h3>
                    <?php echo $desc; ?>
                    <?php if ($link): ?>
                      <p><a class="learn-link" href="<?php echo esc_url($link); ?>">Learn more</a></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </li>
            <?php $index++; ?>
          <?php endwhile; ?>
        </ul>
      </div>
    <?php endif; ?>
  </div>
</section>
