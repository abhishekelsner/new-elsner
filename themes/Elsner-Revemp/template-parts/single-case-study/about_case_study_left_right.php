<?php
// Get the fields
$heading     = get_sub_field('heading'); 
$description = get_sub_field('description'); 
$cards       = get_sub_field('cards');
$about_cta1  = get_sub_field('about_cta1');
$about_cta2  = get_sub_field('about_cta2');
$text_1      = get_sub_field('text_1');
$text_2      = get_sub_field('text_2');
$text_3      = get_sub_field('text_3');

if( $heading || $description || $cards ): ?>
<section class="about-case-study-left-right">
    <div class="container">
        <div class="row about-case-study-left-right-wrapper">
            <div class="col-6 about-case-study-left">
                <?php if( $heading ): ?>
                <div class="heading">
                    <h2><?php echo esc_html( $heading ); ?></h2>
                </div>
                <?php endif; ?>
                <?php if( $description ): ?>
                <div class="about-description">
                    <?php echo wp_kses_post( $description ); ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-6 about-case-study-right">
                <div class="cards-wrapper">
                    <?php foreach( $cards as $card ): 
                $icon    = $card['icon'];
                $percent = $card['percent'];
                $text    = $card['text'];?>
                    <div class="card-item">
                        <?php if( !empty($icon) ): ?>
                        <div class="card-icon">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                        </div>
                        <?php endif; ?>

                        <?php if( $percent ): ?>
                        <div class="card-percent"><?php echo esc_html($percent); ?></div>
                        <?php endif; ?>

                        <?php if( $text ): ?>
                        <div class="card-text"><?php echo esc_html($text); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="cta-about-case-study-last-wrraper">
                                <!-- CTA Buttons -->
                <div class="cta-buttons">
                    <?php if($about_cta1):
                $link_url    = $about_cta1['url'];
                $link_title  = $about_cta1['title'];
                $link_target = $about_cta1['target'] ? $about_cta1['target'] : '_self'; ?>
                    <a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>"
                        target="<?php echo esc_attr( $link_target ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                    </a>
                    <?php endif; ?>

                    <?php if($about_cta2):
                $link_url    = $about_cta2['url'];
                $link_title  = $about_cta2['title'];
                $link_target = $about_cta2['target'] ? $about_cta2['target'] : '_self'; ?>
                    <a class="btn btn-secondary" href="<?php echo esc_url( $link_url ); ?>"
                        target="<?php echo esc_attr( $link_target ); ?>">
                        <span class="play-icon">▶</span> <?php echo esc_html( $link_title ); ?>
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Bottom texts -->
                <div class="extra-texts">
                    <div class="extra-texts-wrapper">
                        <?php if($text_1): ?>
                            <span class="icon"><img src="https://www.elsner.com/wp-content/uploads/2026/05/Vector-3.svg" alt=""></span>
                        <?php echo esc_html($text_1); ?><?php endif; ?>
                    </div>
                    <div class="extra-texts-wrapper">
                        <?php if($text_2): ?>
                         <span class="icon"><img src="https://www.elsner.com/wp-content/uploads/2026/05/Vector-1.svg" alt=""></span>
                        <?php echo esc_html($text_2); ?><?php endif; ?>
                    </div>
                     <div class="extra-texts-wrapper">
                        <?php if($text_3): ?>
                            <span class="icon"><img src="https://www.elsner.com/wp-content/uploads/2026/05/Vector-2.svg" alt=""></span>
                            <?php echo esc_html($text_3); ?>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
    </div>
</section>
<?php endif; ?>
