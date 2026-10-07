<?php
/**
 * Ecommerce Tech Stack Section Template
 * ACF Layout: ecommerce_tech_stack_section
 */

$section_title = get_sub_field("section_title");
$section_description = get_sub_field("section_description");
$technologies = get_sub_field("technologies");

?>

<section class="new-ppc-ecommerce-tech-stack">
    <div class="container">
        <div class="new-ppc-ecommerce-tech-stack-wrapper">
            <!-- Left side - Title and Description -->
            <div class="new-ppc-ecommerce-tech-stack-left">
                <?php if ($section_title): ?>
                    <h2 class="new-ppc-ecommerce-tech-stack-left-title">
                        <?php echo $section_title; ?>
                    </h2>
                <?php endif; ?>
                <?php if ($section_description): ?>
                    <p class="new-ppc-ecommerce-tech-stack-left-desc">
                        <?php echo $section_description; ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <!-- Right side - Technologies Grid -->
            <div class="new-ppc-ecommerce-tech-stack-right">
                <?php if ($technologies): ?>
                    <div class="new-ppc-ecommerce-tech-stack-right-logos">
                        <?php foreach ($technologies as $tech): ?>
                            
                                <div class="new-ppc-ecommerce-tech-stack-icon-logo">
                                    <img src="<?php echo esc_url($tech["icon"]["url"]); ?>" 
                                         alt="<?php echo esc_attr($tech["name"]); ?>" 
                                         class="w-full h-full object-contain">
                               
                                <h3 class="">
                                    <?php echo esc_html($tech["name"]); ?>
                                </h3>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

