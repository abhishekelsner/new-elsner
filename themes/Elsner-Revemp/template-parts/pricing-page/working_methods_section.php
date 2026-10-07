<?php
$section_title = get_sub_field('title');
$section_desc = get_sub_field('description');
?>

<section class="working-method-section tmp-working-method-section">
  <div class="container">
    <div class="working-method-heading">
      <?php if ($section_title): ?>
        <h2 class="working-method-title"><?php echo esc_html($section_title); ?></h2>
      <?php endif; ?>

      <?php if ($section_desc): ?>
        <p class="working-method-description"><?php echo esc_html($section_desc); ?></p>
      <?php endif; ?>
    </div>
    <?php if (have_rows('methods')) : ?>
      <div class="working-methods-wrapper">
        <?php while (have_rows('methods')) : the_row(); ?>
          <?php if (have_rows('steps')) : ?>
            <div class="method-steps">
              <div class="step-cards">
                <?php $step_count = 1; ?>
                <?php while (have_rows('steps')) : the_row(); ?>
                  <div class="method-step-wrapper">
                    
                      <span class="step-circle"><?php echo esc_html($step_count); ?></span>
                      <div class="step-info">
                        <?php if (have_rows('steps_detail')) : ?>
                          <?php while (have_rows('steps_detail')) : the_row();
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $text = get_sub_field('text'); ?>
                            
                              <div class="step-card-img">
                              <?php if ($icon): ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                              <?php endif; ?>
                              </div>
                              <h4 class="step-card-subtitle"><?php echo esc_html($title); ?></h4>
                              <p class="step-card-title"><?php echo esc_html($text); ?></p>
                           
                          <?php endwhile; ?>
                        <?php endif; ?>
                      </div>

                    <!-- Hover Detail Panel -->

                  </div>
                <?php $step_count++; endwhile; ?>
                <span class="method-steps-curve-line"><svg width="1072" height="73" viewBox="0 0 1072 73" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 1.5L188.695 59.2976C240.061 75.0731 294.966 75.1629 346.384 59.5557L457.284 25.8934C508.597 10.3179 563.386 10.375 614.666 26.0574L723.907 59.4649C775.142 75.1334 829.88 75.2046 881.156 59.6694L1071.5 2" stroke="#0A0A0A" stroke-opacity="0.2" stroke-width="2" stroke-linejoin="round" stroke-dasharray="12 12"></path></svg></span>
              </div>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
