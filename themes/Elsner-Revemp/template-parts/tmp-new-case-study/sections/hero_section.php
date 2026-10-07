<?php
// 🔹 Left Side
$top_label     = get_sub_field('top_label');
$title         = get_sub_field('title');
$title_2         = get_sub_field('title_2');
$desc          = get_sub_field('description');
$bg            = get_sub_field('bg_image');
$service_list  = get_sub_field('service_list');
$cta           = get_sub_field('cta');
$button_1           = get_sub_field('primary_button');
$button_2           = get_sub_field('secondary_button');
// 🔹 Right Side (Card)
$card_title    = get_sub_field('card_title');
$card_subtitle = get_sub_field('card_subtitle');
$rating_label  = get_sub_field('rating_label');
$progress_label = get_sub_field('progress_label');
$progress_val  = get_sub_field('progress_value');
$stats         = get_sub_field('stats');
$partner_badge_logo_text = get_sub_field('partner_badge_logo_text');
$global_locations = get_sub_field('global_locations');
?>

<section class="banner our-portfolio-banner-section"
  <?php if (!empty($bg) && is_array($bg)): ?>
  style="background-image:url('<?php echo esc_url($bg['url']); ?>')"
  <?php elseif (!empty($bg) && is_string($bg)): ?>
  style="background-image:url('<?php echo esc_url($bg); ?>')"
  <?php endif; ?>>
  <div class="container ">
    <div class="banner-grid row">
      <!-- Left -->
      <div class="col-6">
        <div class="banner-left ">
          <?php if ($top_label): ?>
            <span class="badge">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                <path d="M2 7.50001C1.90538 7.50033 1.81261 7.4738 1.73247 7.42349C1.65233 7.37319 1.58811 7.30118 1.54727 7.21583C1.50643 7.13048 1.49064 7.0353 1.50175 6.94133C1.51285 6.84737 1.55039 6.75848 1.61 6.68501L6.56 1.58501C6.59713 1.54215 6.64773 1.51318 6.70349 1.50287C6.75925 1.49256 6.81686 1.50151 6.86686 1.52826C6.91686 1.555 6.95629 1.59795 6.97866 1.65006C7.00104 1.70216 7.00503 1.76033 6.99 1.81501L6.03 4.82501C6.00169 4.90077 5.99218 4.98227 6.00229 5.06251C6.0124 5.14275 6.04183 5.21935 6.08804 5.28572C6.13426 5.35209 6.19588 5.40626 6.26763 5.44359C6.33938 5.48091 6.41912 5.50027 6.5 5.50001H10C10.0946 5.49968 10.1874 5.52621 10.2675 5.57652C10.3477 5.62682 10.4119 5.69883 10.4527 5.78418C10.4936 5.86953 10.5093 5.96471 10.4982 6.05868C10.4871 6.15264 10.4496 6.24153 10.39 6.31501L5.44 11.415C5.40287 11.4579 5.35227 11.4868 5.29651 11.4971C5.24074 11.5074 5.18313 11.4985 5.13313 11.4718C5.08313 11.445 5.0437 11.4021 5.02133 11.35C4.99895 11.2978 4.99496 11.2397 5.01 11.185L5.97 8.17501C5.9983 8.09924 6.00781 8.01775 5.9977 7.9375C5.98759 7.85726 5.95817 7.78066 5.91195 7.71429C5.86574 7.64792 5.80411 7.59375 5.73236 7.55643C5.66061 7.5191 5.58087 7.49974 5.5 7.50001H2Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <?php echo esc_html($top_label); ?></span>
          <?php endif; ?>

          <?php if ($title): ?>
            <h1><?php echo wp_kses_post($title); ?><span><?php echo wp_kses_post($title_2); ?></span></h1>
          <?php endif; ?>

          <?php if ($desc): ?>
            <p class="desc"><?php echo esc_html($desc); ?></p>
          <?php endif; ?>

          <?php if (!empty($service_list) && is_array($service_list)): ?>
            <ul class="services">
              <?php foreach ($service_list as $srv): ?>
                <li>
                  <?php if (!empty($srv['icon'])): ?>
                    <?php if (is_array($srv['icon'])): ?>
                      <img src="<?php echo esc_url($srv['icon']['url']); ?>" alt="">
                    <?php else: ?>
                      <img src="<?php echo esc_url($srv['icon']); ?>" alt="">
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php echo esc_html($srv['service_text']); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
          <div class="banner-button-wrapper">
            <?php if (!empty($button_1)): ?>
              <!-- <div class="banner-ctas">
                <a href="<?php echo esc_url($button_1['url']); ?>" target="<?php echo esc_attr($button_1['target'] ?: '_self'); ?>" class="btn btn-secondary">
                  <?php echo esc_html($button_1['title']); ?> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                      <path d="M2.91669 7H11.0834" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M7 2.9165L11.0833 6.99984L7 11.0832" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
              </div> -->
            <?php endif; ?>
            <?php if (!empty($button_2)): ?>
              <div class="banner-ctas">
                <a href="<?php echo esc_url($button_2['url']); ?>" target="<?php echo esc_attr($button_2['target'] ?: '_self'); ?>" class="btn white-btn">
                  <?php echo esc_html($button_2['title']); ?>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Right -->
      <div class="col-6">

        <div class="banner-card ">
          <?php if ($rating_label): ?>
            <span class="rating"><?php echo esc_html($rating_label); ?></span>
          <?php endif; ?>
          <div class="banner-icon-grid">
            <div class="banner-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path d="M15.477 13.39L16.992 21.916C17.009 22.0164 16.9949 22.1196 16.9516 22.2118C16.9084 22.3039 16.838 22.3807 16.7499 22.4318C16.6619 22.4829 16.5603 22.5059 16.4588 22.4977C16.3573 22.4895 16.2607 22.4506 16.182 22.386L12.602 19.699C12.4292 19.5699 12.2192 19.5001 12.0035 19.5001C11.7878 19.5001 11.5778 19.5699 11.405 19.699L7.819 22.385C7.74032 22.4494 7.64386 22.4884 7.54249 22.4966C7.44112 22.5048 7.33967 22.4818 7.25166 22.4309C7.16365 22.3799 7.09327 22.3033 7.04991 22.2113C7.00656 22.1194 6.99228 22.0163 7.009 21.916L8.523 13.39" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 14.5C15.3137 14.5 18 11.8137 18 8.5C18 5.18629 15.3137 2.5 12 2.5C8.68629 2.5 6 5.18629 6 8.5C6 11.8137 8.68629 14.5 12 14.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="banner-icon-contnet">
              <?php if ($card_title): ?>
                <h3><?php echo esc_html($card_title); ?></h3>
              <?php endif; ?>

              <?php if ($card_subtitle): ?>
                <p class="subtitle"><?php echo esc_html($card_subtitle); ?></p>
              <?php endif; ?>
            </div>
          </div>

          <?php if ($progress_label && $progress_val): ?>
            <div class="progress-wrap">
              <div class="progress-content">
                <span><?php echo esc_html($progress_label); ?></span>
                <strong><?php echo esc_html($progress_val); ?></strong>
              </div>
              <div class="progress-bar">
                <span style="width:<?php echo floatval($progress_val); ?>%"></span>
              </div>
            </div>
          <?php endif; ?>

          <?php if (!empty($stats) && is_array($stats)): ?>
            <div class="stats">
              <?php foreach ($stats as $st): ?>
                <div class="stat">
                  <strong><?php echo esc_html($st['stat_number']); ?></strong>
                  <span><?php echo esc_html($st['stat_label']); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <?php if ($partner_badge_logo_text): ?>
            <span class="partner-badge">🏆<?php echo esc_html($partner_badge_logo_text); ?></span>
          <?php endif; ?>

          <?php if (!empty($global_locations) && is_array($global_locations)): ?>
            <p class="locations">
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                  <path d="M8.00016 14.6667C11.6821 14.6667 14.6668 11.6819 14.6668 8.00004C14.6668 4.31814 11.6821 1.33337 8.00016 1.33337C4.31826 1.33337 1.3335 4.31814 1.3335 8.00004C1.3335 11.6819 4.31826 14.6667 8.00016 14.6667Z" stroke="#00BDF2" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M8.00016 1.33337C6.28832 3.13081 5.3335 5.51787 5.3335 8.00004C5.3335 10.4822 6.28832 12.8693 8.00016 14.6667C9.71201 12.8693 10.6668 10.4822 10.6668 8.00004C10.6668 5.51787 9.71201 3.13081 8.00016 1.33337Z" stroke="#00BDF2" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M1.3335 8H14.6668" stroke="#00BDF2" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </span>
              <?php
              $loc_names = array_column($global_locations, 'location_name');
              echo esc_html(implode(', ', $loc_names));
              ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>