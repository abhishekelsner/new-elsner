<?php if( have_rows('cards_section') ): ?>
<section class="cards-grid">
    <div class="container">
        <div class="cards-wrapper">
            <?php while( have_rows('cards_section') ): the_row(); 
                $icon        = get_sub_field('icon');
                $main_image  = get_sub_field('main_image');
                $heading     = get_sub_field('heading');
                $description  = get_sub_field('description');
            ?>
            
            <div class="card-box">
                <div class="card-header">
                    <?php if( !empty($icon) ): ?>
                        <img class="icon" src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                    <?php endif; ?>
                </div>
                
                <?php if( !empty($main_image) ): ?>
                    <div class="card-image">
                        <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>">
                    </div>
                <?php endif; ?>
                
                <div class="card-content heading">
                    <?php if($heading): ?>
                        <h3><?php echo esc_html($heading); ?></h3>
                    <?php endif; ?>
                    
                    <?php if($description): ?>
                        <p class="description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                    
                    <?php if( have_rows('list_items') ): ?>
                        <ul class="card-list">
                            <?php while( have_rows('list_items') ): the_row(); 
                                $item = get_sub_field('item_text'); ?>
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-4 h-4 flex-shrink-0 mt-0.5 text-green-600" aria-hidden="true"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                                 <?php echo esc_html($item); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<style>
    .cards-wrapper {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 25px;
}

.card-box {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  position: relative;
}
.card-box .card-header {
    position: absolute;
    top: 0;
    z-index: 1;
    left: 0;
}
.card-list li svg {
    width: 1rem;
    height: 1rem;
    flex-shrink: 0;
    margin-right: 5px;
    color: #16a34a;
}
.card-box .card-image img {
    aspect-ratio: 4 / 2;
    object-fit: cover;
}
.card-header .icon {
  width: 32px;
  margin: 15px;
}

.card-image img {
  width: 100%;
  height: auto;
  display: block;
}

.card-content {
  padding: 20px;
}

.card-content h2 {

  margin-bottom: 10px;
}
.card-content .description {
    margin: 0 0 10px;
    color: inherit;
    font-size: 16px;
}
.card-content .subheading {
  font-size: 14px;
  color: #666;
  margin-bottom: 15px;
}

.card-list {
  list-style: none;
  padding: 0;
}

.card-list li {
  margin-bottom: 8px;
  font-size: 14px;
  color: #333;
}

</style>