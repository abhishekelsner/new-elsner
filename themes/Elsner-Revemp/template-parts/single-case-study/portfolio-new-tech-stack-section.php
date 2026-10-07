<?php
// Store ACF fields in variables

$tech_stack_title = get_field('tech_stack_title');
$tech_stack_images = get_field('tech_stack_images');
?>


<section class="tech-stack-section">
    <div class="container">
        <?php if ($tech_stack_title): ?>
            <div class="tech-stack-softwares">
                <h2><?php echo $tech_stack_title; ?></h2>

                <?php if (have_rows('tech_stack_images')): ?>
                    <div class="softwares-image d-flex">
                        <?php while (have_rows('tech_stack_images')): the_row();
                            // Get the sub-field value
                            $tech_stack_img = get_sub_field('tech_stack_img');
                            $alt_text = !empty($tech_stack_img['alt']) ? $tech_stack_img['alt'] : '';
                            $title_text = !empty($tech_stack_img['title']) ? $tech_stack_img['title'] : ''; // Get the title
                        ?>
                            <div class="software-icon">
                                <img src="<?php echo esc_url($tech_stack_img['url']); ?>" alt="<?php echo esc_attr($alt_text); ?>" title="<?php echo esc_attr($title_text); ?>">
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    </div>
</section>