<?php
$client_title = get_field('client_title');
$client_logos = get_field('clients_logo_item');
if (!empty($client_logos)) : ?>
    <div class="container">
        <div class="clients-logo-wrapper">
            <div class="client-tile">
                <h3><?php echo esc_html($client_title); ?></h3>
            </div>
            <div class="row">
                <?php foreach ($client_logos as $logo) :
                    $logo_image = $logo['logos'];
                    $logo_hover_logo = $logo['logo_hover_logo'];
                ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 w-slide">
                        <div class="client-logo">
                            <?php if (!empty($logo_image) && !empty($logo_hover_logo)) : ?>
                                <img class="default-logo" src="<?php echo esc_url($logo_image['url']); ?>" alt="<?php echo esc_attr($logo_image['alt']); ?>" 
                                    data-hover="<?php echo esc_url($logo_hover_logo['url']); ?>" 
                                    data-default="<?php echo esc_url($logo_image['url']); ?>">
                            <?php elseif (!empty($logo_image)) : ?>
                                <img src="<?php echo esc_url($logo_image['url']); ?>" alt="<?php echo esc_attr($logo_image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const logos = document.querySelectorAll(".default-logo");
    let index = 0;

    function fadeEffect() {
        if (index >= logos.length) {
            index = 0;
        }

        const logo = logos[index];
        const hoverSrc = logo.getAttribute("data-hover");
        const defaultSrc = logo.getAttribute("data-default");

        // Add fade-out effect before changing logo
        logo.classList.add("fade-out");
        setTimeout(() => {
            logo.src = (logo.src === defaultSrc) ? hoverSrc : defaultSrc;
            logo.classList.remove("fade-out");
            logo.classList.add("fade-in");
        }, 500); // Fade duration

        setTimeout(() => {
            logo.classList.remove("fade-in");
        }, 1000); // Reset after fade-in

        index++;

        setTimeout(fadeEffect, 2000); // Loop with delay
    }

    fadeEffect();
});


</script>
<style>
  @keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.fade-out {
    animation: fadeOut 0.5s ease-in-out;
}

.fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

.default-logo {
    transition: opacity 0.5s ease-in-out;
}

</style>