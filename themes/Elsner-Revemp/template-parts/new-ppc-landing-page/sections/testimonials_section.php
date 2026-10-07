<?php
$section_title = get_sub_field("section_title");
$testimonials = get_sub_field("testimonials");
?>

<section class="ppc-landing-testimonial-section">
  <div class="container">
    <?php if ($section_title): ?>
      <h2 class="testimonial-title">
        <?php echo $section_title; ?>
      </h2>
    <?php endif; ?>

  </div>
  <?php if ($testimonials): ?>
    <div class="testimonial-slider">
      <?php foreach ($testimonials as $testimonial): ?>
        <div class="testimonial-slider-block">
          <div class="testimonial-slider-description">
            <?php echo ($testimonial["quote"]); ?>
          </div>
          <div class="testimonial-slider-author-details">
            <div class="testimonial-slider-name">
              <?php echo ($testimonial["client_name"]); ?>
            </div>
            <div class="testimonial-slider-company">
              <?php echo ($testimonial["client_title_company"]); ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

