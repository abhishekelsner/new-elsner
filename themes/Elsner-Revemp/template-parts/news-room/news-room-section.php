<?php
$terms = get_terms([
    'taxonomy'   => 'news-updates',
    'hide_empty' => false,
    'orderby'    => 'name',
    'order'      => 'desc',
    'number'     => 0,
    'parent'     => 0,
    'fields'     => 'all',
 ]);
?>



            <!-- ==========================================================
                 SECTION: TABS
            =========================================================== -->
            <section class="news-hub-tabs">
                <ul class="news-hub-tabs__list">
                    <li class="news-hub-tabs__item is-active" data-filter="all">All</li>

                    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
                        <?php foreach ($terms as $term) : ?>
                            <li class="news-hub-tabs__item" data-filter="<?php echo esc_attr($term->slug); ?>">
                                <?php echo esc_html($term->name); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Add Latest Updates tab manually -->
                </ul>
            </section>

            <!-- ==========================================================
                 SECTION: ALL UPDATES VIEW ("All" tab — default, visible)
            =========================================================== -->
            <div id="all-sections-view" class="sections-view sections-view--active">

                <section class="news-hub-section">
                    <h2 class="news-hub-section__title">All Updates</h2>

                    <?php
                    $all_query = new WP_Query([
                        'post_type'      => 'news',
                        'post_status'    => 'publish',
                        'posts_per_page' => 4,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'tax_query'      => [
                            [
                                'taxonomy' => 'news-updates',
                                'field'    => 'slug',
                                'terms'    => 'events', // parent term slug — confirm this matches your actual taxonomy term slug in wp-admin
                                'operator' => 'NOT IN',
                            ],
                        ],
                    ]);
                    ?>

                    <?php if ($all_query->have_posts()) : ?>
                        <div class="news-hub-all">

                            <?php
                            $count = 0;
                            while ($all_query->have_posts()) :
                                $all_query->the_post();
                                $count++;
                                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            ?>

                                <?php if ($count === 1) : ?>
                                    <!-- Featured Card -->
                                    <a href="<?php the_permalink(); ?>" class="news-card news-card--featured">
                                        <div class="news-card--featured-image">
                                            <?php if ($thumb_url) : ?>
                                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php endif; ?>
                                        </div>

                                        <div class="news-card__content-first">
                                            <h3><?php the_title(); ?></h3>
                                            <p class="date"><?php echo get_the_date('F j, Y'); ?></p>
                                            <div><?php the_excerpt(); ?></div>
                                            <span href="<?php the_permalink(); ?>">Know More
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                                    <polyline points="12 5 19 12 12 19"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </a>

                                    <div class="news-hub-all__grid">
                                <?php else : ?>
                                    <!-- Normal Card -->
                                    <a href="<?php the_permalink(); ?>" class="news-card">
                                        <div class="news-single-content-image">
                                            <?php if ($thumb_url) : ?>
                                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php endif; ?>
                                        </div>

                                        <div class="news-card__content">
                                            <h3><?php the_title(); ?></h3>
                                            <p class="date"><?php echo get_the_date('F j, Y'); ?></p>
                                            <div><?php the_excerpt(); ?></div>
                                            <span href="<?php the_permalink(); ?>">Know More
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                                    <polyline points="12 5 19 12 12 19"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </a>
                                <?php endif; ?>

                            <?php endwhile; ?>

                            </div><!-- .news-hub-all__grid -->
                        </div><!-- .news-hub-all -->
                    <?php endif; wp_reset_postdata(); ?>

                    <div class="news-hub-section__cta">
                        <a href="#" data-category="all" class="btn-view-all">Load More
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>

                </section>

            </div><!-- #all-sections-view -->
</div>
</section>
<!-- ==========================================================
     SECTION: UPCOMING EVENTS (hidden by default, toggled by JS)
=========================================================== -->
<?php
    $upcoming_events_query = new WP_Query([
        'post_type'      => 'news',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'tax_query'      => [
            [
                'taxonomy' => 'news-updates',
                'field'    => 'slug',
                'terms'    => 'upcoming-events',
            ],
        ],
        'orderby' => 'date',
        'order'   => 'ASC',
    ]);
?>

