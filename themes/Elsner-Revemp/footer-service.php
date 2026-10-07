<?php
  global $contact_form, $sales_phone_number, $sales_email_address, $skype_id, $partners, $address, $facebook, $instagram, $linekdin, $google, $twitter, $pinterest, $youtube, $template, $github;
  $template_name = basename($template);
  $select_footer = get_field('select_footer', get_the_ID()); ?>
  
<footer class="footer main-footer service-template-footer">
   <div class="container">
      <div class="footer-wrapper">
         <div class="row">
            <div class="mobile-order-3 col-auto">
               <div class="footer-menu mobile-menu">
                  <h3><?php echo esc_html('Connect'); ?></h3>
                  <ul>
                     <li><a
                        href="tel:<?php echo $sales_phone_number; ?>"><?php echo $sales_phone_number; ?></a>
                     </li>
                     <li><a
                        href="mailto:<?php echo $sales_email_address; ?>"><?php echo $sales_email_address; ?></a>
                     </li>
                     <li><a href="skype:<?php echo $skype_id; ?>"><?php echo $skype_id; ?></a></li>
                  </ul>
               </div>
            </div>
            <div class="mobile-order-3 col-lg-6 col-md-12">
               <div class="footer-certificate">
                  <?php if(have_rows('certification_repeater', 'option')):
                     while(have_rows('certification_repeater', 'option')):the_row();
                     $certification = get_sub_field('certification', 'option');
                     $certification_url = get_sub_field('certification_url', 'option');
                     $certificate_url = $certification_url ? $certification_url: '#'; ?>
                  <a>
                  <img src="<?=$certification ?>" alt="footer certificate" height="55" width="490"
                     loading="lazy">
                  </a>
                  <?php endwhile; ?>
                  <?php endif; ?>
               </div>
            </div>
            <div class="mobile-order-4 col-auto">
               <div class="footer-menu">
                  <h3>Address</h3>
                  <div class="footer-address">
                     <address>
                        <strong><?php echo esc_html('Headquarter-India'); ?></strong><br>
                        <?php echo $address; ?>
                     </address>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
  
  <?php wp_footer(); ?>