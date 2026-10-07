<?php
/**
 * Section: Why Choose (Blue — with counters)
 * Layout key: why_choose_blue_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout      = $args['layout'];
$show        = ! empty( $layout['show_yesno_request_business'] );
$heading     = $layout['why_choose_heading']            ?? '';
$description = $layout['why_choose_description']        ?? '';
$image_url   = $layout['why_choose_section_image']      ?? '';
$image_alt   = $layout['why_choose_section_image_alt_tag'] ?? '';
$counters    = $layout['counter']                       ?? array();

// Button is now ACF-driven from the layout to remove all is_page() hacks.
$button_text = $layout['why_choose_button_text'] ?? 'Start Project';
$button_link = $layout['why_choose_button_link'] ?? '';

if ( ! $show ) {
    return;
}
?>

<section class="why-choose-section blue-section">
    <div class="row m-0">

        <div class="col-md-6 p-0">
            <div class="why-choose-block request-quoteHead">

                <?php if ( $heading ) : ?>
                    <h2 class="Redhat-font"><?php echo wp_kses_post( $heading ); ?></h2>
                <?php endif; ?>

                <?php if ( $description ) : ?>
                    <div class="why-choose-content">
                        <?php echo wp_kses_post( $description ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $counters ) ) : ?>
                    <div class="counting-stats">
                        <div class="row">
                            <?php foreach ( $counters as $counter ) :
                                $number = $counter['counter_number'] ?? '';
                                $symbol = $counter['counter_symbol'] ?? '';
                                $label  = $counter['counter_text']   ?? '';
                            ?>
                                <div class="col-sm-6 service-stats">
                                    <div class="counter-col">
                                        <span class="timer"
                                              data-count="<?php echo esc_attr( $number ); ?>">
                                            <?php echo esc_html( $number ); ?>
                                        </span>
                                        <span><?php echo esc_html( $symbol ); ?></span>
                                        <h5><?php echo esc_html( $label ); ?></h5>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $button_link ) : ?>
                    <a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-secondary">
                        <?php echo esc_html( $button_text ); ?>
                    </a>
                <?php endif; ?>

            </div>
        </div>

        <?php if ( $image_url ) : ?>
            <div class="col-md-6 p-0">
                <div class="why-choose-image">
                    <img src="<?php echo esc_url( $image_url ); ?>"
                         alt="<?php echo esc_attr( $image_alt ); ?>"
                         width="950"
                         height="100%">
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
