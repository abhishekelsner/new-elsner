<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$b2b_contact_heading = get_field('b2b_contact_heading', $post_id);
$b2b_contact_description = get_field('b2b_contact_description', $post_id);
$b2b_commitment_text = get_field('b2b_commitment_text', $post_id);
$b2b_commitment_repeater = get_field('b2b_commitment_repeater', $post_id);
$b2b_contact_form = get_field('b2b_contact_form', $post_id);
 ?>
<section class="services-banner maintenance-banner b2b-contact-block" id="b2b-contact-form">
    <div class="container">
        <div class="row">
            <div class="col-md-5 b2b-contact-left">
                <div class="services-heading">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/b2b-marketing/contact-smile.png'?>">
                    <h2><?php echo $b2b_contact_heading; ?></h2>
                    <p><?= $b2b_contact_description;?></p>
                    <div class="b2b-commitment">
                        <h3><?= $b2b_commitment_text ?></h3>
                        <ul>
                            <?php if(have_rows('b2b_commitment_repeater')):
                            while(have_rows('b2b_commitment_repeater')):the_row();
                            $b2b_commitment_repeater_title = get_sub_field('b2b_commitment_repeater_title', $post_id);
                            ?>
                            <li><?= $b2b_commitment_repeater_title ?></li>
                            <?php endwhile;
                        endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7 b2b-contact-right">
                <div class="b2b-form">
                    <?=$b2b_contact_form;?>
                </div>
            </div>
        </div>
    </div>
</section>