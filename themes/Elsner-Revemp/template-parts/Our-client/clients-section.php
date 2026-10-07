<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$client_button_text = get_field('client_button_text', $post_id);
global $contact_us_link;
?>

<section class="partner-alliances-section">
    <div class="container">
        <div class="client-testimonial">
            <?php
            $client_query = array(
                'post_type' => 'client',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $all_posts = new WP_Query($client_query);
            if ($all_posts->have_posts()) {
                while ($all_posts->have_posts()) {
                    $all_posts->the_post();

            ?>
                    <div class="testimonial-box client_box">
                        <div class="client-image">
                            <img  src="<?php echo get_the_post_thumbnail_url(); ?>" alt="user" height="150" loading="lazy">
                        </div>
                        <h5 class="Redhat-font"><?php echo esc_html(get_the_title()); ?></h5>
                        <p><?php echo esc_html(get_field('description')); ?></p>
                    </div>
            <?php
                }
            } else {
                echo '<div class="not_found">No Clients found.</div>';
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="view-all text-center">
            <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary"><?php echo $client_button_text; ?></a>
        </div>
    </div>
</section>