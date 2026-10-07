<?php
/**
 * ACF Flexible Content Layout: Pricing Page Banner
 * Layout name: pricing_page_banner
 */
            // Fields
            $sub_title        = get_sub_field( 'sub_title' );
            $title            = get_sub_field( 'title' );
            $description      = get_sub_field( 'description' );
            $image_section    = get_sub_field( 'image_section' ); // Repeater
            $contact_form     = get_sub_field( 'contact_form' );  // e.g. shortcode or form ID
            $background_image = get_sub_field( 'background_image' );

            $bg_url = ! empty( $background_image['url'] ) ? esc_url( $background_image['url'] ) : '';
            $bg_alt = ! empty( $background_image['alt'] ) ? esc_attr( $background_image['alt'] ) : '';
            ?>

            <section
                class="ppb-banner"
                <?php if ( $bg_url ) : ?>
                    style="background-image: url('<?php echo $bg_url; ?>');"
                <?php endif; ?>
                aria-label="<?php esc_attr_e( 'Pricing Page Banner', 'textdomain' ); ?>"
            >
                <div class="ppb-banner__overlay"></div>

                <div class="ppb-banner__container container">

                    <!-- LEFT COLUMN: Text content -->
                    <div class="ppb-banner__content">

                        <?php if ( $sub_title ) : ?>
                            <span class="ppb-banner__subtitle"><?php echo esc_html( $sub_title ); ?></span>
                        <?php endif; ?>

                        <?php if ( $title ) : ?>
                            <h1 class="ppb-banner__title"><?php echo wp_kses_post( $title ); ?></h1>
                        <?php endif; ?>

                        <?php if ( $description ) : ?>
                            <p class="ppb-banner__description"><?php echo wp_kses_post( $description ); ?></p>
                        <?php endif; ?>

                        <!-- Image / Logo Repeater -->
                        <?php if ( $image_section ) : ?>
                            <div class="ppb-banner__images">
                                <?php foreach ( $image_section as $item ) :
                                    $img = ! empty( $item['image'] ) ? $item['image'] : null;
                                    if ( ! $img ) continue;
                                ?>
                                    <div class="ppb-banner__image-item">
                                        <img
                                            src="<?php echo esc_url( $img['url'] ); ?>"
                                            alt="<?php echo esc_attr( $img['alt'] ); ?>"
                                            width="<?php echo esc_attr( $img['width'] ); ?>"
                                            height="<?php echo esc_attr( $img['height'] ); ?>"
                                            loading="lazy"
                                        />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- CTA / Help button -->
                        <a href="#contact" class="ppb-banner__cta">
                            <?php esc_html_e( "Need Help? We're Live 24/7", 'textdomain' ); ?>
                        </a>

                    </div><!-- /.ppb-banner__content -->

                    <!-- RIGHT COLUMN: Contact Form -->
                    <?php if ( $contact_form ) : ?>
                        <div class="ppb-banner__form-wrap" id="contact">
                            <h2 class="ppb-banner__form-title">
                                <?php esc_html_e( 'Get Free Personalized Demo', 'textdomain' ); ?>
                            </h2>
                            <?php
                            // If contact_form holds a shortcode string e.g. [contact-form-7 id="123"]
                            echo do_shortcode( wp_kses_post( $contact_form ) );
                            ?>
                        </div>
                    <?php endif; ?>

                </div><!-- /.ppb-banner__container -->
            </section>