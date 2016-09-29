<?php
/*
Plugin Name: Testimonials Post Type
Plugin URI: https://github.com/AmmoCan/on-point/blob/master/plugins/testimonial-posttype.php
Description: A plugin that will create a custom post type for displaying Testimonials.
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
 * Add Testimonials Custom Post Type.
 *
 */

// Ensure the proper doctype is added to the HTML document.
if ( !function_exists( 'on_point_testimonials_posttype' ) ) :
function on_point_testimonials_posttype() {
  register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => __('Testimonials'),
        'singular_name' => __('Testimonial'), 
        'all_items' => __('All Testimonials'), 
        'add_new_item' => __('Add New Testimonial'),
        'edit_item' => __('Edit Testimonial'), 
        'view_item' => __('View Testimonial')
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'testimonials'),
      'show_ui' => true, 
      'show_in_menu' => true, 
      'show_in_nav_menus' => true,
      'capability_type' => 'post', 
      'supports' => array('title', 'editor', 'thumbnail'), 
      'exclude_from_search' => true, 
      'menu_position' => 20, 
      'has_archive' => true, 
      'menu_icon' => 'dashicons-format-status'
    )
  );
}
add_action( 'init', 'on_point_testimonials_posttype');
endif;

// Place new meta box above page editor
if ( !function_exists( 'on_point_testimonials_metabox_context' ) ):
add_action( 'edit_form_after_title', 'on_point_testimonials_metabox_context' );
function on_point_testimonials_metabox_context( ) {
  
  # Get the globals:
  global $post, $wp_meta_boxes;

  # Output the "advanced" meta boxes:
  do_meta_boxes( get_current_screen(), 'testimonial_metabox_holder', $post );

  # Remove the initial "advanced" meta boxes:
  unset($wp_meta_boxes['post']['testimonial_metabox_holder']);
    
}
endif;

// Set up meta box
if ( !function_exists( 'on_point_testimonials_meta_box' ) ) :
add_action( 'add_meta_boxes', 'on_point_testimonials_meta_box' );
function on_point_testimonials_meta_box() {
  add_meta_box( 'on_point_testimonial_meta_box', 'Testimonial Details', 'on_point_testimonial_form', 'testimonials', 'testimonial_metabox_holder', 'high' );
}
endif;

if ( !function_exists( 'on_point_testimonial_form' ) ) :
function on_point_testimonial_form() {
  global $post;
  $values = get_post_custom( $post->ID );
  $client_name = isset( $values['client_name'] ) ? esc_attr( $values['client_name'][0] ) : '';
  $company = isset( $values['company'] ) ? esc_attr( $values['company'][0] ) : '';
  $link = isset( $values['link'] ) ? esc_attr( $values['link'][0] ) : '';
  
  wp_nonce_field( 'testimonials_nonce', 'testimonial_nonce' );
?>
  <div>
    <label for="client_name">Client Name</label>
    <input type="text" name="client_name" id="client_name" style="margin-top:15px; margin-left:9px; margin-bottom:10px;" value="<?php echo $client_name; ?>" /><br />
    <label for="company">Company</label>
    <input type="text" name="company" id="company" style="margin-left:25px; margin-bottom:10px;" value="<?php echo $company; ?>" /><br />
    <label for="company">Link</label>
    <input type="text" name="link" id="link" style="margin-left:58px; margin-bottom:15px;" value="<?php echo $link; ?>" />
  </div>
<?php
}
endif;

if ( !function_exists( 'on_point_testimonial_save_meta' ) ) :
add_action( 'save_post', 'on_point_testimonial_save_meta', 10, 2 );
function on_point_testimonial_save_meta( $post_id ) {
  
  // Bail if we're doing an auto save
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

  // if our nonce isn't there, or we can't verify it, bail
  if ( !isset( $_POST['testimonial_nonce'] ) || !wp_verify_nonce( $_POST['testimonial_nonce'], 'testimonials_nonce' ) ) return;

  // if our current user can't edit this post, bail
  if ( !current_user_can( 'edit_post' ) ) return;

    if (isset( $_POST['client_name'] ) )
        update_post_meta( $post_id, 'client_name', esc_attr( $_POST['client_name'] ) );
        
    if (isset( $_POST['company'] ) )
        update_post_meta( $post_id, 'company', esc_attr( $_POST['company'] ) );
         
    if (isset( $_POST['link'] ) )
        update_post_meta( $post_id, 'link', esc_attr( $_POST['link'] ) );
}
endif;
 
?>
