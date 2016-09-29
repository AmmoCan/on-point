<?php
/*
Plugin Name: Services Post Type
Plugin URI: http://2-drops.com/
Description: A plugin that will create a custom post type for displaying Services.
Version: 1.0
Author: AmmoCan
Author URI: http://www.linkedin.com/in/ammocan
License: GPL3
*/

/*  Copyright 2016 Two Drops (email : ammo@2-Drops.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this plugin; if not, write to the following:
    
    Free Software Foundation, Inc.,
    51 Franklin St, Fifth Floor,
    Boston, MA 02110-1301 USA
*/

/*
 * Add Services Custom Post Type.
 *
 */

// Ensure the proper doctype is added to the HTML document.
if ( !function_exists( 'on_point_services_posttype' ) ) :
function on_point_services_posttype() {
  register_post_type( 'services',
    array(
      'labels' => array(
        'name' => __('Services'),
        'singular_name' => __('Service'), 
        'all_items' => __('All Services'), 
        'add_new_item' => __('Add New Service'),
        'edit_item' => __('Edit Service'), 
        'view_item' => __('View Service')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'services'),
      'show_ui' => true, 
      'show_in_menu' => true, 
      'show_in_nav_menus' => true,
      'capability_type' => 'post', 
      'supports' => array('title', 'editor', 'thumbnail'), 
      'exclude_from_search' => true, 
      'menu_position' => 20, 
      'has_archive' => true, 
      'menu_icon' => 'dashicons-hammer'
    )
  );
}
add_action( 'init', 'on_point_services_posttype');
endif;

// Place new meta box above page editor
if ( !function_exists( 'on_point_services_metabox_context' ) ):
add_action( 'edit_form_after_title', 'on_point_services_metabox_context' );
function on_point_services_metabox_context( ) {
  
  # Get the globals:
  global $post, $wp_meta_boxes;

  # Output the "advanced" meta boxes:
  do_meta_boxes( get_current_screen(), 'service_metabox_holder', $post );

  # Remove the initial "advanced" meta boxes:
  unset($wp_meta_boxes['post']['service_metabox_holder']);
    
}
endif;

// Set up meta box
if ( !function_exists( 'on_point_services_meta_box' ) ) :
add_action( 'add_meta_boxes', 'on_point_services_meta_box' );
function on_point_services_meta_box() {
  
  add_meta_box( 'on_point_service_meta_box', 'Service Details', 'on_point_service_form', 'services', 'service_metabox_holder', 'high' );

}
endif;

if ( !function_exists( 'on_point_service_form' ) ) :
function on_point_service_form() {
  global $post;
  $values = get_post_custom( $post->ID );
  $service_icon = isset( $values['service_icon'] ) ? esc_attr( $values['service_icon'][0] ) : '';
  
  wp_nonce_field( 'services_nonce', 'service_nonce' );
?>
  <div>
    <label for="service_icon">FontAwesome Icon</label>
    <input type="text" name="service_icon" id="service_icon" style="margin-top:15px; margin-left:9px; margin-bottom:10px;" value="<?php echo $service_icon; ?>" /><br />
  </div>
<?php
}
endif;

if ( !function_exists( 'on_point_service_save_meta' ) ) :
add_action( 'save_post', 'on_point_service_save_meta', 10, 2 );
function on_point_service_save_meta( $post_id ) {
  
  // Bail if we're doing an auto save
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

  // if our nonce isn't there, or we can't verify it, bail
  if ( !isset( $_POST['service_nonce'] ) || !wp_verify_nonce( $_POST['service_nonce'], 'services_nonce' ) ) return;

  // if our current user can't edit this post, bail
  if ( !current_user_can( 'edit_post' ) ) return;

    if (isset( $_POST['service_icon'] ) )
        update_post_meta( $post_id, 'service_icon', esc_attr( $_POST['service_icon'] ) );
}
endif;
 
?>