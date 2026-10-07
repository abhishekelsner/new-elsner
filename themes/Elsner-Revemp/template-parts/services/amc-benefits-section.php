<section class="amc-section-counter">
    <div class="container">
        <div class="amc-section-wrapper">
            <?php
            if (have_rows('amc_benefits', $post_id)) :
                while (have_rows('amc_benefits', $post_id)) : the_row();
            ?>
            <div class="amc-section" id="counter">
                <div class="amc-benefits">
                    <img src="<?php the_sub_field('amc_icons'); ?>" alt="amc logo">
                    <p><?php the_sub_field('amc_title'); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>