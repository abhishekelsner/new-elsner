<?php
add_filter( 'nav_menu_link_attributes', 'elsner_main_menu_atts', 10, 3 );
function elsner_main_menu_atts( $atts, $item, $args )
{
	if ( wp_is_mobile() ){
		if ( in_array('children', $item->classes) ){
			$atts['class'] = 'children';
			$atts['data-toggle'] = 'dropdown';
			$atts['href'] = '#';
		}
	}

  return $atts;
}

class StagingElsnerMegaMenu extends Walker_Nav_Menu 
{
    public function end_el(&$output, $item, $depth=0, $args=array()) 
    {
		$enable_mega_menu = get_field('enable_mega_menu', $item);
		if($enable_mega_menu)
		{

			$menu_items = get_field('menu_block', $item);
		
			$output .= '<div class="sub-menu child-menu">';
						
				
					if( !empty($menu_items) )
					{
						if( have_rows('menu_block',$item) )
						{ 
							$output .= '<ul class="mega-menu">';
								while( have_rows('menu_block',$item) ): the_row();
									$main_menu_link = get_sub_field('menu_link',$item);
									$output .= '<li class="children">';
													if($main_menu_link == '' || $main_menu_link == '#'){
														$output .= '<a class="no-link"><span>
															<img  src="'.get_sub_field('menu_icon',$item).'">
															'.get_sub_field("menu_title",$item).'
														</span></a>';	
													}else{
														$output .= '<a href="'.$main_menu_link.'">
															<img  src="'.get_sub_field('menu_icon',$item).'">
															'.get_sub_field("menu_title",$item).'
														</a>';
													} ?>

													<?php if( have_rows('menu_items',$item) ){
															$output .= '<ul class="sub-menu child-menu-2">';
																while( have_rows('menu_items',$item) ): the_row();
								                                    $output .= '<li>
											                                    	<a href="'.get_sub_field('page',$item).'">
											                                        	'.get_sub_field('page_title',$item).'
											                                        </a>
											                                    </li>';
																endwhile; //menu_items
															$output .= '</ul>';
														} // menu_items 
									$output .= '</li>';
								endwhile; // menu_block 
							$output .= '</ul>';
						} // menu_block
					}

					$output .= '<div class="side-content-wrapper">
								<div class="side-content">
									<h4>'.get_field('mm_title','option').'</h4>
										<div class="blue-btn">
										<a href="'.get_field('mm_button_link','option').'">'.get_field('mm_button_title','option').'</a>
									</div>
								</div>
							</div>';

			$output .= '</div>';


		}		
	}
}