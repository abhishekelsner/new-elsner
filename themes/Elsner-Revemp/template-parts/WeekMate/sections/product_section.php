<?php
$heading = get_sub_field('heading');
$description = get_sub_field('description');
$products_list = get_sub_field('products_list'); // This is the relationship field
?>

<?php if ($heading || $description || $products_list): ?>
  <section class="product-section">
    <div class="container">
      <div class="product-section-wrapper">
        <div class="heading">
          <?php if ($heading): ?>
            <h2 class="section-heading"><?php echo esc_html($heading); ?></h2>
          <?php endif; ?>
        </div>

        <?php if ($description): ?>
          <div class="section-description"><?php echo $description; ?></div>
        <?php endif; ?>

        <?php if ($products_list): ?>
          <div class="product-list row">
            <?php foreach ($products_list as $post): ?>
              <?php setup_postdata($post); ?>
              <div class="  col-sm-6  col-lg-4  col-xl-3  col-md-6 product-wrapper">
                <div class="product-item">
                <a href="<?php the_permalink(); ?>">
                  <div class="product-thumb">
                    <?php if (has_post_thumbnail()): ?>
                      <?php the_post_thumbnail('medium'); ?>
                    <?php endif; ?>
                  </div>
  
                  <div class="product-title">
                    <h3><?php the_title(); ?></h3>
                  </div>
  
                  <div class="product-content">
                    <?php the_excerpt(); ?>
  
                    <?php
                    // Custom ACF field: short_description
                    $short_description = get_field('short_description');
                    if ($short_description) {
                      echo '<p>' . esc_html($short_description) . '</p>';
                    }
                    ?>
                  </div>
                </a>
                </div>
              </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        <?php endif; ?>
      </div>


    </div>
  </section>
<?php endif; ?>