<?php
// Retrieve the post ID from the $args array
$columns = [
    [
        'text' => 'Swift responses, dedicated support'
    ],
    [
        'text' => 'Efficient and always here for you'
    ],
    [
        'text' => 'We listen, understand, and act promptly'
    ],
];
 ?>
<section class="services-banner maintenance-banner b2b-contact-block" id="b2b-contact-form">
    <div class="container">
        <div class="row">
            <div class="col-md-5 b2b-contact-left">
                <div class="services-heading">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/b2b-marketing/contact-smile.png'?>">
                    <h2> Connect with Us Today! </h2>
                    <p>At Apex, we value your inquiries, feedback, and collaborations. Whether you are interested in our digital services, have questions about our projects</p>
                    <div class="b2b-commitment">
                        <h3>Our Commitment to You</h3>
                        <ul>
                            <?php   foreach ($columns as $column) { ?>
                            <li><?php echo $column['text']; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7 b2b-contact-right">
                <div class="b2b-form">
                    <?php echo do_shortcode('[contact-form-7 id="42510" title="Teams Contact Enquiry Form"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>