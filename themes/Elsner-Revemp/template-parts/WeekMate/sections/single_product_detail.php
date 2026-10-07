<?php
$heading = get_sub_field('heading');
?>
<section class="weekmate-single-product-hero-section custom-py-50">
  <div class="container">
    <div class="weekmate-heading heading">
     <h2> <span class="gradient-heading"> <?php echo $heading; ?> </span></h2>
    </div>
    <?php if (have_rows('product_detail_block')) : ?>
      <div class="product-detail-section  d-flex">
        <!-- Left side: Swiper for Images -->
        <div class="product-image-slider swiper w-50">
          <div class="swiper-wrapper">
            <?php while (have_rows('product_detail_block')) : the_row();
              $image = get_sub_field('image'); ?>
               <div class="swiper-slide">
                <a 
                    href="<?php echo esc_url($image['url']); ?>" 
                    data-fancybox="product-gallery">
                    <img src="<?php echo esc_url($image['url']); ?>" 
                         alt="<?php echo esc_attr($image['alt']); ?>" 
                         class="img-fluid">
                </a>
              </div>
            <?php endwhile; ?>
          </div>
        </div>

        <!-- Right side: Navigation Texts -->
        <div class="product-text-nav w-50 d-flex flex-column justify-content-center">
          <?php
          $index = 0;
          while (have_rows('product_detail_block')) : the_row();
            $title = get_sub_field('title');
            $content = get_sub_field('content'); ?>
            <div class="text-box swiper-text-trigger" data-index="<?php echo $index++; ?>">
              <h4 class="mb-1"><?php echo esc_html($title); ?></h4>
              <p class="mb-3"><?php echo esc_html($content); ?></p>
            </div>
          <?php endwhile; ?>
        </div>

      </div>
    <?php endif; ?>
  </div>
</section>



