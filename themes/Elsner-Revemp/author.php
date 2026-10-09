<?php get_header(); ?>

<?php
$author_id   = get_queried_object_id();
$author_meta = get_userdata($author_id);
$author_id = get_the_author_meta('ID');
$author_linkedin = get_field('author_linkedin', 'user_' . $author_id);
$author_email = get_field('author_email', 'user_' . $author_id);
$author_image_url = get_field('author_image', 'user_' . $author_id);


?>

<section class="author-hero">
    <div class="container">
        <div class="author-profile-card">
            <div class="author-avatar">
                <?php if ($author_image_url) {
                    echo '<img src="' . esc_url($author_image_url) . '" alt="Author Image">';
                }
                ?>
            </div>
            <div class="author-details">
                <h1><?php echo esc_html($author_meta->display_name); ?></h1>
                <p class="author-role"><?php the_field('author_position', 'user_' . $author_id); ?></p>
                <p class="author-exp"><span><svg width="34" height="40" viewBox="0 0 34 40" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.3177 0.148058C16.7914 -0.0361947 17.3227 -0.0489782 17.8062 0.112524L17.8122 0.114538L17.8183 0.11661L32.6682 5.24104L32.669 5.24134C33.0487 5.37263 33.3774 5.60513 33.6139 5.90908L33.6365 5.93875L33.6585 5.96878C33.8816 6.27985 34.0005 6.64521 34 7.01903V20.1412C33.9994 23.3296 33.1078 26.4638 31.4119 29.2392C29.716 32.0146 27.2733 34.337 24.3212 35.9807L24.3207 35.9809L24.3203 35.9812L17.0889 40L9.76663 35.9688C6.78934 34.3319 4.32335 32.0065 2.61101 29.2207C0.898661 26.435 -0.0011319 23.2849 1.06861e-06 20.0799V7.71555C0.000328653 7.34356 0.118952 6.97984 0.341071 6.6698C0.563186 6.35977 0.878987 6.11711 1.2491 5.97203L1.25191 5.97091L1.25479 5.96978L16.3177 0.147939V0.148058ZM2.45724 7.9695V20.0807C2.45625 22.8911 3.24528 25.6534 4.74682 28.0962C6.22492 30.5008 8.34337 32.5145 10.8995 33.9459L11.0223 34.0139L17.083 37.3506L23.0544 34.032C25.6434 32.5905 27.7856 30.5538 29.2729 28.1197C30.7602 25.6857 31.5422 22.9372 31.5428 20.1409V7.27973L17.1194 2.30253L2.45724 7.9695Z"
                                fill="white" />
                            <path
                                d="M17.0236 7.44214C17.2992 7.44773 17.5662 7.53693 17.787 7.69726L17.8089 7.71349L18.0278 7.87951L20.846 13.4209L26.8518 14.2663C26.8543 14.2667 26.8568 14.2671 26.8592 14.2674L26.8634 14.268C27.0861 14.2985 27.2971 14.3836 27.4765 14.5155L27.515 14.545L27.5524 14.5758C27.7238 14.7225 27.8531 14.9098 27.9276 15.1194L27.9428 15.1647L27.9561 15.2105C28.0187 15.4403 28.0144 15.6828 27.9431 15.9108C27.8756 16.1267 27.7507 16.3209 27.5819 16.4745L23.2722 20.553L24.3049 26.3972H24.3048C24.3461 26.6301 24.3209 26.8696 24.2316 27.0895C24.1414 27.3118 23.9894 27.5054 23.7926 27.6488C23.5957 27.7921 23.3618 27.8797 23.1167 27.9015C22.8718 27.9234 22.6253 27.8788 22.4049 27.7727L22.3914 27.7662L22.3781 27.7594L17 25.0079L11.622 27.7594L11.6087 27.7662L11.5952 27.7727C11.3747 27.8788 11.1282 27.9234 10.8832 27.9015C10.6382 27.8797 10.4043 27.7921 10.2075 27.6488C10.0106 27.5054 9.85859 27.3118 9.76836 27.0895C9.67908 26.8696 9.65387 26.6301 9.69517 26.3972H9.69504L10.7277 20.5529L6.41745 16.4739C6.24894 16.3204 6.12431 16.1264 6.05693 15.9108C5.98092 15.6676 5.98102 15.4079 6.05724 15.1647C6.13346 14.9215 6.28236 14.7058 6.48501 14.545L6.52351 14.5155C6.70281 14.3836 6.91384 14.2985 7.13648 14.268L13.1538 13.4198L15.9636 7.87988L16.183 7.71349C16.4152 7.53743 16.7014 7.44183 16.996 7.44183L17.0236 7.44214ZM15.0797 14.9663L15.0761 14.9736L15.0722 14.9809C14.9765 15.1632 14.8378 15.321 14.6674 15.4413C14.497 15.5617 14.2997 15.6413 14.0916 15.6735L14.0831 15.6748L14.0747 15.676L9.70834 16.2914L13.0387 19.4431L13.134 19.655C13.2076 19.8189 13.2456 19.9957 13.2456 20.1744C13.2456 20.2794 13.2324 20.3836 13.2066 20.485L12.4694 24.657L16.3807 22.656L16.4004 22.6458L16.4205 22.6365C16.6014 22.552 16.7995 22.5082 17 22.5082L17.0376 22.5087C17.2127 22.5135 17.3853 22.5517 17.5454 22.6211L17.5795 22.6365L17.5996 22.6458L17.6193 22.656L21.5305 24.657L20.7976 20.5088C20.7672 20.4003 20.7515 20.2879 20.7515 20.1744C20.7515 19.9506 20.8122 19.7307 20.9274 19.5369L21.0114 19.3956L24.2912 16.2917L19.8458 15.666L19.7758 15.6476C19.5969 15.6008 19.4298 15.5187 19.2852 15.4063C19.1405 15.2939 19.0212 15.1536 18.935 14.9944L18.9278 14.981L18.9208 14.9675L16.9974 11.1854L15.0797 14.9663Z"
                                fill="white" />
                        </svg>
                    </span><?php the_field('years_of_experience', 'user_' . $author_id); ?></p>
                <div class="author-expertise"><span>Expertise :</span>
                    <p><?php the_field('expertise', 'user_' . $author_id); ?></p>
                </div>
                <div class="author-social">
                    <div class="author-linkedin">
                        <span>Connect with me at</span>
                        <?php if ($author_linkedin) : ?>
                        <a href="<?php echo esc_url($author_linkedin['url']); ?>"
                            target="<?php echo esc_attr($author_linkedin['target'] ?: '_self'); ?>"
                            rel="noopener noreferrer">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="author-email">
                        <span>Or send me an email at</span>
                        <?php if ($author_email) : ?>
                        <a href="<?php echo esc_url($author_email['url']); ?>"
                            target="<?php echo esc_attr($author_email['target'] ?: '_self'); ?>"
                            rel="noopener noreferrer">
                            <i class="fa-solid fa-square-envelope"></i>
                            <?php echo esc_html($author_email['title']); ?>
                        </a>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="author-bio">
            <?php echo wpautop(get_the_author_meta('description', $author_id)); ?>
        </div>
    </div>
