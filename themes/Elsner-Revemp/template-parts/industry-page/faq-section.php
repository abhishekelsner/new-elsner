<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$show = get_field('industry_page_show_faq', $post_id);

if ($show === true) {
?>
    <section class="faq-section padding-80 blue-section industry-page">
        <div class="container">
            <div class="block-title text-center max-700">
                <h2 style="color:white;"><?php echo esc_html('Frequently Asked Questions'); ?></h2>
            </div>
            <div class="faq-wrapper">
                <div id="accordion">
                    <?php if (have_rows('industry_page_faq', $post_id)) : ?>
                        <?php $first_row = true; ?>
                        <?php while (have_rows('industry_page_faq', $post_id)) : the_row(); ?>

                        <?php
                        $question = get_sub_field('industry_page_faq_question');
                        $answer   = get_sub_field('industry_page_faq_answer');

                        if (!$question || !$answer) continue;

                        $faq_id = 'faq-' . get_row_index() . '-' . sanitize_title($question);
                        ?>

                        <div class="faq_card">
                            <div class="faq-header">
                                <a class="<?php echo $first_row ? '' : 'collapsed'; ?> card-link"
                                data-toggle="collapse"
                                href="#<?php echo esc_attr($faq_id); ?>"
                                aria-expanded="<?php echo $first_row ? 'true' : 'false'; ?>">
                                    <?php echo esc_html($question); ?>
                                </a>
                            </div>

                            <div id="<?php echo esc_attr($faq_id); ?>"
                                class="collapse <?php echo $first_row ? 'show' : ''; ?>"
                                data-parent="#accordion">
                                <div class="faq-body">
                                    <?php echo wp_kses_post($answer); ?>
                                </div>
                            </div>
                        </div>

                        <?php $first_row = false; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section><?php
            }
                ?>