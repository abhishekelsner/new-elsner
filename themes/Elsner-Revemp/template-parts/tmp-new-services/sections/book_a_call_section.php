<?php
$title = get_sub_field('section_title');
$left_title = get_sub_field('left_title');
$left_desc = get_sub_field('left_description');
$email_text = get_sub_field('email_text');
$email_link = get_sub_field('email_link');
$left_image = get_sub_field('left_image');
$call_title = get_sub_field('call_title');
$call_duration = get_sub_field('call_duration');
$call_platform = get_sub_field('call_platform');
$call_timezone = get_sub_field('call_timezone');
$request_form = get_sub_field('booking_form'); // <-- this was missing
$calendar_iframe = get_sub_field('calendar_iframe');
$expert_image = get_sub_field('expert_image');
$expert_name = get_sub_field('expert_name');
?>

<?php if ($title || $left_title || $left_desc): ?>
<section class="book-call-section">
  <div class="book-call-section-bg-img">
    <img src="https://www.elsner.com/wp-content/uploads/2025/08/Image-1-1-1.png" alt="">
  </div>
  <div class="container">
    <div class="book-call-section-heading">
      <?php if ($title): ?>
      <div class="section-heading">
        <p class="sub-heading">Book a Call</p>
        <h2>
          <?php echo esc_html($title); ?>
        </h2>
      </div>
      <?php endif; ?>
    </div>
    <div class="book-call-wrapper">
      <div class="book-call-left">
        <div class="book-call-host-details">
          <?php if ($left_title): ?>
          <h3>
            <?php echo esc_html($left_title); ?>
          </h3>
          <?php endif; ?>

          <?php if ($left_desc): ?>
          <h5>
            <?php echo esc_html($left_desc); ?>
          </h5>
          <?php endif; ?>

          <?php if ($email_text && $email_link): ?>
          <p>
            <?php echo esc_html($email_text); ?>
          </p>
          <div>Or send me an email at <br>
            <a href="mailto:<?php echo esc_attr($email_link); ?>">pankaj@elsner.com
            </a>
          </div>
          <?php endif; ?>
        </div>
        <?php if ($left_image): ?>
        <div class="book-call-content-background-img">
          <img src="<?php echo esc_url($left_image); ?>" alt="Contact Person" />
        </div>
        <?php endif; ?>
        <div class="book-call-host-image">
          <img
            src="https://www.elsner.com/wp-content/uploads/2025/08/Pankaj_1_1747736286998_1754303482275-1.png"
            alt="host-img" class="host-img">
        </div>
      </div>

      <div class="book-call-right">
        
        <?php if ($calendly_embed): ?>
        <div class="calendly-embed">
          <?php echo $calendly_embed; ?>
        </div>
        <?php endif; ?>
        <div class="booking-box">
          <div class="book-call-right-inner">
          <div class="booking-tabs">
            <button class="tab-button active" data-tab="quote">Request A Quote</button>
            <button class="tab-button" data-tab="call">Book A Call</button>
          </div>
    
          <div class="booking-content">
            <!-- Request A Quote Form -->
            <div class="tab-content quote-tab" style="display: block;">
              <?php if ($request_form): ?>
              <div class="request-quote-form">
                <?php echo $request_form; ?>
              </div>
              <?php endif; ?>
            </div>
    
            <!-- Book A Call Tab -->
            <div class="tab-content call-tab" style="display: none;">
              <div class="booking-header">
                <?php if ($expert_image): ?>
                <img src="<?php echo esc_url($expert_image['url']); ?>" alt="<?php echo esc_attr($expert_name); ?>" />
                <?php endif; ?>
                <h3>
                  <?php echo esc_html($expert_name); ?>
                </h3>
                <h4>
                  <?php echo esc_html($call_title); ?>
                </h4>
    
                <p><i class="fas fa-clock"></i>
                  <?php echo esc_html($call_duration); ?>
                </p>
                <p><i class="fas fa-video"></i>
                  <?php echo esc_html($call_platform); ?>
                </p>
                <p><i class="fas fa-globe"></i>
                  <?php echo esc_html($call_timezone); ?>
                </p>
              </div>
    
              <?php if ($calendar_iframe): ?>
              <div class="calendar-embed">
                <?php echo $calendar_iframe; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>

  </div>
</section>
<?php endif; ?>