</section>

<section class="author-quote">
    <div class="container">
        <div class="author-block-quote">
            <blockquote>
                <p><?php the_field('author_quote', 'user_' . $author_id); ?></p>
                <cite>~ <?php echo esc_html($author_meta->display_name); ?></cite>
            </blockquote>
        </div>
    </div>
</section>
<section id="author-section-<?php echo esc_attr($author_id); ?>" class="author-section">
    <div class="container">
        <h2>Insights by <?php echo esc_html($author_meta->display_name); ?></h2>

        <div class="author-posts author-posts-<?php echo esc_attr($author_id); ?>">
            <div class="post-grid" id="author-posts-grid-<?php echo esc_attr($author_id); ?>">
                <?php
                $args = array(
                    'author'        => $author_id,
                    'posts_per_page'=> 3,
                    'post_status'   => 'publish',
                    'paged'         => 1
                );
                $author_posts = new WP_Query($args);

                if ($author_posts->have_posts()) :
                    while ($author_posts->have_posts()) : $author_posts->the_post(); ?>
                <article class="post-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumb"><?php the_post_thumbnail('full'); ?></div>
                        <?php endif; ?>
                        <div class="post-detail-content">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo get_the_date('F Y'); ?></p>
                        </div>
                    </a>
                </article>
                <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <div class="author-more-btn">
                <button id="load-more-posts-<?php echo esc_attr($author_id); ?>" data-page="1"
                    data-author="<?php echo esc_attr($author_id); ?>" class="btn">
                    See More Insights →
                </button>
            </div>
        </div>
    </div>
</section>




<?php get_footer(); ?>
<style>
.author-hero {
    /* background: linear-gradient(180deg, #0e0e23 0%, #1c1c3a 100%); */
    color: #fff;
    padding: 80px 0 50px;
    margin-top: 60px;
}

.author-profile-card {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    background-image: url('https://www.elsner.com/wp-content/uploads/2025/10/Rectangle-31594-1.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 22px;
    margin-bottom: 30px;
}

.author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: bottom;
}

.author-details h1 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 10px;
    font-family: Red Hat Display, sans-serif, serif, monospace;
}

.author-details .author-role {
    font-size: 20px;
    font-weight: 700;
    color: #C7C7C7;
    margin-bottom: 40px;
}

.author-exp span {
    display: inline-block;
    margin-right: 12px;
}

