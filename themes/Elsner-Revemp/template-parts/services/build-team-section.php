<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
$build_team_lottie  = get_field('build_team_lottie', $post_id);
$button_text = get_field('button_text', $post_id);
$show_build_team_section = get_field('show_build_team_section', $post_id);
if (!$button_text) {
    $button_text = 'SCHEDULE A DEVELOPER INTERVIEW';
}
$schedule_interview_url = is_page('pimcore-development') ? '#service-request-quote' : $contact_us_link;
?>

<?php if (get_field('build_team_heading')) : ?>
<?php if($show_build_team_section === true): ?>
<section class="dedicated-dreams padding-80 blue-section">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo get_field('build_team_heading', $post_id); ?></h2>
        </div>
        <div class="dedicated-development">
            <div class="hours-dedicated">
                <h3><?php echo get_field('dedicated_hours', $post_id); ?></h3>
                <h4><?php echo get_field('dedicate_hour_name', $post_id); ?></h4>
            </div>
            <div class="dedicated-row">
                <div class="dedicated-img">
                    <dotlottie-player src="<?php echo get_template_directory_uri() . '/assets/lotties/build.lottie'; ?>"
                        background="transparent" speed="1" loop autoplay></dotlottie-player>
                </div>
                <div class="dedicated-content">
                    <p><?php echo get_field('build_team_description', $post_id); ?></p>
                </div>
            </div>
            <div class="schedule-developer">
                <a href="<?php echo esc_url($schedule_interview_url); ?>"
                    class="btn btn-secondary btn-schedule"><?php echo $button_text; ?></a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>