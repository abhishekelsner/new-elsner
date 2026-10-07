<?php
$post_id = $args['post_id'];
$growth_plans_services_repeater = get_field('growth_plans_services_repeater', $post_id);
$growth_plans_services_heading = get_field('growth_plans_services_heading', $post_id);
$tabs_content = array();

if (have_rows('growth_plans_services_repeater', $post_id)) {
    while (have_rows('growth_plans_services_repeater', $post_id)) {
        the_row();
        $growth_plans_services_title = get_sub_field('growth_plans_services_title');
        $growth_plans_services_subtitle = get_sub_field('growth_plans_services_subtitle');
        $services_tab_image = get_sub_field('services_tab_image');
        $growth_plans_services_title_new = preg_replace('/\s*/', '', $growth_plans_services_title);
        $growth_plans_services_title_id = strtolower($growth_plans_services_title_new);

        // Prepare nested repeater content
        $nested_content = array();
        if (have_rows('growth_plans_services_repeater_box')) {
            while (have_rows('growth_plans_services_repeater_box')) {
                the_row();
                $nested_title = get_sub_field('growth_plans_services_repeater_title');
                $nested_content_text = get_sub_field('growth_plans_services_repeater_content');
                $nested_image = get_sub_field('growth_plans_services_repeater_image');
                $nested_content[] = array(
                    'title' => $nested_title,
                    'content' => $nested_content_text,
                    'image'   => $nested_image
                );
            }
        }

        $tabs_content[] = array(
            'title' => $growth_plans_services_title,
            'content' => $growth_plans_services_subtitle,
            'image' => $services_tab_image,
            'title_id' => $growth_plans_services_title_id,
            'nested_content' => $nested_content
        );
    }
}
?>
<section class="featured-projects section pd-50 growth-service-tab" id="section4">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?= $growth_plans_services_heading ?></h2>
        </div>
        <div class="projects-wrapper b2b-featured-sidebar">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="project-head">
                        <ul class="nav nav-pills">
                            <?php foreach ($tabs_content as $index => $tab) : ?>
                            <li>
                                <a class="term_slugs <?= ($index === 0) ? 'active show' : '' ?>" data-toggle="pill"
                                    href="#<?= esc_attr($tab['title_id']) ?>"><?= esc_html($tab['title']) ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="tab-content">
                        <?php foreach ($tabs_content as $index => $tab) : ?>
                        <div id="<?= esc_attr($tab['title_id']) ?>"
                            class="tab-pane fade <?= ($index === 0) ? 'active show' : '' ?>">
                            <div class="tab-wrap">
                                <div class="service-tab-content">
                                    <?= $tab['content'] ?>
                                </div>
                                <div class="row">
                                    <?php if (!empty($tab['nested_content'])): ?>
                                    <?php foreach ($tab['nested_content'] as $nested): ?>
                                    <div class="col-lg-6 col-md-6 mb-30">
                                        <div class="growth-tab">
                                            <img src="<?= $nested['image']?>" />
                                            <p class="title"><?= esc_html($nested['title']) ?></h3>
                                            <p><?= esc_html($nested['content']) ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>