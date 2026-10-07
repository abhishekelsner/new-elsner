<?php
$heading       = get_sub_field('heading'); 
$sub_heading   = get_sub_field('sub_heading');
$main_image = get_sub_field('main_image'); 
$solution_block = get_sub_field('solution_block'); // Repeater field
?>

<?php if( $heading || $sub_heading || $solution_block ): ?>
<section class="challenge-section-case-study our-solution-section">
    <div class="container">
        
        <div class="challenge-section-detail text-center">
            <?php if($heading): ?>
                <h3><?php echo esc_html($heading); ?></h3>
            <?php endif; ?>

            <?php if($sub_heading): ?>
                <p><?php echo esc_html($sub_heading); ?></p>
            <?php endif; ?>
             <?php if( !empty($main_image) ): ?>
                <img src="<?php echo esc_url( $main_image['url'] ); ?>" alt="<?php echo esc_attr( $main_image['alt'] ); ?>">
            <?php endif; ?>
        </div>
          
        <?php if( $solution_block ): ?>
        <div class="challenge-section-cards">
            <?php foreach( $solution_block as $box ): ?>
                <div class="challenge-card">
                    <?php if( !empty($box['icon']) ): ?>
                        <div class="challenge-icon">
                            <img src="<?php echo esc_url($box['icon']['url']); ?>" alt="<?php echo esc_attr($box['icon']['alt']); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if( !empty($box['title']) ): ?>
                        <p><?php echo esc_html($box['title']); ?></p>
                    <?php endif; ?>
                    <?php if( !empty($box['text']) ): ?>
                        <p><?php echo esc_html($box['text']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
        <?php if (have_rows('cards')) : ?>
<section class="case-study-cards">
    <div class="container">
        <div class="cards-grid">

            <?php while (have_rows('cards')) : the_row();
                $image = get_sub_field('card_image');
                $icon  = get_sub_field('card_icon');
                $title = get_sub_field('card_title');
                $desc  = get_sub_field('card_description');
            ?>
                <div class="card-box">

                    <?php if ($image): ?>
                        <div class="card-image">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php if ($icon): ?>
                                <!-- <span class="card-icon">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="">
                                </span> -->
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="card-content">
                        <?php if ($title): ?>
                            <h3><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($desc): ?>
                            <p><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>

                        <?php if (have_rows('card_features')): ?>
                            <ul class="card-features">
                                <?php while (have_rows('card_features')): the_row(); ?>
                                    <li>
                                        <span class="check-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
<path d="M12.7172 5.83345C12.9837 7.14087 12.7938 8.50011 12.1793 9.6845C11.5649 10.8689 10.5629 11.8068 9.34063 12.3419C8.11833 12.877 6.74953 12.9768 5.4625 12.6248C4.17548 12.2728 3.04803 11.4903 2.26816 10.4076C1.48829 9.32496 1.10315 8.00767 1.17697 6.67542C1.25078 5.34318 1.77909 4.0765 2.67379 3.08663C3.56849 2.09676 4.7755 1.44353 6.09354 1.23588C7.41157 1.02823 8.76095 1.2787 9.91666 1.94553" stroke="#007AC1" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M5.25 6.41659L7 8.16659L12.8333 2.33325" stroke="#007AC1" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span>
                                        <?php echo esc_html(get_sub_field('feature_text')); ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endwhile; ?>

        </div>
    </div>
</section>
<?php endif; ?>
<?php
$principles_heading = get_sub_field('principles_heading');
?>

<section class="digital-principles">
    <div class="container">                        
    <?php if ($principles_heading): ?>
        <h2 class="section-title"><?php echo esc_html($principles_heading); ?></h2>
    <?php endif; ?>

  <?php if ( have_rows('before_automation') ) : ?>
    <div class="before-automation-wrapper">

        <?php while ( have_rows('before_automation') ) : the_row(); ?>

            <?php 
                $title = get_sub_field('before_title');
                $image = get_sub_field('before_image');
            ?>

            <div class="before-automation-item">

                <?php if ( $title ) : ?>
                    <h3><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if ( $image ) : ?>
                    <div class="before-image">
                        <img src="<?php echo esc_url($image['url']); ?>" 
                             alt="<?php echo esc_attr($image['alt']); ?>">
                    </div>
                <?php endif; ?>

                <?php if ( have_rows('before_points') ) : ?>
                    <ul class="before-points">
                        <?php while ( have_rows('before_points') ) : the_row(); ?>
                            <?php $point = get_sub_field('point_text'); ?>
                            <?php if ( $point ) : ?>
                                <li><?php echo esc_html($point); ?></li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

            </div>

        <?php endwhile; ?>

    </div>
<?php endif; ?>
  <!-- PRINCIPLES -->
    <?php if (have_rows('principles')): ?>
        <div class="principles-grid">
            <?php while (have_rows('principles')): the_row(); ?>
                <div class="principle-item">
                    <?php $icon = get_sub_field('icon'); ?>
                    <?php if ($icon): ?>
                        <img src="<?php echo esc_url($icon['url']); ?>" alt="">
                    <?php endif; ?>
                    <h5><?php echo esc_html(get_sub_field('title')); ?></h5>
                    <p><?php echo esc_html(get_sub_field('description')); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    </div>
</section>