<?php
$heading = get_sub_field('heading');
$sub_heading = get_sub_field('sub_heading');
$description = get_sub_field('description');

?>
<section class="weekmate why-weekmate">
  <div class="container">
    <div class="why-choose-weekmate-wrapper">
      <div class="heading">
        <h2><span class="thin-heading"><?php echo $heading; ?> </span><span class="gradient-heading"><?php echo $sub_heading; ?> </span></h2>
      </div>
      <div class="paragraph">
        <?php echo $description; ?>
      </div>
      <?php if (have_rows('cards')) : ?>
        <div class="virtual-assistants-box-wrapper d-flex">
          <?php $index = 0; ?>
          <?php while (have_rows('cards')) : the_row();
            $image = get_sub_field('card_image');
            $title = get_sub_field('card_title');
            $label = get_sub_field('card_label');

            // Define classes to match your structure
            $classes = ['growth', 'strategies', 'solutions', 'business'];
            $box_class = isset($classes[$index]) ? $classes[$index] : '';
          ?>
            <div class="virtual-assistants-box <?= esc_attr($box_class); ?>">
              <?php if ($image) : ?>
                <div class="virtual-assistants-box-icon">
                  <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>">
                </div>
              <?php endif; ?>
              <?php if ($label) : ?>
                <div class="virtual-assistants-details">
                  <span class="card-label"><?= esc_html($label); ?> </span>
                  <h3 class="card-title"><?= esc_html($title); ?></h3>
                </div>
              <?php endif; ?>
            </div>
            <?php $index++; ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>


</section>