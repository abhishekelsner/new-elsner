<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
?>
<section class="expertise-developer padding-80 blue-section">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo esc_html('Expertise of Our developers'); ?></h2>
        </div>
        <div class="expertise-accordian" id="accordion2">
            <?php if (have_rows('expertise_accodian')) : ?>
                <?php $first_row = true; ?>
                <?php while (have_rows('expertise_accodian')) : the_row(); ?>

                    <div class="expertise-card">
                        <div class="expertise-header">
                            <a class="<?php echo $first_row ? '' : 'collapsed'; ?> card-link" data-toggle="collapse" href="#<?php echo str_replace(' ', '-', get_sub_field('accordion_title')); ?>">
                                <?php the_sub_field('accordion_title'); ?>
                            </a>
                        </div>
                        <div id="<?php echo str_replace(' ', '-', get_sub_field('accordion_title')); ?>" class="collapse <?php echo $first_row ? 'show' : ''; ?>" data-parent="#accordion2">
                            <div class="expertise-body">
                                <?php the_sub_field('accordion_content'); ?>
                            </div>
                        </div>
                    </div>
                    <?php $first_row = false; ?>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>