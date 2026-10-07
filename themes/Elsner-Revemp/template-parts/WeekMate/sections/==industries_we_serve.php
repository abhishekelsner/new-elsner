<?php
$title = get_sub_field('industries_title');
?>
<section class="industries-we-serve">
    <div class="container">
        <div class="industreis-wrapper">

       <div class="heading">
           <h2 class="gradient-heading"><?php echo $title; ?></h2>
       </div>
        <?php if (have_rows('industries_cards')) : ?>
            <div class="industries-cards-wrapper">
                <?php while (have_rows('industries_cards')) : the_row();
                    $heading = get_sub_field('heading');
                    $text = get_sub_field('text');
                ?>
                    <div class="industry-card">
                        <?php if ($heading): ?>
                            <h3><?php echo esc_html($heading); ?></h3>
                        <?php endif; ?>

                        <?php if ($text): ?>
                            <p><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        </div>

    </div>
</section>