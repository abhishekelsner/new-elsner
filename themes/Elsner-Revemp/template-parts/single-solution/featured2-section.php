<section class="challenge-section featured2-section">
    <div class="container">
        <div class="heading-wrapper challenge-content">
            <h2><?php echo esc_html('Advantages'); ?></h2>
            <div class="data-chanllenge">
            <?php echo get_field('project_highlights', get_the_ID()); ?>
            </div>
        </div>
    </div>
</section>