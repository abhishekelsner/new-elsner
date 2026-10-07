<?php
$disable_section = get_sub_field('disable_section'); 
$heading = get_sub_field('heading');
$description = get_sub_field('description');
$product_content_box = get_sub_field('product_content_box');
if (!$disable_section) :
?>

<section class="weekmate-single-product-hero-section weekmate-grid-section custom-py-50" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
  <div class="container">
    <div class="hero-section-wrapper">

      <div class="heading">

        <h2><span class="gradient-heading"> <?php echo $heading; ?> </h2>
      </div>
      <div class="hero-section-paragraph h2">
        <?php echo $description; ?>
      </div>
      <?php if (have_rows('product_content_box')) : ?>
        <div class="product-content-box-wrapper swiper">
          <div class="swiper-wrapper">
            <?php while (have_rows('product_content_box')) : the_row();
              $title = get_sub_field('title');
              $description = get_sub_field('description');
            ?>
              <div class="swiper-slide">
                <div class="product-box">
                  <div class="product-box-item">
                    <?php if (!empty($title)) : ?>
                      <h3><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($description)) : ?>
                      <p><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <!-- Optional pagination -->
          <div class="swiper-pagination"></div>
        </div>
      <?php endif; ?>


    </div>
  </div>
</section>
<?php endif; ?>