<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$title = get_sub_field('title');
$description = get_sub_field('description');
$features = get_sub_field('features');
?>
<section class="why-choose-elsner-section section section-padding">
    <div class="container">
        <div class="why-choose-elsner-section-wrapper">
            <?php if ($title) : ?>
                <div class="block-title text-center">
                    <h2><?php echo esc_html($title); ?></h2>
                </div>
            <?php endif; ?>
            
            <?php if ($description) : ?>
                <div class="section-description text-center">
                    <p><?php echo esc_html($description); ?></p>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if ($features) : ?>
            <div class="features-wrapper">
                <div class="row">
                    <?php foreach ($features as $feature) : 
                        $icon = $feature['icon'];
                        $feature_title = $feature['title'];
                        
                        $icon_url = '';
                        if ($icon) {
                            $icon_url = is_array($icon) ? $icon['url'] : $icon;
                        }
                    ?>
                        <div class="col-lg-2 col-md-6 col-sm-6">
                            <div class="feature-item text-center">
                                <?php if ($icon_url) : ?>
                                    <div class="feature-icon">
                                        <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($feature_title); ?>" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <?php if ($feature_title) : ?>
                                    <h4><?php echo esc_html($feature_title); ?></h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

