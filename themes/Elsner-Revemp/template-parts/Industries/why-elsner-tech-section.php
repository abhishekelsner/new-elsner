<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
$why_hire_heading = get_field('why_hire_heading', $post_id);
$why_hire_content = get_field('why_hire_content', $post_id);
?>

<section class="why-elsner-tech padding-80 blue-section">
    <div class="container">
        <div class="heading-wrapper white-text text-left">
            <h2><?php echo $why_hire_heading; ?><span class="title-icon"> <img src="<?php echo get_template_directory_uri() . '/assets/images/industries/launch-icon.svg'; ?>"
                            alt="launch icon" width="50" height="50" /></span></h2>
            <p><?php echo $why_hire_content; ?></p>
        </div>
        <div class="why-elsner-row">
            <div class="row">
                <?php if (have_rows('why_hire_box', $post_id)) : ?>
                    <?php while (have_rows('why_hire_box', $post_id)) : the_row(); ?>
                        <div class="col-md-6">
                            <div class="why-elsner">
                                <div class="why-tech-img">
                                    <img  alt="tech img" loading="lazy" src="<?php echo get_sub_field('hire_image', get_the_ID()); ?>" width="60">
                                </div>
                                <h4><?php echo esc_html(get_sub_field('hire_title', $post_id)); ?></h4>
                                <p><?php echo esc_html(get_sub_field('hire_content', $post_id)); ?></p>
                            </div>
                        </div>
                    <?php endwhile ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>