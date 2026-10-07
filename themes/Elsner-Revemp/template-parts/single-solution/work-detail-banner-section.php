<section class="work-detail-banner blue-section padding-120">
    <div class="container">
        <div class="work-details-wrapper">
            <div class="heading-wrapper white-text">
                <h2><?php echo get_the_title(); ?></h2>
                <h6><?php echo get_the_content(); ?></h6>
            </div>
            <div class="work-details-list">
                <ul>
                    <?php
                    $portfolio_categories = get_the_terms(get_the_ID(), 'portfolio-tag');
                    if ($portfolio_categories) {
                        foreach ($portfolio_categories as $category) {
                            echo '<li>#' . $category->name . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>