<?php
$post_id            = $args['post_id'];
$page_title         = get_field('heading_why_hire', 'option');
$current_url        = isset($_SERVER['REQUEST_URI']) ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])) : '';
$parts              = explode('-', $current_url);
$value              = isset($parts[1]) ? preg_replace('/[^a-zA-Z0-9_]/', '', $parts[1]) : '';

if($value == 'mern')
{
    $page_title = str_replace('%page_title%', strtoupper($value), $page_title);
}
else{
    $page_title = str_replace('%page_title%', ucfirst($value), $page_title);
}

$page_excerpt       = str_replace('%page_title%', ($value == 'mern' ? strtoupper($value) : ucfirst($value)), get_field('content_why_hire', 'option'));
$hire_gif           = get_field('why_hire_gif', 'option');
$link           = get_field('hire_developer_link', 'option');
?>
<section class="why-hire-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="why-hire-heading">
                    <div class="heading-wrapper text-left">
                        <h2 class="Redhat-font"><?php echo esc_html($page_title); ?> <br> <span></span></h2>
                        <h6><?php echo esc_html($page_excerpt); ?></h6>
                    </div>
                    <div class="why-hire-gif">
                        <dotlottie-player src="<?php echo $hire_gif; ?>" background="transparent" speed="1" loop
                            autoplay />
                    </div>
                    <a href="<?php echo esc_url($link); ?>" class="btn btn-secondary">
                    <?php
                        if (is_page('hire-magento-developer')) {
                            echo esc_html('Hire Magento Developer');
                        } elseif (is_page('hire-shopify-developer')) {
                            echo esc_html('SHOPIFY EXPERT DEVELOPER');
                        } elseif (is_page('hire-wordpress-developer')) {
                            echo esc_html('HIRE WORDPRESS DEVELOPERS');
                        } elseif (is_page('hire-ecommerce-developer')) {
                            echo esc_html('ECOMMERCE EXPERT DEVELOPER');
                        } elseif (is_page('hire-bigcommerce-developer')) {
                            echo esc_html('HIRE BIGCOMMERCE EXPERT');
                        } elseif (is_page('hire-reactjs-developer')) {
                            echo esc_html('HIRE REACTJS DEVELOPERS');
                        }elseif (is_page('hire-odoo-developers')) {
                            echo esc_html('HIRE ODOO DEVELOPER');
                        }else {
                            echo esc_html('Hire Developer');
                        }
                        ?>
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">

                    <?php if (have_rows('hire_block', 'option')) : ?>
                    <?php $row_count = 1; ?>
                    <?php while (have_rows('hire_block', 'option')) : the_row(); ?>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="hire-num">
                            <span><?php echo str_pad($row_count, 2, '0', STR_PAD_LEFT); ?></span>
                        </div>
                        <div class="hire-title">
                            <h4><?php the_sub_field('label'); ?></h4>
                            <p><?php echo esc_html(str_replace('%tech_name%', ($value == 'mern' ? strtoupper($value) : ucfirst($value)), get_sub_field('description'))); ?>
                        </div>
                    </div>
                    <?php $row_count++; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>
