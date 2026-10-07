<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$sub_title = get_sub_field('sub_title_');
$faqs = get_sub_field('faqs_block');

if ($faqs):
?>
<section class="faq-section tmp-faq-section">
    <div class="container">
        <div class="faq-section-heading">
            <?php if ($text): ?>
                <div class="faq-title-pill"><?php echo esc_html($text); ?></div>
            <?php endif; ?>
            <?php if ($title): ?>
                <h2 class="faq-title"><?php echo esc_html($title); ?><?php if ($sub_title): ?>
                <span class="faq-subtitle"><?php echo esc_html($sub_title); ?></span>
            <?php endif; ?></h2>
            <?php endif; ?>

            
        </div>
        <div class="faq-items">
            <?php foreach ($faqs as $index => $faq): ?>
                <div class="faq-item<?php echo $index === 0 ? ' active' : ''; ?>">
                    <button class="faq-question-wrap" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                        <div class="faq-question"><?php echo esc_html($faq['questions']); ?></div>
                        <img class="toggle-icon" 
                             src="<?php echo $index === 0 
                                ? 'https://www.elsner.com/wp-content/uploads/2025/08/Border-1.png' 
                                : 'https://www.elsner.com/wp-content/uploads/2025/08/Border-5.png'; ?>" 
                             alt="Toggle Icon">
                    </button>
                    <div class="faq-answer" <?php echo $index === 0 ? '' : 'hidden'; ?>>
                        <p><?php echo esc_html($faq['answer']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>



