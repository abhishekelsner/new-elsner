<?php

/**
 * Template Name: Partner Portal
 */
get_header();
?>

<?php
$content = get_field('partner_content', get_the_ID());
$content = str_replace('_site_url', site_url(), $content);

?>
<section class="partner-editor">
    <div class="partner-editor-box">
        <div class="container partner-editor-container">
            <div class="row">
                <div class="col-12">
                    <div class="partner-editor-content">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
get_footer();
?>