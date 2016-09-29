<?php
/**
 * Custom function that removes class names from list tags and gives it to the anchor tags.
 */

if (!class_exists('on_point_social_navwalker')) :
class on_point_social_navwalker extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
  	global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		
		// Passed classes.
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
    
    /* Add active class */
		if ( in_array( 'menu-item', $classes ) ) {
			$classes[] = 'icon';
			unset( $classes['menu-item'] );
		}
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
    
    // Build HTML.
    $output .= $indent . '<li'. $class_names .'>';

    // Link attributes.
    $atts = array();
		$atts['title']  = ! empty( $item->title )	? $item->title	: '';
		$atts['target'] = ! empty( $item->target )	? $item->target	: '';
		$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
    $atts['href'] = ! empty( $item->url ) ? $item->url : '';
    
    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
			
		$item_output = $args->before;
		
		/*
		 * FontAwesome Icons
		 * =================
		 * We will check to see if there is a value in the attr_title property.
		 * If the attr_title property is NOT null, then we apply it as part of 
		 * the class name needed for our icon.
		 */
		if ( ! empty( $item->attr_title ) )
			$item_output .= '<a'. $attributes .'><i class="fa fa-' . esc_attr( $item->attr_title ) . '"></i>';
		else
			$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $args->has_children && 0 === $depth ) ? ' <i class="caret"></i></a>' : '</a>';
		$item_output .= $args->after;
		
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
    if ( ! $element )
      return;
    $id_field = $this->db_fields['id'];
    // Display this element.
    if ( is_object( $args[0] ) )
      $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
      parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}
endif;
?>