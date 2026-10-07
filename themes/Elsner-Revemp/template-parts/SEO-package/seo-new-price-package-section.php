<?php
// Retrieve the post ID from the $args array
global $contact_form, $contact_us_link, $post;
$post_id = $args['post_id'];
?>
<script>
    // Enhanced scroll behavior for mobile
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.package-table-container');
        const wrapper = document.querySelector('.package-table-wrapper');
        
        if (window.innerWidth <= 768 && wrapper && container) {
            // Check if scrolled to end
            function checkScrollEnd() {
                const scrollLeft = wrapper.scrollLeft;
                const scrollWidth = wrapper.scrollWidth;
                const clientWidth = wrapper.clientWidth;
                
                if (scrollLeft + clientWidth >= scrollWidth - 5) {
                    container.classList.add('scrolled-end');
                } else {
                    container.classList.remove('scrolled-end');
                }
            }
            
            // Add scroll event listener
            wrapper.addEventListener('scroll', checkScrollEnd);
            
            // Initial check
            checkScrollEnd();
            
            // Smooth scroll to show there's more content
            setTimeout(() => {
                if (wrapper.scrollLeft === 0) {
                    wrapper.scrollTo({
                        left: 50,
                        behavior: 'smooth'
                    });
                    setTimeout(() => {
                        wrapper.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                    }, 1000);
                }
            }, 1500);
        }
    });
