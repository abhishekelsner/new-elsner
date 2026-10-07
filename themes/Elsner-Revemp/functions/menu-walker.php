<?php
// class NewElsnerMenu extends Walker_Nav_Menu
// {
//     function start_lvl(&$output, $depth = 0, $args = array())
//     {
//         $indent = str_repeat("\t", $depth);
//         $sub_menu = '';
//         if (get_field('sub_menu', $item->ID)) {
//             $sub_menu = ' dropdown-menu';
//         }
//         $output .= "\n$indent<ul class=\"dropdown-menu$sub_menu\">\n";
//     }

//     function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
//     {
//         $classes = $item->classes;
//         $enable_mega_menu = get_field('enable_mega_menu', $item);
//         $singlemenu_class = in_array('single-submenu', $classes) ? 'single-menu-items' : '';
//         $doublemenu_class = in_array('double-submenu', $classes) ? 'double-menu-items' : '';

//         if ($enable_mega_menu) {
//             $output .= '<li class="dropdown ' . $singlemenu_class . ''.$doublemenu_class.'">';
//             $output .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
//             $output .= $item->title;
//             $output .= '</a>';
//         } else {
//             $atts['href'] = !empty($item->url) ? $item->url : '';
//             $atts['target'] = in_array('menu-item-new-tab', $item->classes) ? '_blank' : '';
//             foreach ($atts as $attr => $value) {
//                 if (!empty($value)) {
//                     $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
//                     $attributes .= ' ' . $attr . '="' . $value . '"';
//                 }
//             }

//             // Check if the current item is active
//             //$classes = $item->classes;
//             $active_class = in_array('current-menu-item', $classes) ? 'active' : '';
//             $call_now_button_class = in_array('call-now-button', $classes) ? 'btn btn-primary' : '';

//             $output .= '<li class="' . $active_class . '">';
//             $output .= '<a' . $attributes . ' class="' . $call_now_button_class . '">';
//             $output .= $item->title;

//             $output .= '</a>';
//         }
//         $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
//     }

//     public function end_el(&$output, $item, $depth = 0, $args = array())
//     {
//         global $contact_us_link;
//         $enable_mega_menu = get_field('enable_mega_menu', $item);
//         if ($enable_mega_menu) {

//             $menu_items = get_field('menu_block', $item);

//             $output .= '<div class="dropdown-menu"><div class="container"><div class="submenu-wrapper">';

//             if (!empty($menu_items)) {
//                 if (have_rows('menu_block', $item)) {

//                     while (have_rows('menu_block', $item)) : the_row();

//                         $main_menu_link = get_sub_field('menu_link', $item);
//                         //  $output .= '<li>';
//                         $output .= '<div class="submenu-item">
//                             <div class="sub-menu">';
//                         if ($main_menu_link == '' || $main_menu_link == '#') {
//                             $output .= '<h5>' . get_sub_field("menu_title", $item) . '</h5>';
//                         } else {
//                             $output .= '<a href="' . $main_menu_link . '"><img  src="' . get_sub_field('menu_icon', $item) . '">' . get_sub_field("menu_title", $item) . '</a>';
//                         }
//                         if (have_rows('menu_items', $item)) {
//                             $output .= '<ul>';
//                             while (have_rows('menu_items', $item)) : the_row();
//                                 $output .= '<li><a href="' . get_sub_field('page', $item) . '">' . get_sub_field('page_title', $item) . '</a></li>';
//                             endwhile; //menu_items

//                         } // menu_items 
//                         $output .= '</ul>';
//                         $output .= '</div></div>';

//                     endwhile; // menu_block 

//                 } // menu_block
//             }
//             $output .= '</div></div>';
//             $output .= '<div class="lets-connect">
//                                 <div class="container">
//                                     <div class="connect-wrapper">
                        
//                                     <h4>' . get_field('mm_title', 'option') . '</h4>
                                        
//                                         <a class="btn btn-primary white-btn" href="' . $contact_us_link . '">' . get_field('mm_button_title', 'option') . '</a>
//                                     </div>
//                                 </div>
//                             </div>';

//             $output .= '</div>';
//         }
//     }
// }

