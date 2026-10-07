<?php
$post_id            = $args['post_id'];
$featured_project   = get_field('recent_project', $post_id);
$show_recent_project_section = get_field('show_recent_project_section', $post_id);
$shopify_growth_projects = is_page('shopify-growth-plan') ? 'padding-80' : 'padding-120';

if (empty($featured_project)) {
    $featured_project = '';
}

$current_url        = $_SERVER['REQUEST_URI'];
$parts              = explode('-', $current_url);
$value              = $parts[1];
$term_name          = get_term_by('id', $featured_project, 'portfolio-technology');

if (empty($term_name)) {

    $term_name = get_term_by('id', $featured_project, 'platform');

    if (empty($term_name)) {
        $page_slug = 'our-portfolio';
        $page = get_page_by_path($page_slug);
        if ($page) {
            $term_link = get_permalink($page->ID);
        }
        $term_name = '';
    } else {
        $term_name = $term_name->name;
        $term_link = get_term_link($featured_project, 'platform');
        $term_link = str_replace('platform', 'our-portfolio', $term_link);
    }
} else {
    $term_name = $term_name->name;
    $term_link = get_term_link($featured_project, 'portfolio-technology');
    $page      = url_to_postid($term_link);
    if (!$page) {
        $page_slug = 'our-portfolio';
        $page = get_page_by_path($page_slug);
        if ($page) {
            $term_link = get_permalink($page->ID);
            $term_name = '';
        }
    } else {
        $term_link = str_replace('portfolio-technology', 'our-portfolio', $term_link);
    }
}
$args = array(
    'post_type'      => 'portfolio',
    'posts_per_page' => 3,
);
if (!empty($featured_project)) {
    $args['tax_query'] = array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'portfolio-technology',
            'field'    => 'term_id',
            'terms'    => $featured_project,
        ),
        array(
            'taxonomy' => 'platform',
            'field'    => 'term_id',
            'terms'    => $featured_project,
        ),
    );
}
$projects_query = new WP_Query($args);
?>

<?php if($show_recent_project_section === true): ?>
<section class="featured-projects <?=$shopify_growth_projects?>">
    <div class="container">
        <div class="heading flex">
            <h2 class="heading2">Recent Projects</h2>
            <div class="all-project">
                <?php
                if ($projects_query->have_posts()) {
                    echo '<a href="' . $term_link . '" class="all-link">All ' . $term_name . ' Projects</a>';
                } else {
                    $page_slug = 'our-portfolio';
                    $page = get_page_by_path($page_slug);
                    if ($page) {
                        $term_link = get_permalink($page->ID);
                    }
                    echo '<a href="' . $term_link . '" class="all-link">All Projects</a>';
                } ?>
            </div>
        </div>
        <div class="services-project-wrapper">
            <div class="project-box">
                <div class="row">
                    <?php


                    if ($projects_query->have_posts()) {
                        while ($projects_query->have_posts()) {
                            $projects_query->the_post();
                            $tags = get_the_terms(get_the_ID(), 'portfolio-tag');
                            $tag_list = '';
                            if ($tags && !is_wp_error($tags)) {
                                foreach ($tags as $tag) {
                                    $tag_list .= '<li>' . '#' . $tag->name . '</li>';
                                }
                            }
                    ?>
                    <div class="col-md-4">
                        <div class="projects">
                            <?php echo '<a href="' . get_the_permalink() . '">'; ?>
                            <div class="project-img">
                                <?php
                                        if (has_post_thumbnail()) {
                                            add_image_size('full', 0, 0, false);
                                            the_post_thumbnail('full');
                                        } else {
                                            echo '<img  src="' . get_template_directory_uri() . '/assets/images/default-image.jpg" alt="project image" height="400" width="450" loading="lazy">';
                                        }
                                        ?>
                                <div class="hover-project">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sticky-logo.svg"
                                        alt="logo" width="40" height="40" loading="lazy">
                                    <ul>
                                        <?php
                                                $portfolio_categories = get_the_terms(get_the_ID(), 'platform');
                                                if ($portfolio_categories) {
                                                    foreach ($portfolio_categories as $category) {
                                                        echo '<li>#' . $category->name . '</li>';
                                                    }
                                                }
                                                ?>
                                    </ul>
                                </div>
                            </div>
                            </a>
                            <div class="project-description">
                                <?php echo '<a href="' . get_the_permalink() . '">'; ?>
                                <h4><?php the_title(); ?></h4>
                                <?php add_filter('excerpt_length', 'custom_excerpt_length'); ?>
                                <?php the_excerpt(); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<div class="not_found"><p>No projects found.</p></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;?>