</script>
<style>

    .package-table-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 6rem 1rem;
        overflow-x: auto;
    }

    .package-table-container h2 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 3rem;
        color: #111827;
    }

    .package-table-wrapper {
        background: white;
        border-radius: 12px;
        padding-top: 20px;
    }

    .comparison-table {
        width: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    /* Header Row */
    .table-header {
        background: #34495e;
        color: white;
    }

    .feature-header {
        padding: 25px 20px;
        font-size: 1.1rem;
        font-weight: 600;
        background: #005282;
        width: 30%;
        text-align: left;
    }

    .package-header {
        padding: 25px 15px;
        text-align: center;
        background: #005282;
        font-weight: 600;
        position: relative;
        width: 23.33%;
        border: 1px solid;
    }

    /*.basic-header {
        /* background: linear-gradient(135deg, #3498db, #2980b9);
        position: relative;
        border: 2px solid;
        border-right-color: #f39c12;
    }*/

    .package-header.package_recommanded {
        border-left: 2px solid  #f39c12;
        border-right: 2px solid  #f39c12;
        /* background: #34495e; */
        position: relative;
    }

    td.button-cell.package_recommanded a {
        background-color: #f39c12;
    }

    /* 
    .premium-header {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
    } */

    .recommended-badge {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: #f39c12;
        color: white;
        padding: 5px 15px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(243, 156, 18, 0.4);
    }

    .package-name {
        font-size: 1.3rem;
        margin-bottom: 5px;
    }

    .package-price {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    /* Table Body */
    .table-row {
        border-bottom: 1px solid #dbdbdb;
    }

    .table-row:last-child {
        border-bottom: none;
    }

    .feature-cell {
        padding: 18px 20px;
        background: #f8f9fa;
        font-weight: 500;
        color: #2c3e50;
        border-right: 2px solid #dee2e6;
        text-align: left;
    }

    .package-cell {
        padding: 18px 15px;
        text-align: center;
        border-right: 1px solid #ecf0f1;
        background: white;
    }

    .button-cell.package_recommanded,
    .package-cell.package_recommanded {
        border-right: 2px solid #f39c12;
        border-left: 2px solid #f39c12;
    }

    .package-cell {
        background: #ffff;
        /* border-right: 2px solid #e74c3c; */
    }

    .check-mark {
        color: #27ae60;
        font-size: 1.3rem;
        font-weight: bold;
    }

    .cross-mark {
        color: #e74c3c;
        font-size: 1.3rem;
        font-weight: bold;
    }

    .feature-value {
        color: #34495e;
        font-weight: 500;
    }

    /* Button Row */
    .button-row {
        background: #f8f9fa;
    }

    .button-cell {
        padding: 25px 15px;
        text-align: center;
        border-right: 1px solid #ecf0f1;
    }

    .buy-button {
        display: inline-block;
        padding: 12px 25px;
        color: white;
        background: #005282;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .basic-button {
        background: linear-gradient(135deg, #3498db, #2980b9);
    }

    .advanced-button {
        background: linear-gradient(135deg, #f39c12, #e67e22);
    }

    .premium-button {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
    }

    .buy-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Tablet responsiveness */
    @media (max-width: 1024px) {
        .package-table-container {
            padding: 4rem 0.5rem;
        }
        
        .package-table-container h2 {
            font-size: 1.8rem;
            margin-bottom: 2rem;
        }
        
        .feature-header {
            padding: 20px 15px;
            font-size: 1rem;
        }
        
        .package-header {
            padding: 20px 10px;
        }
        
        .package-name {
            font-size: 1.2rem;
        }
        
        .package-price {
            font-size: 0.9rem;
        }
        
        .feature-cell, .package-cell, .button-cell {
            padding: 15px 10px;
        }
    }

    /* Mobile responsiveness - Enhanced */
    @media (max-width: 768px) {
        body {
            padding: 5px;
            background-color: #f5f7fa;
        }
        
        .package-table-container {
            padding: 1rem 0.25rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .package-table-container h2 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            padding: 0 10px;
        }
        
        .package-table-wrapper {
            border-radius: 8px;
            margin: 0 5px;
        }
        
        .comparison-table {
            min-width: 580px;
            font-size: 0.8rem;
            border-radius: 8px;
         
        }
        
        .feature-header {
            padding: 12px 6px;
            font-size: 0.85rem;
            width: 40%;
            line-height: 1.2;
            word-break: break-word;
        }
        
        .package-header {
            padding: 12px 4px;
            width: 20%;
        }
        
        .package-name {
            font-size: 0.9rem;
            margin-bottom: 2px;
            font-weight: 700;
        }
        
        .package-price {
            font-size: 0.7rem;
            line-height: 1.1;
        }
        
        .recommended-badge {
            font-size: 0.6rem;
            padding: 2px 6px;
            top: -6px;
            border-radius: 10px;
        }
        
        .feature-cell {
            padding: 10px 6px;
            font-size: 0.75rem;
            line-height: 1.2;
            word-break: break-word;
        }
        
        .package-cell {
            padding: 10px 4px;
            vertical-align: middle;
        }
        
        .button-cell {
            padding: 12px 4px;
        }
        
        .check-mark, .cross-mark {
            font-size: 1rem;
        }
        
        .feature-value {
            font-size: 0.7rem;
            line-height: 1.1;
            word-break: break-word;
            hyphens: auto;
        }
        
        .buy-button {
            padding: 6px 8px;
            font-size: 0.75rem;
            border-radius: 4px;
            min-width: 60px;
        }
        
        /* Better touch targets */
        .buy-button:hover {
            transform: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
    }

    /* Small mobile responsiveness - Enhanced */
    @media (max-width: 480px) {
        .package-table-container {
            padding: 0.75rem 0.1rem;
        }
        
        .package-table-container h2 {
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
            padding: 0 5px;
        }
        
        .package-table-wrapper {
            margin: 0 2px;
        }
        
        .comparison-table {
            min-width: 520px;
            font-size: 0.75rem;
        }
        
        .feature-header {
            padding: 10px 4px;
            font-size: 0.8rem;
            width: 42%;
        }
        
        .package-header {
            padding: 10px 2px;
            width: 19.33%;
        }
        
        .package-name {
            font-size: 0.85rem;
            margin-bottom: 1px;
        }
        
        .package-price {
            font-size: 0.65rem;
        }
        
        .recommended-badge {
            font-size: 0.55rem;
            padding: 1px 4px;
            top: -5px;
        }
        
        .feature-cell {
            padding: 8px 4px;
            font-size: 0.7rem;
        }
        
        .package-cell {
            padding: 8px 2px;
        }
        
        .button-cell {
            padding: 10px 2px;
        }
        
        .feature-value {
            font-size: 0.65rem;
            line-height: 1;
        }
        
        .buy-button {
            padding: 5px 6px;
            font-size: 0.7rem;
            min-width: 50px;
        }
        
        .check-mark, .cross-mark {
            font-size: 0.9rem;
        }
    }

    /* Very small screens - Enhanced */
    @media (max-width: 360px) {
        .package-table-container {
            padding: 0.5rem 0.05rem;
        }
        
        .package-table-container h2 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            padding: 0 3px;
        }
        
        .comparison-table {
            min-width: 480px;
            font-size: 0.7rem;
        }
        
        .feature-header {
            padding: 8px 3px;
            font-size: 0.75rem;
            width: 44%;
        }
        
        .package-header {
            padding: 8px 1px;
            width: 18.67%;
        }
        
        .package-name {
            font-size: 0.8rem;
            margin-bottom: 1px;
        }
        
        .package-price {
            font-size: 0.6rem;
        }
        
        .recommended-badge {
            font-size: 0.5rem;
            padding: 1px 3px;
            top: -4px;
        }
        
        .feature-cell {
            padding: 6px 3px;
            font-size: 0.65rem;
            line-height: 1.1;
        }
        
        .package-cell {
            padding: 6px 1px;
        }
        
        .button-cell {
            padding: 8px 1px;
        }
        
        .feature-value {
            font-size: 0.6rem;
            line-height: 0.9;
        }
        
        .buy-button {
            padding: 4px 5px;
            font-size: 0.65rem;
            min-width: 45px;
        }
        
        .check-mark, .cross-mark {
            font-size: 0.8rem;
        }
    }

    /* Mobile scroll hint - Enhanced with custom styling */
    @media (max-width: 768px) {
        
        .package-table-wrapper::before {
            content: "";
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 6px solid #e8f4f8;
            z-index: 5;
        }
    }

    /* Custom Scrollbar for Mobile */
    @media (max-width: 768px) {
        .package-table-container {
            scroll-behavior: smooth;
            /* Custom scrollbar styling */
            scrollbar-width: thin;
            scrollbar-color: #667eea #f1f5f9;
        }
        
        .package-table-container::-webkit-scrollbar {
            height: 12px;
            width: 12px;
        }
        
        .package-table-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
            border: 2px solid #fff;
        }
        
        .package-table-container::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 10px;
            border: 2px solid #f1f5f9;
            cursor: pointer;
        }
        
        .package-table-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a4190);
            box-shadow: 0 2px 6px rgba(102, 126, 234, 0.3);
        }
        
        .package-table-container::-webkit-scrollbar-thumb:active {
            background: linear-gradient(45deg, #4c5bc4, #5d3a7e);
        }
        
        .package-table-container::-webkit-scrollbar-corner {
            background: #f1f5f9;
        }
        
        /* Custom scrollbar for the table wrapper */
        .package-table-wrapper {
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: #667eea #f8fafc;
        }
        
        .package-table-wrapper::-webkit-scrollbar {
            height: 10px;
        }
        
        .package-table-wrapper::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 8px;
            margin: 0 10px;
        }
        
        .package-table-wrapper::-webkit-scrollbar-thumb {
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 8px;
            cursor: grab;
            transition: all 0.3s ease;
        }
        
        .package-table-wrapper::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(90deg, #5a6fd8, #6a4190);
            transform: scaleY(1.2);
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
        }
        
        .package-table-wrapper::-webkit-scrollbar-thumb:active {
            cursor: grabbing;
            background: linear-gradient(90deg, #4c5bc4, #5d3a7e);
            transform: scaleY(1.1);
        }
        
        /* Scroll indicators with arrows */
        .package-table-container {
            position: relative;
        }
        
        .package-table-container::before {
            content: "→";
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(102, 126, 234, 0.9);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: bold;
            z-index: 10;
            pointer-events: none;
            animation: bounce-right 2s infinite;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }
        
        @keyframes bounce-right {
            0%, 100% { transform: translateY(-50%) translateX(0); }
            50% { transform: translateY(-50%) translateX(5px); }
        }
        
        /* Hide arrow when scrolled to end */
        .package-table-container.scrolled-end::before {
            display: none;
        }
    }
</style>

<?php
$package_html = array();
$package_html['package_header'][] = '<th class="feature-header">Feature</th>';

$enable_support_package = get_field('enable_support_package', $post_id);
$support_package_title = (!empty(get_field('support_package_title', $post_id))) ? get_field('support_package_title', $post_id) : 'WordPress Support Package Update ~';
$support_package_tagline = get_field('support_package_tagline', $post_id);

$support_package_details = array();
$support_package_features = array();
if ( $enable_support_package && have_rows('all_support_packages', $post_id)) :
    $index = 0;
    while (have_rows('all_support_packages', $post_id)) : the_row();
        $enable_package = get_sub_field('enable_package', $post_id);
        $package_name = get_sub_field('package_name', $post_id);
        $package_price = get_sub_field('package_price', $post_id);
        $package_recommanded = get_sub_field('package_recommanded', $post_id);
        $package_description = get_sub_field('package_description', $post_id);
        $package_icon = get_sub_field('package_icon', $post_id);
        $package_button_link = get_sub_field('package_button_link', $post_id);
        
        if( $enable_package && !empty($package_name) && !empty($package_price) && have_rows('package_features', $post_id) ){

            $temp_details = array();
            $temp_details['status'] = $enable_package;
            $temp_details['recommanded'] = $package_recommanded;
            $temp_details['name'] = $package_name;
            $temp_details['price'] = $package_price;
            $temp_details['package_description'] = $package_description;
            $temp_details['package_icon'] = $package_icon;
            $temp_details['package_link'] = $package_button_link;

            $package_name_slug = str_replace(' ', '_', strtolower($package_name));
            $temp_package_header = '';
            $temp_package_header_class = '';
            if( $package_recommanded ){
                $temp_package_header_class = ' package_recommanded';
            }

            $temp_package_header = '<th class="package-header '.$package_name_slug.'-header'.$temp_package_header_class.'">';
                if( $package_recommanded ){
                    $temp_package_header .= '<div class="recommended-badge">RECOMMENDED</div>';
                }
                $temp_package_header .= '<div class="package-name">'.$package_name.'</div>';
                $temp_package_header .= '<div class="package-price">('.$package_price.')</div>';
            $temp_package_header .= '</th>';

            $package_html['package_header'][] = $temp_package_header;

            $link_title = 'Buy '.$package_name;
            $link_url = '#';
            $link_target = '';

            if( isset($package_button_link['url']) && !empty($package_button_link['url']) ){
                $link_url = $package_button_link['url'];
            }
            if( isset($package_button_link['title']) && !empty($package_button_link['title']) ){
                $link_title = $package_button_link['title'];
            }
            if( isset($package_button_link['target']) && !empty($package_button_link['target']) ){
                $link_target = ' target="_blank"';
            }

            $package_html['package_button_html'][$package_name_slug] = '<td class="button-cell '.$package_name_slug.'-cell'.$temp_package_header_class.'">
                <a href="'.$link_url.'" class="buy-button"'.$link_target.'>'.$link_title.'</a>
            </td>';

            $i=0;
            while (have_rows('package_features', $post_id)) { the_row();
                $feature_title = get_sub_field('feature_title', $post_id);
                $feature_status = get_sub_field('feature_status', $post_id);
                    //$support_package_features[$index][''] = $;

                $temp_features = array();
                $temp_features['label'] = $feature_title['label'];
                $temp_features['status'] = $feature_status;

                $temp_package_feature = '';
                $temp_package_feature_status = '<span class="cross-mark">✗</span>';
                if( !empty($feature_status) && strtolower($feature_status) == 'yes' ){
                    $temp_package_feature_status = '<span class="check-mark">✓</span>';
                }else if( !empty($feature_status) && strtolower($feature_status) != 'yes' && strtolower($feature_status) != 'no' ){
                    $temp_package_feature_status = '<span class="feature-value">'.$feature_status.'</span>';
                }

                if( !isset($package_html['package_feature_html'][$feature_title['label']][0]) ){
                    $package_html['package_feature_html'][$feature_title['label']][0] = '<td class="feature-cell">'.$feature_title['label'].'</td>';
                }

                $package_html['package_feature_html'][$feature_title['label']][$package_name_slug] .= '<td class="package-cell '.$package_name_slug.'-cell'.$temp_package_header_class.'">';
                    $package_html['package_feature_html'][$feature_title['label']][$package_name_slug] .= $temp_package_feature_status;
                $package_html['package_feature_html'][$feature_title['label']][$package_name_slug] .= '</td>';
                
                $temp_details['features'][] = $temp_features;
                $i++;
            }
            $support_package_details[] = $temp_details;
        }
        $index++;
    endwhile; ?>

    <div class="package-table-container">
        <h2><?= $support_package_title; ?></h2>
        <div class="package-table-wrapper">
            <table class="comparison-table">
                <thead>
                    <tr class="table-header">
                        <?php if( isset($package_html['package_header']) ){
                            echo implode(' ', $package_html['package_header']);
                        } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($package_html['package_feature_html'] as $key => $value) {
                        echo '<tr class="table-row">';
                            echo implode(' ', $value);
                        echo '</tr>';
                    } ?>
                    <tr class="button-row">
                        <td class="feature-cell"></td>
                        <?php if( isset($package_html['package_button_html']) ){
                            echo implode(' ', $package_html['package_button_html']);
                        } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif;