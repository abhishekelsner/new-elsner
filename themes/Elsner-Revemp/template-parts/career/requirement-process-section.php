<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$heading_process          = get_field('heading_process', $post_id);
$heading_content_process  = get_field('heading_content_process', $post_id);
?>
<section class="requirement-process-section padding-80">
    <div class="container">
        <div class="heading-wrapper text-left width-900">
            <h2><?php echo $heading_process; ?></h2>
            <h6><?php echo $heading_content_process; ?></h6>
        </div>
        <div class="recruitment-block-content">
            <div class="row">
                <?php
                $count = 1;
                if (have_rows('recruitment_block', $post_id)) :
                    while (have_rows('recruitment_block', $post_id)) : the_row();

                        $recruitment_title = get_sub_field('title');
                        $recruitment_content = get_sub_field('content');
                ?>
                        <div class="col-xl-3 col-lg-6 col-sm-6 recruit">
                            <div class="recruitment-process">
                                <h2><?php echo str_pad($count, 2, '0', STR_PAD_LEFT); ?></h2>
                                <div class="recruitment-process-content">
                                    <p><strong><?php echo $recruitment_title; ?></strong></p>
                                    <p><?php echo $recruitment_content; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                <?php
                        $count++;
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>