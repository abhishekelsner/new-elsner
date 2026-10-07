<?php 
//Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$build_trust_section_hideshow = get_field('build_trust_section_hideshow', $post_id);
$build_trust_image_alt_tag = get_field('build_trust_image_alt_tag', $post_id);

if($build_trust_section_hideshow === true):?>
<section class="request-quote blue-section padding-120">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="request-quoteHead">
                    <h2 class="Redhat-font"><?php echo get_field('build_trust_heading', $post_id); ?></h2>
                    <div class="content">
                        <?php echo get_field('build_trust_description', $post_id); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="request-form1">
                    <img src="<?php echo get_field('build_trust_image', $post_id); ?>" alt="<?php echo $build_trust_image_alt_tag;?>"/>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>