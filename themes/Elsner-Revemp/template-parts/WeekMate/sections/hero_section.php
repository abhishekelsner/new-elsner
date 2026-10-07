<?php
$title = get_sub_field('hero_title');
$subtitle = get_sub_field('hero_subtitle');
$subtitle2 = get_sub_field('subtitle2');
$description = get_sub_field('hero_description');
$button = get_sub_field('hero_button_text');
$background_image = get_sub_field('hero_background_image');
?>

<section class="weekmate-hero-section" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
  <div class="container">
    <div class="hero-section-wrapper">

      <div class="heading">

        <h1><span class="thin-heading"> <?php echo esc_html($title); ?> </span><span class="gradient-heading"><?php echo esc_html($subtitle); ?></span> <span class="dark-heading"><?php echo esc_html($subtitle2); ?></span></h1>
      </div>
      <div class="hero-section-paragraph">
        <?php echo $description; ?>
      </div>
      <?php if ($button):
        $button_url = $button['url'];
        $button_title = $button['title'];
        $button_target = $button['target'] ? $button['target'] : '_self';
      ?>
        <div class=" weekmate-button">

          <a href="<?php echo esc_url($button_url); ?>"
            class="btn"
            target="<?php echo esc_attr($button_target); ?>">
            <?php echo esc_html($button_title); ?>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>


