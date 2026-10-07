<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$main_title = get_sub_field('main_title');
$services = get_sub_field('services');
?>
<section class="our-expertise-section section section-padding">
    <div class="container">
        <?php if ($main_title) : ?>
            <div class="block-title text-center">
                <h2><?php echo esc_html($main_title); ?></h2>
            </div>
        <?php endif; ?>
        
        <?php if ($services) : ?>
            <div class="expertise-wrapper">
                <div class="expertise-wrapper-block-box" dir="rtl">
                    <?php foreach ($services as $service) : 
                        $icon = $service['icon'];
                        $title = $service['title'];
                        $description = $service['description'];
                        $link = $service['link'];
                        
                        $icon_url = '';
                        if ($icon) {
                            $icon_url = is_array($icon) ? $icon['url'] : $icon;
                        }
                    ?>
                        <div class="">
                            <?php if ($link) : ?>
                                <a href="<?php echo esc_url($link); ?>" class="expertise-item" dir="ltr" style="text-align: left;">
                            <?php else : ?>
                                <div class="expertise-item" dir="ltr" style="text-align: left;">
                            <?php endif; ?>
                                
                                <?php if ($icon_url) : ?>
                                    <div class="expertise-icon">
                                        <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($title) : ?>
                                    <h3><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>
                                
                                <?php if ($description) : ?>
                                    <p class="expertise-desc"><?php echo wp_kses_post($description); ?></p>
                                <?php endif; ?>

                            <?php if ($link) : ?>
                                </a>
                            <?php else : ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

