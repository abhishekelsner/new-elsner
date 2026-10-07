<?php
/**
 * Section: B2B Client Testimonial
 * Layout key: b2b_testimonial_section
 *
 * Testimonials are pulled dynamically from the 'testimonial' CPT.
 * Editors should tag testimonials to control which appear via a
 * dedicated taxonomy rather than hardcoded post IDs.
 *
 * If a testimonial_group taxonomy term is set in the layout,
 * only testimonials in that group are shown; otherwise all are shown.
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout           = $args['layout'];
$group_term_id    = ! empty( $layout['testimonial_group'] ) ? (int) $layout['testimonial_group'] : 0;

$query_args = array(
    'post_type'      => 'testimonial',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

if ( $group_term_id ) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'testimonial_group',
            'field'    => 'term_id',
            'terms'    => $group_term_id,
        ),
    );
}

$testimonials_query = new WP_Query( $query_args );

if ( ! $testimonials_query->have_posts() ) {
    return;
}
?>

<section class="b2b-client-testimonial blue-section">
    <div class="container">
        <div class="row alinc">

            <div class="col-md-12 col-sm-12 col-lg-4">
                <div class="brew-content">
                    <h2><span>Clients Testimonials</span></h2>
                    <p>Hear it from our loyal customers around the globe</p>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-lg-8">
                <div class="b2b-client-testimonials-slider slick-slider">
                    <?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
                        $rating = (int) get_field( 'rating' );
                        if ( $rating < 1 || $rating > 5 ) {
                            $rating = 4;
                        }
                        $testimonial_content = wp_trim_words( get_the_content(), 20, '&hellip;' );
                        $client_photo        = get_field( 'client_photo' );
                    ?>
                        <div class="user-slide">

                            <div class="review-data-slide">
                                <div class="description">
                                    <p><?php echo esc_html( $testimonial_content ); ?></p>
                                </div>
                                <p class="head_rate">
                                    <span class="rates">
                                        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                            <i class="fa <?php echo ( $i <= $rating ) ? 'fa-star' : 'fa-star-o'; ?>"></i>
                                        <?php endfor; ?>
                                    </span>
                                    (<?php echo esc_html( $rating ); ?>)
                                </p>
                            </div>

                            <div class="user-details-wrap">
                                <div class="user-img">
                                    <?php if ( $client_photo ) :
                                        $thumb = $client_photo['sizes']['thumbnail'] ?? '';
                                        $med   = $client_photo['sizes']['medium']    ?? '';
                                        $lrg   = $client_photo['sizes']['large']     ?? '';
                                        $alt   = $client_photo['alt']               ?? get_the_title();
                                    ?>
                                        <?php if ( $thumb ) : ?>
                                            <img src="<?php echo esc_url( $thumb ); ?>"
                                                 srcset="<?php echo esc_attr( "$med 600w, $lrg 1200w, $thumb 300w" ); ?>"
                                                 alt="<?php echo esc_attr( $alt ); ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="user-detail">
                                    <p class="name"><?php echo esc_html( get_the_title() ); ?></p>
                                </div>
                            </div>

                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>

        </div>
    </div>
</section>
