<?php

function testimonial_shortcode()
{
    $testimonials = array(
        'post_type' => 'testimonial',
        'posts_per_page' => '3',

    );
    $testimonialquery = new WP_Query($testimonials);
    if ($testimonialquery->have_posts()) {
        while ($testimonialquery->have_posts()) {
            $testimonialquery->the_post(); ?>

            <div class="review-item">
                <div class="row">
                    <div class="col-md-6">
                        <div class="client-image">
                            <img src="<?php the_field('client_photo'); ?>" alt="client_photo" loading="lazy">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="client-description">
                            <img src="/wp-content/themes/elsner2019/images/quote-new.svg" alt="quote img" loading="lazy">
                            <div class="review">
                                <div class="testimonial__content">
                                    <?php
                                    $the_content = get_the_content();
                                    $trim_content = wp_trim_words($the_content, 45, '...'); // Trim content to 45 words

                                    if (!empty($trim_content)) {
                                        echo '<p>' . $trim_content;
                                        $word_count = str_word_count($the_content); // Get word count of original content
                                        if ($word_count > 45) {
                                            echo '<a href="https://www.elsner.com/clientele-and-testimonials/"> Read more</a>';
                                        }
                                        echo '</p>';
                                    } else {
                                        echo '<p>' . $trim_content . '</p>';
                                    }
                                    ?>
                                </div>
                                <h5><?php the_title(); ?></h5>
                                <h6><?php the_field('client_position'); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
    }
    wp_reset_postdata();
}
add_shortcode('testimonial', 'testimonial_shortcode');

function portfolios_shortcode($atts)
{

    $portfolios = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 10,
    );

    $portfolioquery = new WP_Query($portfolios);
    if ($portfolioquery->have_posts()) { ?>
        <div class="row">
            <?php while ($portfolioquery->have_posts()) {
                $portfolioquery->the_post(); ?>
                <div class="col-md-4 gal-item">
                    <div class="box">
                        <div class="workimg">

                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" class="project" loading="lazy" alt="project">
                            </a>
                        </div>
                        <h6><?php
                            $terms = get_the_terms($post->ID, array('platform'));
                            foreach ($terms as $term) {
                                echo $term->name;
                            }
                            ?></h6>

                        <p><?php the_title(); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php  } ?>
    <?php wp_reset_postdata();
}
add_shortcode('portfolio', 'portfolios_shortcode');


function portfolioslider_shortcode($atts)
{
    if (isset($atts['category'])) {
        $category = $atts['category'];
        $portfolioslider = array(
            'post_type' => 'portfolio',


            'tax_query' => array(
                array(
                    'taxonomy' => 'platform',
                    'field' => 'slug',
                    'terms' => $category,
                )
            )
        );
    } else {
        $portfolioslider = array(
            'post_type' => 'portfolio',
            'posts_per_page' => 10,
        );
    }
    $portfoliosliderquery = new WP_Query($portfolioslider);
    if ($portfoliosliderquery->have_posts()) { ?>

        <?php while ($portfoliosliderquery->have_posts()) {
            $portfoliosliderquery->the_post(); ?>
            <div class="service_desc">
                <div class="projects-image-section"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
                <h6><?php
                    $terms = get_the_terms($post->ID, array('platform'));
                    foreach ($terms as $term) {
                        echo $term->name;
                    }
                    ?></h6>
                <a href="<?php the_permalink(); ?>">
                    <p><?php the_title(); ?></p>
                </a>
            </div>
        <?php } ?>

    <?php  } ?>
<?php wp_reset_postdata();
}
add_shortcode('portfolio-slider', 'portfolioslider_shortcode');


function blog_shortcode($atts)
{

    if (isset($atts['category'])) {
        $category = $atts['category'];
        $blogs = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category,
                )
            )
        );
    } else {
        $blogs = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
        );
    }


    $blogsquery = new WP_Query($blogs); ?>

    <div class="row blogs">

        <?php if ($blogsquery->have_posts()) {
            while ($blogsquery->have_posts()) {
                $blogsquery->the_post(); ?>
                <div class="col-md-4">
                    <div class="blog-post">
                        <?php the_post_thumbnail(); ?>
                        <div class="blog-content">
                            <h5><?php the_title(); ?></h5>
                            <h6><?php the_date(); ?></h6>
                            <p><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>

            <?php } ?>
        <?php  } ?>
    </div>
    <?php wp_reset_postdata();
}

add_shortcode('blog', 'blog_shortcode');




function recent_posts_shortcode($atts, $content = NULL)
{
    $atts = shortcode_atts(
        [
            'orderby' => 'date',
            'posts_per_page' => '1',
            'order' => 'DESC'
        ],
        $atts,
        'recent-posts'
    );

    $query = new WP_Query($atts);

    while ($query->have_posts()) : $query->the_post(); ?>
        <div class="row alinc">
            <div class="col-md-5">
                <div class="blog-text">
                    <h2><?php the_title(); ?></h2>
                    <div class="date_time">
                        <a href="<?php the_permalink(); ?>"><img src="<?php the_field('calendar_image', 'option'); ?>" /alt=""><?php the_date(); ?></a>
                        <a href="<?php the_permalink(); ?>"> <img src="<?php the_field('eye_image', 'option'); ?>" /alt="">
                            <?php // echo do_shortcode('[views id="' . get_the_ID() . '"]'); 
                            ?> </a>

                    </div>
                    <p><?php echo wp_trim_words(get_the_content(), 90); ?></p>
                    <a href="<?php the_permalink(); ?>" class="read_more"><?php the_field('read_more_button', 'option'); ?></a>
                </div>
            </div>
            <div class="col-md-7">
                <div class="blogimg_right">
                    <?php the_post_thumbnail(); ?>
                </div>
            </div>
        </div>



    <?php endwhile;

    wp_reset_query();
}
add_shortcode('recent-posts', 'recent_posts_shortcode');

function blogpage_shortcode($atts)
{

    $mainblog = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC'

    );


    $blogsquery = new WP_Query($mainblog); ?>


    <?php if ($blogsquery->have_posts()) {
        while ($blogsquery->have_posts()) {
            $blogsquery->the_post(); ?>
            <div class="col-md-4">
                <div class="blog-post">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?>
                        <div class="blog-content">
                            <h5><?php the_title(); ?></h5>
                    </a>
                    <div class="date_time">
                        <a href="<?php the_permalink(); ?>"><img src="<?php the_field('calendar_image', 'option'); ?>" /alt=""><?php the_date(); ?></a>
                        <a href="<?php the_permalink(); ?>"><img src="<?php the_field('eye_image', 'option'); ?>" /alt="">
                            <?php //echo do_shortcode('[views id="' . get_the_ID() . '"]'); 
                            ?> </a>
                    </div>
                </div>
            </div>
            </div>


        <?php } ?>
    <?php  } ?>

<?php wp_reset_postdata();
}
add_shortcode('blog-page', 'blogpage_shortcode');