<?php if ($upcoming_events_query->have_posts()) : ?>

    <section id="upcoming-events-section" class="upcoming-events-section" style="display:none;">
        <div class="container">
            <div class="upcoming-events-header">
                <h2 class="upcoming-events-title">Upcoming Events</h2>
            </div>

            <div class="row upcoming-events-slider">

                <?php while ($upcoming_events_query->have_posts()) : ?>

                    <?php
                    $upcoming_events_query->the_post();

                    $event_logo        = get_field('event_logo');
                    $event_category    = get_field('event_category');
                    $event_location    = get_field('event_location');
                    $event_date        = get_field('event_date');
                    $event_description = get_field('event_description');
                    $event_button_text = get_field('event_button_text');
                    $event_button_url  = get_field('event_button_url');

                    $event_logo_url = '';

                    if (is_array($event_logo) && !empty($event_logo['url'])) {
                        $event_logo_url = $event_logo['url'];
                    } elseif (is_string($event_logo)) {
                        $event_logo_url = $event_logo;
                    }
                    ?>

                    <!-- ONE SLIDE -->
                    <div class=" col-12 upcoming-event-slide">
                        <article class="upcoming-event-card">

                            <!-- TOP -->
                            <div class="upcoming-event-card__top">

                                <?php if ($event_logo_url) : ?>
                                    <div class="upcoming-event-card__logo">
                                        <img
                                            src="<?php echo esc_url($event_logo_url); ?>"
                                            alt="<?php echo esc_attr(get_the_title()); ?>"
                                        >
                                    </div>
                                <?php endif; ?>

                                <span class="upcoming-event-card__badge">
                                    UPCOMING
                                </span>

                            </div>

                            <!-- TITLE -->
                            <div class="upcoming-event-card__heading">
                                <h3 class="upcoming-event-card__title">
                                    <?php the_title(); ?>
                                </h3>

                                <?php if ($event_category) : ?>
                                    <span class="upcoming-event-card__category">
                                        <?php echo esc_html($event_category); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Divider line -->
                            <hr class="content-divider">

                            <!-- Content Wrapper -->
                            <div class="content-wrapper">

                                <!-- LOCATION + DATE -->
                                <div class="upcoming-event-card__meta-wrapper">

                                    <?php if ($event_location) : ?>
                                        <div class="upcoming-event-card__meta">
                                            <span class="upcoming-event-card__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">

                                                    <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0Z"/>
                                                    <circle cx="12" cy="10" r="3"/>

                                                </svg>
                                            </span>

                                            <span>
                                                <?php echo esc_html($event_location); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($event_date) : ?>
                                        <div class="upcoming-event-card__meta">
                                            <span class="upcoming-event-card__icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">

                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                                    <line x1="3" y1="10" x2="21" y2="10"/>

                                                </svg>
                                            </span>

                                            <span>
                                                <?php echo esc_html($event_date); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <!-- Exhibiting at event -->
                                <div class="exibition-at-event">
                                    <span class="upcoming-event-card__icon">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2253_1148)">
                                                <path d="M14.5331 6.66373C14.8376 8.15793 14.6206 9.71135 13.9183 11.0649C13.2161 12.4185 12.071 13.4904 10.6741 14.1019C9.27718 14.7135 7.71284 14.8276 6.24196 14.4253C4.77107 14.023 3.48255 13.1287 2.59127 11.8913C1.7 10.654 1.25984 9.14856 1.3442 7.62599C1.42856 6.10342 2.03234 4.65579 3.05486 3.52451C4.07737 2.39323 5.45681 1.64668 6.96313 1.40937C8.46946 1.17205 10.0116 1.4583 11.3324 2.2204M5.99935 7.33008L7.99935 9.33008L14.666 2.66341" stroke="#06B0FB" stroke-width="2" stroke-linecap="round"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2253_1148">
                                                    <rect width="16" height="16" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>

                                    <span>Exhibiting at the event</span>
                                </div>

                                <!-- DESCRIPTION -->
                                <?php if ($event_description) : ?>
                                    <div class="upcoming-event-card__description">
                                        <span class="upcoming-event-card__icon">
                                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.3341 13V11.6667C10.3341 10.9594 10.0531 10.2811 9.55297 9.78105C9.05283 9.28095 8.3745 9 7.6672 9H3.66688C2.95958 9 2.28125 9.28095 1.78111 9.78105C1.28097 10.2811 1 10.9594 1 11.6667V13M10.3341 1.08529C10.906 1.23353 11.4124 1.56746 11.774 2.03466C12.1355 2.50186 12.3317 3.07588 12.3317 3.66662C12.3317 4.25736 12.1355 4.83138 11.774 5.29858C11.4124 5.76578 10.906 6.09971 10.3341 6.24795M14.3344 12.9999V11.6666C14.334 11.0757 14.1373 10.5018 13.7753 10.0348C13.4132 9.56783 12.9064 9.2343 12.3342 9.08659M8.33392 3.66667C8.33392 5.13943 7.13992 6.33333 5.66704 6.33333C4.19416 6.33333 3.00016 5.13943 3.00016 3.66667C3.00016 2.19391 4.19416 1 5.66704 1C7.13992 1 8.33392 2.19391 8.33392 3.66667Z" stroke="#06B0FB" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </span>
                                        <?php echo wp_kses_post($event_description); ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                          <!-- BUTTON -->
                        <?php if ($event_button_text && $event_button_url) : ?>
                            <div class="upcoming-event-card__button">
                                <a href="<?php echo esc_url($event_button_url); ?>" class="upcoming-event-card__link"
                                data-event-name="<?php echo esc_attr(get_the_title()); ?>"
                                >
                                    <span><?php echo esc_html($event_button_text); ?></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                        <polyline points="12 5 19 12 12 19"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>

                        </article>
                    </div>

                <?php endwhile; ?>

            </div>
        </div>
    </section>

