<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$heading_work_play  = get_field('heading_work_play', $post_id);
$subheading_work_play  = get_field('subheading_work_play', $post_id);
?>
<section class="work-and-play padding-80">
    <div class="container">
        <div class="heading-wrapper white-text text-left">
            <h2><?php echo $heading_work_play; ?></h2>
            <p><?php echo $subheading_work_play; ?> </p>
        </div>
    </div>
    <div class="work-party-slider slider">
        <?php
        if (have_rows('work_images', $post_id)) :
            while (have_rows('work_images', $post_id)) : the_row();
                $work_image = get_sub_field('images');
        ?>
                <div class="work-slide">
                    <div class="img-multiple">
                        <img src="<?php echo $work_image['url']; ?>" alt="<?php echo $work_image['alt']; ?>" width="330" />
                    </div>
                </div>
            <?php
            endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="view-more text-center">
        <?php
        $page_slug = 'life-at-elsner';
        $page = get_page_by_path($page_slug);
        if ($page) {
            $page_link = get_permalink($page->ID);
        }
        echo '<a href="' . $page_link . '" class="btn btn-secondary">LIFE AT ELSNER</a>';
        ?>
    </div>
</section>