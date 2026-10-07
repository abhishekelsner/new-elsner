<?php
/**
 * Section: Featured Blog Posts
 * Layout key: blog_section
 *
 * Fixes:
 * - $args variable no longer overwritten (was destroying post_id).
 * - $page_link safely initialised before use.
 * - get_stylesheet / get_template_directory_uri consolidated.
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout            = $args['layout'];
$show_blog_section = ! empty( $layout['show_blog'] );
$category_id       = $layout['blog_post'] ?? '';

if ( ! $show_blog_section ) {
    return;
}

// Query args — avoid shadowing $args.
$blog_query_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 2,
    'post_status'    => 'publish',
);

if ( ! empty( $category_id ) ) {
    $blog_query_args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => (int) $category_id,
        ),
    );
}

$blog_query = new WP_Query( $blog_query_args );

// Resolve blog archive link safely.
$blog_page_link = '';
$blog_page      = get_page_by_path( 'blog' );
if ( $blog_page ) {
    $blog_page_link = get_permalink( $blog_page->ID );
}
// Fallback: use the WordPress posts page if no /blog slug exists.
if ( ! $blog_page_link ) {
    $posts_page_id = get_option( 'page_for_posts' );
    if ( $posts_page_id ) {
        $blog_page_link = get_permalink( $posts_page_id );
    }
}

$assets_uri = get_template_directory_uri() . '/assets/images';
?>

<section class="blog-section padding-80">
    <div class="container">

        <div class="block-title text-center max-700">
            <h2><?php echo esc_html( 'Explore our blogs' ); ?></h2>
        </div>

        <div class="service-blog-wrapper">
            <div class="row">
                <?php if ( $blog_query->have_posts() ) : ?>
                    <?php while ( $blog_query->have_posts() ) : $blog_query->the_post();
                        $categories = get_the_category();
                        $category_name = ! empty( $categories ) ? $categories[0]->name : '';
                        $author    = get_the_author();
                        $date      = get_the_date( 'd F, Y' );
                        $permalink = get_the_permalink();
                    ?>
                        <div class="col-md-6">
                            <div class="blog-card">

                                <a href="<?php echo esc_url( $permalink ); ?>">
                                    <div class="blog-image">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'full' ); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url( $assets_uri . '/blog.svg' ); ?>"
                                                 alt="blog image"
                                                 width="690"
                                                 height="auto">
                                        <?php endif; ?>
                                    </div>
                                </a>

                                <div class="blog-description">
                                    <a href="<?php echo esc_url( $permalink ); ?>">
                                        <?php if ( $category_name ) : ?>
                                            <span class="category"><?php echo esc_html( $category_name ); ?></span>
                                        <?php endif; ?>
                                        <h4><?php the_title(); ?></h4>
                                        <ul>
                                            <li><?php echo 'by ' . esc_html( $author ); ?></li>
                                            <li><?php echo esc_html( $date ); ?></li>
                                        </ul>
                                    </a>
                                    <a href="<?php echo esc_url( $permalink ); ?>" class="view-more">
                                        <img src="<?php echo esc_url( $assets_uri . '/up-icon.svg' ); ?>"
                                             alt="view more"
                                             width="15"
                                             height="15">
                                    </a>
                                </div>

                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="not_found">
                        <p><?php esc_html_e( 'No blog posts found.', 'your-theme' ); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ( $blog_page_link ) : ?>
                <div class="view-all text-center">
                    <a href="<?php echo esc_url( $blog_page_link ); ?>" class="btn btn-secondary">
                        VIEW ALL BLOGS
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
