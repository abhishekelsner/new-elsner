<?php
/**
 * Section: FAQ
 * Layout key: faq_section
 *
 * Fixes:
 * - Accordion IDs now use sanitize_title() instead of raw str_replace,
 *   preventing broken or injectable HTML from special characters in questions.
 * - Unique prefix added so multiple FAQ sections on one page don't conflict.
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout    = $args['layout'];
$show      = ! empty( $layout['show_yesno'] );
$faq_items = $layout['faq'] ?? array();

if ( ! $show || empty( $faq_items ) ) {
    return;
}

// Unique prefix for accordion IDs to avoid conflicts with multiple FAQ sections.
$accordion_id = 'faq-accordion-' . uniqid();
?>

<section class="faq-section padding-80 blue-section">
    <div class="container">

        <div class="block-title text-center max-700">
            <h2 style="color:white;"><?php esc_html_e( 'Frequently Asked Questions', 'your-theme' ); ?></h2>
        </div>

        <div class="faq-wrapper">
            <div id="<?php echo esc_attr( $accordion_id ); ?>">
                <?php foreach ( $faq_items as $index => $item ) :
                    $question  = $item['faq_question'] ?? '';
                    $answer    = $item['faq_answer']   ?? '';
                    $is_first  = ( $index === 0 );

                    // Use sanitize_title for safe, slug-friendly IDs.
                    $item_id = $accordion_id . '-' . sanitize_title( $question ) . '-' . $index;
                ?>
                    <div class="faq_card">
                        <div class="faq-header">
                            <a class="<?php echo $is_first ? '' : 'collapsed'; ?> card-link"
                               data-toggle="collapse"
                               href="#<?php echo esc_attr( $item_id ); ?>"
                               aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                               aria-controls="<?php echo esc_attr( $item_id ); ?>">
                                <?php echo esc_html( $question ); ?>
                            </a>
                        </div>
                        <div id="<?php echo esc_attr( $item_id ); ?>"
                             class="collapse <?php echo $is_first ? 'show' : ''; ?>"
                             data-parent="#<?php echo esc_attr( $accordion_id ); ?>">
                            <div class="faq-body">
                                <?php echo wp_kses_post( $answer ); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
