<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
$request_quote_industries_heading = get_field('request_quote_industries_heading', $post_id);
$request_quote_description = get_field('request_quote_description', $post_id);
$request_quote_section_image = get_field('request_quote_section_image', $post_id);
$request_quote_section_image_alt_tag = get_field('request_quote_section_image_alt_tag', $post_id);

?>

<section class="request-quote padding-120">
    <div class="container">
        <div class="row">
            <div class="col-md-6 request-content">
                <div class="request-quoteHead">
                    <h2 class="Redhat-font bold-font">
                        <?php echo $request_quote_industries_heading;?>
                    </h2>
                    <?php echo $request_quote_description; ?>
                </div>
            </div>
            <div class="col-md-6 request-image">
                <div class="content-inner">
                    <img src="<?php echo $request_quote_section_image; ?>" alt="<?php echo $request_quote_section_image_alt_tag;?>" width="1016"
                        height="504" />
                </div>
            </div>
        </div>
    </div>
</section>