<?php
$ImageUrl = wp_upload_dir();
$path = $ImageUrl['baseurl']; 
$columns = [
    [
        'image' => $path.'/2024/08/Excellence.svg',
        'heading' => 'Excellence',
        'text' => 'We strive for the highest standards in everything we do.'
    ],
    [
        'image' => $path.'/2024/08/Innovation.svg',
        'heading' => 'Innovation',
        'text' => 'We are constantly exploring new ideas and technologies to provide the best solutions.'
    ],
    [
        'image' => $path.'/2024/08/Customer-Focus.svg',
        'heading' => 'Customer Focus',
        'text' => 'Your goals are our goals. We work closely with you to understand your needs and deliver solutions that exceed your expectations.'
    ],
    [
        'image' => $path.'/2024/08/Integrity.svg',
        'heading' => 'Integrity',
        'text' => 'We conduct our business with honesty and transparency, building trust with our clients and partners.'
    ]
];
?>

<section class="why-choose-us-section">
    <div class="container">
        <div class="top-content">
            <h2>Why Choose Us?</h2>
            <p class="main-content">At Elsner Technologies, we believe in the power of technology to transform businesses. Our team is dedicated to</p>
        </div>
        <div class="row choose-us-card">
        <?php
            foreach ($columns as $column) {
                echo '
                <div class="col-12 col-md-6 col-xl-3 wrap-column">
                    <div class="container-wrap">
                        <div class="icon">
                            <img src="' . $column['image'] . '" alt="">
                        </div>
                        <div class="content">
                            <h4>' . $column['heading'] . '</h4>
                            <p class="why-choose-us-text">' . $column['text'] . '</p>
                        </div>
                    </div>
                </div>';
            }
        ?>
        </div>
    </div>
</section>

