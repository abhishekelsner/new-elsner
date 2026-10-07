<?php
$text_contetnt = get_field('text_contetnt');

if (!empty($text_contetnt)) : ?>
    <section>
        <div class="case-study-extra-text-content">
            <div class="container">
                <div class="case-study-extra-text-content-wrapper">
                    <?php echo $text_contetnt; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

