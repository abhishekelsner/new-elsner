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
        </div>
        <?php endif; ?>
        <div class="secondary-cta-btn-wrapper">
           <?php 
$cta_link = get_sub_field('cta_button'); 
if( $cta_link ): ?>
    <a href="<?php echo esc_url($cta_link); ?>" class="cta-button">
        Call To Action
    </a>
<?php endif; ?>

        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
