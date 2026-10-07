<?php 
//Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$show_yesno_request_business = get_field('show_yesno_request_business', $post_id);

if($show_yesno_request_business === true):?>
<section class="request-quote blue-section padding-120">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="request-quoteHead">
                    <h2 class="Redhat-font"><?php echo get_field('why_choose_heading', $post_id); ?></h2>
                    <div class="content">
                        <?php echo get_field('why_choose_description', $post_id); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="request-form1">
                    <img src="<?php echo get_field('why_choose_section_image', $post_id); ?>" />
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>