<section class="challenge-section padding-80">
    <div class="container">
        <div class="heading-wrapper challenge-content">
            <h2><?php echo get_field('project_about_custom_title' , get_the_ID());?></h2>
            <div class="data-chanllenge">
            <?php echo get_field('project_highlight', get_the_ID()); ?>
            </div>
        </div>
    </div>
</section>