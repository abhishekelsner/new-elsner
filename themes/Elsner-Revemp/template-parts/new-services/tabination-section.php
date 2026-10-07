<?php
// Get the repeater field
$tab_sections = get_field('tab_section');
$tab_title = get_field('tab_title');
$tab_description = get_field('tab_description');

?>

<?php if ($tab_sections): ?>
    <section class="tab-section">
        <div class="container">
            <div class="tab-title">
                <?php if (!empty($tab_title)) : ?>
                    <h2><?php echo wp_kses_post($tab_title); ?></h2>
                <?php endif; ?>

                <?php if (!empty($tab_description)) : ?>
                    <p><?php echo $tab_description; ?></p>
                <?php endif; ?>
            </div>

            <div class="tab-grid">
                <!-- Tab Image (Placed outside the .tab-content) -->
                <div class="tab-image">
                    <?php if (!empty($tab_sections[0]['tab_image'])): ?>
                        <img id="dynamic-tab-image" src="<?php echo esc_url($tab_sections[0]['tab_image']); ?>" alt="Tab Image">
                    <?php else: ?>
                        <p style="color:red;">No Image Found</p>
                    <?php endif; ?>
                </div>


                <!-- Tab Navigation & Content -->
                <div class="tab-content">
                    <div class="main-tab-bar">
                        <ul>
                            <?php foreach ($tab_sections as $index => $tab): ?>
                                <li data-tab="tab-<?php echo $index; ?>" data-image="<?php echo esc_url($tab['tab_image']); ?>" <?php echo ($index === 0) ? 'class="active"' : ''; ?>>
                                    <?php echo esc_html($tab['tab_title_']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="tab-content-items">
                        <?php foreach ($tab_sections as $index => $tab): ?>
                            <div class="tab-content-item" id="tab-<?php echo $index; ?>" style="display: <?php echo ($index === 0) ? 'block' : 'none'; ?>;">
                                <?php echo esc_html($tab['tab_content_title_']); ?>
                                <div class="rich-text">
                                    <?php echo wp_kses_post($tab['tab_content_description_']); ?>
                                </div>

                                <!-- CTA Button -->
                                <?php if (!empty($tab['tab_cta']['url'])):
                                    $cta_url = esc_url($tab['tab_cta']['url']);
                                    $cta_title = esc_html($tab['tab_cta']['title']);
                                    $cta_target = !empty($tab['tab_cta']['target']) ? ' target="' . esc_attr($tab['tab_cta']['target']) . '"' : '';
                                ?>
                                    <div class="btn-wrapper">
                                        <a href="<?php echo $cta_url; ?>" class="btn btn-secondary" <?php echo $cta_target; ?>>
                                            <?php echo $cta_title; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for Tab Switching -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".main-tab-bar li");
            const contents = document.querySelectorAll(".tab-content-item");
            const tabImage = document.getElementById("dynamic-tab-image");

            tabs.forEach((tab, index) => {
                tab.addEventListener("click", function() {
                    let tabId = this.getAttribute("data-tab");
                    let imageSrc = this.getAttribute("data-image");

                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove("active"));
                    this.classList.add("active");

                    // Hide all tab content items
                    contents.forEach(content => content.style.display = "none");

                    // Show the selected tab content
                    document.getElementById(tabId).style.display = "block";

                    // Update the tab image dynamically
                    if (tabImage && imageSrc) {
                        tabImage.src = imageSrc;
                    }
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".read-more-btn").forEach(function(button) {
                button.addEventListener("click", function() {
                    console.log("click like");
                    var container = this.closest(".read-more-container");
                    container.classList.toggle("expanded");

                    var readMoreText = container.querySelector(".read-more");

                    if (container.classList.contains("expanded")) {
                        this.textContent = "Read Less";
                        readMoreText.style.webkitLineClamp = "unset";
                        readMoreText.style.overflow = "visible";
                    } else {
                        this.textContent = "Read More";
                        readMoreText.style.webkitLineClamp = "2";
                        readMoreText.style.overflow = "hidden";
                    }
                });
            });
        });
    </script>

<?php endif; ?>