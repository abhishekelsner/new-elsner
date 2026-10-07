<?php
/**
 * Page Builder Layout: Why Choose Us (why_choose_us)
 * Fields: section_label, heading, description, features (repeater: icon,
 *   title, description)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 *
 * Structure:
 * - First 2 cards: 2-column layout (Desktop)
 * - Remaining cards: 4-column layout (Desktop)
 * - Tablet: 2 columns
 * - Mobile: 1 column
 */

$section_label = get_sub_field( 'section_label' );
$heading       = get_sub_field( 'heading' );
$description   = get_sub_field( 'description' );
$features      = get_sub_field( 'features' );

$primary   = is_array( $features ) ? array_slice( $features, 0, 2 ) : array();
$secondary = is_array( $features ) ? array_slice( $features, 2 ) : array();
?>

<section class="why-section">
    <div class="container">

        <div class="sec-head reveal">
            <?php if ( $section_label ) : ?>
                <div class="eyebrow"><?php echo esc_html( $section_label ); ?></div>
            <?php endif; ?>

            <?php if ( $heading ) : ?>
                <h2><?php echo wp_kses_post( $heading ); ?></h2>
            <?php endif; ?>

            <?php if ( $description ) : ?>
                <p class="lead"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $primary ) ) : ?>
            <div class="row g-4 ">

                <?php foreach ( $primary as $idx => $feature ) :

                    $icon = $feature['icon'] ?? null;
                ?>

                    <div class="col-12 col-lg-6 mb-4 mb-sm-6 ">

                        <div class="why-section__card why-section__card--primary reveal"
                            <?php if ( $idx ) : ?>
                                data-d="<?php echo esc_attr( $idx ); ?>"
                            <?php endif; ?>>

                            <div class="row align-items-center">

                                <div class="col-12 col-lg-6 text-center text-md-start">

                                    <?php if ( ! empty( $icon['url'] ) ) : ?>
                                        <img class="ic"
                                            src="<?php echo esc_url( $icon['url'] ); ?>"
                                            alt="">
                                    <?php endif; ?>

                                </div>

                                <div class="col-12 col-lg-6">

                                    <h4><?php echo esc_html( $feature['title'] ); ?></h4>

                                    <p><?php echo esc_html( $feature['description'] ); ?></p>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        <?php endif; ?>


        <?php if ( ! empty( $secondary ) ) : ?>

            <div class="row g-4">

                <?php foreach ( $secondary as $idx => $feature ) :

                    $icon = $feature['icon'] ?? null;
                ?>

                    <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-sm-6">

                        <div class="why-section__card why-section__card--secondary reveal"
                            <?php if ( $idx ) : ?>
                                data-d="<?php echo esc_attr( $idx ); ?>"
                            <?php endif; ?>>

                            <?php if ( ! empty( $icon['url'] ) ) : ?>
                                <img class="ic"
                                    src="<?php echo esc_url( $icon['url'] ); ?>"
                                    alt="">
                            <?php endif; ?>

                            <h4><?php echo esc_html( $feature['title'] ); ?></h4>

                            <p><?php echo esc_html( $feature['description'] ); ?></p>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>
</section>