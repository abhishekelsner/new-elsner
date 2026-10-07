<?php
$bg_image = get_sub_field('faq_background_image');
$faq_title = get_sub_field('faq_title');
$faqs = get_sub_field('faqs');
$faq_cta = get_sub_field('faq_cta');
?>

<section class="faq-section" style="background:url('<?php echo esc_url($bg_image['url']); ?>'); background-position:top left;background-size: cover;">
  <div class="container">
    <div class="weekmate-faq-wrapper">
      <div class="faq-img-wrapper">
        <img src="<?php echo esc_url($bg_image['url']); ?>" alt="<?php echo esc_attr($bg_image['alt']); ?>" style="opacity:0;"/>
      </div>
      <div class="faq-box">
        <?php if ($faq_title): ?>
          <h2><?php echo esc_html($faq_title); ?></h2>
        <?php endif; ?>

        <?php if ($faqs): ?>
          <div class="accordion">
            <?php foreach ($faqs as $index => $faq): ?>
              <div class="accordion-item">
                <button class="accordion-header">
                  <?php echo esc_html($faq['question']); ?>
                </button>
                <div class="accordion-body">
                  <p><?php echo esc_html($faq['answers']); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>


        <?php if ($faq_cta): ?>
          <div class="faq-footer">
            <span>My question is not here.</span>
            <a href="<?php echo esc_url($faq_cta['url']); ?>" class="faq-btn" target="<?php echo esc_attr($faq_cta['target']); ?>">
              <?php echo esc_html($faq_cta['title']); ?>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>



