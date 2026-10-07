<?php
/**
 * Section: Magento Integrations
 * Layout key: magento_integrations
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$post_id = $args['post_id'];
$layout  = $args['layout'];

// Field values from layout row.
$title      = $layout['title']      ?? '';
$technology = $layout['technology'] ?? []; // Repeater: title, tech_image (sub-repeater: image)

$unique_id = 'integrations-' . uniqid();
?>

<section class="integrations">
    <div class="container">

        <?php if ( $title ) : ?>
            <div class="integrations__header">
                <h2 class="integrations__title">
                    <?php echo wp_kses_post( $title ); ?>
                </h2>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $technology ) ) : ?>

            <div class="integrations__dropdown">
                <select class="integrations__select">
                    <?php foreach ( $technology as $index => $tab ) :
                        $tab_title = $tab['title'] ?? '';
                        $tab_id    = sanitize_title( $tab_title ) . '-' . $index;
                    ?>
                        <option value="<?php echo esc_attr( $tab_id ); ?>" <?php echo $index === 0 ? 'selected' : ''; ?>>
                            <?php echo esc_html( $tab_title ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tab Buttons -->
            <div class="integrations__tabs" role="tablist">
                <?php foreach ( $technology as $index => $tab ) :
                    $tab_title = $tab['title'] ?? '';
                    $tab_id    = sanitize_title( $tab_title ) . '-' . $index;
                ?>
                    <button class="integrations__tab <?php echo $index === 0 ? 'integrations__tab--active' : ''; ?>"
                            role="tab"
                            data-tab="<?php echo esc_attr( $tab_id ); ?>"
                            aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                        <?php echo esc_html( $tab_title ); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Tab Panels -->
            <div class="integrations__panels">
                <?php foreach ( $technology as $index => $tab ) :
                    $tab_title  = $tab['title']      ?? '';
                    $tab_id     = sanitize_title( $tab_title ) . '-' . $index;
                    $tech_images = $tab['tech_image'] ?? []; // sub-repeater: image
                ?>
                    <div class="integrations__panel <?php echo $index === 0 ? 'integrations__panel--active' : ''; ?>"
                         id="panel-<?php echo esc_attr( $tab_id ); ?>"
                         role="tabpanel"
                         aria-hidden="<?php echo $index === 0 ? 'false' : 'true'; ?>">

                        <?php if ( ! empty( $tech_images ) ) : ?>
                            <div class="integrations__logos">
                                <?php foreach ( $tech_images as $tech ) :
                                    $img    = $tech['image'] ?? '';
                                    $imgurl = is_array( $img ) ? ( $img['url'] ?? '' ) : $img;
                                    $imgalt = is_array( $img ) ? ( $img['alt'] ?? '' ) : '';
                                ?>
                                    <?php if ( $imgurl ) : ?>
                                        <div class="integrations__logo-item">
                                            <img src="<?php echo esc_url( $imgurl ); ?>"
                                                 alt="<?php echo esc_attr( $imgalt ); ?>"
                                                 width="160"
                                                 height="80"
                                                 loading="lazy">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</section>
<script>
(function () {
    const tabs   = document.querySelectorAll('.integrations__tab');
    const panels = document.querySelectorAll('.integrations__panel');
    const select = document.querySelector('.integrations__select');

    function activateTab(tabId) {
        tabs.forEach(t => {
            t.classList.remove('integrations__tab--active');
            t.setAttribute('aria-selected', 'false');
        });

        panels.forEach(p => {
            p.classList.remove('integrations__panel--active');
            p.setAttribute('aria-hidden', 'true');
        });

        const activeTab = document.querySelector('[data-tab="' + tabId + '"]');
        const activePanel = document.getElementById('panel-' + tabId);

        if (activeTab) {
            activeTab.classList.add('integrations__tab--active');
            activeTab.setAttribute('aria-selected', 'true');
        }

        if (activePanel) {
            activePanel.classList.add('integrations__panel--active');
            activePanel.setAttribute('aria-hidden', 'false');
        }
    }

    // Existing tab click
    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            activateTab(tab.dataset.tab);
        });
    });

    // Dropdown change
    if (select) {
        select.addEventListener('change', function () {
            activateTab(this.value);
        });
    }
})();
</script>