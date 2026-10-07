<?php
$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$development_services = get_sub_field('development_services');
?>
<section class="weekmate-development-services">
  <div class="container">
    <div class="capability-section-wrapper">


      <div class="heading">
        <h2>
          <span class="gradient-heading"><?php echo $title; ?></span>
          <span class="thin-heading"><?php echo $sub_title; ?></span>
        </h2>
      </div>

      <?php if (have_rows('development_services')) : ?>
        <div class="development-services-slider">
          <?php while (have_rows('development_services')) : the_row();
            $title = get_sub_field('title');
            $text  = get_sub_field('text');
            $image = get_sub_field('image');
          ?>
            <div class="service-card">
            <div class="service-inner">
                <?php if (!empty($image)) : ?>
                  <div class="service-image" style="background-image: url('<?php echo esc_url($image['url']); ?>'); background-size: cover; background-position: center;">
                <div class="slider-content-wrapper">
                  <div class="slider-content">
                    <?php if (!empty($title)) : ?>
                      <h3 class="service-title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($text)) : ?>
                      <p class="service-text"><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                  </div>
                </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
