<?php
// Retrieve the post ID from the $args array
global $contact_us_link, $post;
$post_slug = $post->post_name;
$heading_title          = get_field('main_heading_premium_field', 'option');
if(is_page(36998)){
    $heading_title = str_replace('Services','', $heading_title);
}
if (str_contains($post_slug, 'services') || str_contains($post_slug, 'service')) {
    $post_slug = str_replace(['services', 'service'], '', $post_slug);
}
$section_title          = str_replace('%tech_name%', ucfirst($post_slug), $heading_title);
$remove_hyphen          = str_replace('-', ' ', $section_title);
?>

<?php if (get_field('main_heading_premium_field', 'option')) : ?>
<section class="solution-section padding-80">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo $remove_hyphen; ?></h2>
        </div>
        <?php if (!is_page(36998)) : ?>
        <div class="enterprise-wrapper">
            <div class="row">
                <?php if (have_rows('solutions_box', 'option')) : ?>
                <?php while (have_rows('solutions_box', 'option')) : the_row(); ?>
                <div class="col-lg-6 col-md-12">
                    <div class="solution-enterprise">
                        <p><?php echo esc_html('Solution for'); ?></p>
                        <h3><?php echo esc_html(get_sub_field('solution_heading', 'option')); ?></h3>
                        <div class="lottie">
                            <dotlottie-player src="<?php echo get_sub_field('solution_lottie_image', 'option'); ?>"
                                background="transparent" speed="1" loop autoplay width="300" height="300" />
                        </div>
                        <ul>
                            <?php if (have_rows('solution_list', 'option')) : ?>
                            <?php while (have_rows('solution_list', 'option')) : the_row(); ?>
                            <li><?php echo esc_html(get_sub_field('solution_list_name', 'option')); ?></li>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>