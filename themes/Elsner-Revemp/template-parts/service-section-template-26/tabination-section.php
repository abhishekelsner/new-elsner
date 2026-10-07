<?php
/**
 * Section: Tab Section
 * Layout key: tabination_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */
 
$layout       = $args['layout'];
$tab_sections = $layout['tab_section'] ?? array();
$title = $layout['title'] ?? array();
$description = $layout['description'] ?? array();

if ( empty( $tab_sections ) ) {
    return;
}
 
// Generate a unique ID so multiple tab sections on one page don't conflict.
// wp_unique_id() is deterministic per-request and collision-free vs. uniqid().
$instance_id = function_exists( 'wp_unique_id' )
    ? wp_unique_id( 'tab-section-' )
    : 'tab-section-' . uniqid();
 
$first_tab = $tab_sections[0];
?>
 
<section class="tab-section" id="<?php echo esc_attr( $instance_id ); ?>">
    <div class="container">
        <div class="tab-title">
                                    <h2><?php echo wp_kses_post( $title ); ?></span></h2>
                
                                    <p><?php echo esc_html( $description ); ?></p>
                            </div>
        <div class="tab-grid">
 
            <div class="tab-image">
                <?php if ( ! empty( $first_tab['tab_image'] ) ) : ?>
                    <img id="<?php echo esc_attr( $instance_id ); ?>-img"
                         src="<?php echo esc_url( $first_tab['tab_image'] ); ?>"
                         alt="<?php echo esc_attr( $first_tab['tab_title_'] ?? '' ); ?>">
                <?php endif; ?>
            </div>
 
            <div class="tab-content">
                <div class="main-tab-bar">
                    <ul>
                        <?php foreach ( $tab_sections as $index => $tab ) : ?>
                            <li data-tab="<?php echo esc_attr( $instance_id . '-tab-' . $index ); ?>"
                                <?php if ( ! empty( $tab['tab_image'] ) ) : ?>
                                data-image="<?php echo esc_url( $tab['tab_image'] ); ?>"
                                <?php endif; ?>
                                <?php echo ( $index === 0 ) ? 'class="active"' : ''; ?>>
                                <?php echo esc_html( $tab['tab_title_'] ?? '' ); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
 
                <div class="tab-content-items">
                    <?php foreach ( $tab_sections as $index => $tab ) :
                        $content_title = $tab['tab_content_title_']       ?? '';
                        $content_desc  = $tab['tab_content_description_'] ?? '';
                        $cta           = $tab['tab_cta']                  ?? array();
                        $cta_url       = ! empty( $cta['url'] )    ? esc_url( $cta['url'] )    : '';
                        $cta_label     = ! empty( $cta['title'] )  ? esc_html( $cta['title'] ) : '';
                        $cta_target    = ! empty( $cta['target'] ) ? esc_attr( $cta['target'] ) : '';
                    ?>
                        <div class="tab-content-item<?php echo ( $index === 0 ) ? ' is-active' : ''; ?>"
                             id="<?php echo esc_attr( $instance_id . '-tab-' . $index ); ?>"
                             style="display: <?php echo ( $index === 0 ) ? 'block' : 'none'; ?>;">
 
                            <?php if ( $content_title ) : ?>
                                <h3><?php echo esc_html( $content_title ); ?></h3>
                            <?php endif; ?>
 
                            <?php if ( $content_desc ) : ?>
                                <div class="rich-text">
                                    <?php echo wp_kses_post( $content_desc ); ?>
                                </div>
                            <?php endif; ?>
 
                            <?php if ( $cta_url ) : ?>
                                <div class="btn-wrapper">
                                    <a href="<?php echo $cta_url; ?>"
                                       class="btn btn-secondary"
                                       <?php echo $cta_target ? 'target="' . $cta_target . '"' : ''; ?>
                                       <?php echo ( '_blank' === $cta_target ) ? 'rel="noopener noreferrer"' : ''; ?>>
                                        <?php echo $cta_label; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
 
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
 
        </div>
    </div>
</section>
 
<script>
    (function () {
        // Scope every query to THIS section only, so multiple tab sections
        // on the same page don't interfere with each other.
        var sectionId = <?php echo wp_json_encode( $instance_id ); ?>;
        var section   = document.getElementById( sectionId );
        if ( ! section ) {
            return;
        }
 
        var tabs     = section.querySelectorAll( '.main-tab-bar li' );
        var contents = section.querySelectorAll( '.tab-content-item' );
        var tabImage = document.getElementById( sectionId + '-img' );
 
        tabs.forEach( function ( tab ) {
            tab.addEventListener( 'click', function () {
                var tabId    = this.getAttribute( 'data-tab' );
                var imageSrc = this.getAttribute( 'data-image' );
 
                // Switch active tab.
                tabs.forEach( function ( t ) { t.classList.remove( 'active' ); } );
                this.classList.add( 'active' );
 
                // Show the selected panel, hide the others.
                contents.forEach( function ( content ) {
                    content.style.display = 'none';
                    content.classList.remove( 'is-active' );
                } );
 
                var target = document.getElementById( tabId );
                if ( target ) {
                    target.style.display = 'block';
                    target.classList.add( 'is-active' );
                }
 
                // Swap the section image if this tab has one.
                if ( tabImage && imageSrc ) {
                    tabImage.src = imageSrc;
                }
            } );
        } );
    })();
</script>