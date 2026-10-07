<?php
/**
 * Section: Why Choose (New — with feature list, LinkedIn posts, Clutch reviews)
 * Layout key: why_choose_new_section
 *
 * Merges the old why-choose-section-staging.php into one clean partial.
 * All ACF data comes from the flexible content layout row.
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout               = $args['layout'];
$top_heading          = $layout['why_choose_top_heading']    ?? '';
$view_all_link        = $layout['why_choose_view_all_link']  ?? array();
$title                = $layout['why_choose_title']          ?? '';
$text                 = $layout['why_choose_text']           ?? '';
$cta                  = $layout['why_choose_cta']            ?? array();
$image_url            = $layout['why_choose_image']          ?? '';
$feature_items        = $layout['why_choose_content_box']    ?? array();

// Bail early if nothing to show.
if ( ! $title && ! $text && ! $top_heading && empty( $feature_items ) ) {
    return;
}

// Build view-all link attributes safely.
$view_all_url    = ! empty( $view_all_link['url'] )    ? esc_url( $view_all_link['url'] )       : '';
$view_all_label  = ! empty( $view_all_link['title'] )  ? esc_html( $view_all_link['title'] )    : '';
$view_all_target = ! empty( $view_all_link['target'] ) ? esc_attr( $view_all_link['target'] )   : '';

// Build CTA attributes safely.
$cta_url    = ! empty( $cta['url'] )    ? esc_url( $cta['url'] )     : '';
$cta_label  = ! empty( $cta['title'] )  ? esc_html( $cta['title'] )  : '';
$cta_target = ! empty( $cta['target'] ) ? esc_attr( $cta['target'] ) : '';
?>

<?php echo do_shortcode( '[linkedin_posts]' ); ?>

<section class="why-choose-section">

    <?php if ( $top_heading || $view_all_url ) : ?>
        <div class="nav-migrate">
            <div class="nav-migrates-wrapper">
                <?php if ( $top_heading ) : ?>
                    <p class="why-choose-title"><?php echo wp_kses_post( $top_heading ); ?></p>
                <?php endif; ?>
                <?php if ( $view_all_url ) : ?>
                    <a href="<?php echo $view_all_url; ?>"
                       <?php echo $view_all_target ? 'target="' . $view_all_target . '"' : ''; ?>>
                        <?php echo $view_all_label; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="why-choose-wrapper">
        <div class="container">
            <div class="row why-choose-inner-block-box">

                <div class="col-12 col-md-4">
                    <?php if ( $title ) : ?>
                        <h2 class="why-choose-title"><?php echo esc_html( $title ); ?></h2>
                    <?php endif; ?>
                    <?php if ( $text ) : ?>
                        <p class="why-choose-desc"><?php echo wp_kses_post( $text ); ?></p>
                    <?php endif; ?>
                    <?php if ( $cta_url ) : ?>
                        <a href="<?php echo $cta_url; ?>"
                           class="why-choose-cta btn btn-secondary"
                           <?php echo $cta_target ? 'target="' . $cta_target . '"' : ''; ?>>
                            <?php echo $cta_label; ?>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if ( ! empty( $feature_items ) ) : ?>
                    <div class="col-12 col-md-5">
                        <ul class="why-choose-list">
                            <?php foreach ( $feature_items as $item ) :
                                $item_number = $item['itme_number'] ?? '';
                                $item_text   = $item['itme_text']   ?? '';
                            ?>
                                <li class="why-choose-item">
                                    <?php if ( $item_number ) : ?>
                                        <span class="item-number"><?php echo esc_html( $item_number ); ?></span>
                                    <?php endif; ?>
                                    <?php if ( $item_text ) : ?>
                                        <span class="item-text"><?php echo esc_html( $item_text ); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ( $image_url ) : ?>
                    <div class="col-12 col-md-3">
                        <div class="why-choose-image">
                            <img src="<?php echo esc_url( $image_url ); ?>"
                                 alt="<?php echo esc_attr( $title ); ?>">
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

</section>

<?php
// Clutch reviews slider — pulled dynamically from clutch_review CPT.
$clutch_query = new WP_Query( array(
    'post_type'      => 'clutch_review',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
) );

if ( $clutch_query->have_posts() ) : ?>
    <div class="new-services-clutch-wrapper">
        <h2 class="new-services-clutch-title">What Our Clients Says on Clutch</h2>
        <div class="container">
            <div class="new-services-clutch-slider">
                <?php while ( $clutch_query->have_posts() ) : $clutch_query->the_post(); ?>
                    <div class="new-services-clutch-review-box">
                        <div class="new-services-clutch-review-box-wrapper">

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="new-services-clutch-review-image">
                                    <?php the_post_thumbnail( 'medium', array( 'class' => 'img-fluid rounded-circle' ) ); ?>
                                </div>
                            <?php endif; ?>

                            <div class="new-services-clutch-review-title">
                                <div class="new-services-clutch-review-title-wrapper">
                                    <h3 class="new-services-reviewer-name">
                                        <?php echo esc_html( get_field( 'the_reviewer' ) ); ?>
                                    </h3>
                                    <p class="new-services-reviewer-position">
                                        <?php echo esc_html( get_field( 'reviewer_position' ) ); ?>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="new-services-clutch-review-content">
                            <div class="new-services-clutch-review-wrapper">
                                <p class="new-services-review-rating">
                                    <strong>
                                        Rating: <?php echo esc_html( number_format( (float) get_field( 'rating' ), 1 ) ); ?>
                                    </strong>
                                    <?php
                                    $rating     = (float) get_field( 'rating' );
                                    $star_image = get_template_directory_uri() . '/images/star-' . $rating . '.png';
                                    ?>
                                    <span class="star-<?php echo esc_attr( $rating ); ?>">
                                        <img src="<?php echo esc_url( $star_image ); ?>"
                                             alt="<?php echo esc_attr( $rating ); ?> stars">
                                    </span>
                                </p>
                                <div class="new-services-review-text">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                            <div class="slider-img-wrapper">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/powered-by-clutch.svg' ); ?>"
                                     alt="Powered by Clutch"
                                     height="30">
                            </div>
                        </div>

                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
