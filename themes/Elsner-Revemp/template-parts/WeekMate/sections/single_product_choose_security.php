<?php
$heading = get_sub_field('heading');
$heading_2 = get_sub_field('heading_2');
$description = get_sub_field('description');

?>

<section class="weekmate-single-product-hero-section custom-py-50" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
  <div class="container">
    <div class="hero-section-wrapper text-with-bg-section">
      <div class="text-with-bg-wrapper">
        <div class="heading">
          <h2> 
            <span><?php echo $heading; ?> </span>
            <span> <?php echo $heading_2; ?> </span>
          </h2>
          </div>
          <div class="hero-section-paragraph">
            <?php echo $description; ?>
          </div>
        </div>
     </div>
  </div>
</section>


