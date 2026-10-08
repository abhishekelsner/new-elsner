<?php

class acf_field_nav_menu extends acf_field
{
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	public function __construct()
	{
		// vars
		$this->name = 'nav_menu';
		$this->label = __('Nav Menu');
		$this->category = __("Relational",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			'save_format' => 'id',
			'allow_null' => 0,
			'container' => 'div'
		);
		
		// do not delete!
    	parent::__construct();
    	
    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.1.2'
		);
	}
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	public function create_options( $field )
	{
		// defaults?
		$field = array_merge($this->defaults, $field);
		
		// key is needed in the field names to correctly save the data
		$key = $field['name'];
		
		
		// Create Field Options HTML
		?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Return Value",'acf'); ?></label>
	</td>
	<td>
		<?php
		
		do_action('acf/create_field', array(
			'type'		=>	'radio',
			'name'		=>	'fields['.$key.'][save_format]',
			'value'		=>	$field['save_format'],
			'layout'	=>	'horizontal',
			'choices' 	=>	array(
				'object'	=>	__("Nav Menu Object",'acf'),
				'menu'		=>	__("Nav Menu HTML",'acf'),
				'id'		=>	__("Nav Menu ID",'acf')
			)
		));
		
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Menu Container",'acf'); ?></label>
		<p class="description">What to wrap the Menu's ul with.<br />Only used when returning HTML.</p>
	</td>
	<td>
		<?php

		$choices = $this->get_allowed_nav_container_tags();
		
		do_action('acf/create_field', array(
			'type'		=>	'select',
			'name'		=>	'fields['.$key.'][container]',
			'value'		=>	$field['container'],
			'choices' 	=>	$choices
		));
		
		?>
	</td>
</tr>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Allow Null?",'acf'); ?></label>
	</td>
	<td>
		<?php 
		do_action('acf/create_field', array(
			'type'	=>	'radio',
			'name'	=>	'fields['.$key.'][allow_null]',
			'value'	=>	$field['allow_null'],
			'choices'	=>	array(
				1	=>	__("Yes",'acf'),
				0	=>	__("No",'acf'),
			),
			'layout'	=>	'horizontal',
		));
		?>
	</td>
</tr>
		<?php
	}
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	public function create_field( $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
				
		// create Field HTML
		echo sprintf( '<select id="%d" class="%s" name="%s">', $field['id'], $field['class'], $field['name']  );

		// null
		if( $field['allow_null'] )
		{
			echo '<option value=""> - Select - </option>';
		}

		// Nav Menus
		$nav_menus = $this->get_nav_menus();

		foreach( $nav_menus as $nav_menu_id => $nav_menu_name ) {
			$selected = selected( $field['value'], $nav_menu_id );
			echo sprintf( '<option value="%1$d" %3$s>%2$s</option>', $nav_menu_id, $nav_menu_name, $selected );
		}

		echo '</select>';
	}

	public function get_nav_menus() {
		$terms = get_terms('nav_menu', array('hide_empty' => false));
		$menu_items = array();
		if (!empty($terms) && is_array($terms)) {
			foreach ($terms as $term_object) {
				$menu_items[$term_object->term_id] = $term_object->name;
			}
		}
		return $menu_items;
	}

	public function get_allowed_nav_container_tags() {
		$supported_tags = apply_filters('wp_nav_menu_container_allowedtags', array('div', 'nav'));
		$container_tags_map = array(
			array('0' => 'None')
		);
		if (is_array($supported_tags)) {
			foreach ($supported_tags as $valid_tag) {
				$container_tags_map[0][$valid_tag] = ucfirst($valid_tag);
			}
		}
		return $container_tags_map;
	}
	
	public function format_value_for_api( $value, $post_id, $field )
	{
		// defaults
		$field = array_merge($this->defaults, $field);
		
		if( !$value ) {
			return false;
		}

		// check format
		if( $field['save_format'] == 'object' ) {
			$wp_menu_object = wp_get_nav_menu_object( $value );

			if( !$wp_menu_object ) {
				return false;
			}

			$menu_object = new stdClass;

			$menu_object->ID = $wp_menu_object->term_id;
			$menu_object->name = $wp_menu_object->name;
			$menu_object->slug = $wp_menu_object->slug;
			$menu_object->count = $wp_menu_object->count;

			return $menu_object;

		} elseif( $field['save_format'] == 'menu' ) {
			
			ob_start();

			wp_nav_menu( array(
				'menu' => $value,
				'container' => $field['container']
			) );
			
			return ob_get_clean();

		}
		
		return $value;
	}
}

// create field
$acf_field_nav_menu = new acf_field_nav_menu(); 
?>