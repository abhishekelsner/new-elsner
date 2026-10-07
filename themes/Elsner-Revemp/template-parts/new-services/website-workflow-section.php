<?php 
$workflow_title = get_field('workflow_title');
$workflow_list = get_field('workflow_list');

if (!empty($workflow_list)) : ?>
    <section class="workflow-section padding-80">
        <div class="container">
            <div class="block-title text-center">
                <h2><?php echo $workflow_title; ?></h2>
            </div>
            <div class="workflow-main-wrapper">
                <div class="row">
                    <?php foreach ($workflow_list as $workflow) : 
                        $workflow_image = $workflow['workflow_image'];
                        $workflow_title = $workflow['workflow_title'];
                        $workflow_text = $workflow['workflow_text'];
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="workflow-item">
                                <div class="workflow-img">
                                    <?php if (!empty($workflow_image)) : ?>
                                        <img src="<?php echo esc_url($workflow_image['url']); ?>" alt="<?php echo esc_attr($workflow_image['alt']); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="workflow-content">
                                    <div class="workflow-title">
                                        <h3><?php echo esc_html($workflow_title); ?></h3>
                                    </div>
                                    <div class="rich-text">
                                        <p><?php echo esc_html($workflow_text); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>  
<?php endif; ?>
