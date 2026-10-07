<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$heading_group = get_field('heading_group', $post_id);

?>
<section class="testing-group-table blue-section padding-80">
    <div class="container">
        <div class="block-title text-center max-900">
            <h2>Mobile Testing Group – Technology Coverage</h2>
        </div>
        <div class="testing-table-wrapper">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <h6>Technology Expertise</h6>
                            </td>

                            <?php
                            if (have_rows('technology_row', $post_id)) :
                                while (have_rows('technology_row', $post_id)) : the_row();
                                    $technology_icon = get_sub_field('icon', $post_id);
                                    $technology_icon_url = wp_get_attachment_image_src($technology_icon, 'full');
                                    echo '<td><img src="' . $technology_icon_url[0] . '" alt="table icon" width="70" height="70"></td>';
                                endwhile;
                            endif;
                            ?>

                        </tr>
                        <tr>
                            <td>
                                <h6>No. of Year Experience</h6>
                            </td>
                            <?php
                            if (have_rows('years_of_experiance_row', $post_id)) :
                                while (have_rows('years_of_experiance_row', $post_id)) : the_row();
                                    echo '<td>';
                                    echo '<h6>' . get_sub_field('label') . '</h6>';
                                    echo '</td>';
                                endwhile;
                            endif;
                            ?>
                        </tr>
                        <tr>
                            <td>
                                <h6>Total Project Executed</h6>
                            </td>
                            <?php
                            if (have_rows('executed_row', $post_id)) :
                                while (have_rows('executed_row', $post_id)) : the_row();
                                    echo '<td>';
                                    echo '<h6>' . get_sub_field('label') . '</h6>';
                                    echo '</td>';
                                endwhile;
                            endif;
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>