class NewElsnerMenu extends Walker_Nav_Menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        // Only top-level items
        if ($depth !== 0) {
            return;
        }

        // ACF toggle on menu item
        $enable_mega = get_field('enable_mega_menu', $item);

        $enable_industries = get_field('enable_industries_mega', $item);

        if ($enable_industries) {
            $this->render_industries_mega($output, $item);
            return;
        }

        // Inside start_el, add this check:
        $enable_resource = get_field('enable_resource_mega', $item);
        if ($enable_resource) {
            $this->render_resource_mega($output, $item);
            return;
        }


        if (!$enable_mega) {
            // Normal menu item
            $output .= '<li class="menu-item">';
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
            $output .= '</li>';
            return;
        }

        /**
         * =================================================
         * READ menu_block ONCE (VERY IMPORTANT)
         * =================================================
         */
        $menu_blocks = [];

        if (have_rows('menu_block', $item)) {
            while (have_rows('menu_block', $item)) : the_row();

                $menu_blocks[] = [
                    'title'        => get_sub_field('menu_title'),
                    'items'        => get_sub_field('menu_items'),
                    'tech_stack'   => get_sub_field('menu_tech_stack'),
                    'footer_image' => get_sub_field('menu_footer_image'),
                    'menu_link'    => get_sub_field('menu_link'),
                ];

            endwhile;
        }

        if (empty($menu_blocks)) {
            return;
        }

        /**
         * =================================================
         * MEGA MENU MARKUP
         * =================================================
         */
        $output .= '<li class="elsner-header-menu menu-item has-mega">';
        $output .= '<a href="#">' . esc_html($item->title) . '</a>';
        $output .= '<div class="mega-menu">';

        
        /**
         * =================================================
         * LEFT COLUMN
         * =================================================
         */
        $output .= '<div class="mega-left">';
        foreach ($menu_blocks as $i => $block) {

            $left_id = 'left-' . sanitize_title($block['title']);
            $active  = ($i === 0) ? ' active' : '';

            // Get the menu link (if exists)
            $menu_link = !empty($block['menu_link']) ? $block['menu_link'] : '#';
            $has_link = ($menu_link !== '#' && !empty($menu_link));

            $output .= '<a href="' . esc_url($menu_link) . '" class="mega-left-item' . $active . '" data-target="' . esc_attr($left_id) . '" data-has-link="' . ($has_link ? 'true' : 'false') . '">';
            $output .= esc_html($block['title']);
            $output .= '</a>';

        }
        $output .= '</div>';

        /**
         * =================================================
         * CENTER COLUMN
         * =================================================
         */
        $output .= '<div class="mega-center mega-center-drilldown">';

        foreach ($menu_blocks as $i => $block) {

            $left_id = 'left-' . sanitize_title($block['title']);
            $active  = ($i === 0) ? ' active' : '';

            $output .= '<div class="mega-center-content' . $active . '" id="' . esc_attr($left_id) . '">';

            

            if (!empty($block['items'])) {
                $output .= '<ul class="mega-menu-list">';
                foreach ($block['items'] as $row) {
                    if (!empty($row['page'])) {
                        $output .= '<li>';
                        $output .= '<a href="' . esc_url($row['page']) . '">' . esc_html($row['page_title']) . '</a>';
                        $output .= '</li>';
                    }
                }
                $output .= '</ul>';
            }

            $output .= '</div>';
        }

        // Global search
        $output .= '<div class="mega-menu-search-wrapper global-search">';
        $output .= '<div class="mega-search-box">';
        $output .= '<input type="text" class="mega-menu-search-input" placeholder="Search">';
        $output .= '<button type="submit" class="mega-search-btn" aria-label="Search">';
        $output .= '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">';
        $output .= '<circle cx="11" cy="11" r="7" stroke="#007AC1" stroke-width="2"/>';
        $output .= '<line x1="16.65" y1="16.65" x2="22" y2="22" stroke="#007AC1" stroke-width="2" stroke-linecap="round"/>';
        $output .= '</svg>';
        $output .= '</button>';
        $output .= '</div>';
        $output .= '</div>';


        $output .= '</div>';

        /**
         * =================================================
         * RIGHT COLUMN (PER TITLE TECH STACK + FOOTER)
         * =================================================
         */
        $output .= '<div class="mega-right">';

        foreach ($menu_blocks as $i => $block) {

            $right_id = 'right-' . sanitize_title($block['title']);
            $active   = ($i === 0) ? ' active' : '';

            $output .= '<div class="mega-right-content' . $active . '" id="' . esc_attr($right_id) . '">';

            /* ---------- TECH STACK ---------- */
            if (!empty($block['tech_stack'])) {
                $output .= '<ul class="mega-tech-stack">';

                foreach ($block['tech_stack'] as $tech) {
                    $output .= '<li class="tech-stack-item">';

                    if (!empty($tech['tech_stack_icon'])) {
                        $output .= '<img src="' . esc_url($tech['tech_stack_icon']) . '" alt="">';
                    }

                    if (!empty($tech['tech_stack_title'])) {
                        $output .= '<span>' . esc_html($tech['tech_stack_title']) . '</span>';
                    }

                    $output .= '</li>';
                }

                $output .= '</ul>';
            }

            /* ---------- FOOTER IMAGE ---------- */
            if (!empty($block['footer_image'])) {
                $output .= '<div class="mega-footer-image">';
                $output .= '<img src="' . esc_url($block['footer_image']) . '" alt="">';
                $output .= '</div>';
            }

            $output .= '</div>';
        }

        $output .= '</div>'; // mega-right
        $output .= '</div>'; // mega-menu
        $output .= '</li>';
    }

    private function render_industries_mega(&$output, $item) {

        if (!have_rows('menu_industries_item', $item)) {
            return;
        }

        $industries = [];

        while (have_rows('menu_industries_item', $item)) : the_row();
            $page = get_sub_field('industry_page');

            if (!$page) continue;

            $industries[] = [
                
                'title'   => get_sub_field('industry_title') ?: get_the_title($page->ID),
                'page'    => $page,
                'image'   => get_the_post_thumbnail_url($page->ID, 'full'),
                'excerpt' => wp_trim_words($page->post_excerpt ?: $page->post_content, 25),
                'url'     => get_permalink($page->ID),
                'industry_link' =>  get_sub_field('industry_link'),
            ];
        endwhile;

        if (empty($industries)) return;

        $output .= '<li class="elsner-header-menu menu-item has-mega industries-mega">';
        $output .= '<a href="#">' . esc_html($item->title) . '</a>';
        $output .= '<div class="mega-menu">';

        /* LEFT */
        $output .= '<div class="mega-left">';
        foreach ($industries as $i => $ind) {
            $active = $i === 0 ? ' active' : '';
            $link = !empty($ind['industry_link']) 
                    ? $ind['industry_link'] 
                    : $ind['url'];

            $output .= '<a href="' . esc_url($link) . '" 
            class="mega-left-item' . $active . '" 
            data-target="industry-' . $i . '"
            data-has-link="' . (!empty($ind['industry_link']) ? 'true' : 'false') . '">';
            $output .= esc_html($ind['title']);
            $output .= '</a>';
        }
        $output .= '</div>';

        /* RIGHT (COMBINED CONTENT) */
        $output .= '<div class="mega-right">';

        foreach ($industries as $i => $ind) {
            $active = $i === 0 ? ' active' : '';
            $output .= '<div class="industry-panel' . $active . '" id="industry-' . $i . '">';

            // Image container
            if ($ind['image']) {
                $output .= '<div class="industry-image">';
                $output .= '<img src="' . esc_url($ind['image']) . '" alt="' . esc_attr($ind['title']) . '">';
                $output .= '</div>';
            }

            // Content container
            $output .= '<div class="industry-content">';
            $output .= '<h3>' . esc_html( get_the_title( $ind['page']->ID ) ) . '</h3>';
            $output .= '<p>' . esc_html($ind['excerpt']) . '</p>';
            $output .= '<a href="' . esc_url($ind['url']) . '" class="industry-btn">';
            $output .= '<span>View More</span>';
            $output .= '<svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" 
                viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                <polyline points="15 3 21 3 21 9"></polyline>
                <line x1="10" y1="14" x2="21" y2="3"></line>
            </svg>';
            $output .= '</a>';

            $output .= '</div>';

            $output .= '</div>';
        }


        $output .= '</div>'; // mega-right
        $output .= '</div>'; // mega-menu
        $output .= '</li>';
    }

    private function render_resource_mega(&$output, $item) {
        $resource_data = get_field('menu_resource_item', $item);
        if (!$resource_data) return;

        $output .= '<li class="elsner-header-menu menu-item has-mega resource-mega">';
        $output .= '<a href="#">' . esc_html($item->title) . '</a>';
        $output .= '<div class="mega-menu">';

        // 1. LEFT COLUMN: Repeater Links

        $output .= '<div class="mega-resource-left">';

        if (!empty($resource_data['resource_links'])) {

            foreach ($resource_data['resource_links'] as $link) {

                $left_id = 'left-' . sanitize_title($link['link_title']);

                $menu_link = !empty($link['url']) ? $link['url'] : '#';
                $has_link  = ($menu_link !== '#' && !empty($menu_link));

                $output .= '<a href="' . esc_url($menu_link) . '" 
                                class="mega-resource-left-item" 
                                data-target="' . esc_attr($left_id) . '" 
                                data-has-link="' . ($has_link ? 'true' : 'false') . '">';
                
                $output .= esc_html($link['link_title']);
                $output .= '</a>';
            }
        }

        $output .= '</div>'; // mega-left

        // 2. CENTER COLUMN: Image
        $output .= '<div class="mega-resource-center">';
        $output .= '<div class="mega-resource-center-image">';
        if (!empty($resource_data['resource_left_image'])) {
            $output .= '<img src="' . esc_url($resource_data['resource_left_image']) . '" alt="Resource Image">';
        }
        $output .= '</div>';
        $output .= '</div>';

        // 3. RIGHT COLUMN: Latest Posts + Redirect
        $output .= '<div class="mega-resource-right">';
        
        $latest_posts = get_posts(['posts_per_page' => 3, 'post_status' => 'publish']);
        foreach ($latest_posts as $post) {
            $output .= '<div class="mega-post-card">';
            $output .= '<div class="post-thumb"><img src="' . get_the_post_thumbnail_url($post->ID, 'thumbnail') . '"></div>';
            $output .= '<div class="post-details">';
            $output .= '<a href="' . get_permalink($post->ID) . '" class="mega-latest">' . esc_html($post->post_title) . '</a>';
            $output .= '</div></div>';
        }

        // Redirect to Blog/Listing
        $blog_url = home_url('/blog/');
        $output .= '<a href="' . esc_url($blog_url) . '" class="industry-btn">Explore More <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 12H19" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13 6L19 12L13 18" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg></a>';
        
        // Footer Image inside the right column
        // if (!empty($resource_data['resource_footer_image'])) {
        //     $output .= '<div class="mega-footer-image" style="margin-top:20px;">';
        //     $output .= '<img src="' . esc_url($resource_data['resource_footer_image']) . '" alt="Footer Ads">';
        //     $output .= '</div>';
        // }
        $output .= '</div>';

        $output .= '</div>'; // mega-menu
        $output .= '</li>';
    }

}

