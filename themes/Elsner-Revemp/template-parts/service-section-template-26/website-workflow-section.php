<?php
/**
 * Section: Website Workflow
 * Layout key: website_workflow_section
 *
 * The workflow section title is now ACF-driven per layout row,
 * removing the old hardcoded "Magento Website Development Workflow" string.
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout         = $args['layout'];
$section_title  = $layout['workflow_section_title'] ?? '';
$workflow_items = $layout['workflow_list']           ?? array();

if ( empty( $workflow_items ) ) {
    return;
}
?>

<section class="workflow-section padding-80">
    <div class="container">

        <?php if ( $section_title ) : ?>
            <div class="block-title text-center">
                <h2><?php echo wp_kses_post( $section_title ); ?></h2>
            </div>
        <?php endif; ?>

        <div class="workflow-main-wrapper">
            <div class="row">
                <?php foreach ( $workflow_items as $workflow ) :
                    $image = $workflow['workflow_image'] ?? array();
                    $title = $workflow['workflow_title'] ?? '';
                    $text  = $workflow['workflow_text']  ?? '';
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="workflow-item">

                            <?php if ( ! empty( $image['url'] ) ) : ?>
                                <div class="workflow-img">
                                    <img src="<?php echo esc_url( $image['url'] ); ?>"
                                         alt="<?php echo esc_attr( $image['alt'] ?? $title ); ?>">
                                </div>
                            <?php endif; ?>

                            <div class="workflow-content">
                                <?php if ( $title ) : ?>
                                    <div class="workflow-title">
                                        <h3><?php echo esc_html( $title ); ?></h3>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $text ) : ?>
                                    <div class="rich-text">
                                        <p><?php echo esc_html( $text ); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
