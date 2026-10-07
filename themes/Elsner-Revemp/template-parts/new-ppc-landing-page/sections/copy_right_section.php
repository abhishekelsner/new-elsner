<?php 
$copy_right_title = get_sub_field('copy_right_title');

?>

<section class="copy-right-section">
   <div class="container">
        <div class="copy-right-text">
            <?php if (!empty($copy_right_title)) : ?>
                        <?php echo $copy_right_title; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
