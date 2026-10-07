<?php
$heading = get_sub_field('heading');
$subtitle = get_sub_field('hero_subtitle');
$subtitle2 = get_sub_field('subtitle2');
$description = get_sub_field('hero_description');
$button = get_sub_field('hero_button_text');
$background_image = get_sub_field('hero_background_image');
?>

<section class="single-product-weekmate-Benefits-section custom-py-50">
  <div class="container">
    <div class="hero-section-wrapper">
      <div class="heading">
        <h2><span class="gradient-heading"> <?php echo $heading; ?> </h2>
      </div>
      <?php if (have_rows('software_detail_block')) : ?>
        <div class="expertise">
        
          <div class="expertise-slider slider slick-slider">
            <?php while (have_rows('software_detail_block')) : the_row();
              $image = get_sub_field('image');
              $title = get_sub_field('title');
              $description = get_sub_field('description');
              $link = get_sub_field('link');
            ?>
              <div class="technology-slide">
                <div class="tech-logo">
                  <?php if (!empty($image)) : ?>
                    <img class="lazy" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Logo'); ?>" width="100" height="52" loading="lazy">
                  <?php endif; ?>
                </div>

                <div class="description-tech">
                  <?php if (!empty($title)) : ?>
                    <h3 class="tech-head"><?php echo esc_html($title); ?></h3>
                  <?php endif; ?>

                  <?php if (!empty($description)) : ?>
                    <p><?php echo esc_html($description); ?></p>
                  <?php endif; ?>

                  <?php if (!empty($link)) : ?>
                    <div class="link">
                      <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?: '_self'); ?>" class="arrow-link">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow.svg" alt="arrow" width="18" height="20" loading="lazy">
                      </a>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Optional overlay if needed later -->
                <!--
          <div class="overlay-data">
            <div class="overlay">
              <p>Project Info</p>
              <h5>Store Name</h5>
            </div>
            <p>Certified Developer Info</p>
          </div>
          -->
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>