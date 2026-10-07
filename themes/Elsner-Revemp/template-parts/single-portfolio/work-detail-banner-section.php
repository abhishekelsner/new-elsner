<section class="work-detail-banner blue-section padding-120">
    <div class="container">
        <div class="work-details-wrapper">
            <div class="heading-wrapper white-text portfolio-detail-page-title">
                <div class="breadcrumb-wrapper">
                    <?php custom_breadcrumbs(); ?>
                </div>
                <h1><?php echo get_the_title(); ?></h1>
                <h6><?php echo get_the_content(); ?></h6>
            </div>
            <div class="work-details-list">
                <ul>
                    <?php
                    $portfolio_categories = get_the_terms(get_the_ID(), 'platform');
                    $portfolio_tags = get_the_terms(get_the_ID(), 'portfolio-tag');
                    if ($portfolio_categories) {
                        foreach ($portfolio_categories as $category) {
                            echo '<li>#' . $category->name . '</li>';
                        }
                    }
                    if ($portfolio_tags) {
                        foreach ($portfolio_tags as $tag) {
                            echo '<li>' . $tag->name . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>