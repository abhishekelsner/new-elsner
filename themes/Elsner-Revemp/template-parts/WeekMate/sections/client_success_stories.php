<?php
$heading = get_field('client_stories_heading', 'option');
?>

<section class="weekmate-client-success-stories">
  <div class="container">
    <div class="client-sucess-wrapper">
      <div class="heading">
        <?php if ($heading): ?>
          <h2><span class="gradient-heading"><?php echo $heading; ?></span> </h2>
        <?php endif; ?>
      </div>

      <?php if (have_rows('client_stories_block', 'option')): ?>
        <div class="client-slider">
          <?php while (have_rows('client_stories_block', 'option')): the_row();
            $image = get_sub_field('client_success_stories_image');
            $name = get_sub_field('client_success_stories_text');
            $text = get_sub_field('client_name');
            $client_designation = get_sub_field('client_designation');
          ?>
            <div class="client-slide">
              <div class="tag-wrapper">
                <?php if ($image): ?>
                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                <?php endif; ?>
              </div>
              <div class="sider-content-wrapper">

                <?php if ($name): ?>
                  <p><?php echo esc_html($name); ?></p>
                <?php endif; ?>
                <div class="designation-wrapper">
                  <?php if ($text): ?>
                    <h4><?php echo esc_html($text); ?></h4>
                  <?php endif; ?>
                  <?php if ($text): ?>
                    <p class="designation"><?php echo esc_html($client_designation); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>