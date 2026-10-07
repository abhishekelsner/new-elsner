<?php
/**
 * SEO Cards Section - ACF Flexible Content Layout
 * 
 * ACF Fields Required:
 * - title (Text) - Section heading
 * - seo_card (Repeater)
 *   - title (Text)        - Card title
 *   - sub_title (Text)    - Card subtitle
 *   - text (Text)         - Card description
 *   - seo_list (Repeater) - List items inside card
 *     - list_item (Text)  - Single list item text
 *   - seo_button (Link)   - Card CTA button { title, url, target }
 */

$section_title = get_sub_field('title');
$seo_cards     = get_sub_field('seo_card');
?>

<?php if ( $section_title || $seo_cards ) : ?>
<!-- ============================================================
     SEO CARDS SECTION — HTML
     ============================================================ -->
<section class="seo-cards-section">
    <div class="scs-container container">

        <!-- Section Heading -->
        <?php if ( $section_title ) : ?>
        <div class="scs-heading">
            <h2 class="scs-title">
                <?php echo wp_kses_post( $section_title ); ?>
            </h2>
        </div>
        <?php endif; ?>

        <!-- Cards Grid -->
        <?php if ( $seo_cards ) : ?>
        <div class="scs-grid">
            <?php
            $card_index = 0;
            foreach ( $seo_cards as $card ) :
                $card_index++;
                $card_title    = isset( $card['title'] )     ? $card['title']     : '';
                $card_subtitle = isset( $card['sub_title'] ) ? $card['sub_title'] : '';
                $card_text     = isset( $card['text'] )      ? $card['text']      : '';
                $card_list     = isset( $card['seo_list'] )  ? $card['seo_list']  : [];
                $card_btn      = isset( $card['seo_button'] )? $card['seo_button']: '';
            ?>
            <div class="scs-card <?php echo ($card_index % 2 === 0) ? 'even' : 'odd' ?>">

                <!-- Title -->
                <?php if ( $card_title ) : ?>
                <h3 class="scs-card-title"><?php echo esc_html( $card_title ); ?></h3>
                <?php endif; ?>

                <!-- Subtitle -->
                <?php if ( $card_subtitle ) : ?>
                <p class="scs-card-subtitle"><?php echo esc_html( $card_subtitle ); ?></p>
                <?php endif; ?>

                <hr class="scs-divider">

                <!-- Description -->
                <?php if ( $card_text ) : ?>
                <p class="scs-card-text"><?php echo esc_html( $card_text ); ?></p>
                <?php endif; ?>

                <!-- SEO List -->
                <?php if ( ! empty( $card_list ) ) : ?>
                <ul class="scs-list">
                    <?php foreach ( $card_list as $list_row ) :
                        $list_item = isset( $list_row['list'] ) ? $list_row['list'] : '';
                        if ( ! $list_item ) continue;
                    ?>
                    <li><?php echo esc_html( $list_item ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <!-- CTA Button -->
                <?php if ( $card_btn && ! empty( $card_btn['url'] ) ) :
                    $btn_url    = esc_url( $card_btn['url'] );
                    $btn_title  = ! empty( $card_btn['title'] )  ? esc_html( $card_btn['title'] ) : 'Learn More';
                    $btn_target = ! empty( $card_btn['target'] ) ? esc_attr( $card_btn['target'] ) : '_self';
                ?>
                <a href="<?php echo $btn_url; ?>" target="<?php echo $btn_target; ?>" class="scs-btn">
                    <?php echo $btn_title; ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <?php endif; ?>

            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php endif; ?>