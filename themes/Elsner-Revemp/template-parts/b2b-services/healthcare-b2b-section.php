<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
$why_choose_b2b_title = get_field('why_choose_b2b_title', $post_id);
$why_choose_b2b_content = get_field('why_choose_b2b_content', $post_id);
$why_choose_b2b_button = get_field('why_choose_b2b_button', $post_id);
?>

<section class="custom-healthcare blue-section padding-80">
    <div class="container">
        <div class="heading-wrapper white-text">
            <h2><?php echo $why_choose_b2b_title; ?></h2>
            <p><?php echo $why_choose_b2b_content; ?></p>
        </div>
        <div class="healthcare-solutions white-text">
            <div class="row">
                <?php if (have_rows('why_choose_b2b_repeater', $post_id)) : ?>
                <?php while (have_rows('why_choose_b2b_repeater', $post_id)) : the_row();
                $why_choose_b2b_repeater_icon = get_sub_field('why_choose_b2b_repeater_icon', $post_id); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="healthcare-box">
                        <img src="<?=$why_choose_b2b_repeater_icon?>" />
                        <h6 class="Redhat-font">
                            <?php echo esc_html(get_sub_field('why_choose_b2b_repeater_heading', $post_id)); ?></h6>
                        <p><?php echo esc_html(get_sub_field('why_choose_b2b_repeater_content', $post_id)); ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="health-care-bottom-btn"><a href="#b2b-contact-form" class="btn btn-secondary"><?=$why_choose_b2b_button ?>
            </a></div>
    </div>
</section>