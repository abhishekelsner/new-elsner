<?php
// Retrieve the post ID from the $args array
global $contact_form, $contact_us_link, $post;
$post_id = $args['post_id'];
$form_heading   = get_field('form_heading', $post_id);
$form_content   = get_field('form_content', $post_id);

?>

<section class="elsner-life-events">
    <div class="container">
        <div class="filter-list">
            <div class="category-filter white-filter">
                <?php if (have_rows('category_button', $post_id)) : ?>
                <?php while (have_rows('category_button', $post_id)) : the_row(); ?>
                <button type="button" class="filter-btn" data-toggle="modal" data-target="#reviewModal">
                    <?php echo esc_html(get_sub_field('category_button_name', $post_id)); ?>
                </button>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="package-block-wrapper">
            <div class="row">
                <?php $count = count(get_field('package', $post_id)); ?>
                <?php if (have_rows('package', $post_id)) : ?>
                <?php while (have_rows('package', $post_id)) : the_row(); ?>

                <div
                    class="<?php echo ($count === 3) ? 'col-lg-4 col-md-6 col-sm-6' : 'col-xl-3 col-lg-6 col-md-6 col-sm-6'; ?>">
                    <div class="package-block <?php $checked = get_sub_field('recommanded', $post_id);
                                                        if ($checked) {
                                                            echo 'active';
                                                        } ?>">
                        <div class="package-recomended">
                            <p>RECOMMENDED</p>
                        </div>
                        <div class="package-heading">
                            <img src="<?php echo get_sub_field('image', get_the_ID()); ?>" alt="package-image"
                                width="60" height="60">
                            <h5><?php echo esc_html(get_sub_field('package_name', $post_id)); ?></h5>
                            <h3 class="price-number"><?php echo esc_html(get_sub_field('package_price', $post_id)); ?>
                            </h3>
                            <?php
                                $package_button_link = get_sub_field('package_button_link');

                                if (!empty($package_button_link)) {
                                    echo '<a href="' . esc_url($package_button_link) . '" class="btn btn-primary">Buy Now</a>';
                                } else {
                                    echo '<a href="/contact-us/" class="btn btn-primary">buy
                                    now</a>';
                                }
                                ?>
                            <!-- <a href="/contact-us" class="btn btn-primary">buy
                                now</a> -->
                        </div>
                        <div class="package-list">
                            <ul>
                                <?php if (have_rows('list', $post_id)) : ?>
                                <?php while (have_rows('list', $post_id)) : the_row(); ?>
                                <li><span
                                        class="list-span"><?php echo get_sub_field('package_list', $post_id); ?></span>
                                </li>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- The Modal -->
<div class="modal review-modal" id="reviewModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="request-form">
                    <h3 class="white-text">Get Sample Report</h3>
                    <div class="form-quote">
                        <?php echo do_shortcode('[contact-form-7 id="34823" title="Sample report"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>