.author-exp span svg {
    width: 34px;
    height: 34px;
}

.author-expertise span {
    font-size: 16px;
    font-weight: 700;
    display: inline-block;
    margin-bottom: 8px;
}

.author-expertise p {
    font-size: 20px;
    font-weight: 700;
    color: #E6E0E0;
}

.author header.header {
    background: #fff;
}

.author .header ul.navmenu>li>a {
    color: #4d4d4d;
}

.author .header .sticky-logo {
    display: block;
}

.author .navbar-brand img.logo {
    display: none;
}

.author .header ul.navmenu>li>a.btn.btn-primary {
    color: #fff;
}

.author .menubtn span {
    background: #000;
}

.author button.navbar-toggler.collapsed span {
    background: #000;
}

.author-expertise {
    margin-bottom: 40px;
}

.author-profile-card .author-avatar {
    padding: 20px 70px 0;
    flex: 0 0 calc(40% - 20px);
}

.author-profile-card .author-details {
    flex: 0 0 calc(60% - 20px);
    padding: 60px 20px;
}

.author-social .author-linkedin {
    margin-right: 20px;
}

.author-linkedin span,
.author-email span {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 6px;
    display: inline-block;
}

.author-social a {
    display: block;
    font-size: 16px;
    font-weight: 700;
}

.author-social a i,
.author-social a svg,
.author-social a img {
    margin-right: 10px;
}

.author-exp {
    font-size: 20px;
    font-weight: 700;
    font-family: Red Hat Display, sans-serif;
    margin-bottom: 45px;
}

.author-social {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
}

.author-social a {
    color: #fff;
    font-size: 1.2rem;
}

.author-bio {
    margin-bottom: 20px;
}

.author-bio p {
    color: #002840;
    font-size: 24px;
    font-weight: 500;
}

.author-quote {
    background-image: url('https://elsner-new.elsnerdev.com/wp-content/uploads/2025/09/Image.png');
    background-size: auto;
    background-position: center;
    background-repeat: no-repeat;
    padding: 128px 20px;
}

.author-block-quote {
    max-width: 1348px;
    width: 100%;
    margin: 0 auto;
    border: 2px solid #E8E8E8;
    border-radius: 40px;
    background-color: #fff;
    padding: 88px 20px;
    position: relative;
}

