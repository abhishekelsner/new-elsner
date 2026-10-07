<?php
/**
 * Section: Right Image / Left Content
 * Layout key: right_image_leftcontent_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout            = $args['layout'];
$section_heading   = $layout['title'] ?? '';
$content_items     = $layout['left_right_content'] ?? array();

if ( empty( $content_items ) && empty( $section_heading ) ) {
    return;
}
?>

<div class="certified-box">
    <div class="container">

        <?php if ( $section_heading ) : ?>
            <div class="section-header">
                <h2><?php echo wp_kses_post( $section_heading ); ?></h2>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $content_items ) ) : ?>
            <div class="certified-box-wrapper">
                <?php foreach ( $content_items as $row ) :
                    $sub_title   = $row['sub_title']   ?? '';
                    $description = $row['description'] ?? '';
                    $button      = $row['button']      ?? array();
                    $image_url   = $row['image']       ?? '';
                ?>
                    <div class="certified-box-item">
                        <div class="certified-image">

                            <?php if ( $image_url ) : ?>
                                <div class="image-wrapper">
                                    <img src="<?php echo esc_url( $image_url ); ?>"
                                         alt="<?php echo esc_attr( $sub_title ); ?>">
                                </div>
                            <?php endif; ?>

                            <div class="certified-content">

                                <?php if ( $sub_title ) : ?>
                                    <div class="certified-title">
                                        <h3><?php echo esc_html( $sub_title ); ?></h3>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $description ) : ?>
                                    <div class="rich-text">
                                        <?php echo wp_kses_post( $description ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $button['url'] ) ) : ?>
                                    <div class="btn-wraper">
                                        <a href="<?php echo esc_url( $button['url'] ); ?>"
                                           <?php echo ! empty( $button['target'] ) ? 'target="' . esc_attr( $button['target'] ) . '"' : ''; ?>>
                                            <?php echo esc_html( $button['title'] ); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" aria-hidden="true">
                                                <path d="M7 17.5L17 7.5" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7 7.5H17V17.5" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>
