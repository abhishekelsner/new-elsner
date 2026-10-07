<section class="solution-provided-section blue-section padding-80">
    <div class="container">
        <div class="solution-provided-wrapper">
            <div class="heading-wrapper white-text width-900">
                <h2><?php echo esc_html('The solution we provided'); ?></h2>
                <p><?php echo get_field('solution_provided', get_the_ID()); ?></p>
            </div>
            <div class="solution-slider slider">
                <?php
                $solution_provided = get_field('project_images_slider', get_the_ID());
                if (have_rows('project_images_slider', get_the_ID())) :
                    while (have_rows('project_images_slider', get_the_ID())) : the_row();
                ?>
                <div class="sol-img">
                    <img src="<?php echo get_sub_field('project_images'); ?>" alt="solution image" width="900"
                        height="100%" loading="lazy">
                </div>
                <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>