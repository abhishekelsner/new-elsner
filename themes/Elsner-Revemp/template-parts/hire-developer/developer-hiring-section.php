<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
$show_section  = get_field('show_section_hire', $post_id);


if ($show_section === true) {
?>

<section class="why-choose-section skyblue-section">
    <div class="row m-0">
        <div class="col-md-6 p-0">
            <div class="why-choose-block request-quoteHead">
                <h2 class="Redhat-font"><?php echo get_field('why_choose_heading', $post_id); ?></h2>
                <div class="why-choose-content">
                    <?php echo get_field('why_choose_description', $post_id); ?>
                </div>
                <?php
                    $current_slug = get_post_field('post_name', get_post());
                    $button_text = 'Talk to us';
                    if ($current_slug === 'hire-wordpress-developer') {
                        $button_text = 'SPEAK TO WORDPRESS EXPERT';
                    } elseif ($current_slug === 'hire-shopify-developer') {
                        $button_text = 'CHAT WITH SHOPIFY EXPERT';
                    } elseif ($current_slug === 'hire-ecommerce-developer') {
                        $button_text = 'CONNECT WITH ECOMMERCE EXPERT';
                    } elseif ($current_slug === 'hire-bigcommerce-developer') {
                        $button_text = 'CHAT WITH BIGCOMMERCE EXPERT';
                    } elseif ($current_slug === 'hire-reactjs-developer') {
                        $button_text = 'SPEAK WITH REACTJS EXPERT';
                    } elseif ($current_slug === 'hire-magento-developer') {
                        $button_text = 'Hire Magento Developer ';
                    }elseif ($current_slug === 'hire-odoo-developers') {
                        $button_text = 'HIRE ODOO DEVELOPER';
                    }
                    ?>
                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary"><?php echo esc_html($button_text); ?></a>
            </div>
        </div>
        <div class="col-md-6 p-0">
            <div class="why-choose-image">
                <img src="<?php echo get_field('why_choose_section_image', $post_id); ?>" alt="Why choose images"
                    width="950" height="100%">
            </div>
        </div>
    </div>
</section>

<?php
}
?>