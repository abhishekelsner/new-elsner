<?php 
$certifications_title = get_sub_field('certifications_title');
$certifications_title_2 = get_sub_field('certifications_title_2');

?>
<section class ="tmp-new-service-award-section">
  <div class="container">
    <div class="tmp-new-service-award-wrapper">
      <div class="title">
        <h4><?php echo $certifications_title; ?><span><?php echo $certifications_title_2; ?></span></h4>
      </div>
  <?php if (have_rows('certifications_item')) : ?>
    <div class="certifications-slider-wrapper">
      <div class="certifications-slider" id="certSlider">
        <?php while (have_rows('certifications_item')) : the_row();
          $image = get_sub_field('images');
          if ($image) :
        ?>
          <div class="certification-slide">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          </div>
        <?php endif; endwhile; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
</div>
</section>




