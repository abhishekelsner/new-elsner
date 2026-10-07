<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
$current_url = $_SERVER['REQUEST_URI'];
$parts = explode('-', $current_url);
$value = $parts[1];

?>
<section class="request-quote padding-120 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="request-quoteHead">
                    <h2 class="Redhat-font"><?php echo get_field('hire_developer_heading'); ?>
                    </h2>
                    <div class="quote-content">
                        <p><?php echo get_the_content(); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="request-form">
                    <h3 class="white-text">
                        <?php
                            $developerType = ($value == 'mern') ? strtoupper($value) : ucfirst($value);
                            echo "Hire a $developerType Developer Now!";
                        ?>
                    </h3>
                    <div class="form-quote">
                        <?php echo do_shortcode($contact_form); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>