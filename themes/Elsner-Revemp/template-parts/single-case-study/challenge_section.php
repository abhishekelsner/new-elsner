<?php
$heading       = get_sub_field('heading'); 
$sub_heading   = get_sub_field('sub_heading');
$challenge_box = get_sub_field('challenge_box'); // Repeater field
?>

<?php if( $heading || $sub_heading || $challenge_box ): ?>
<section class="challenge-section-case-study">
    <div class="container">
        
        <div class="challenge-section-detail text-center    ">
            <?php if($heading): ?>
                <div class="heading">
                    <h2><?php echo esc_html($heading); ?></h2>
                </div>
            <?php endif; ?>

            <?php if($sub_heading): ?>
                <p><?php echo esc_html($sub_heading); ?></p>
            <?php endif; ?>
        </div>

        <?php if( $challenge_box ): ?>
        <div class="challenge-section-cards">
            <?php foreach( $challenge_box as $box ): ?>
                <div class="challenge-card">
                    <?php if( !empty($box['icon']) ): ?>
                        <div class="challenge-icon">
                            <img src="<?php echo esc_url($box['icon']['url']); ?>" alt="<?php echo esc_attr($box['icon']['alt']); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if( !empty($box['text']) ): ?>
                        <p><?php echo esc_html($box['text']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>