<?php endif; wp_reset_postdata(); ?>

<div id="filtered-view" class="sections-view">
    <section class="news-hub-section">
        <h2 class="news-hub-section__title" id="filtered-title">Filtered Posts</h2>

        <div id="filtered-content" class="news-hub-grid">
            <!-- Content will be loaded here via JavaScript -->
        </div>

        <div class="news-hub-section__cta">
            <a href="#" data-category="" class="btn-view-all">Load More
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"/>
                    <polyline points="12 5 19 12 12 19"/>
                </svg>
            </a>
        </div>
        
    </section>
</div>
<p id="no-more-post-message" style="display: none; text-align: center; margin-top: 20px">No More Post Found</p>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        console.log("it is Working");

        const tabs = document.querySelectorAll('.news-hub-tabs__item');
        const upcomingEventsSection = document.getElementById('upcoming-events-section');
        const $upcomingSlider = jQuery('.upcoming-events-slider');

        if (!tabs.length || !upcomingEventsSection) return;

        // Initialize Upcoming Events Slider
        function initUpcomingSlider() {

            if (!$upcomingSlider.length) return;

            // Prevent duplicate initialization
            if ($upcomingSlider.hasClass('slick-initialized')) {
                return;
            }

            $upcomingSlider.slick({
                slidesToShow: 2,
                slidesToScroll: 1,

                // Loop
                infinite: true,

                // Autoplay
                autoplay: true,
                autoplaySpeed: 3000,

                arrows: true,
                dots: false,
                adaptiveHeight: false,
                speed: 500,

                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: true
                        }
                    }
                ]
            });
        }

        // Reinitialize Slider
        function reinitializeUpcomingSlider() {

            if (!$upcomingSlider.length) return;

            // Destroy existing Slick slider
            if ($upcomingSlider.hasClass('slick-initialized')) {
                $upcomingSlider.slick('unslick');
            }

            // Reinitialize after section becomes visible
            setTimeout(function () {
                initUpcomingSlider();

                // Make sure autoplay starts
                if ($upcomingSlider.hasClass('slick-initialized')) {
                    $upcomingSlider.slick('slickPlay');
                }

            }, 50);
        }

        // Event / Tab Click
        tabs.forEach(function (tab) {

            tab.addEventListener('click', function () {

                console.log("tab is Changed");

                const filterValue = this.getAttribute('data-filter');

                if (
                    filterValue === 'upcoming-events' ||
                    filterValue === 'events'
                ) {

                    upcomingEventsSection.style.display = 'block';

                    // Reinitialize slider
                    reinitializeUpcomingSlider();

                } else {

                    upcomingEventsSection.style.display = 'none';

                }

            });

        });

        // Initial initialization
        initUpcomingSlider();

    });
</script>

