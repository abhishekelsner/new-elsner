<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$heading_hiring  = get_field('heading_hiring', $post_id);
$hiring_content  = get_field('hiring_content', $post_id);
$hiring_block    = get_field('hiring_block', $post_id);
?>
<section class="career-hiring">
    <div class="container">
        <div class="hiring-wrapper">
            <div class="hiring-head">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="heading-wrapper">
                            <h2><?php echo $heading_hiring; ?></h2>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="hiring-content max-700">
                            <p><?php echo $hiring_content; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hiring-desc-block">
                <?php echo $hiring_block; ?>
            </div>
        </div>
    </div>
</section>

<?php
$section_title    = get_field('contact_section_title');
$left_image       = get_field('contact_left_image');
$form_title       = get_field('contact_form_title');
$form_description = get_field('contact_form_description');
$form_shortcode   = get_field('contact_form_shortcode');
?>
<section id="hiring" class="contact-section">

  <?php if ($section_title) : ?>
    <h2 class="contact-main-title"><?php echo esc_html($section_title); ?></h2>
  <?php endif; ?>

  <div class="contact-inner">

    <?php if ($left_image) : ?>
      <div class="contact-image-col">
        <img
          src="<?php echo esc_url($left_image['url']); ?>"
          alt="<?php echo esc_attr($left_image['alt']); ?>"
          width="<?php echo esc_attr($left_image['width']); ?>"
          height="<?php echo esc_attr($left_image['height']); ?>"
        />
      </div>
    <?php endif; ?>

    <div class="contact-form-col">

      <?php if ($form_title) : ?>
        <h3 class="contact-form-title"><?php echo esc_html($form_title); ?></h3>
      <?php endif; ?>

      <?php if ($form_description) : ?>
        <p class="contact-form-desc"><?php echo wp_kses_post($form_description); ?></p>
      <?php endif; ?>

      <?php if ($form_shortcode) : ?>
        <div class="contact-form-wrap">
          <?php echo do_shortcode($form_shortcode); ?>
        </div>
      <?php endif; ?>

    </div>

  </div>
</section>