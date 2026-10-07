<?php 
// Get fields
$heading       = get_sub_field('heading'); 
$heading_2       = get_sub_field('heading_2'); 
$description   = get_sub_field('description'); 
$image         = get_sub_field('image'); 
$image_title   = get_sub_field('image_title'); 
$image_tagline = get_sub_field('image_tag_line'); 
?>
<?php if( $heading || $description || $image || $image_title || $image_tagline ): ?>
<section class="case-study-banner-new-design">
    <div class="container">
        <?php if( $heading ): ?>
            <h1 class="csb-heading"><?php echo esc_html( $heading ); ?><span class="highlight"><?php echo esc_html( $heading_2 ); ?></span></h1>
        <?php endif; ?>
        <?php if( $description ): ?>
            <p class="csb-description"><?php echo esc_html( $description ); ?></p>
        <?php endif; ?>
    </div>
     <?php if( $image ): ?>
            <div class="case-study-banner-img">
                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
            </div>
        <?php endif; ?>
</section>
<?php endif; ?>