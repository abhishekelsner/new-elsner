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

                <!-- Top row: odd items (1, 3, 5) -->
                <div class="workflow__row workflow__row--top">
                    <?php foreach ( $workflow_list as $index => $item ) :
                        if ( $index % 2 !== 0 ) continue; // skip even (0-based)
                        $step        = $index + 1;
                        $icon        = $item['image']        ?? '';
                        $item_title  = $item['title']       ?? '';
                        $item_desc   = $item['description'] ?? '';
                        $icon_url    = is_array( $icon ) ? ( $icon['url'] ?? '' ) : $icon;
                        $icon_alt    = is_array( $icon ) ? ( $icon['alt'] ?? $item_title ) : $item_title;
                        $is_last_top = ( $index === count( $workflow_list ) - 1 || $index === count( $workflow_list ) - 2 );
                    ?>
                        <div class="workflow__item workflow__item--top">
                            <div class="workflow__step-number"><?php echo str_pad( $step, 2, '0', STR_PAD_LEFT ); ?></div>

                            <?php if ( $icon_url ) : ?>
                                <div class="workflow__icon">
                                    <img src="<?php echo esc_url( $icon_url ); ?>"
                                         alt="<?php echo esc_attr( $icon_alt ); ?>"
                                         width="32"
                                         height="32"
                                         loading="lazy">
                                </div>
                            <?php endif; ?>

                            <?php if ( $item_title ) : ?>
                                <h3 class="workflow__item-title"><?php echo esc_html( $item_title ); ?></h3>
                            <?php endif; ?>

                            <?php if ( $item_desc ) : ?>
                                <p class="workflow__item-description"><?php echo wp_kses_post( $item_desc ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Bottom row: even items (2, 4, 6) -->
                <div class="workflow__row workflow__row--bottom">
                    <?php foreach ( $workflow_list as $index => $item ) :
                        if ( $index % 2 === 0 ) continue; // skip odd (0-based)
                        $step       = $index + 1;
                        $icon       = $item['icon']        ?? '';
                        $item_title = $item['title']       ?? '';
                        $item_desc  = $item['description'] ?? '';
                        $icon_url   = is_array( $icon ) ? ( $icon['url'] ?? '' ) : $icon;
                        $icon_alt   = is_array( $icon ) ? ( $icon['alt'] ?? $item_title ) : $item_title;
                    ?>
                        <div class="workflow__item workflow__item--bottom">
                            <div class="workflow__step-number"><?php echo str_pad( $step, 2, '0', STR_PAD_LEFT ); ?></div>

                            <?php if ( $icon_url ) : ?>
                                <div class="workflow__icon">
                                    <img src="<?php echo esc_url( $icon_url ); ?>"
                                         alt="<?php echo esc_attr( $icon_alt ); ?>"
                                         width="32"
                                         height="32"
                                         loading="lazy">
                                </div>
                            <?php endif; ?>

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

    </div>
</section>
<style>
    /* ================================================
   Workflow Section — BEM — Pixel Perfect
   ================================================ */

.workflow {
    padding: 80px 0 100px;
    background-color: #ffffff;
}

/* ---------- Header ---------- */
.workflow__header {
    text-align: center;
    margin-bottom: 70px;
}

.workflow__title {
    font-size: 32px;
    font-weight: 500;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.3;
}

/* ---------- Grid ---------- */
.workflow__grid {
    display: flex;
    flex-direction: column;
    position: relative;
}

/* ---------- Rows ---------- */
.workflow__row {
    display: flex;
    justify-content: space-between;
    position: relative;
}

.workflow__row--top {
    padding: 0 60px;
    align-items: flex-start;
}

.workflow__row--bottom {
    padding: 0 60px;
    margin-top: 60px;
    align-items: flex-start;
    /* shift bottom row so items sit between top items */
    padding-left: calc(60px + 13.5%);
    padding-right: calc(60px - 13.5%);
}

/* ---------- Item ---------- */
.workflow__item {
    position: relative;
    text-align: center;
    width: 200px;
    flex: 0 0 200px;
}

/* Large faded step number */
.workflow__step-number {
    position: absolute;
    font-size: 90px;
    font-weight: 800;
    color: #eeeeee;
    line-height: 1;
    top: 0px;
    left: -30px;
    z-index: 0;
    user-select: none;
    letter-spacing: -4px;
}

/* ---------- Icon circle ---------- */
.workflow__icon {
    position: relative;
    z-index: 1;
    width: 76px;
    height: 76px;
    border-radius: 50%;
    background-color: #e87722;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    box-shadow: 0 8px 24px rgba(232, 119, 34, 0.3);
}

.workflow__icon img {
    width: 34px;
    height: 34px;
    object-fit: contain;
    filter: brightness(0) invert(1);
}

/* ---------- Text ---------- */
.workflow__item-title {
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 10px;
    position: relative;
    z-index: 1;
}

.workflow__item-description {
    font-size: 13.5px;
    color: #777777;
    line-height: 1.75;
    margin: 0;
    position: relative;
    z-index: 1;
}

/* ================================================
   L-shaped dashed connectors
   Top row items: line goes RIGHT then DOWN
   Bottom row items: line goes RIGHT only
   ================================================ */

/* --- Top row: right arm --- */
.workflow__row--top .workflow__item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 38px; /* center of icon */
    right: -55%;
    width: 55%;
    height: 0;
    border-top: 2px dashed #cccccc;
    z-index: 0;
}

/* --- Top row: down arm (connects to bottom row) --- */
.workflow__row--top .workflow__item:not(:last-child)::before {
    content: '';
    position: absolute;
    top: 38px;
    right: -55%;
    width: 0;
    height: 130px; /* distance between rows */
    border-right: 2px dashed #cccccc;
    z-index: 0;
}

/* --- Bottom row: left arm coming from above --- */
.workflow__row--bottom .workflow__item:not(:last-child)::before {
    content: '';
    position: absolute;
    top: 38px;
    right: -55%;
    width: 0;
    height: 0; /* no vertical arm needed on bottom row */
    z-index: 0;
}

/* --- Bottom row: right connector between items --- */
.workflow__row--bottom .workflow__item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 38px;
    right: -55%;
    width: 55%;
    height: 0;
    border-top: 2px dashed #cccccc;
    z-index: 0;
}

/* ================================================
   Responsive
   ================================================ */

@media (max-width: 1024px) {
    .workflow__item {
        width: 160px;
        flex: 0 0 160px;
    }

    .workflow__step-number {
        font-size: 70px;
    }

    .workflow__row--top,
    .workflow__row--bottom {
        padding-left: 20px;
        padding-right: 20px;
    }

    .workflow__row--bottom {
        padding-left: calc(20px + 11%);
    }
}

@media (max-width: 768px) {
    .workflow__grid {
        gap: 48px;
    }

    .workflow__row--top,
    .workflow__row--bottom {
        flex-direction: column;
        align-items: center;
        gap: 40px;
        padding: 0;
        margin-top: 0;
    }

    .workflow__row--top .workflow__item::after,
    .workflow__row--top .workflow__item::before,
    .workflow__row--bottom .workflow__item::after,
    .workflow__row--bottom .workflow__item::before {
        display: none;
    }

    .workflow__item {
        width: 100%;
        max-width: 260px;
        flex: unset;
    }
}

@media (max-width: 480px) {
    .workflow {
        padding: 50px 0 60px;
    }

    .workflow__title {
        font-size: 24px;
    }

    .workflow__step-number {
        font-size: 55px;
    }
}
</style>