.author-block-quote blockquote {
    max-width: 1068px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.author-block-quote blockquote p {
    font-size: clamp(28px, 4vw, 38px);
    font-weight: 600;
    color: #002840;
}

.author-block-quote cite {
    font-size: 24px;
    font-weight: 700;
    color: #404968;
}

.author-block-quote:before {
    content: '';
    position: absolute;
    top: -80px;
    left: -50px;
    background-image: url("data:image/svg+xml,%3Csvg width='212' height='148' viewBox='0 0 212 148' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg filter='url(%23filter0_dd_2094_1081)'%3E%3Cpath d='M111.042 88.8164C111.042 74.8082 113.183 62.7755 117.465 52.7184C121.746 42.302 127.277 33.8612 134.056 27.3959C140.836 20.5714 148.507 15.7225 157.07 12.849C165.991 9.61633 174.732 8 183.296 8V26.8572C174.019 26.8572 165.277 30.0898 157.07 36.5551C149.221 42.6612 144.582 51.102 143.155 61.8776C144.225 61.5184 145.474 61.1592 146.901 60.8C147.972 60.4408 149.221 60.0816 150.648 59.7225C152.432 59.3633 154.394 59.1837 156.535 59.1837C167.239 59.1837 176.16 63.3143 183.296 71.5755C190.432 79.4776 194 88.8163 194 99.5919C194 110.367 190.254 119.886 182.761 128.147C175.624 136.049 165.991 140 153.859 140C140.3 140 129.775 134.971 122.282 124.914C114.789 114.498 111.042 102.465 111.042 88.8164ZM4 88.8164C4 74.8082 6.14085 62.7755 10.4225 52.7184C14.7042 42.302 20.2347 33.8612 27.0141 27.3959C33.7934 20.5714 41.4648 15.7225 50.0282 12.849C58.9484 9.61633 67.6901 8 76.2535 8V26.8572C66.9765 26.8572 58.2347 30.0898 50.0282 36.5551C42.1784 42.6612 37.5399 51.102 36.1127 61.8776C37.1831 61.5184 38.4319 61.1592 39.8592 60.8C40.9296 60.4408 42.1784 60.0816 43.6056 59.7225C45.3897 59.3633 47.3521 59.1837 49.493 59.1837C60.1972 59.1837 69.1174 63.3143 76.2535 71.5755C83.3897 79.4776 86.9577 88.8163 86.9577 99.5919C86.9577 110.367 83.2113 119.886 75.7183 128.147C68.5822 136.049 58.9484 140 46.8169 140C33.2582 140 22.7324 134.971 15.2394 124.914C7.74648 114.498 4 102.465 4 88.8164Z' fill='white'/%3E%3C/g%3E%3Cdefs%3E%3Cfilter id='filter0_dd_2094_1081' x='0' y='0' width='212' height='148' filterUnits='userSpaceOnUse' color-interpolation-filters='sRGB'%3E%3CfeFlood flood-opacity='0' result='BackgroundImageFix'/%3E%3CfeColorMatrix in='SourceAlpha' type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0' result='hardAlpha'/%3E%3CfeOffset dx='10'/%3E%3CfeGaussianBlur stdDeviation='4'/%3E%3CfeComposite in2='hardAlpha' operator='out'/%3E%3CfeColorMatrix type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0'/%3E%3CfeBlend mode='normal' in2='BackgroundImageFix' result='effect1_dropShadow_2094_1081'/%3E%3CfeColorMatrix in='SourceAlpha' type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0' result='hardAlpha'/%3E%3CfeOffset dy='4'/%3E%3CfeGaussianBlur stdDeviation='2'/%3E%3CfeComposite in2='hardAlpha' operator='out'/%3E%3CfeColorMatrix type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0'/%3E%3CfeBlend mode='normal' in2='effect1_dropShadow_2094_1081' result='effect2_dropShadow_2094_1081'/%3E%3CfeBlend mode='normal' in='SourceGraphic' in2='effect2_dropShadow_2094_1081' result='shape'/%3E%3C/filter%3E%3C/defs%3E%3C/svg%3E%0A");
    background-repeat: no-repeat;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.post-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 30px;
}

.author-section {
    padding: 70px 0;
}

.author-section h2 {
    font-size: clamp(28px, 4vw, 38px);
    font-weight: 600;
    margin-bottom: 30px;
}

.author-section .post-thumb {
    margin-bottom: 20px;
}

.author-section .post-thumb img {
    height: 100%;
    border-radius: 20px;
    width: 100%;
    object-fit: cover;
    aspect-ratio: 5 / 3;
}

.author-section .post-card h3 {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 15px;
}

.author-section .post-card p {
    font-size: 18px;
    font-weight: 500;
    color: #404968;
    margin-bottom: 15px;
}

.post-card {
    transition: transform 0.3s ease, scale 0.3s ease;
}

.post-card:hover {
    scale: 1.1;
}


.author-more-btn {
    text-align: center;
    margin-top: 40px;
}

.author-more-btn .btn {
    background: linear-gradient(180deg, #002840 25%, #002840 100%);
    font-size: 18px;
    font-weight: 500;
    text-transform: capitalize;
    color: #fff;
    padding: 12px 30px;
    border-radius: 6px;
}

@media(max-width:1200px) {
    .author-profile-card .author-avatar {
        padding: 20px 20px 0;
    }
}

@media(max-width:991px) {

    .author-details .author-role,
    .author-details .author-exp,
    .author-details .author-expertise {
        margin-bottom: 20px;
    }

    .author-profile-card .author-details {
        padding: 30px 20px;
    }

    .author-profile-card {
        gap: 0;
    }

    .author-profile-card .author-avatar,
    .author-profile-card .author-details {
        flex: 0 0 calc(50% - 5px);
    }

    .post-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media(max-width:767px) {
    .author-profile-card {
        flex-direction: column-reverse;
    }

    .author-profile-card .author-avatar,
    .author-profile-card .author-details {
        flex: 0 0 100%;
    }

    .post-grid {
        grid-template-columns: 1fr;
    }

    .author-avatar img {
        object-fit: contain;
        height: inherit;
        object-position: unset;
        width: auto;
        vertical-align: bottom;
    }

    .author-profile-card .author-avatar {
        height: 100%;
        text-align: right;
        padding: 0;
    }

    .author-quote {
        background-size: cover;
        padding: 128px 20px 80px;
    }

    .author-block-quote:before {
        background-size: 40% 40%;
        top: -100px;
        left: -20px;
    }

}
</style>
<script>
jQuery(document).ready(function($) {
    $("[id^=load-more-posts-]").each(function() {
        var button = $(this);
        button.on("click", function() {
            var page = parseInt(button.data("page"));
            var author = button.data("author");
            var grid = $("#author-posts-grid-" + author);

            $.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                type: "POST",
                data: {
                    action: "load_more_author_posts",
                    page: page,
                    author: author
                },
                beforeSend: function() {
                    button.text("Loading...");
                },
                success: function(response) {
                    if (response.trim() === "no-more") {
                        button.text("No more posts").prop("disabled", true);
                    } else {
                        grid.append(response);
                        button.data("page", page + 1);
                        button.text("See More Insights →");
                    }
                }
            });
        });
    });
});
</script>