//sidebar menu
class SidebarMenu extends Walker_Nav_Menu
{
    var $count = 0;

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = ' class="' . esc_attr($class_names) . '"';



        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $output .= $indent . '<li data-menuanchor="' . str_replace("#", "", $value) . '">';
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= '<img  src="' . get_field('menu_icon', $item) . '" alt="sidebar icons" width="28" height="22" loading="lazy" />';
        $item_output .= '<span>' . $title . '</span>';
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }
}
class HeaderSecondMenu extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $output .= '<li>';

        if ($item->title === 'Menu') {

            $output .= '<div class="menu-left">';
            $output .= '<h6 class="Redhat-font">' . $item->title . '</h6>';
            $output .= '<ul>';
        } elseif ($item->title === 'Headquarter - India') {
            $output .= '<div class="menu-address">';
            $output .= '<h6>' . $item->title . '</h6>';
            $output .= '<address>' . $item->description . '</address>';
            $output .= '</div>';
        } elseif ($item->title === 'USA') {
            $output .= '<div class="menu-address">';
            $output .= '<h6>' . $item->title . '</h6>';
            $output .= '<div class="multiple-address">' . $item->description . '</div>';
            $output .= '</div>';
        } elseif ($item->title === 'Social Links') {
            $output .= '<div class="social-links-menu">';
            $output .= $item->description;
            $output .= '</div>';
        } elseif ($item->title === 'Image') {
            $output .= '<div class="menu-right-img">';
            $output .= '<img  src="' . $item->url . '" alt="menu-image" width="' . $item->width . '" height="' . $item->height . '"  loading="lazy" />';
            $output .= '</div>';
        } elseif ($item->title === 'Store') {
            $output .= '<a href="' . $item->url . '" target="_blank">' . $item->title . '</a>';
        } else {
            $output .= '<a href="' . $item->url . '" >' . $item->title . '</a>';
        }

        $output .= '</li>';
    }
}