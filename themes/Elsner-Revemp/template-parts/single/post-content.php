<?php
global $contact_us_link;
?>

<section class="blog-detail-banner blue-section padding-80">
    <div class="container">
        <div class="row block-box-banner-wrapper">
            <div class="single-blog_wrapper col-md-6 col-sm-12">
                <div class="breadcrumb-wrapper">
                    <?php custom_breadcrumbs(); ?>
                </div>
                <?php //while (have_posts()) : the_post();
                $author_url = get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>

                <div class="blog_inner_wrapper">
                    <div class="blog-head">
                    <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                echo '<span class="category-text-blog-detail-page">' . esc_html($category->name) . '</span>';
                                echo '<span class="category-link-blog-detail-page"><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></span>';
                            }
                        }
                        ?>
                        <h1 class="banners-headding"><?php the_title(); ?></h1>
                    </div>

                    <div class="blog-dates">
                        <ul>
                            <li>
                                Published: <?php the_time("M d, Y"); ?>
                            </li>
                            <li>
                                Updated: <?php the_modified_time("M d, Y"); ?>
                            </li>
                            <li>
                                Read Time:
                                <?php echo get_the_content_reading_time(); ?> mins
                            </li>
                            <li>
                                Author: <a href="<?= $author_url; ?>"><?php echo get_the_author(); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="single-blog-banner-image col-md-6 col-sm-12">
                <?php if ('' !== get_the_post_thumbnail()) : ?>
                    <div class="blog_image_wrapper">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="single-blog-content-section">
    <div class="container">
        <div class="blog_content_bar">
            <div class="row">
                
                <div class="col-lg-9 col-md-12">
                    <div class="post-data">
                        <?php echo apply_filters('the_content', $modified_content); ?>
                        <div class="blog_tag_row d-flex">
                            <?php echo get_the_tag_list(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="sidebar-sticky">
                        <div class="blog-table social-blog">
                            <h4>Share this Blog</h4>
                            <ol>
                                <li><a href="<?php echo esc_url('http://www.reddit.com/submit?url=' . get_permalink()); ?>"
                                        target="_blank" aria-label="social icon">
                                        <i class="fa-brands fa-reddit"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url('https://www.linkedin.com/sharing/share-offsite/?url=' . get_permalink()); ?>"
                                        target="_blank" aria-label="social icon"><i
                                            class="fa-brands fa-linkedin-in"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u=' . get_permalink()); ?>"
                                        target="_blank" aria-label="social icon"><i
                                            class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url('https://twitter.com/intent/tweet?url=' . get_permalink()); ?>"
                                        target="_blank" aria-label="social icon"><i
                                            class="fa-brands fa-x-twitter"></i></a>
                                </li>
                                <li>
                                    <a id="open-newsletter-blog-popup" href="#" aria-label="social icon"><i class="fa-solid fa-envelope"></i></a>
                                </li>
                            </ol>
                        </div>
                        <?php if (get_the_ID() !== 8212) : ?>
                        <div class="blog-table more-traffic-section">
                            <div class="heading-wrapper">
                                <h3>Let's discuss <br><span>your project</span></h3>
                            </div>
                            <div class="traffic-form">
                                <?php echo do_shortcode('[contact-form-7 id="34771" title="Single post"]'); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php
            // Get the author name
            $author_name = get_the_author_meta('display_name');

            // Check if the author is 'Pankaj Sakariya'
            if ($author_name === 'Harshal Shah') {
            ?>
                <div class="blog_footer">
                    <div class="author_thumbnail">
                        <div class="thumb_cover">
                            <img src="https://www.elsner.com/wp-content/uploads/2024/09/Harshal.png" alt="<?php echo esc_attr($author_name); ?>" width="160" height="160">
                        </div>
                        <div class="author-desc">
                            <h4>About Author</h4>
                            <h5>Harshal Shah - Founder & CEO of Elsner Technologies</h5>
                            <p>Harshal is an accomplished leader with a vision for shaping the future of technology. His passion for innovation and commitment to delivering cutting-edge solutions has driven him to spearhead successful ventures. With a strong focus on growth and customer-centric strategies, Harshal continues to inspire and lead teams to achieve remarkable results.</p>
                            <!-- Add Social Media Links Here -->
                            <div class="blog-footer-social-links">
                                <div class="blog-footer-social-links-inner-block">
                                    <a href="https://www.facebook.com/TheHarshalShah/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/harshalelsner?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a href="https://in.linkedin.com/in/harshalelsner" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.instagram.com/harshalelsner/" target="_blank"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <!-- End of Social Media Links -->
                            <div class="bookbtn">
                                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary">Let's Connect</a>
                            </div>
                        </div>


                    </div>
                </div>
            <?php
            }
            // Check if the author is 'Pankaj Sakariya'
            if ($author_name === 'Pankaj Sakariya') {
            ?>
                <div class="blog_footer">
                    <div class="author_thumbnail">
                        <div class="thumb_cover">
                            <img src="https://www.elsner.com/wp-content/uploads/2024/09/Pankaj-sakariya.png" alt="<?php echo esc_attr($author_name); ?>" width="160" height="160">
                        </div>
                        <div class="author-desc">
                            <h4>About Author</h4>
                            <h5>Pankaj Sakariya - Delivery Manager</h5>
                            <p>Pankaj is a results-driven professional with a track record of successfully managing high-impact projects. His ability to balance client expectations with operational excellence makes him an invaluable asset. Pankaj is committed to ensuring smooth delivery and exceeding client expectations, with a strong focus on quality and team collaboration.</p>

                            <!-- Add Social Media Links Here -->
                            <div class="blog-footer-social-links">
                                <div class="blog-footer-social-links-inner-block">
                                    <a href="https://in.linkedin.com/in/pankaj-sakariya-20014a20" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <!-- End of Social Media Links -->
                            <div class="bookbtn">
                                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary">Let's Connect</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            // Check if the author is 'Tarun Bansal'
            if ($author_name === 'Tarun Bansal') {
            ?>
                <div class="blog_footer">
                    <div class="author_thumbnail">
                        <div class="thumb_cover">
                            <img src="https://www.elsner.com/wp-content/uploads/2024/09/Tarun-Bansal.png" width="160" height="160">
                        </div>
                        <div class="author-desc">
                            <h4>About Author</h4>
                            <h5>Tarun Bansal - Technical Head</h5>
                            <p>Tarun is a technology enthusiast with a flair for solving complex challenges. His technical expertise and deep knowledge of emerging trends have made him a go-to person for strategic tech initiatives. Passionate about innovation, Tarun continuously explores new ways to drive efficiency and performance in every project he undertakes.</p>
                            <!-- Add Social Media Links Here -->
                            <div class="blog-footer-social-links">
                                <div class="blog-footer-social-links-inner-block">
                                    <a href="https://in.linkedin.com/in/tarun-bansal-4b062640" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <!-- End of Social Media Links -->
                            <div class="bookbtn">
                                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary">Let's Connect</a>
                            </div>
                        </div>


                    </div>
                </div>
            <?php
            }

            // Check if the author is 'Dipak Patil'
            if ($author_name === 'Dipak Patil') {
            ?>
                <div class="blog_footer">
                    <div class="author_thumbnail">
                        <div class="thumb_cover">
                            <img src="https://www.elsner.com/wp-content/uploads/2024/09/Dipak-patil.png" width="160" height="160">
                        </div>
                        <div class="author-desc">
                            <h4>About Author</h4>
                            <h5>Dipak Patil - Delivery Head & Partner Manager</h5>
                            <p>Dipak is known for his ability to seamlessly manage and deliver top-notch projects. With a strong emphasis on quality and customer satisfaction, he has built a reputation for fostering strong client relationships. His leadership and dedication have been instrumental in guiding teams towards success, ensuring timely and effective delivery of services.</p>
                            <!-- Add Social Media Links Here -->
                            <div class="blog-footer-social-links">
                                <div class="blog-footer-social-links-inner-block">
                                    <a href="https://in.linkedin.com/in/patildipakmagento" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <!-- End of Social Media Links -->
                            <div class="bookbtn">
                                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary">Let's Connect</a>
                            </div>
                        </div>


                    </div>
                </div>
            <?php
            }
            // Check if the author is 'Dipak Patil'
            if ($author_name === 'Manoj Mondal') {
            ?>
                <div class="blog_footer">
                    <div class="author_thumbnail">
                        <div class="thumb_cover">
                            <img src="https://www.elsner.com/wp-content/uploads/2024/09/Manoj-Mondal.png" width="160" height="160">
                        </div>
                        <div class="author-desc">
                            <h4>About Author</h4>
                            <h5>Manoj Mondal - Team Lead - Magento</h5>
                            <p>Manoj has a deep-rooted expertise in the ecommerce landscape, particularly in building and optimizing online experiences. His keen understanding of technology, paired with a hands-on approach, has enabled him to navigate complex projects with ease. Known for his collaborative spirit and technical acumen, he consistently drives projects to success.
                            </p>
                            <!-- Add Social Media Links Here -->
                            <div class="blog-footer-social-links">
                                <div class="blog-footer-social-links-inner-block">
                                    <a href="https://www.linkedin.com/in/manoj-mondal-8387a3134?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <!-- End of Social Media Links -->
                            <div class="bookbtn">
                                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary">Let's Connect</a>
                            </div>
                        </div>


                    </div>
                </div>
            <?php
            }
            // Check if the author is 'Varun Rajyaguru'
            if ($author_name === 'Aakif Kadiwala') {
            ?>
                <div class="blog_footer">
                    <div class="author_thumbnail">
                        <div class="thumb_cover">
                            <img src="https://www.elsner.com/wp-content/uploads/2025/07/Aakif_1753364078576-1.jpg" alt="<?php echo esc_attr($author_name); ?>" width="160" height="160">
                        </div>
                        <div class="author-desc">
                            <h4>About Author</h4>
                            <h5>Aakif Kadiwala – Delivery Head WordPress</h5>
                            <p>Aakif is a seasoned WordPress expert with 10 years of experience in building, customizing, and scaling WordPress and WooCommerce websites. From tailor-made themes to complex plugin integrations, Akif has helped businesses across the globe turn their digital goals into reality. His deep technical knowledge, problem-solving mindset, and passion for performance make him a go-to resource for anything WordPress.
                            </p>
                            <!-- Add Social Media Links Here -->
                            <div class="blog-footer-social-links">
                                <div class="blog-footer-social-links-inner-block">
                                    <a href="https://in.linkedin.com/in/aakif-kadiwala-514545154" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <!-- End of Social Media Links -->
                            <div class="bookbtn">
                                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary">Let's Connect</a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            }
            //check if the author is "Rohan Pandey"
            if ($author_name === 'Rohan Pandey') {
            ?>
                <div class="blog_footer">
                    <div class="author_thumbnail">
                        <div class="thumb_cover">
                            <img src="https://www.elsner.com/wp-content/uploads/2026/08/image_picker_64AD9587-7B3C-4367-9EC2-BADF2871ECE9-48027-000010565E684714_1786347142394_1786359916458.jpg" alt="<?php echo esc_attr($author_name); ?>" width="160" height="160">
                        </div>
                        <div class="author-desc">
                            <h4>About Author</h4>
                            <h5>Rohan Pandey – QA Engineer</h5>
                            <p>Rohan is a quality-focused QA Engineer passionate about delivering reliable, high-performing and user-friendly software. With a strong eye for detail and a problem-solving mindset, he works closely with development and business teams to identify issues early, improve testing processes, and ensure every release meets high standards of quality. He is continuously exploring smarter testing practices and AI-driven solutions to make software quality faster, stronger and more efficient.
                            </p>
                            <!-- Add Social Media Links Here -->
                            <div class="blog-footer-social-links">
                                <div class="blog-footer-social-links-inner-block">
                                    <a href="https://www.linkedin.com/in/rohan-pandey-9639952b3/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <!-- End of Social Media Links -->
                            <div class="bookbtn">
                                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary">Let's Connect</a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            } 
            ?>
        </div>
        <?php
        the_post_navigation(array(
            'prev_text' => '<span class="pagination-link">' . __('Previous Article', 'twentyseventeen') . '</span>',
            'next_text' => '<span class="pagination-link">' . __('Next Article', 'twentyseventeen') . '</span>',
            'screen_reader_text' => 'Continue Reading',
        )); ?>
    </div>
</section>
