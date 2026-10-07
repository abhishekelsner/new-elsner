<?php
/**
 * Services Integration Section
 * Template Part: template-parts/industry-page/services-integration-section.php
 */

// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

// Get ACF fields
$heading = get_field('industry_page_services_integration_heading', $post_id);
$description = get_field('industry_page_services_integration_description', $post_id);
$service_categories = get_field('industry_page_service_categories', $post_id);

// Exit if no data
if (!$service_categories) {
    return;
}
?>

<section class="services-integration">
    <div class="container">
        <!-- Section Header -->
        <div class="services-integration__header">
            <?php if ($heading): ?>
                <h2 class="services-integration__heading">
                    <?php echo esc_html($heading); ?>
                </h2>
            <?php endif; ?>

            <?php if ($description): ?>
                <div class="services-integration__description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Main Content -->
        <div class="services-integration__wrapper">
            <!-- Left Column: Categories Menu -->
            <div class="services-integration__menu">
                <!-- Mobile Dropdown Toggle -->
                <div class="services-integration__dropdown-toggle">
                    <span class="services-integration__dropdown-text">
                        <?php echo esc_html($service_categories[0]['industry_page_category_name']); ?>
                    </span>
                    <svg class="services-integration__dropdown-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                
                <!-- Menu List (Desktop + Mobile Dropdown) -->
                <ul class="services-integration__menu-list">
                    <?php foreach ($service_categories as $index => $category): ?>
                        <li class="services-integration__menu-item <?php echo $index === 0 ? 'active' : ''; ?>"
                            data-tab="tab-<?php echo $index; ?>">
                            <span class="services-integration__menu-text">
                                <?php echo esc_html($category['industry_page_category_name']); ?>
                            </span>
                            <svg class="services-integration__menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Right Column: Content Box -->
            <div class="services-integration__content">
                <?php foreach ($service_categories as $index => $category): ?>
                    <div class="services-integration__content-panel <?php echo $index === 0 ? 'active' : ''; ?>"
                         id="tab-<?php echo $index; ?>">
                        
                        <?php if (!empty($category['industry_page_content_title'])): ?>
                            <h3 class="services-integration__content-title">
                                <?php echo esc_html($category['industry_page_content_title']); ?>
                            </h3>
                        <?php endif; ?>

                        <div class="services-integration__content-grid">
                            <!-- Left Column Items -->
                            <?php if (!empty($category['industry_page_content_items_left'])): ?>
                                <ul class="services-integration__list services-integration__list--left">
                                    <?php foreach ($category['industry_page_content_items_left'] as $item): ?>
                                        <?php if (!empty($item['industry_page_item_text_left'])): ?>
                                            <li class="services-integration__list-item">
                                                <?php echo esc_html($item['industry_page_item_text_left']); ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <!-- Right Column Items -->
                            <?php if (!empty($category['industry_page_content_items_right'])): ?>
                                <ul class="services-integration__list services-integration__list--right">
                                    <?php foreach ($category['industry_page_content_items_right'] as $item): ?>
                                        <?php if (!empty($item['industry_page_item_text_right'])): ?>
                                            <li class="services-integration__list-item">
                                                <?php echo esc_html($item['industry_page_item_text_right']); ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuItems = document.querySelectorAll('.services-integration__menu-item');
    const contentPanels = document.querySelectorAll('.services-integration__content-panel');
    const dropdownToggle = document.querySelector('.services-integration__dropdown-toggle');
    const dropdownText = document.querySelector('.services-integration__dropdown-text');
    const dropdownIcon = document.querySelector('.services-integration__dropdown-icon');
    const menuList = document.querySelector('.services-integration__menu-list');

    // Toggle dropdown on mobile
    if (dropdownToggle) {
        dropdownToggle.addEventListener('click', function() {
            menuList.classList.toggle('is-open');
            dropdownIcon.classList.toggle('is-rotated');
        });
    }

    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            const targetTabId = this.getAttribute('data-tab');
            const targetPanel = document.getElementById(targetTabId);
            const selectedText = this.querySelector('.services-integration__menu-text').textContent;

            // 1. Update Menu Active State
            menuItems.forEach(mi => mi.classList.remove('active'));
            this.classList.add('active');

            // 2. Update dropdown text on mobile
            if (dropdownText) {
                dropdownText.textContent = selectedText;
            }

            // 3. Close dropdown on mobile
            if (window.innerWidth <= 768) {
                menuList.classList.remove('is-open');
                dropdownIcon.classList.remove('is-rotated');
            }

            // 4. Update Content Panels with a simple fade effect
            contentPanels.forEach(panel => {
                panel.classList.remove('active');
                panel.style.display = 'none'; // Hide all
            });

            if (targetPanel) {
                targetPanel.style.display = 'block';
                // Small timeout to allow the browser to register display:block before adding opacity
                setTimeout(() => {
                    targetPanel.classList.add('active');
                }, 10);
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 768) {
            const menu = document.querySelector('.services-integration__menu');
            if (menu && !menu.contains(event.target)) {
                menuList.classList.remove('is-open');
                dropdownIcon.classList.remove('is-rotated');
            }
        }
    });
});
</script>