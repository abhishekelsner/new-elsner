<?php
/**
 * Section: Dedicated Team
 * Layout key: dedicated_team_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout         = $args['layout'];
$team_title     = $layout['team_title']           ?? '';
$team_logo      = $layout['team_logo']            ?? '';
$dedicated_boxes = $layout['dedicated_box']       ?? array();
$bottom_text    = $layout['dedicate_botton_title'] ?? '';
$bottom_link    = $layout['dedicate_bottom_link']  ?? array();

if ( ! $team_title && empty( $dedicated_boxes ) ) {
    return;
}

// Build bottom link attributes — using the correct variable (bug fix).
$bottom_url    = ! empty( $bottom_link['url'] )    ? esc_url( $bottom_link['url'] )    : '';
$bottom_label  = ! empty( $bottom_link['title'] )  ? esc_html( $bottom_link['title'] ) : '';
$bottom_target = ! empty( $bottom_link['target'] ) ? esc_attr( $bottom_link['target'] ) : '';
?>

<section class="dedicated-section padding-80">
    <div class="container">

        <div class="section-header">
            <?php if ( $team_title ) : ?>
                <div class="section-title">
                    <h2><?php echo wp_kses_post( $team_title ); ?></h2>
                </div>
            <?php endif; ?>
            <?php if ( $team_logo ) : ?>
                <div class="section-logo">
                    <img src="<?php echo esc_url( $team_logo ); ?>"
                         alt="<?php echo esc_attr( $team_title ); ?>">
                </div>
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $dedicated_boxes ) ) : ?>
            <div class="dedicated-main-wrapper">
                <div class="row">
                    <?php foreach ( $dedicated_boxes as $box ) :
                        $box_image       = $box['box_image']       ?? array();
                        $box_title       = $box['box_title']       ?? '';
                        $box_description = $box['box_description'] ?? '';
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="dedicated-box">

                                <?php if ( ! empty( $box_image['url'] ) ) : ?>
                                    <div class="dedicated-img">
                                        <img src="<?php echo esc_url( $box_image['url'] ); ?>"
                                             alt="<?php echo esc_attr( $box_image['alt'] ?? $box_title ); ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="dedicated-content-wrapper">
                                    <?php if ( $box_title ) : ?>
                                        <div class="dedicated-title">
                                            <h3><?php echo esc_html( $box_title ); ?></h3>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( $box_description ) : ?>
                                        <ul>
                                            <?php echo wp_kses_post( $box_description ); ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <?php if ( $bottom_text || $bottom_url ) : ?>
        <div class="nav-migrate">
            <div class="nav-migrates-wrapper">
                <?php if ( $bottom_text ) : ?>
                    <p class="why-choose-title"><?php echo wp_kses_post( $bottom_text ); ?></p>
                <?php endif; ?>
                <?php if ( $bottom_url ) : ?>
                    <a href="<?php echo $bottom_url; ?>"
                       class="why-choose-cta"
                       <?php echo $bottom_target ? 'target="' . $bottom_target . '"' : ''; ?>>
                        <?php echo $bottom_label; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

</section>
