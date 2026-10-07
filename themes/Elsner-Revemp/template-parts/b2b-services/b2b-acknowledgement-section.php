<?php 
$post_id = $args['post_id']; ?>
<section class="acknowledgement-section">
    <div class="container">
        <div class="acknowledgement-slider slick-slider slider">
            <?php 
            if(is_page('digital-marketing-solutions-for-agency-partners')){
            if (have_rows('acknowledgement_block', 'option')) : ?>
            <?php while (have_rows('acknowledgement_block', 'option')) : the_row(); ?>
            <div class="slider-image">
                <img src="<?php echo esc_url(get_sub_field('image', 'option')); ?>" loading="lazy"
                    alt="acknowledgement logo" width="120">
            </div>
            <?php endwhile; ?>
            <?php endif;
            }
            else{
                if (have_rows('b2b_web_development_clients_repeater', $post_id)) : ?>
            <?php while (have_rows('b2b_web_development_clients_repeater', $post_id)) : the_row(); ?>
            <div class="slider-image">
                <img src="<?php echo esc_url(get_sub_field('b2b_web_development_clients', $post_id)); ?>" loading="lazy"
                    alt="acknowledgement logo" width="120">
            </div>
            <?php endwhile; ?>
            <?php endif;
            } 
            ?>
        </div>
    </div>
</section>