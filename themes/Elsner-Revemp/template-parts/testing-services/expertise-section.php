<?php
$post_id = $args['post_id'];
$expertise_image = get_field('expertise_image', $post_id);
$expertise_we_offer = get_field('expertise_we_offer', $post_id);
$expertise_content = get_field('expertise_content', $post_id);
?>

<section class="expertise-section blue-section padding-80">
    <div class="container">
        <div class="expertise-wrapper">
            <div class="row alinc">
                <div class="col-md-6">
                    <div class="expertise-image">
                        <img src="<?php echo $expertise_image; ?>" alt="Why choose images" width="500" height="500">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="expertise--content request-quoteHead">
                        <h2 class="Redhat-font"><?php echo $expertise_we_offer; ?></h2>
                        <div class="expertise--content">

                            <?php if ($expertise_content) : ?>
                                <ol>
                                    <?php foreach ($expertise_content as $row) : ?>
                                        <li><?php echo $row['content']; ?></li>
                                    <?php endforeach; ?>
                                </ol>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>