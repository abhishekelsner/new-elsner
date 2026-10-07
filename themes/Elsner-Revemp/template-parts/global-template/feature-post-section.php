<?php
$post_id            = $args['post_id'];
$featured_post   = get_field('blog_post', $post_id);
$show_blog_section  = get_field('show_blog', $post_id);

if (empty($featured_post)) :
    $featured_post = '';
endif;
if($show_blog_section === true){
?>
<section class="blog-section padding-80">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo esc_html('Explore our blogs');?></h2>
        </div>
        <div class="service-blog-wrapper">
            <div class="row">
                <?php

                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 2,
                );
                if (!empty($featured_post)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => $featured_post
                        ),
                    );
                }

                $projects_query = new WP_Query($args);
                if ($projects_query->have_posts()) {
                    while ($projects_query->have_posts()) {
                        $projects_query->the_post();
                        $category = get_the_category();
                        $category = get_the_category();
                        $author = get_the_author();
                        $date = get_the_date('d F, Y');

                        echo '<div class="col-md-6">';
                        echo '<div class="blog-card">';
                        echo '<a href="' . get_the_permalink() . '">';
                        echo '<div class="blog-image">';

                        if (has_post_thumbnail()) {
                            add_image_size('full', 0, 0, false);
                            the_post_thumbnail('full');
                        } else {
                            echo '<img  src="' . get_stylesheet_directory_uri() . '/assets/images/blog.svg" alt="blog image" width="690" height="auto" />';
                        }

                        echo '</div>';
                        echo '</a>';
                        echo '<div class="blog-description">';
                        echo '<a href="' . get_the_permalink() . '">';
                        echo '<span class="category">' . esc_html($category[0]->name) . '</span>';
                        echo '<h4>' . get_the_title() . '</h4>';
                        echo '<ul>';
                        echo '<li>by ' . esc_html($author) . '</li>';
                        echo '<li>' . esc_html($date) . '</li>';
                        echo '</ul>';
                        echo '</a>';
                        echo '<a href="' . get_the_permalink() . '" class="view-more">';
                        echo '<img  src="' . get_template_directory_uri() . '/assets/images/up-icon.svg" alt="view more" width="15" height="15">';
                        echo '</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                } else {
                    echo '<div class="not_found"><p>No projects found.</p></div>';
                }
                ?>
            </div>
            <div class="view-all text-center">
                <?php
                $page_slug = 'blog';
                $page = get_page_by_path($page_slug);
                if ($page) {
                    $page_link = get_permalink($page->ID);
                }
                echo '<a href="' . $page_link . '" class="btn btn-secondary">VIEW ALL BLOGS</a>';
                ?>
            </div>
        </div>
    </div>
</section>
<?php 
}