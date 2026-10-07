<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$heading_perk_benefit  = get_field('heading_perk_benefit', $post_id);
$sub_heading_perk  = get_field('sub_heading_perk', $post_id);
?>
<section class="perk-benefits-section blue-section padding-80">
    <div class="container">
        <div class="heading-wrapper white-text text-left width-900">
            <h2><?php echo $heading_perk_benefit; ?></h2>
            <h6><?php echo $sub_heading_perk; ?></h6>
        </div>
        <div class="perk-benefit-wrapper">
            <div class="row">
                <?php
                if (have_rows('benefits_block', $post_id)) :
                    while (have_rows('benefits_block', $post_id)) : the_row();
                        $benefits_icon = get_sub_field('image');
                        $benefits_title = get_sub_field('title');
                ?>

                        <div class="col-lg-3 col-sm-6">
                            <div class="making-steps">
                                <img  src="<?php echo $benefits_icon; ?>" width="24" height="24" alt="career icon">
                                <h6 class="Redhat-font"><?php echo $benefits_title; ?></h6>
                            </div>
                        </div>
                <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>