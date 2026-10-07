<?php 
$post_id = $args['post_id'];
$problem_statement_hideshow = get_field('problem_statement_hideshow', $post_id);
?>
<section class="challenge-section padding-80">
    <div class="container">
        <div class="heading-wrapper challenge-content">
            <?php if($problem_statement_hideshow === true):?>
            <h2><?php echo esc_html('Problem statement'); ?></h2>
            <?php echo get_field('problem_statement_content', get_the_ID()); ?>
            <?php endif;?>
            <h2><?php echo esc_html('What was the challenge?'); ?></h2>
            <div class="data-chanllenge">
                <?php echo get_field('project_highlight', get_the_ID()); ?>
            </div>
        </div>
    </div>
</section>