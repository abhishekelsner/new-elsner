<?php
  $technology_top_heading = get_field('technology_top_heading');
  $technology_heading = get_field('technology_heading');
  $technologies = get_field('technologies');

  $technology_cta_text = get_field('technology_cta_text');
  $technology_cta_link = get_field('technology_cta_link');
?>

<?php if ($technology_top_heading || $technology_heading || $technology_cta_text || $technology_cta_link) : ?>
  <style type="text/css">
    .technologies_section {
      position: relative;
      padding: 100px 0 100px;
    }
    .technologies_section .header {
      margin-bottom: 30px;
    }
    .technologies_section .header span {
      font-size: 18px;
      line-height: normal;
      color: #171717;
      text-transform: uppercase;
      letter-spacing: 3.6px;
      display: block;
      margin: 0 0 5px;
    }
    .page-template-services-template-new h2 {
      font-size: 42px;
      line-height: 48px;
      font-family: Poppins;
      font-weight: 700;
      color: #070707;
      margin: 0;
    }
    .technologies_section .row {
      row-gap: 24px;
    }
    .technologies_section .technology_wrapper {
      height: 100%;
      padding: 50px 50px 40px 30px;
      position: relative;
      transition: all .3s ease;
      background: #f0faff;
      border-radius: 20px;
    }

    .technologies_section .technology_wrapper:hover {
      box-shadow: 0 3px 30px rgba(0, 0, 0, .161);
      transition: all .3s ease-out;
    }
    .technologies_section .technology_wrapper img {
      margin-bottom: 13px;
      width: auto;
      height: 47px;
    }
    .technologies_section .technology_wrapper p {
      font-size: 16px;
      line-height: 24px;
      color: #414c5b;
      margin: 0;
    }
    .technologies_section .technology_wrapper .read-more {
      position: absolute;
      right: 7px;
      bottom: 7px;
      background: #f9f8f6;
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2;
      transition: all .3s ease;
    }
    .technologies_section .technology_wrapper .read-more svg {
      transition: all .3s ease;
    }

    .technologies_section .technology_wrapper a:not(.read-more) {
      position: absolute;
      right: 0;
      left: 0;
      top: 0;
      bottom: 0;
      z-index: 1;
      font-size: 0;
    }
    .technologies_section_cta {
      background: #055482;
      position: absolute;
      right: 0;
      bottom: 0;
      width: auto;
      margin-left: auto;
      clip-path: polygon(3% 0, 100% 0, 100% 100%, 0 100%);
      padding: 10px calc(50vw - 720px) 10px 60px;
    }
    .technologies_section_cta p {
      color: #fff;
      font-size: 22px;
      font-weight: 700;
      margin: 0;
      text-transform: capitalize;
    }
    .technologies_section_cta p a {
      border-bottom: 1px solid;
      color: #fff;
      font-size: 22px;
      font-weight: 700;
      line-height: 1.5;
      margin-right: 20px;
      transition: all .2s ease;
    }
    .technologies_section_cta p a:hover {
      color: #f70;
      font-weight: 700;
    }
  </style>

  <section class="technologies_section" id="technologies" data-gtm-vis-first-on-screen43373654_134="84518">
    <div class="container">
      <div class="">
        <div class="content">
          <?php echo (!empty($technology_top_heading)) ? '<span>'.$technology_top_heading.'</span>' : ''; ?>
          <?php echo (!empty($technology_heading)) ? '<h2>'.$technology_heading.'</h2>' : ''; ?>
        </div>
      </div>
      <?php if (have_rows('technologies')) : ?>
        <div class="row">
          <?php while (have_rows('technologies')) : the_row();
            $logo = get_sub_field('logo');
            $title = get_sub_field('title');
            $link = get_sub_field('link');
            $description = get_sub_field('description');
            $link_url = '';
            $link_title = '';
            $link_target = '';
            if( $link ){
              $link_url = esc_url($link['url']);
              $link_title = esc_html($link['title']);
              $link_target = !empty($link['target']) ? ' target="' . esc_attr($link['target']) . '"' : '';
            }
          ?>
            <div class="col-md-4 col-sm-6">
              <div class="technology_wrapper">
                <?php if( !empty($link) ){ ?>
                  <?php echo '<a rel="nofollow" href="' . $link_url . '" class="technology-cta" target="_self">' . $link_title . '</a>'; ?>
                  <!-- <a rel="nofollow" href="/wix-development-services/" target="_self" id="company-technologies">Link</a> -->
                <?php } ?>
                <?php if( !empty($logo) ){ ?>
                  <img width="164" height="47" src="<?php echo $logo; ?>" alt="<?php echo $title; ?>">
                <?php } ?>
                <?php echo (!empty($description)) ? '<p>'.$description.'</p>' : ''; ?>
                <?php if( !empty($link) ){ ?>
                  <a class="read-more" href="<?php echo $link_url; ?>" target="_self">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M4.22481 0.262457C4.15324 0.256814 4.08092 0.266179 4.01247 0.289954C3.94402 0.313729 3.88094 0.351392 3.82724 0.400544C3.77355 0.449695 3.73043 0.509256 3.70063 0.575429C3.67083 0.641602 3.655 0.712935 3.65415 0.784881C3.6533 0.856827 3.66745 0.927806 3.6957 0.993295C3.72395 1.05878 3.76568 1.11734 3.81822 1.16524C3.87077 1.21314 3.93298 1.24933 4.00089 1.27149C4.0688 1.29366 4.14092 1.30132 4.21265 1.29399L9.47856 1.23496L0.678115 10.0354C0.588037 10.1353 0.538915 10.2651 0.54087 10.398C0.542826 10.5309 0.595711 10.6567 0.688628 10.7497C0.781544 10.8426 0.907413 10.8955 1.0403 10.8974C1.17318 10.8994 1.30296 10.8503 1.40288 10.7602L10.2033 1.95973L10.1371 7.22676C10.1386 7.36253 10.1924 7.49125 10.2873 7.58617C10.3823 7.68109 10.511 7.73491 10.6468 7.73644C10.7145 7.73575 10.7818 7.72169 10.8447 7.69507C10.9076 7.66845 10.965 7.62979 11.0135 7.58131C11.0619 7.53283 11.1006 7.47548 11.1272 7.41256C11.1538 7.34963 11.1679 7.28235 11.1686 7.21459L11.2455 0.695334C11.2476 0.627231 11.2359 0.559728 11.2112 0.496866C11.1865 0.434004 11.1493 0.377076 11.1017 0.32949C11.0541 0.281904 10.9972 0.244637 10.9343 0.219922C10.8714 0.195207 10.8039 0.183552 10.7358 0.185654L4.22481 0.262457Z" fill="#070707" stroke="#070707" stroke-width="0.3"></path>
                    </svg>
                  </a>
                <?php } ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if($technology_cta_link){ 
      $cta_url = esc_url($technology_cta_link['url']);
      $cta_title = esc_html($technology_cta_link['title']);
      $cta_target = !empty($technology_cta_link['target']) ? ' target="' . esc_attr($technology_cta_link['target']) . '"' : '';
    ?>
      <div class="technologies_section_cta" id="technologies-cta">
        <p><?php echo $technology_cta_text.' '; ?><?php echo '<a href="' . $cta_url . '" class="technology-cta"' . $cta_target . '>' . $cta_title . '</a>'; ?></p>
      </div>
    <?php } ?>
  </section>
<?php endif; ?>