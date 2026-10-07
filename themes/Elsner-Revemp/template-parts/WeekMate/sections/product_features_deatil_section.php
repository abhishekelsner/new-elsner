<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$gradient_color_1 = get_field('gradient_color_1', $post_id);
$gradient_color_2 = get_field('gradient_color_2', $post_id);
$gradient_angle = get_field('gradient_angle', $post_id);
// Check if it's the homepage
$is_homepage = is_home() || is_front_page();
// Define the class based on the condition
global $post, $template;
$template_name = basename($template);

$section_class = $is_homepage ? 'section-padding' : 'padding-80';
$container_class = $is_homepage ? 'inner-container' : 'container';
$head_class = $is_homepage ? 'head' : 'head text-center';
?>
<section class="expertise-section <?php echo $template_name === 'services.php' ? 'padding-50': $section_class; ?> section " id="section1">
    <div class="brands <?php echo $container_class;?>">
        <div class="heading">
            <h2 class="<?php echo $head_class;?>">Trusted by <span>100+</span> companies</h2>
        </div>
        <ul>
            <?php if (have_rows('expertise_trustes_companies', 'option')) : ?>
            <?php while (have_rows('expertise_trustes_companies', 'option')) : the_row(); ?>
            <?php $image_id = get_sub_field('expertise_logo', 'option'); ?>
            <li>
                <img class="lazy" src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>" 
                alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                title="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                                    style="width: 100%; height: 100%;" loading="lazy">
            </li>
            <!-- <li>
                <img class="lazy" src="<?php //the_sub_field('expertise_logo', 'option'); ?>" alt="logo"
                    style="width: 100%; height:100%;" loading="lazy">
            </li> -->
            <?php endwhile; ?>
            <?php endif; ?>
        </ul>

    </div>
    <div class="expertise">
        <div class="heading">
            <?php echo get_field('section_title_expertise', $post_id); ?>
        </div>
        <div class="expertise-slider slider slick-slider">
            <?php
            if (have_rows('technologies')) : ?>
            <?php while (have_rows('technologies')) : the_row(); ?>
            <div class="technology-slide <?php echo the_sub_field('name'); ?>">
                <div class="tech-logo">
                    <img class="lazy" src="<?php the_sub_field('image'); ?>" alt="tech-logo" width="100" height="52"
                        loading="lazy">
                </div>
                <div class="description-tech">
                    <h3 class="tech-head"><?php the_sub_field('name', $post_id); ?></h3>
                    <?php
                            $post_object = get_sub_field('framework', $post_id);

                            if ($post_object) {

                                $post = $post_object;

                                $permalink = get_permalink($post->ID);

                                if (get_the_excerpt($post->ID)) {
                                    echo '<p>' . get_the_excerpt($post->ID) . '</p>';
                                } else {
                                    echo '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed magna ipsum dolor
                                    sit amet, consetetur sadipscing elitr, sed magna.</p>';
                                }

                                echo '<div class="link">';
                                echo '<a href="' . $permalink . '" class="arrow-link"><img  src="' . get_template_directory_uri() . '/assets/images/arrow.svg" alt="arrow" width="18" height="20" loading="lazy"></a>';
                                echo '</div>';
                                wp_reset_postdata();
                            } ?>

                </div>
                <div class="overlay-data">
                    <?php if (have_rows('hover_data', $post_id)) : ?>
                    <?php while (have_rows('hover_data', $post_id)) : the_row(); ?>
                    <div class="overlay">
                        <p><?php echo esc_html(get_sub_field('completed_projects', $post_id)); ?></p>
                        <h5><?php echo esc_html(get_sub_field('store_name', $post_id)); ?></h5>
                    </div>
                    <p><?php echo esc_html(get_sub_field('certified_developers', $post_id)); ?></p>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>