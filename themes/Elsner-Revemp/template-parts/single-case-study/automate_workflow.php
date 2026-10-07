<?php  
// Get fields
$heading       = get_sub_field('heading'); 
$sub_heading   = get_sub_field('sub_heading'); 
$cta1          = get_sub_field('cta1'); 
$cta2          = get_sub_field('cta2'); 
$contact_block = get_sub_field('contact_blocks'); // Repeater
?>

<section class="new-case-study-work-flow-contact-section">
  <div class="container">

    <?php if( $heading ): ?>
      <h2 class="work-flow-contact-heading"><?php echo esc_html($heading); ?></h2>
    <?php endif; ?>

    <?php if( $sub_heading ): ?>
      <p class="contact-subheading"><?php echo esc_html($sub_heading); ?></p>
    <?php endif; ?>

    <!-- CTA Buttons -->
    <div class="contact-cta">
      <?php if( $cta1 ): ?>
        <a href="<?php echo esc_url($cta1['url']); ?>" target="<?php echo esc_attr($cta1['target'] ?: '_self'); ?>" class="btn btn-primary">
          <?php echo esc_html($cta1['title']); ?>
        </a>
      <?php endif; ?>

      <?php if( $cta2 ): ?>
        <a href="<?php echo esc_url($cta2['url']); ?>" target="<?php echo esc_attr($cta2['target'] ?: '_self'); ?>" class="btn btn-secondary">
          <?php echo esc_html($cta2['title']); ?>
        </a>
      <?php endif; ?>
    </div>

    <!-- Contact Blocks -->
    <?php if( $contact_block ): ?>
      <div class="contact-blocks">
        <?php foreach( $contact_block as $block ): ?>
          <?php 
            $icon  = $block['icon'];
            $title = $block['title'];
            $text  = $block['text'];
          ?>
          <div class="contact-item">
            <?php if($icon): ?>
              <img class="contact-icon" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
            <?php endif; ?>

            <?php if($title): ?>
              <h4 class="contact-title"><?php echo esc_html($title); ?></h4>
            <?php endif; ?>

            <?php if($text): ?>
              <p class="contact-text"><?php echo esc_html($text); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
