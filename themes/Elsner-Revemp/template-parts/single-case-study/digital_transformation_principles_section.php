<?php 
$section_heading = get_sub_field('section_heading'); 
?>

<section class="automation-section">
    <div class="container">
      <div class="automation-main-wrapper">
        <?php if($section_heading): ?>
          <div class="heading">
            <h2 class="section-title"><?php echo esc_html($section_heading); ?></h2>
          </div>
        <?php endif; ?>

        <!-- Comparison Row -->
        <?php if( have_rows('comparison_cards') ): ?>
        <div class="comparison-row">
            <?php while( have_rows('comparison_cards') ): the_row(); 
                $title = get_sub_field('title');
                $image = get_sub_field('image');
                $text_color = get_sub_field('text_color');
            ?>
            <div class="comparison-card">
                <?php if($title): ?>
                    <h3 style="color: <?php echo esc_attr($text_color); ?>;"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if( !empty($image) ): ?>
                    <div class="comparison-image">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    </div>
                <?php endif; ?>

                <?php if( have_rows('list_items') ): ?>
                    <ul class="comparison-list" style="color: <?php echo esc_attr($text_color); ?>;">
                        <?php while( have_rows('list_items') ): the_row(); 
                            $point = get_sub_field('point_text'); ?>
                            <li><?php echo esc_html($point); ?></li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <!-- Bottom Features -->
        <?php if( have_rows('bottom_features') ): ?>
        <div class="bottom-features">
            <?php while( have_rows('bottom_features') ): the_row(); 
                $icon = get_sub_field('Icon');
                $heading = get_sub_field('heading');
                $desc = get_sub_field('description');
            ?>
            <div class="feature-box">
                <?php if( !empty($icon) ): ?>
                    <img class="feature-icon" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                <?php endif; ?>
                <?php if($heading): ?>
                    <h4><?php echo esc_html($heading); ?></h4>
                <?php endif; ?>
                <?php if($desc): ?>
                    <p><?php echo esc_html($desc); ?></p>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
</section>
