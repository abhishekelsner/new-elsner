<?php
$post_id = isset($args['post_id']) ? $args['post_id'] : (isset($post) && $post ? $post->ID : null);

$apps_raw   = get_field('odoo_apps_card', $post_id);
$total_apps = is_array($apps_raw) ? count($apps_raw) : 0;
?>

<section class="odoo-apps-section padding-80" id="odoo-apps-section">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo get_field('odoo_apps_title', $post_id); ?></h2>
        </div>
        <div class="odoo-apps-wrapper">
            <div class="row">
                <?php if (have_rows('odoo_apps_card', $post_id)) : ?>
                    <?php while (have_rows('odoo_apps_card', $post_id)) : the_row();

                        $app_icon = get_sub_field('image');
                        $app_title = get_sub_field('title');
                        $app_link  = get_sub_field('link');

                        $has_link = !empty($app_link['url']);
                        $tag = $has_link ? 'a' : 'div';
                        $link_text = ($has_link && !empty($app_link['title'])) ? $app_link['title'] : 'View More';
                    ?>
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 odoo-app-col">
                            <div class="odoo-app-list">
                                <<?php echo $tag; ?>
                                    class="odoo-app-list-content"
                                    <?php if ($has_link) : ?>
                                        href="<?php echo esc_url($app_link['url']); ?>"
                                        target="<?php echo esc_attr($app_link['target'] ?: '_self'); ?>"
                                    <?php endif; ?>
                                >
                                    <?php if (!empty($app_icon)) : ?>
                                        <img src="<?php echo esc_url($app_icon['url']); ?>"
                                             alt="<?php echo esc_attr($app_icon['alt'] ?: $app_title); ?>">
                                    <?php endif; ?>

                                    <h3><?php echo esc_html($app_title); ?></h3>

                                    <?php if ($has_link) : ?>
                                        <span class="odoo-app-link">
                                            <?php echo esc_html($link_text); ?>
                                            <span class="odoo-app-link__icon">
                                                <svg width="12" height="12" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path d="M3.5 8H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M8.5 3.5L13 8L8.5 12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </span>
                                    <?php endif; ?>
                                </<?php echo $tag; ?>>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <?php if ($total_apps > 4) : ?>
                <div class="text-center odoo-apps-load-more-wrapper">
                    <button type="button" class="btn btn-primary">Load More</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
#odoo-apps-section {
    background: #f6f7f9;
}

.odoo-apps-load-more-wrapper {
    margin-top: 40px;
}

.odoo-apps-load-more-wrapper .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-width: 180px;
    padding: 14px 36px;
    font-size: 16px;
    font-weight: 600;
    line-height: 1;
    color: #005282;
    background-color: transparent;
    border: 2px solid #005282;
    border-radius: 999px;
    cursor: pointer;
    transition: background-color 0.25s ease, color 0.25s ease, box-shadow 0.25s ease, transform 0.1s ease;
}

.odoo-apps-load-more-wrapper .btn:hover,
.odoo-apps-load-more-wrapper .btn:focus-visible {
    background-color: #005282;
    color: #ffffff;
    box-shadow: 0 10px 24px -10px rgba(23, 84, 61, 0.5);
}

.odoo-apps-load-more-wrapper .btn:active {
    transform: translateY(1px);
}


/* Card design */
.odoo-apps-section .odoo-app-col {
    display: flex;
    margin-bottom: 24px;
}
.odoo-apps-wrapper{
    margin-top:20px;
}
.odoo-apps-section .odoo-app-list {
    width: 100%;
    height:100%;
    background: #ffffff;
    border: 1px solid #e7ede9;
    border-radius: 16px;
    padding: 28px 24px;
    box-shadow: 0 4px 16px -8px rgba(15, 33, 26, 0.08);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.odoo-apps-section .odoo-app-list:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 32px -12px rgba(15, 33, 26, 0.18);
}

.odoo-apps-section .odoo-app-list-content {
    display: flex;
    flex-direction: column;
    height: 100%;
    text-align: left;
    text-decoration: none;
    color: inherit;
}

.odoo-apps-section .odoo-app-list-content img {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    object-fit: cover;
    margin-bottom: 18px;
}

.odoo-apps-section .odoo-app-list-content h3 {
    font-family: inherit;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.35;
    color: #16241d;
    margin: 0 0 12px;
}

.odoo-apps-section .odoo-app-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: auto;
    padding-top: 8px;
    font-size: 16px;
    font-weight: 600;
    color: #005282;
}

.odoo-apps-section .odoo-app-link__icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    flex-shrink: 0;
    border-radius: 50%;
    background: #eaf7ff;
    color: #005282;
    transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
}

.odoo-apps-section .odoo-app-list-content:hover .odoo-app-link__icon {
    background: #005282;
    color: #ffffff;
    transform: translateX(3px);
}
</style>

<script>
(function () {
    // Ordered widest-first: per-row count x 3 rows for desktop/laptop, x2 for tablet/mobile.
    var BREAKPOINTS = [
        { minWidth: 1200, step: 8 }, // desktop, 4/row
        { minWidth: 992,  step: 8  }, // laptop, 3/row
        { minWidth: 576,  step: 4  }, // tablet, 2/row
        { minWidth: 0,    step: 4  }  // mobile, 1/row
    ];

    function getStep() {
        var w = window.innerWidth;
        for (var i = 0; i < BREAKPOINTS.length; i++) {
            if (w >= BREAKPOINTS[i].minWidth) {
                return BREAKPOINTS[i].step;
            }
        }
        return BREAKPOINTS[BREAKPOINTS.length - 1].step;
    }

    function initSection(section) {
        var btn = section.querySelector('.odoo-apps-load-more-wrapper .btn');
        if (!btn) {
            return;
        }

        var wrapper = btn.closest('.odoo-apps-load-more-wrapper');
        var cols = section.querySelectorAll('.odoo-app-col');
        var visibleCount = getStep();

        function render() {
            for (var i = 0; i < cols.length; i++) {
                cols[i].style.display = i < visibleCount ? '' : 'none';
            }
            wrapper.style.display = visibleCount >= cols.length ? 'none' : '';
        }

        btn.addEventListener('click', function () {
            visibleCount += getStep();
            render();
        });

        window.addEventListener('resize', function () {
            visibleCount = getStep();
            render();
        });

        render();
    }

    function init() {
        var sections = document.querySelectorAll('.odoo-apps-section');
        for (var i = 0; i < sections.length; i++) {
            initSection(sections[i]);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
