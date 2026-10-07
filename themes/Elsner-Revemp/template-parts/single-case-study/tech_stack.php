<?php 

$heading = get_sub_field('section_heading');
?>
<section class="tech-stack-section new-design">
    <div class="container">
        <?php if ( $heading ) : ?>
            <h2 class="tech-stack-heading">
                <?php echo esc_html($heading); ?>
            </h2>
        <?php endif; ?>

        <?php if ( have_rows('tech_stack_logos') ) : ?>
            <div class="tech-stack-logos">
                <?php while ( have_rows('tech_stack_logos') ) : the_row(); ?>

                    <?php
                    $image = get_sub_field('image');
                    if ( $image ) :
                    ?>
                        <div class="tech-stack-logo">
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>