<?php
$hedaing = get_sub_field('hedaing');
?>

<section class="weekmate-single-product-hero-section hrms-category-section custom-py-50">
  <div class="container">
    <div class="hero-section-wrapper">
      <div class="heading">
        <h2><span class="gradient-heading"><?php echo esc_html($hedaing); ?></span></h2>
      </div>

      <?php if (have_rows('hrms_category_blocks')) : ?>
        <div class="hrms-section-wrapper">

          <!-- Category Tabs -->
          <div class="category-tabs">
            <?php
            $cat_index = 0;
            while (have_rows('hrms_category_blocks')) : the_row();
              $category_name = get_sub_field('category_name');
            ?>
              <button class="category-tab <?php echo $cat_index === 0 ? 'active' : ''; ?>" data-tab="tab-<?php echo $cat_index; ?>">
                <?php echo esc_html($category_name); ?>
              </button>
            <?php $cat_index++;
            endwhile; ?>
          </div>

          <!-- Category Content -->
          <div class="category-contents">
            <?php
            $content_index = 0;
            while (have_rows('hrms_category_blocks')) : the_row();
              $contents = get_sub_field('category_content'); ?>
              <div class="category-content-block <?php echo $content_index === 0 ? 'active' : ''; ?>" id="tab-<?php echo $content_index; ?>">
                <?php if ($contents) : ?>
                  <div class="swiper category-swiper">
                    <div class="swiper-wrapper">
                      <?php foreach ($contents as $item) :
                        $title = $item['title'];
                        $description = $item['description'];
                        $image = $item['image'];
                      ?>
                        <div class="swiper-slide">
                          <div class="content-inner">
                            <div class="content-text">
                              <?php if (!empty($title)) : ?>
                                <h3><?php echo esc_html($title); ?> </h3><!-- Display Title -->
                              <?php endif; ?>
                              <p><?php echo esc_html($description); ?> </p><!-- Display Description -->
                            </div>
                            <?php if (!empty($image)) : ?>
                              <div class="content-image">
                                <!-- All anchors have SAME data-fancybox group -->
                                <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery">
                                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: $title); ?>">
                                </a>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                  </div>
                <?php endif; ?>
              </div>
            <?php $content_index++;
            endwhile; ?>
          </div>

        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

