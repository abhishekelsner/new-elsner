<?php
/**
 * Section: Workflow
 * Layout key: workflow
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$post_id = $args['post_id'];
$layout  = $args['layout'];

// Field values from layout row.
$title         = $layout['title']         ?? '';
$workflow_list = $layout['client_info'] ?? []; // Repeater: icon (image), title, description
?>

<section class="workflow">
    <div class="container">

        <?php if ( $title ) : ?>
            <div class="workflow__header">
                <h2 class="workflow__title">
                    <?php echo wp_kses_post( $title ); ?>
                </h2>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $workflow_list ) ) : ?>
            <div class="workflow__grid">

                <!-- Top row: odd items (1, 3, 5…) — index 0, 2, 4 -->
                <div class="workflow__row workflow__row--top">
                    <?php foreach ( $workflow_list as $index => $item ) :
                        if ( $index % 2 !== 0 ) continue;
                        $step       = $index + 1;
                        $icon       = $item['image']       ?? '';
                        $item_title = $item['title']       ?? '';
                        $item_desc  = $item['description'] ?? '';
                        $icon_url   = is_array( $icon ) ? ( $icon['url'] ?? '' ) : $icon;
                        $icon_alt   = is_array( $icon ) ? ( $icon['alt'] ?? $item_title ) : $item_title;
                    ?>
                        <div class="workflow__item workflow__item--top">
                            <div class="workflow__step-number"><?php echo str_pad( $step, 2, '0', STR_PAD_LEFT ); ?></div>

                            <div class="workflow__icon">
                                <?php if ( $icon_url ) : ?>
                                    <img src="<?php echo esc_url( $icon_url ); ?>"
                                         alt="<?php echo esc_attr( $icon_alt ); ?>"
                                         width="32"
                                         height="32"
                                         loading="lazy">
                                <?php endif; ?>
                            </div>

                            <?php if ( $item_title ) : ?>
                                <h3 class="workflow__item-title"><?php echo esc_html( $item_title ); ?></h3>
                            <?php endif; ?>

                            <?php if ( $item_desc ) : ?>
                                <p class="workflow__item-description"><?php echo wp_kses_post( $item_desc ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Bottom row: even items (2, 4, 6…) — index 1, 3, 5 -->
                <div class="workflow__row workflow__row--bottom">
                    <?php foreach ( $workflow_list as $index => $item ) :
                        if ( $index % 2 === 0 ) continue;
                        $step       = $index + 1;
                        $icon       = $item['image']       ?? '';   // ← was $item['icon'], now fixed
                        $item_title = $item['title']       ?? '';
                        $item_desc  = $item['description'] ?? '';
                        $icon_url   = is_array( $icon ) ? ( $icon['url'] ?? '' ) : $icon;
                        $icon_alt   = is_array( $icon ) ? ( $icon['alt'] ?? $item_title ) : $item_title;
                    ?>
                        <div class="workflow__item workflow__item--bottom">
                            <div class="workflow__step-number"><?php echo str_pad( $step, 2, '0', STR_PAD_LEFT ); ?></div>

                            <div class="workflow__icon">
                                <?php if ( $icon_url ) : ?>
                                    <img src="<?php echo esc_url( $icon_url ); ?>"
                                         alt="<?php echo esc_attr( $icon_alt ); ?>"
                                         width="32"
                                         height="32"
                                         loading="lazy">
                                <?php endif; ?>
                            </div>

                            <?php if ( $item_title ) : ?>
                                <h3 class="workflow__item-title"><?php echo esc_html( $item_title ); ?></h3>
                            <?php endif; ?>

                            <?php if ( $item_desc ) : ?>
                                <p class="workflow__item-description"><?php echo wp_kses_post( $item_desc ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        <?php endif; ?>

        <?php if ( ! empty( $workflow_list ) ) : ?>
        <div class="workflow__grid  mobile-view">

            <?php foreach ( $workflow_list as $index => $item ) :
                $step       = $index + 1;
                $icon       = $item['image']       ?? '';
                $item_title = $item['title']       ?? '';
                $item_desc  = $item['description'] ?? '';
                $icon_url   = is_array( $icon ) ? ( $icon['url'] ?? '' ) : $icon;
                $icon_alt   = is_array( $icon ) ? ( $icon['alt'] ?? $item_title ) : $item_title;
            ?>
                <div class="workflow__item">
                    <div class="workflow__step-number"><?php echo str_pad( $step, 2, '0', STR_PAD_LEFT ); ?></div>

                    <div class="workflow__icon">
                        <?php if ( $icon_url ) : ?>
                            <img src="<?php echo esc_url( $icon_url ); ?>"
                                alt="<?php echo esc_attr( $icon_alt ); ?>"
                                width="32"
                                height="32"
                                loading="lazy">
                        <?php endif; ?>
                    </div>

                    <?php if ( $item_title ) : ?>
                        <h3 class="workflow__item-title"><?php echo esc_html( $item_title ); ?></h3>
                    <?php endif; ?>

                    <?php if ( $item_desc ) : ?>
                        <p class="workflow__item-description"><?php echo wp_kses_post( $item_desc ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>
<?php endif; ?>

    </div>
</section>

<style>
/* ================================================
   Workflow Section — Scoped to Template
   ================================================ */





</style>