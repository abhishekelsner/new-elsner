<?php
/**
 * Section: Recent Case Study / Projects
 * Layout key: recent_casestudy_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout      = $args['layout'];
$heading     = $layout['case_study_heading']     ?? '';
$description = $layout['case_study_description'] ?? '';
$cta         = $layout['case_study_cta']         ?? array();
$terms       = $layout['case_study_posts']       ?? array();

// Build CTA.
$cta_url    = ! empty( $cta['url'] )    ? esc_url( $cta['url'] )    : '#';
$cta_label  = ! empty( $cta['title'] )  ? esc_html( $cta['title'] ) : 'View All';
$cta_target = ! empty( $cta['target'] ) ? esc_attr( $cta['target'] ) : '';

// Collect term IDs from taxonomy field (returns objects or IDs depending on return_format).
$term_ids = array();
if ( ! empty( $terms ) ) {
    foreach ( $terms as $term ) {
        $term_ids[] = is_object( $term ) ? (int) $term->term_id : (int) $term;
    }
    $term_ids = array_unique( array_filter( $term_ids ) );
}

// Query.
$query_args = array(
    'post_type'      => array( 'case-study', 'portfolio' ),
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
);

if ( ! empty( $term_ids ) ) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'portfolio-technology',
            'field'    => 'term_id',
            'terms'    => $term_ids,
        ),
    );
}

$related = new WP_Query( $query_args );

if ( ! $related->have_posts() ) {
    return;
}
?>

<section class="featured-section new-services-dev padding-80">
    <div class="container">

        <div class="section-header">
            <?php if ( $heading ) : ?>
                <h2><?php echo wp_kses_post( $heading ); ?></h2>
            <?php endif; ?>
            <?php if ( $description ) : ?>
                <p><?php echo wp_kses_post( $description ); ?></p>
            <?php endif; ?>
            <div class="btn-wrapper">
                <a href="<?php echo $cta_url; ?>"
                   <?php echo $cta_target ? 'target="' . $cta_target . '"' : ''; ?>>
                    <?php echo $cta_label; ?>
                </a>
            </div>
        </div>

        <div class="featured-box">
            <div class="row">
                <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="featured-main-box">

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="image-wrapper">
                                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'full' ) ); ?>"
                                         alt="<?php echo esc_attr( get_the_title() ); ?>">
                                </div>
                            <?php endif; ?>

                            <div class="featured-main-content">
                                <div class="featured-title">
                                    <h3><?php the_title(); ?></h3>
                                </div>
                                <div class="rich-text">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="btn-featured">
                                    <a href="<?php the_permalink(); ?>" target="_blank">
                                        View Case Study
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>

    </div>
</section>
