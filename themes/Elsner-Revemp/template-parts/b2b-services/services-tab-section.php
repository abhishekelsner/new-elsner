<?php
$post_id = $args['post_id'];
$services_tab_repeater_section = get_field('services_tab_repeater_section', $post_id);
$service_tab_heading = get_field('service_tab_heading', $post_id);
$tabs_content = array();

if (have_rows('services_tab_repeater_section', $post_id)) {
    while (have_rows('services_tab_repeater_section', $post_id)) {
        the_row();
        $services_tab_title = get_sub_field('services_tab_title', $post_id);
        $services_tab_content = get_sub_field('services_tab_content', $post_id);
        $services_tab_image = get_sub_field('services_tab_image', $post_id);
        $services_tab_title_new = preg_replace('/\s*/', '', $services_tab_title);
        $services_tab_title_id = strtolower($services_tab_title_new);

        $tabs_content[] = array(
            'title' => $services_tab_title,
            'content' => $services_tab_content,
            'image' => $services_tab_image,
            'title_id' => $services_tab_title_id
        );
    }
}
?>
<section class="featured-projects section pd-50" id="section4">
    <div class="container">
        <div class="heading-wrapper heading flex">
            <h2><?= $service_tab_heading ?></h2>
        </div>
        <div class="projects-wrapper b2b-featured-sidebar">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="project-head">
                        <ul class="nav nav-pills">
                            <?php foreach ($tabs_content as $index => $tab) : ?>
                            <li>
                                <a class="term_slugs <?= ($index === 0) ? 'active show' : '' ?>" data-toggle="pill"
                                    href="#<?= $tab['title_id'] ?>"><?= $tab['title'] ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content">
                        <?php foreach ($tabs_content as $index => $tab) : ?>
                        <div id="<?= $tab['title_id'] ?>"
                            class="tab-pane fade <?= ($index === 0) ? 'active show' : '' ?>">
                            <div class="tab-wrap">
                                <div class="service-tab-content">
                                    <?= $tab['content'] ?>
                                </div>
                                <img src="<?= $tab['image'] ?>" />
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>