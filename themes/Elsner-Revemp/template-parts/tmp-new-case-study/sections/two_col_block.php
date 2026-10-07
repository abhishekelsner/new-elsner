<?php
// Section main fields
$section_heading        = get_sub_field('section_heading');
$section_subheading     = get_sub_field('section_subheading');
$left_why_choose_title  = get_sub_field('left_why_choose_title');
$bg            = get_sub_field('background_image');
// Form block fields
$form_heading    = get_sub_field('form_heading');
$form_desc       = get_sub_field('form_description');
$form_shortcode  = get_sub_field('form_shortcode');
?>

<section class="our-portfolio-form">
  <div class="container">
    <div class="our-portfolio-form-grid">

      <!-- Left Content -->
       <div class="section-header">
        <?php if ($section_heading): ?>
          <h2 class="section-heading"><?php echo $section_heading; ?></h2>
        <?php endif; ?>

        <?php if ($section_subheading): ?>
          <p class="section-subheading"><?php echo $section_subheading; ?></p>
        <?php endif; ?>
        </div>
      <div class="our-portfolio-form-content">
         <!-- Why Choose Elsner -->
        <?php if ($left_why_choose_title): ?>
          <h3 class="why-choose-title"><?php echo $left_why_choose_title; ?></h3>
        <?php endif; ?>

        <!-- Features -->
        <?php if (have_rows('why_elsner_features')): ?>
          <div class="features-list">
            <?php while (have_rows('why_elsner_features')): the_row();
              $icon        = get_sub_field('icon');
              $title       = get_sub_field('title');
              $description = get_sub_field('description');
            ?>
              <div class="feature-item">
                <?php if ($icon): ?>
                  <div class="feature-icon">
                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                  </div>
                <?php endif; ?>
                <div class="feature-content">
                  <?php if ($title): ?>
                    <h4 class="feature-title"><?php echo esc_html($title); ?></h4>
                  <?php endif; ?>
                  <?php if ($description): ?>
                    <p class="feature-desc"><?php echo esc_html($description); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>

        <!-- Stats -->
        <?php if (have_rows('stats')): ?>
          <div class="stats">
            <?php while (have_rows('stats')): the_row();
              $number = get_sub_field('number');
              $label  = get_sub_field('label');
            ?>
              <div class="stat-item">
                <?php if ($number): ?>
                  <h3 class="stat-number"><?php echo esc_html($number); ?></h3>
                <?php endif; ?>
                <?php if ($label): ?>
                  <p class="stat-label"><?php echo esc_html($label); ?></p>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Right Form -->
      <div class="portfolio-form">
        <div class="form-box">
          <?php if ($form_heading): ?>
            <h3 class="form-heading"><?php echo $form_heading; ?></h3>
          <?php endif; ?>

          <?php if ($form_desc): ?>
            <p class="form-desc"><?php echo $form_desc; ?></p>
          <?php endif; ?>

          <?php if ($form_shortcode): ?>
            <div class="form-wrapper">
              <?php echo do_shortcode($form_shortcode); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>


