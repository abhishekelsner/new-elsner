<?php
// Store ACF fields in variables
$case_study_form = get_field('case_study_form');
?>

<section class="case_study_form_section">
    <div class="container">
        <?php if ($case_study_form): ?>
            <?php echo $case_study_form; ?>
        <?php endif; ?>
    </div>
</section>

