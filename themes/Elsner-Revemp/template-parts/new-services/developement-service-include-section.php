<?php
// Fetch the repeater field (returns an array if it has rows)
$service_list_items = get_field('service_list_item');
$service_list_heading = get_field('service_list_heading');

if ($service_list_items) : ?>
    <section class="services-section padding-80">
        <div class="container">
            <div class="block-title text-center max-700">
                <h2><?php echo wp_kses_post($service_list_heading); ?></h2>
            </div>
            <div class="service-wrapper">
                <div class="row">
                    <?php foreach ($service_list_items as $service) : ?>
                        <?php
                        // Retrieve values from each row
                        $service_image = $service['service_list_image']; // Default image fallback
                        $service_title = $service['service_list_title'];
                        $service_text = $service['service_list_text'];
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-list-item">
                                <div class="service-list-image">
                                    <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_title); ?>">
                                </div>
                                <div class="service-list-content">
                                    <h4><?php echo esc_html($service_title); ?></h4>
                                    <p><?php echo $service_text; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
