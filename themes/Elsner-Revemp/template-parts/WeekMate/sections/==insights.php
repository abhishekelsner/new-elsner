<?php
$heading = get_sub_field('heading');
?>

<section class="weekmate-insights-blocks">
  <div class="container">
    <div class="weekmate-insights-wrapper">
      <div class="heading">

        <?php if ($heading): ?>
          <h2 class="gradient-heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
      </div>
      <?php if (have_rows('insights_blocks')): ?>
        <div class="insights-blocks-wrapper">

          <?php while (have_rows('insights_blocks')): the_row();
            $insights_title = get_sub_field('insights_title');
            $insights_description = get_sub_field('insights_description');
            $insights_image = get_sub_field('insights_image');
          ?>
            <div class="insights-block">
              <?php if (!empty($insights_image)): ?>
                <div class="insights-image" style="background-image: url('<?php echo esc_url($insights_image['url']); ?>'); background-size: cover; background-position: center;">
                  <div class="slider-content-wrapper">
                    <div class="slider-content">
                      <?php if (!empty($insights_title)): ?>
                        <h3 class="insights-title"><?php echo esc_html($insights_title); ?></h3>
                      <?php endif; ?>

                      <?php if (!empty($insights_description)): ?>
                        <p class="insights-description"><?php echo esc_html($insights_description); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>

        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

