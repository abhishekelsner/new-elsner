<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$show_section  = get_field('show_section', $post_id);

if ($show_section === true) {
?>
    <section class="faq-section padding-80 blue-section">
        <div class="container">
            <div class="block-title text-center max-700">
                <h2><?php echo esc_html('Frequently Asked Questions'); ?></h2>
            </div>
            <div class="faq-wrapper">
                <div id="accordion">
                    <?php if (have_rows('faq', $post_id)) : ?>
                        <?php $first_row = true; ?>
                        <?php while (have_rows('faq', $post_id)) : the_row(); ?>

                            <div class="faq_card">
                                <div class="faq-header">
                                    <a class="<?php echo $first_row ? '' : 'collapsed'; ?> card-link" data-toggle="collapse" href="#<?php echo str_replace(' ', '-', get_sub_field('faq_que')); ?>">
                                        <?php the_sub_field('faq_que'); ?>
                                    </a>
                                </div>
                                <div id="<?php echo str_replace(' ', '-', get_sub_field('faq_que')); ?>" class="collapse <?php echo $first_row ? 'show' : ''; ?>" data-parent="#accordion">
                                    <div class="faq-body">
                                        <?php the_sub_field('faq_ans'); ?>
                                    </div>
                                </div>
                            </div>

                            <?php $first_row = false; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>