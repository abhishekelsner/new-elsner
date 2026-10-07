<?php

/**
 * Our Process Section Template
 * ACF Layout: our_process_section
 */

$section_title = get_sub_field("section_title");
$process_steps = get_sub_field("process_steps");
?>

<section class="new-ppclanding-our-process our-process-section">
    <div class="container">
        <div class="process-steps-wrap">
            <?php if ($section_title): ?>
                <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>

            <div class="process-steps-wrapper">
                <?php if ($process_steps): ?>
                    <?php foreach ($process_steps as $step): ?>
                        <div class="process-step">
                            <div class="process-content">
                                <?php if (!empty($step['image'])): ?>
                                    <div class="process-icon-img">
                                        <img class="process-icon" src="<?php echo esc_url($step['image']['url']); ?>" alt="<?php echo esc_attr($step['image']['alt']); ?>" />
                                    </div>
                                <?php endif; ?>
                                <h3 class="process-title"><?php echo esc_html($step["title"]); ?></h3>
                                <p class="process-description"><?php echo $step["description"]; ?></p>
                            </div>
                            <div class="process-number"><?php echo esc_html($step["step_number"]); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

