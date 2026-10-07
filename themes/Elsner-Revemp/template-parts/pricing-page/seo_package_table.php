<?php
/**
 * ACF Flexible Content Layout: SEO Package Table
 * Layout name: seo_package_table
 *
 * ACF Fields:
 *  - title           (Text)
 *  - plan_columns    (Repeater) → plan_name (Text), plan_button (Link)
 *  - table_categories (Repeater) →
 *      category_title (Text)
 *      category_rows  (Repeater) →
 *          row_feature_name  (Text)
 *          row_tooltip       (Text)
 *          lite_check        (True/False)
 *          lite_value        (Text)
 *          standard_check    (True/False)
 *          standard_value    (Text)
 *          enterprise_check  (True/False)
 *          enterprise_value  (Text)
 */

$spt_title        = get_sub_field( 'title' );
$plan_columns     = get_sub_field( 'plan_columns' );     // repeater array
$table_categories = get_sub_field( 'table_categories' ); // repeater array

if ( empty( $plan_columns ) || empty( $table_categories ) ) return;

$plan_count = count( $plan_columns );

/**
 * Helper: render one plan cell value.
 * Priority: check (tick) → custom value → dash (—)
 */
function spt_cell( $check, $value ) {
    if ( $check ) {
        return '<span class="spt-tick" aria-label="Included">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="10" r="10" fill="#22C55E"/>
                        <path d="M5.5 10.5L8.5 13.5L14.5 7" stroke="#fff" stroke-width="1.8"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>';
    }
    if ( $value !== '' && $value !== null ) {
        return '<span class="spt-value">' . esc_html( $value ) . '</span>';
    }
    return '<span class="spt-dash" aria-label="Not included">&mdash;</span>';
}
?>
<section class="spt-section">
    <div class="spt-container container">

        <?php if ( $spt_title ) : ?>
            <h2 class="spt-heading"><?php echo esc_html( $spt_title ); ?></h2>
        <?php endif; ?>

        <div class="spt-table-wrap">
            <table class="spt-table" role="table">

                <!-- ── THEAD: plan names + CTA buttons ── -->
                <thead>
                    <tr class="spt-header-row">
                        <!-- empty first column (feature name column) -->
                        <th class="spt-th spt-th--feature" scope="col"></th>

                        <?php foreach ( $plan_columns as $col ) :
                            $plan_name   = $col['plan_name']   ?? '';
                            $plan_button = $col['plan_button'] ?? [];
                            $btn_url     = ! empty( $plan_button['url'] )    ? esc_url( $plan_button['url'] )       : '#';
                            $btn_title   = ! empty( $plan_button['title'] )  ? esc_html( $plan_button['title'] )    : __( 'Get Proposal', 'textdomain' );
                            $btn_target  = ! empty( $plan_button['target'] ) ? esc_attr( $plan_button['target'] )   : '_self';
                        ?>
                        <th class="spt-th spt-th--plan" scope="col">
                            <?php if ( $plan_name ) : ?>
                                <span class="spt-plan-name"><?php echo esc_html( $plan_name ); ?></span>
                            <?php endif; ?>
                            <a href="<?php echo $btn_url; ?>"
                               target="<?php echo $btn_target; ?>"
                               class="spt-plan-btn">
                                <?php echo $btn_title; ?>
                            </a>
                        </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>

                <!-- ── TBODY: categories + feature rows ── -->
                <tbody>
                    <?php foreach ( $table_categories as $cat ) :
                        $cat_title = $cat['category_title'] ?? '';
                        $cat_rows  = $cat['category_rows']  ?? [];
                    ?>

                        <!-- Category heading row -->
                        <tr class="spt-category-row">
                            <td class="spt-cat-title" colspan="<?php echo $plan_count + 1; ?>">
                                <?php echo esc_html( $cat_title ); ?>
                            </td>
                        </tr>

                        <?php foreach ( $cat_rows as $row ) :
                            $feature_name      = $row['row_feature_name']   ?? '';
                            $tooltip           = $row['row_tooltip']        ?? '';
                            $lite_check        = ! empty( $row['lite_check'] );
                            $lite_value        = $row['lite_value']         ?? '';
                            $standard_check    = ! empty( $row['standard_check'] );
                            $standard_value    = $row['standard_value']     ?? '';
                            $enterprise_check  = ! empty( $row['enterprise_check'] );
                            $enterprise_value  = $row['enterprise_value']   ?? '';
                        ?>
                        <tr class="spt-feature-row">

                            <!-- Feature name + optional tooltip -->
                            <td class="spt-td spt-td--feature">
                                <?php if ( $feature_name ) : ?>
                                    <span class="spt-feature-name"><?php echo esc_html( $feature_name ); ?></span>
                                <?php endif; ?>
                                <?php if ( $tooltip ) : ?>
                                    <button class="spt-tooltip-trigger"
                                            type="button"
                                            aria-label="<?php echo esc_attr( $tooltip ); ?>"
                                            data-tooltip="<?php echo esc_attr( $tooltip ); ?>">
                                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="10" cy="10" r="9" stroke="#6B7280" stroke-width="1.4"/>
                                            <path d="M10 9v5" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round"/>
                                            <circle cx="10" cy="6.5" r="0.9" fill="#6B7280"/>
                                        </svg>
                                        <span class="spt-tooltip-bubble" role="tooltip">
                                            <?php echo esc_html( $tooltip ); ?>
                                        </span>
                                    </button>
                                <?php else : ?>
                                    <!-- no feature name: tooltip-icon only row (info-only row) -->
                                    <?php if ( ! $feature_name ) : ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                            <!-- Per-plan cells (order: lite, standard, enterprise) -->
                            <td class="spt-td spt-td--plan">
                                <?php echo spt_cell( $lite_check, $lite_value ); ?>
                            </td>
                            <td class="spt-td spt-td--plan">
                                <?php echo spt_cell( $standard_check, $standard_value ); ?>
                            </td>
                            <td class="spt-td spt-td--plan">
                                <?php echo spt_cell( $enterprise_check, $enterprise_value ); ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>

                    <?php endforeach; ?>
                </tbody>

            </table>
        </div><!-- /.spt-table-wrap -->

    </div><!-- /.spt-container -->
</section>
