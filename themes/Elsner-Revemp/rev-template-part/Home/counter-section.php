<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$counters = get_sub_field('counter');
?>
<section class="counter-section section  ">
    <div class="container">
        <?php if ($counters) : ?>
            <div class="counter-wrapper">
                <div class="row">
                    <?php foreach ($counters as $counter) :
                        $icon = $counter['icon'];
                        $number = $counter['number'];
                        $suffix = $counter['suffix'];
                        $label = $counter['label'];

                        $icon_url = '';
                        if ($icon) {
                            $icon_url = is_array($icon) ? $icon['url'] : $icon;
                        }
                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="counter-item ">
                                <?php if ($icon_url) : ?>
                                    <div class="counter-icon">
                                        <img src="<?php echo esc_url($icon_url); ?>" alt="Counter Icon" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <div class="counter-number-wrapper">
                                    <div class="counter-number">
                                        <span class="number"><?php echo esc_html($number); ?></span>
                                        <?php if ($suffix) : ?>
                                            <span class="suffix"><?php echo esc_html($suffix); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($label) : ?>
                                        <div class="counter-label">
                                            <p><?php echo esc_html($label); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>