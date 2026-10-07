<?php 
// Get slider settings


$slider_settings = get_sub_field('slider_settings');
$auto_rotate = $slider_settings['auto_rotate'] ?? false;
$rotation_speed = $slider_settings['rotation_speed'] ?? 5;
$show_navigation = $slider_settings['show_navigation'] ?? true;

// Get section content
$section_title = get_sub_field('title');
$section_description = get_sub_field('description');
?>

<section class="services-tabbed-slider-section">
    <div class="container">

        <?php if ($section_title || $section_description): ?>
        <div class="section-header">
            <?php if ($section_title): ?>
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if ($section_description): ?>
            <p class="section-description"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (have_rows('services_content_block')): ?>
        <div class="services-tabs-wrapper">

            <!-- Service Cards as Tab Buttons -->
            <div class="services-tab-buttons">
                <?php $tab_index = 0; ?>
                <?php while (have_rows('services_content_block')): the_row(); 
                        $service_icon = get_sub_field('service_icon');
                        $service_title = get_sub_field('service_title');
                        $service_text = get_sub_field('service_text');
                    ?>
                <div class="service-tab-card<?php echo $tab_index === 0 ? ' active' : ''; ?>"
                    data-tab="tab-<?php echo $tab_index; ?>">
                    <div class="service-tab-card-icon-text">
                        <?php if ($service_icon): ?>
                        <div class="service-icon">
                            <img src="<?php echo esc_url($service_icon['url']); ?>"
                                alt="<?php echo esc_attr($service_icon['alt']); ?>">
                        </div>
                        <?php endif; ?>
                        <h5><?php echo $service_title; ?></h5>
                    </div>
                    <p class="service-description"><?php echo esc_html($service_text); ?></p>
                    <div class="service-progess-bar-line">
                        <div class="progress-bar"></div>
                    </div>
                </div>
                <?php $tab_index++; ?>
                <?php endwhile; ?>
            </div>

            <!-- Tab Contents / Slider -->
            <div class="services-tab-contents">
                <?php $tab_index = 0; ?>
                <?php while (have_rows('services_content_block')): the_row(); 
                        $tab_content_title = get_sub_field('tab_content_title');
                        $service_image = get_sub_field('service_image');
                        // $tab_background_color = get_sub_field('tab_background_color') ?: '#fef7f0';
                    ?>
                <div class="service-tab-content<?php echo $tab_index === 0 ? ' active' : ''; ?>"
                    id="tab-<?php echo $tab_index; ?>"
                    style="background: <?php echo esc_attr($tab_background_color); ?>;">

                    <div class="tab-content-inner">
                        <div class="content-left">
                            <?php if ($tab_content_title): ?>
                            <h3 class="content-title"><?php echo esc_html($tab_content_title); ?></h3>
                            <?php endif; ?>

                            <?php if (have_rows('service_inner_block')): ?>
                            <div class="tmp-service-details-list-content">

                                <?php while (have_rows('service_inner_block')): the_row(); 
                                                $block_title = get_sub_field('service_block_title');
                                                $service_block_image = get_sub_field('service_block_image');

                                            ?>


                                <?php echo wp_kses_post($block_title); ?>

                                <?php endwhile; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="content-right">
                            <?php if ($service_block_image): ?>
                            <div class="service-image">
                                <img src="<?php echo esc_url($service_block_image['url']); ?>"
                                    alt="<?php echo esc_attr($service_block_image['alt']); ?>">
                            </div>
                            <?php else: ?>
                            <!-- Default illustration if no image -->
                            <div class="service-illustration">
                                <div class="default-icon">

                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php $tab_index++; ?>
                <?php endwhile; ?>

                <!-- <?php if ($show_navigation): ?>
                        <div class="tab-navigation">
                            <?php for ($i = 0; $i < $tab_index; $i++): ?>
                                <span class="nav-dot<?php echo $i === 0 ? ' active' : ''; ?>" 
                                      data-tab="tab-<?php echo $i; ?>"></span>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?> -->
            </div>
        </div>
        <?php endif; ?>
        <div class="secondary-cta-btn-wrapper">
            <?php 
    $cta_link = get_sub_field('cta_button'); 
      if ($cta_link): ?>
            <a href="<?php echo esc_url($cta_link['url']); ?>" target="<?php echo esc_attr($cta_link['target']); ?>"
                class="hero-cta">
                <?php echo esc_html($cta_link['title']); ?>
            </a>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>