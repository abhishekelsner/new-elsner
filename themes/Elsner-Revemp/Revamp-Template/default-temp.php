<?php
/* Template Name: CMS */
get_header();
?>
<section class="cms-section padding-80">
    <div class="container">
        <div class="cms-page-wrapper">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile; // End of the loop.
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
