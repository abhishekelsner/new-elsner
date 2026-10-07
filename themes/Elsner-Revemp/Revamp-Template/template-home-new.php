<?php

/**
 * Template Name: Home New 
 */
get_header();
?>

<div id="fullpage">
    <?php

    get_template_part('template-parts/home/banner', 'section', array('post_id' => get_the_ID()));
    get_template_part('template-parts/home/expertise', 'section', array('post_id' => get_the_ID()));
    get_template_part('template-parts/home/client', 'section', array('post_id' => get_the_ID()));
    get_template_part('template-parts/home/industries', 'section', array('post_id' => get_the_ID()));
    if (!wp_is_mobile()) :
        get_template_part('template-parts/home/projects', 'section', array('post_id' => get_the_ID()));
    endif;
    get_template_part('template-parts/home/buisness', 'section', array('post_id' => get_the_ID()));
    get_template_part('template-parts/home/partner', 'section', array('post_id' => get_the_ID()));
    if (!wp_is_mobile()) :
        get_template_part('template-parts/home/life', 'section', array('post_id' => get_the_ID()));
    endif;
    get_footer('home');
    ?>
</div>


</div>
<div class="whatsapp-popup-trigger">
    <img src="<?php echo get_template_directory_uri() . '/assets/images/popup/whatsapp-icon.png'; ?>"
        alt="WhatsApp Image" width="48" height="48" />
</div>
</div>
</div>

<?php wp_footer(); ?>
<script type="text/javascript">
   jQuery(document).ready(function(){
            setTimeout(function(){
                console.log('INTERVAL')
                jQuery("#elsner-popup").modal("show");
            }, 180000);
        });
</script>

</body>

</html>